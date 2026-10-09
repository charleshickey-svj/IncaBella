<?php
/**
 * The "Send my list" and contact forms: emails each enquiry to Lucy and keeps a copy under
 * IncaBella → Enquiries, so nothing is lost if an email goes astray.
 */

defined( 'ABSPATH' ) || exit;

/** Where enquiries are emailed (IncaBella → Enquiry email). */
function ib_enquiry_email() {
	$email = get_option( 'ib_enquiry_email' );
	return is_email( $email ) ? $email : 'Lucy@incabella.co.uk';
}

add_action(
	'init',
	function () {
		register_post_type(
			'ib_enquiry',
			array(
				'labels'       => array(
					'name'          => 'Enquiries',
					'singular_name' => 'Enquiry',
					'all_items'     => 'Enquiries',
					'edit_item'     => 'Enquiry',
					'not_found'     => 'No enquiries yet.',
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_menu' => 'incabella',
				'supports'     => array( 'title', 'editor' ),
				'capabilities' => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap' => true,
			)
		);
	}
);

/** A hire item with its current price (including any dashboard change). */
function ib_current_product( $slug ) {
	$products = ib_default_products();
	if ( ! isset( $products[ $slug ] ) ) {
		return null;
	}
	$p     = $products[ $slug ];
	$edits = ib_product_edits();
	if ( isset( $edits[ $slug ]['price'] ) ) {
		$p['price'] = (float) $edits[ $slug ]['price'];
	}
	return $p;
}

/** Same format as the site: £25, £10.50, £1,000. */
function ib_money( $n ) {
	return '£' . number_format( (float) $n, fmod( (float) $n, 1 ) ? 2 : 0 );
}

function ib_enquiry_field( $name, $multiline = false ) {
	// phpcs:ignore WordPress.Security.NonceVerification -- public form; checked by ib_enquiry_handler().
	$value = isset( $_POST[ $name ] ) ? wp_unslash( $_POST[ $name ] ) : '';
	return $multiline ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
}

function ib_enquiry_handler() {
	// Simple flood protection: at most 10 enquiries an hour from one address.
	$ip    = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key   = 'ib_enq_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= 10 ) {
		wp_send_json_error( 'busy', 429 );
	}
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	$type  = 'contact' === ib_enquiry_field( 'type' ) ? 'contact' : 'list';
	$email = sanitize_email( ib_enquiry_field( 'email' ) );
	$phone = ib_enquiry_field( 'phone' );
	$date  = ib_enquiry_field( 'date' );
	$when  = $date && strtotime( $date ) ? wp_date( 'l j F Y', strtotime( $date . ' 12:00:00' ) ) : '';

	if ( ! is_email( $email ) || '' === $phone ) {
		wp_send_json_error( 'invalid', 400 );
	}

	if ( 'list' === $type ) {
		$names   = ib_enquiry_field( 'names' );
		$guests  = ib_enquiry_field( 'guests' );
		$flowers = '' !== ib_enquiry_field( 'flowers' );
		$notes   = ib_enquiry_field( 'notes', true );
		$items   = json_decode( ib_enquiry_field( 'items' ), true );
		$items   = is_array( $items ) ? $items : array();

		$lines = array();
		$total = 0;
		foreach ( $items as $slug => $qty ) {
			$p   = ib_current_product( (string) $slug );
			$qty = max( 0, min( 999, (int) $qty ) );
			if ( ! $p || ! $qty ) {
				continue;
			}
			$unit    = ! empty( $p['unit'] ) && 'each' !== $p['unit'] ? $p['unit'] : 'each';
			$lines[] = sprintf( '%d × %s (%s %s) = %s', $qty, $p['name'], ib_money( $p['price'] ), $unit, ib_money( $p['price'] * $qty ) );
			$total  += $p['price'] * $qty;
		}

		if ( '' === $names || '' === $when || ( ! $lines && ! $flowers ) ) {
			wp_send_json_error( 'invalid', 400 );
		}

		$subject = 'Wedding list from ' . $names . ( $when ? ' – ' . $when : '' );
		$body    = "New wedding list from the website.\n\n" .
			"Names: $names\nEmail: $email\nPhone: $phone\nWedding date: $when\n" .
			'Guests: ' . ( '' !== $guests ? $guests : 'not given' ) . "\nVenue: Sopley Mill, Christchurch\n" .
			'Wants to talk about flowers: ' . ( $flowers ? 'Yes' : 'No' ) . "\n\n" .
			( $lines ? "Items:\n" . implode( "\n", $lines ) . "\n\nEstimated total: " . ib_money( $total ) . "\n" : "No hire items, just flowers.\n" ) .
			( '' !== $notes ? "\nAnything else:\n$notes\n" : '' );
		$who     = $names;
	} else {
		$name    = ib_enquiry_field( 'name' );
		$topic   = ib_enquiry_field( 'topic' );
		$message = ib_enquiry_field( 'message', true );
		if ( '' === $name || '' === $message ) {
			wp_send_json_error( 'invalid', 400 );
		}
		$subject = 'Website message from ' . $name . ( $topic ? ' – ' . $topic : '' );
		$body    = "New message from the website contact form.\n\n" .
			"Name: $name\nEmail: $email\nPhone: $phone\nWedding date: " . ( $when ? $when : 'not given' ) . "\nAbout: $topic\n\n" .
			"Message:\n$message\n";
		$who     = $name;
	}

	$body .= "\nReply to this email to answer " . $who . ' directly.';

	$sent = wp_mail( ib_enquiry_email(), $subject, $body, array( 'Reply-To: ' . $who . ' <' . $email . '>' ) );

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'ib_enquiry',
			'post_status'  => 'private',
			'post_title'   => $subject,
			'post_content' => $body,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_ib_emailed', $sent ? 'yes' : 'no' );
	}

	if ( ! $sent && ( ! $post_id || is_wp_error( $post_id ) ) ) {
		wp_send_json_error( 'failed', 500 );
	}
	wp_send_json_success();
}
add_action( 'wp_ajax_ib_enquiry', 'ib_enquiry_handler' );
add_action( 'wp_ajax_nopriv_ib_enquiry', 'ib_enquiry_handler' );

/* ---------- dashboard ---------- */

add_filter(
	'manage_ib_enquiry_posts_columns',
	function ( $columns ) {
		return array(
			'cb'         => $columns['cb'],
			'title'      => 'Enquiry',
			'ib_emailed' => 'Emailed to you?',
			'date'       => 'Received',
		);
	}
);

add_action(
	'manage_ib_enquiry_posts_custom_column',
	function ( $column, $post_id ) {
		if ( 'ib_emailed' === $column ) {
			echo 'no' === get_post_meta( $post_id, '_ib_emailed', true ) ? '<strong style="color:#b32d2e">No, the email failed</strong>' : 'Yes';
		}
	},
	10,
	2
);
