<?php
/**
 * "My list": couples collect hire items in their browser, then send the list to Lucy.
 * The list is emailed to Lucy, a copy is kept under "Enquiries", and the couple gets a confirmation.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

/** Plain-text name of a hire item (titles are stored with HTML entities). */
function ib_plain_title( $id ) {
	return html_entity_decode( get_the_title( $id ), ENT_QUOTES, 'UTF-8' );
}

/** "£10 each", "From £695 per room" in plain text. */
function ib_price_text( $id ) {
	$unit = get_post_meta( $id, '_ib_unit', true );
	return ( get_post_meta( $id, '_ib_from', true ) ? 'From ' : '' ) . ib_money( ib_product_price( $id ) ) . ' ' . ( $unit ? $unit : 'each' );
}

/** Every published hire item, for the My List page to build the list from. */
function ib_list_catalogue() {
	$out = array();
	foreach ( ib_get_products() as $p ) {
		$out[] = array(
			'id'    => $p->ID,
			'name'  => ib_plain_title( $p->ID ),
			'price' => ib_product_price( $p->ID ),
			'unit'  => (string) get_post_meta( $p->ID, '_ib_unit', true ),
			'from'  => (bool) get_post_meta( $p->ID, '_ib_from', true ),
			'img'   => ib_product_photo_url( $p->ID, 'thumbnail' ),
			'url'   => get_permalink( $p ),
		);
	}
	return $out;
}

/** "Add to my list" button. The name and photo are for the "Added to your list" panel. */
function ib_add_button( $id, $qty_from = '' ) {
	return '<button class="add-btn" type="button" data-add="' . (int) $id . '" data-name="' . esc_attr( get_the_title( $id ) ) . '" data-img="' . esc_url( ib_product_photo_url( $id, 'thumbnail' ) ) . '"' .
		( $qty_from ? ' data-qty-from="' . esc_attr( $qty_from ) . '"' : '' ) . '>Add to my list</button>';
}

/* Sites set up before "My list" existed get the page added once. */
add_action( 'admin_init', 'ib_add_list_page' );
function ib_add_list_page() {
	if ( ! get_option( 'ib_setup_done' ) || get_option( 'ib_list_page_done' ) ) {
		return;
	}
	if ( ! get_page_by_path( 'list' ) ) {
		wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => 'My list',
				'post_name'   => 'list',
			)
		);
	}
	update_option( 'ib_list_page_done', 1 );
}

