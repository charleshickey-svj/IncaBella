<?php
/**
 * The enquiry form on the Contact page: emails Lucy and keeps a copy under "Enquiries".
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

function ib_enquiry_topics() {
	return array( 'Hire items', 'Flowers', 'A decoration package', 'Visiting to see the hire items', 'Something else' );
}

add_action( 'init', 'ib_register_enquiries' );
function ib_register_enquiries() {
	register_post_type(
		'ib_enquiry',
		array(
			'labels'          => array(
				'name'          => 'Enquiries',
				'singular_name' => 'Enquiry',
				'edit_item'     => 'Enquiry',
				'all_items'     => 'All enquiries',
				'not_found'     => 'No enquiries yet',
				'search_items'  => 'Search enquiries',
			),
			'public'          => false,
			'show_ui'         => true,
			'menu_position'   => 6,
			'menu_icon'       => 'dashicons-email-alt',
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}

add_action( 'admin_post_nopriv_ib_enquiry', 'ib_handle_enquiry' );
add_action( 'admin_post_ib_enquiry', 'ib_handle_enquiry' );
function ib_handle_enquiry() {
	$back = ib_page_url( 'contact' );
	$get  = function ( $key ) {
		return isset( $_POST[ $key ] ) ? trim( sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) ) : '';
	};

	// Spam traps: a hidden field people never fill in, and forms sent too fast to be human.
	$started = (int) $get( 'ib_started' );
	if ( '' !== $get( 'website' ) || ( $started && time() - $started < 3 ) ) {
		wp_safe_redirect( add_query_arg( 'enquiry', 'sent', $back ) . '#enquiry' );
		exit;
	}

	$data = array(
		'name'    => $get( 'name' ),
		'phone'   => $get( 'phone' ),
		'email'   => sanitize_email( $get( 'email' ) ),
		'date'    => $get( 'date' ),
		'topic'   => in_array( $get( 'topic' ), ib_enquiry_topics(), true ) ? $get( 'topic' ) : 'Something else',
		'message' => isset( $_POST['message'] ) ? trim( sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) ) : '',
		'item'    => (int) $get( 'item' ),
	);

	if ( ! $data['name'] || ! $data['phone'] || ! is_email( $data['email'] ) || ! $data['message'] ) {
		wp_safe_redirect( add_query_arg( 'enquiry', 'missing', $back ) . '#enquiry' );
		exit;
	}

	$date_text = '';
	if ( $data['date'] && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $data['date'] ) ) {
		$date_text = wp_date( 'l j F Y', strtotime( $data['date'] . ' 12:00:00' ) );
	}
	$item_text = '';
	if ( $data['item'] && 'ib_product' === get_post_type( $data['item'] ) ) {
		$item_text = get_the_title( $data['item'] ) . ' (' . get_permalink( $data['item'] ) . ')';
	}

	$lines = array(
		'Name: ' . $data['name'],
		'Email: ' . $data['email'],
		'Phone: ' . $data['phone'],
		'Wedding date: ' . ( $date_text ? $date_text : 'Not given' ),
		'About: ' . $data['topic'],
	);
	if ( $item_text ) {
		$lines[] = 'Hire item: ' . $item_text;
	}
	$body = implode( "\n", $lines ) . "\n\nMessage:\n" . $data['message'];

	// Keep a copy in the dashboard so nothing is lost if an email goes astray.
	$enquiry_id = wp_insert_post(
		array(
			'post_type'    => 'ib_enquiry',
			'post_status'  => 'publish',
			'post_title'   => $data['name'] . ' · ' . $data['topic'],
			'post_content' => wpautop( esc_html( $body ) ),
		)
	);
	foreach ( array( 'email', 'phone', 'date', 'topic' ) as $k ) {
		update_post_meta( $enquiry_id, '_ib_' . $k, $data[ $k ] );
	}

	$to      = ib_opt( 'email' );
	$subject = 'Website enquiry from ' . $data['name'] . ' · ' . $data['topic'];
	$headers = array( 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>' ), '', $data['name'] ) . ' <' . $data['email'] . '>' );
	$sent    = wp_mail( $to, $subject, $body . "\n\n—\nSent from the enquiry form on " . home_url( '/' ), $headers );
	update_post_meta( $enquiry_id, '_ib_emailed', $sent ? 'yes' : 'no' );

	// Remember who to thank on the next page, without putting their email in the address bar.
	$ref = wp_generate_password( 12, false );
	set_transient( 'ib_enquiry_' . $ref, $data['email'], 15 * MINUTE_IN_SECONDS );

	wp_safe_redirect( add_query_arg( array( 'enquiry' => 'sent', 'ref' => $ref ), $back ) . '#enquiry' );
	exit;
}

/** Email address of the person who just sent an enquiry, if we still know it. */
function ib_enquiry_sender() {
	$ref = isset( $_GET['ref'] ) ? sanitize_key( $_GET['ref'] ) : '';
	return $ref ? get_transient( 'ib_enquiry_' . $ref ) : '';
}

/* Enquiries list in the dashboard. */
add_filter( 'manage_ib_enquiry_posts_columns', 'ib_enquiry_columns' );
function ib_enquiry_columns( $cols ) {
	return array(
		'cb'         => $cols['cb'],
		'title'      => 'From',
		'ib_email'   => 'Email',
		'ib_phone'   => 'Phone',
		'ib_wedding' => 'Wedding date',
		'ib_emailed' => 'Emailed to you',
		'date'       => 'Received',
	);
}

add_action( 'manage_ib_enquiry_posts_custom_column', 'ib_enquiry_column', 10, 2 );
function ib_enquiry_column( $col, $id ) {
	if ( 'ib_email' === $col ) {
		$email = get_post_meta( $id, '_ib_email', true );
		echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
	} elseif ( 'ib_phone' === $col ) {
		echo esc_html( get_post_meta( $id, '_ib_phone', true ) );
	} elseif ( 'ib_wedding' === $col ) {
		$d = get_post_meta( $id, '_ib_date', true );
		echo esc_html( $d ? wp_date( 'j M Y', strtotime( $d . ' 12:00:00' ) ) : '–' );
	} elseif ( 'ib_emailed' === $col ) {
		echo 'no' === get_post_meta( $id, '_ib_emailed', true ) ? '<strong style="color:#b32d2e">Email failed – see guide</strong>' : 'Yes';
	}
}

/* Show a bubble with the number of enquiries from the last 7 days. */
add_action( 'admin_menu', 'ib_enquiry_count_bubble', 99 );
function ib_enquiry_count_bubble() {
	global $menu;
	$recent = get_posts(
		array(
			'post_type'      => 'ib_enquiry',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'date_query'     => array( array( 'after' => '7 days ago' ) ),
		)
	);
	if ( ! $recent ) {
		return;
	}
	foreach ( $menu as $i => $item ) {
		if ( 'edit.php?post_type=ib_enquiry' === $item[2] ) {
			$menu[ $i ][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . count( $recent ) . '</span></span>';
		}
	}
}
