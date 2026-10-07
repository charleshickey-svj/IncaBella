<?php
/**
 * Small helpers shared by the templates.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

/** URL of a file in the theme's assets folder. */
function ib_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/** Link to one of the site's pages by its slug ("about", "hire" …), or the home page. */
function ib_page_url( $slug = '' ) {
	if ( '' === $slug || 'home' === $slug ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/** Contact page link that pre-fills the enquiry form. */
function ib_enquire_url( $args = array() ) {
	$url = ib_page_url( 'contact' );
	if ( $args ) {
		$url = add_query_arg( $args, $url );
	}
	return $url . '#enquiry';
}

/** A setting from Appearance → Customise, falling back to the theme default. */
function ib_opt( $key ) {
	$defaults = ib_defaults();
	return get_theme_mod( 'ib_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/** Default contact details. */
function ib_defaults() {
	return array(
		'email'     => 'Lucy@incabella.co.uk',
		'phone'     => '07946 471707',
		'address'   => "Sopley Mill, Mill Lane\nNr Christchurch\nDorset, BH23 7AU",
		'instagram' => 'https://www.instagram.com/incabella_/',
		'facebook'  => 'https://www.facebook.com/incabellaweddinghire/',
	);
}

/** The phone number in tel: link form. */
function ib_phone_href() {
	$digits = preg_replace( '/[^0-9+]/', '', ib_opt( 'phone' ) );
	if ( 0 === strpos( $digits, '0' ) ) {
		$digits = '+44' . substr( $digits, 1 );
	}
	return 'tel:' . $digits;
}

/**
 * Page photos editable in Appearance → Customise.
 * key => array( section, label, default file in assets/img/site, alt text ).
 */
function ib_photo_slots() {
	return array(
		'hero_1'                => array( 'home', 'Home: slideshow photo 1', 'hero.jpg', 'Jugs of home-grown wildflowers along a rustic wedding table' ),
		'hero_2'                => array( 'home', 'Home: slideshow photo 2', 'ceremony.jpg', 'The ceremony room at Sopley Mill dressed with lanterns and olive trees' ),
		'hero_3'                => array( 'home', 'Home: slideshow photo 3', 'long-table.jpg', 'Long tables dressed with greenery garlands and candles' ),
		'hero_4'                => array( 'home', 'Home: slideshow photo 4', 'chess.jpg', 'Giant chess and deckchairs on the lawn' ),
		'home_flowers_main'     => array( 'home', 'Home: "Flowers" section, large photo', 'bouquets.jpg', 'Bridesmaids holding white rose bouquets' ),
		'home_flowers_inset'    => array( 'home', 'Home: "Flowers" section, small photo', 'vase-pink.jpg', '' ),
		'home_hire_main'        => array( 'home', 'Home: "Wedding hire" section, large photo', 'ceremony.jpg', 'Sopley Mill ceremony room dressed with lanterns and olive trees' ),
		'home_hire_inset'       => array( 'home', 'Home: "Wedding hire" section, small photo', 'crates.jpg', '' ),
		'home_banner'           => array( 'home', 'Home: "Getting married at Sopley Mill?" banner', 'river-window.jpg', '' ),
		'flowers_hero'          => array( 'flowers', 'Flowers: top banner', 'bouquets.jpg', 'Bridesmaids holding white rose and greenery bouquets' ),
		'flowers_arranged'      => array( 'flowers', 'Flowers: "Arranged flowers", large photo', 'delphinium-bouquet.jpg', 'Hand-tied bouquet of pale blue delphiniums, white lisianthus and feverfew' ),
		'flowers_arranged_inset'=> array( 'flowers', 'Flowers: "Arranged flowers", small photo', 'jars-on-bench.jpg', '' ),
		'flowers_potted'        => array( 'flowers', 'Flowers: "Potted flowers & trees" photo', 'potted-aisle.jpg', 'Terracotta pots of lavender, gypsophila and seasonal flowers lining a wedding aisle' ),
		'flowers_trio_1'        => array( 'flowers', 'Flowers: bottom row, photo 1', 'wildflower-bouquet.jpg', 'Bride holding a wildflower bouquet of yarrow, daisies, sweet peas and stocks' ),
		'flowers_trio_2'        => array( 'flowers', 'Flowers: bottom row, photo 2', 'white-daisy-vase.jpg', 'White roses, feverfew and olive in a glass vase' ),
		'flowers_trio_3'        => array( 'flowers', 'Flowers: bottom row, photo 3', 'riverside-bouquet.jpg', 'White ranunculus and eucalyptus bouquet held above the river at Sopley Mill' ),
		'hire_hero'             => array( 'hire', 'Hire: top banner', 'long-table.jpg', 'Long banqueting tables dressed with greenery and candles at Sopley Mill' ),
		'about_hero'            => array( 'about', 'About: top banner', 'river-window.jpg', 'Potted flowers and a rustic table on the terrace beside the river at Sopley Mill' ),
		'about_intro'           => array( 'about', 'About: "This is IncaBella" photo', 'crate-display-mill.jpg', 'Vintage crates filled with potted lavender, cow parsley and jars of flowers' ),
		'about_mill'            => array( 'about', 'About: "Rooted at Sopley Mill" photo', 'ceremony.jpg', 'The ceremony room at Sopley Mill dressed with lanterns and olive trees' ),
		'about_banner'          => array( 'about', 'About: "See you at the Mill" banner', 'mill-lawn.jpg', '' ),
	);
}

/** URL and alt text for a page photo slot. */
function ib_photo( $key ) {
	$slots = ib_photo_slots();
	$slot  = $slots[ $key ];
	$theme = ib_asset( 'img/site/' . $slot[2] );
	$url   = get_theme_mod( 'ib_photo_' . $key );
	$alt   = $slot[3];
	if ( $url && $url !== $theme ) {
		$id = attachment_url_to_postid( $url );
		if ( $id ) {
			$custom_alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$alt        = $custom_alt ? $custom_alt : ( $alt ? get_the_title( $id ) : '' );
		}
	} else {
		$url = $theme;
	}
	return array( 'url' => $url, 'alt' => $alt );
}

/** <img> tag for a page photo slot. */
function ib_photo_img( $key, $attrs = '' ) {
	$p = ib_photo( $key );
	return '<img src="' . esc_url( $p['url'] ) . '" alt="' . esc_attr( $p['alt'] ) . '"' . ( $attrs ? ' ' . $attrs : '' ) . '>';
}

/** Turn a stored photo token into a URL: attachment IDs (Lucy's uploads) or "t:" theme files. */
function ib_token_url( $token, $size = 'large' ) {
	if ( 0 === strpos( $token, 't:' ) ) {
		return ib_asset( 'img/' . substr( $token, 2 ) );
	}
	$url = wp_get_attachment_image_url( (int) $token, $size );
	return $url ? $url : '';
}

/** Alt text for a stored photo token. */
function ib_token_alt( $token, $fallback = '' ) {
	if ( ctype_digit( (string) $token ) ) {
		$alt = get_post_meta( (int) $token, '_wp_attachment_image_alt', true );
		if ( $alt ) {
			return $alt;
		}
	}
	return $fallback;
}

/** Split a stored comma list of photo tokens. */
function ib_tokens( $value ) {
	return array_values( array_filter( array_map( 'trim', explode( ',', (string) $value ) ) ) );
}

/** Format a price like the static site: £10, £6.95, £1,000. */
function ib_money( $n ) {
	$n = (float) $n;
	return '£' . number_format( $n, fmod( $n, 1 ) ? 2 : 0 );
}

/** Flower mark: eight petals set like the spokes of Sopley Mill's wheel. */
function ib_logo_mark( $extra_class = '' ) {
	$petals = '';
	$dots   = '';
	for ( $i = 0; $i < 8; $i++ ) {
		$petals .= '<g transform="rotate(' . ( $i * 45 ) . ' 32 32)"><ellipse class="petal" style="animation-delay:' . number_format( $i * 0.07, 2 ) . 's" cx="32" cy="16.5" rx="5.2" ry="11" fill="currentColor" opacity="' . ( $i % 2 ? '0.72' : '1' ) . '"/></g>';
		$a       = deg2rad( $i * 45 + 22.5 );
		$dots   .= '<circle cx="' . number_format( 32 + 27 * sin( $a ), 2 ) . '" cy="' . number_format( 32 - 27 * cos( $a ), 2 ) . '" r="2" fill="currentColor"/>';
	}
	return '<svg class="brand-mark ' . esc_attr( $extra_class ) . '" viewBox="0 0 64 64" aria-hidden="true"><g class="petals">' . $petals . $dots . '</g><circle cx="32" cy="32" r="6.5" fill="#fff"/><circle cx="32" cy="32" r="4.2" fill="var(--rose)"/></svg>';
}

/** Small diagonal arrow used on the hero tab and map button. */
function ib_arrow() {
	return '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M4 12 12 4M5.5 4H12v6.5" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>';
}

/** Instagram and Facebook buttons. */
function ib_social_links() {
	$out = '<div class="social">';
	if ( ib_opt( 'instagram' ) ) {
		$out .= '<a href="' . esc_url( ib_opt( 'instagram' ) ) . '" target="_blank" rel="noopener" aria-label="IncaBella on Instagram"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor"/></svg></a>';
	}
	if ( ib_opt( 'facebook' ) ) {
		$out .= '<a href="' . esc_url( ib_opt( 'facebook' ) ) . '" target="_blank" rel="noopener" aria-label="IncaBella on Facebook"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7.5h2.6l.4-3h-3V8.6c0-.9.3-1.5 1.5-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21z" fill="currentColor"/></svg></a>';
	}
	return $out . '</div>';
}

/** Address lines as HTML. */
function ib_address_html() {
	return implode( '<br>', array_map( 'esc_html', array_filter( array_map( 'trim', explode( "\n", ib_opt( 'address' ) ) ) ) ) );
}

/** Which menu item is the current page. */
function ib_current_section() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_singular( 'ib_product' ) ) {
		return 'hire';
	}
	if ( is_page() ) {
		return get_post_field( 'post_name', get_queried_object_id() );
	}
	return '';
}