add_action( 'admin_post_nopriv_ib_list', 'ib_handle_list' );
add_action( 'admin_post_ib_list', 'ib_handle_list' );
function ib_handle_list() {
	$back = ib_page_url( 'list' );
	$get  = function ( $key ) {
		return isset( $_POST[ $key ] ) ? trim( sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) ) : '';
	};

	// Spam traps: a hidden field people never fill in, and forms sent too fast to be human.
	$started = (int) $get( 'ib_started' );
	if ( '' !== $get( 'website' ) || ( $started && time() - $started < 3 ) ) {
		wp_safe_redirect( add_query_arg( 'list', 'sent', $back ) );
		exit;
	}

	// Only the item IDs and quantities come from the browser; names and prices are read here.
	$raw   = isset( $_POST['items'] ) ? json_decode( wp_unslash( $_POST['items'] ), true ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$items = array();
	foreach ( is_array( $raw ) ? array_slice( $raw, 0, 100, true ) : array() as $id => $qty ) {
		$id  = absint( $id );
		$qty = min( 999, absint( $qty ) );
		if ( $id && $qty && 'ib_product' === get_post_type( $id ) && 'publish' === get_post_status( $id ) ) {
			$items[ $id ] = $qty;
		}
	}

	$data = array(
		'names'   => $get( 'names' ),
		'email'   => sanitize_email( $get( 'email' ) ),
		'phone'   => $get( 'phone' ),
		'date'    => $get( 'date' ),
		'guests'  => absint( $get( 'guests' ) ),
		'flowers' => ! empty( $_POST['flowers'] ),
		'notes'   => isset( $_POST['notes'] ) ? trim( sanitize_textarea_field( wp_unslash( $_POST['notes'] ) ) ) : '',
	);
	$date_ok = (bool) preg_match( '/^\d{4}-\d{2}-\d{2}$/', $data['date'] );

	if ( ! $data['names'] || ! is_email( $data['email'] ) || ! $data['phone'] || ! $date_ok || ( ! $items && ! $data['flowers'] ) ) {
		wp_safe_redirect( add_query_arg( 'list', 'missing', $back ) );
		exit;
	}

	$date_text = wp_date( 'l j F Y', strtotime( $data['date'] . ' 12:00:00' ) );
	$total     = 0;
	$from      = false;
	$lines     = array();
	foreach ( $items as $id => $qty ) {
		$line   = ib_product_price( $id ) * $qty;
		$total += $line;
		$from   = $from || get_post_meta( $id, '_ib_from', true );
		$lines[] = $qty . ' × ' . ib_plain_title( $id ) . ' (' . ib_price_text( $id ) . ') = ' . ib_money( $line );
	}
	if ( $data['flowers'] ) {
		$lines[] = 'A chat about flowers';
	}
	$total_text = $items ? ( $from ? 'From ' : '' ) . ib_money( $total ) : '';
	$count      = array_sum( $items );

	$about = array(
		'Names: ' . $data['names'],
		'Email: ' . $data['email'],
		'Phone: ' . $data['phone'],
		'Wedding date: ' . $date_text,
		'Guests: ' . ( $data['guests'] ? $data['guests'] : 'Not given' ),
		'Venue: Sopley Mill',
	);
	$body = implode( "\n", $about ) . "\n\nTheir list:\n" . implode( "\n", $lines ) .
		( $total_text ? "\n\nEstimated total: " . $total_text : '' ) .
		( $data['notes'] ? "\n\nNotes:\n" . $data['notes'] : '' );

	$summary = $items ? $count . ' ' . ( 1 === $count ? 'item' : 'items' ) . ', ' . $total_text : 'flowers';

	// Keep a copy in the dashboard so nothing is lost if an email goes astray.
	$enquiry_id = wp_insert_post(
		array(
			'post_type'    => 'ib_enquiry',
			'post_status'  => 'publish',
			'post_title'   => $data['names'] . ' · Wedding list (' . $summary . ')',
			'post_content' => wpautop( esc_html( $body ) ),
		)
	);
	update_post_meta( $enquiry_id, '_ib_email', $data['email'] );
	update_post_meta( $enquiry_id, '_ib_phone', $data['phone'] );
	update_post_meta( $enquiry_id, '_ib_date', $data['date'] );
	update_post_meta( $enquiry_id, '_ib_topic', 'Wedding list' );

	$lucy    = ib_opt( 'email' );
	$subject = 'Wedding list from ' . $data['names'] . ' · ' . wp_date( 'j M Y', strtotime( $data['date'] . ' 12:00:00' ) ) . ' (' . $summary . ')';
	$headers = array( 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>', ',' ), '', $data['names'] ) . ' <' . $data['email'] . '>' );
	$sent    = wp_mail( $lucy, $subject, $body . "\n\n—\nSent from My List on " . home_url( '/' ), $headers );
	update_post_meta( $enquiry_id, '_ib_emailed', $sent ? 'yes' : 'no' );

	// The couple's copy carries only what this site wrote (no names or notes), so the form can't be used to email strangers.
	$copy = "Thank you for sending your wedding list to IncaBella.\n\n" .
		'Lucy will check what is available for ' . $date_text . " and reply with a quote, usually within two working days. There is nothing to pay yet.\n\n" .
		"Your list:\n" . implode( "\n", $lines ) .
		( $total_text ? "\n\nEstimated total: " . $total_text . "\nLucy will confirm your final price." : '' ) .
		"\n\nIf anything changes, just reply to this email.\n\nIncaBella Floristry & Wedding Hire\n" . ib_opt( 'phone' ) . "\n" . home_url( '/' );
	wp_mail( $data['email'], 'Your wedding list for IncaBella', $copy, array( 'Reply-To: IncaBella <' . $lucy . '>' ) );

	// Remember what to show on the thank-you page, without putting it in the address bar.
	$ref = wp_generate_password( 12, false );
	set_transient(
		'ib_list_' . $ref,
		array(
			'email' => $data['email'],
			'date'  => $date_text,
			'lines' => $lines,
			'total' => $total_text,
		),
		15 * MINUTE_IN_SECONDS
	);

	wp_safe_redirect( add_query_arg( array( 'list' => 'sent', 'ref' => $ref ), $back ) );
	exit;
}

/** What the couple just sent, if we still know it. */
function ib_list_sent() {
	$ref = isset( $_GET['ref'] ) ? sanitize_key( $_GET['ref'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$got = $ref ? get_transient( 'ib_list_' . $ref ) : false;
	return is_array( $got ) ? $got : array();
}
