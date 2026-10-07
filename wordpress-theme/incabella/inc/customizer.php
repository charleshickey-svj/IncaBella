<?php
/**
 * Appearance → Customise: contact details, page photos and reviews.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', 'ib_customize' );
function ib_customize( $wp ) {
	$wp->add_panel( 'ib_panel', array( 'title' => 'IncaBella', 'priority' => 20 ) );

	/* Contact details */
	$wp->add_section( 'ib_contact', array( 'title' => 'Contact details', 'panel' => 'ib_panel', 'priority' => 10 ) );
	$fields = array(
		'email'     => array( 'Email (enquiries are sent here)', 'email', 'sanitize_email' ),
		'phone'     => array( 'Phone', 'text', 'sanitize_text_field' ),
		'address'   => array( 'Address (one line per row)', 'textarea', 'sanitize_textarea_field' ),
		'instagram' => array( 'Instagram link', 'url', 'esc_url_raw' ),
		'facebook'  => array( 'Facebook link', 'url', 'esc_url_raw' ),
	);
	$defaults = ib_defaults();
	foreach ( $fields as $key => $f ) {
		$wp->add_setting( 'ib_' . $key, array( 'default' => $defaults[ $key ], 'sanitize_callback' => $f[2] ) );
		$wp->add_control( 'ib_' . $key, array( 'label' => $f[0], 'type' => $f[1], 'section' => 'ib_contact' ) );
	}

	/* Page photos */
	$sections = array(
		'home'    => 'Home page photos',
		'flowers' => 'Flowers page photos',
		'hire'    => 'Hire page photo',
		'about'   => 'About page photos',
	);
	$priority = 20;
	foreach ( $sections as $id => $title ) {
		$wp->add_section(
			'ib_photos_' . $id,
			array(
				'title'       => $title,
				'panel'       => 'ib_panel',
				'priority'    => $priority++,
				'description' => 'Click “Change image” to pick a photo from your Media Library or upload a new one, then click Publish. “Remove” puts the original photo back.',
			)
		);
	}
	foreach ( ib_photo_slots() as $key => $slot ) {
		// The default is the theme's own photo, so the current picture shows in the panel.
		$wp->add_setting( 'ib_photo_' . $key, array( 'default' => ib_asset( 'img/site/' . $slot[2] ), 'sanitize_callback' => 'esc_url_raw' ) );
		$wp->add_control(
			new WP_Customize_Image_Control(
				$wp,
				'ib_photo_' . $key,
				array(
					'label'   => $slot[1],
					'section' => 'ib_photos_' . $slot[0],
				)
			)
		);
	}

	/* Reviews */
	$wp->add_section(
		'ib_reviews',
		array(
			'title'       => 'Reviews (home page)',
			'panel'       => 'ib_panel',
			'priority'    => 40,
			'description' => 'Add real reviews from couples. The “Kind words” section only appears on the home page once at least one review is filled in.',
		)
	);
	for ( $i = 1; $i <= 3; $i++ ) {
		$wp->add_setting( 'ib_review_' . $i . '_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field' ) );
		$wp->add_control( 'ib_review_' . $i . '_text', array( 'label' => 'Review ' . $i, 'type' => 'textarea', 'section' => 'ib_reviews' ) );
		$wp->add_setting( 'ib_review_' . $i . '_name', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp->add_control(
			'ib_review_' . $i . '_name',
			array(
				'label'       => 'Review ' . $i . ': names and date',
				'type'        => 'text',
				'section'     => 'ib_reviews',
				'input_attrs' => array( 'placeholder' => 'e.g. Sophie & Tom · June 2025' ),
			)
		);
	}
}

/** Reviews Lucy has filled in. */
function ib_reviews() {
	$out = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$text = trim( (string) get_theme_mod( 'ib_review_' . $i . '_text', '' ) );
		if ( '' !== $text ) {
			$out[] = array( 'text' => $text, 'name' => get_theme_mod( 'ib_review_' . $i . '_name', '' ) );
		}
	}
	return $out;
}
