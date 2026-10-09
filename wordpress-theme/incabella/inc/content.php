<?php
/**
 * Editable content: hire item prices, descriptions and photos, and the hero photos.
 *
 * The hire items themselves are defined in assets/js/products.js (the site's original file).
 * Changes made in the dashboard are stored separately and applied on top of it in the page,
 * so anything not edited is exactly as it was.
 */

defined( 'ABSPATH' ) || exit;

/* ---------- hire items ---------- */

/** Reads a JSON array assigned to window.<name> in products.js. */
function ib_products_js_value( $name ) {
	static $js = null;
	if ( null === $js ) {
		$js = (string) file_get_contents( get_template_directory() . '/assets/js/products.js' );
	}
	$pattern = 'INCABELLA_GROUPS' === $name ? '/window\.INCABELLA_GROUPS\s*=\s*(\[.*?\]);/s' : '/window\.INCABELLA_PRODUCTS\s*=\s*(\[.*\]);/s';
	if ( ! preg_match( $pattern, $js, $m ) ) {
		return array();
	}
	$value = json_decode( $m[1], true );
	return is_array( $value ) ? $value : array();
}

/** The hire items as defined in products.js, keyed by slug. */
function ib_default_products() {
	static $products = null;
	if ( null === $products ) {
		$products = array();
		foreach ( ib_products_js_value( 'INCABELLA_PRODUCTS' ) as $p ) {
			$products[ $p['slug'] ] = $p;
		}
	}
	return $products;
}

function ib_product_groups() {
	return ib_products_js_value( 'INCABELLA_GROUPS' );
}

/**
 * Dashboard changes, keyed by slug: any of
 *   price        number
 *   description  text
 *   images       list of photos: a number is an uploaded photo (Media Library id),
 *                text is one of the theme's own photos in assets/img/products/
 */
function ib_product_edits() {
	$edits = get_option( 'ib_product_edits', array() );
	return is_array( $edits ) ? $edits : array();
}

/** A hire item's photos as a list of Media Library ids and/or theme file names. */
function ib_product_images( $slug ) {
	$edits    = ib_product_edits();
	$defaults = ib_default_products();
	if ( ! empty( $edits[ $slug ]['images'] ) ) {
		return $edits[ $slug ]['images'];
	}
	return isset( $defaults[ $slug ] ) ? $defaults[ $slug ]['images'] : array();
}

/** Full web address of one hire photo. */
function ib_product_image_url( $image, $size = 'ib-product' ) {
	if ( is_int( $image ) || ctype_digit( (string) $image ) ) {
		$url = wp_get_attachment_image_url( (int) $image, $size );
		if ( $url ) {
			return $url;
		}
	}
	return get_template_directory_uri() . '/assets/img/products/' . $image;
}

/**
 * site.js builds hire photo addresses as "assets/img/products/" + name, relative to the page.
 * The pages sit at the top of the site (about.html etc.), so a name that steps back out of that
 * folder ("../../../wp-content/…") leads the browser to the real file, wherever it is stored,
 * without any change to site.js.
 */
function ib_js_image_name( $url ) {
	$home_path = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	$depth     = count( array_filter( explode( '/', $home_path . 'assets/img/products/' ) ) );
	return str_repeat( '../', $depth ) . ltrim( (string) wp_parse_url( $url, PHP_URL_PATH ), '/' );
}

/** The inline script, run straight after products.js, that applies the dashboard changes. */
function ib_product_edits_script() {
	$edits = ib_product_edits();
	$out   = array();
	foreach ( ib_default_products() as $slug => $p ) {
		$item = array(
			'images' => array_map(
				function ( $image ) {
					return ib_js_image_name( ib_product_image_url( $image ) );
				},
				ib_product_images( $slug )
			),
		);
		if ( isset( $edits[ $slug ]['price'] ) ) {
			$item['price'] = (float) $edits[ $slug ]['price'];
		}
		if ( isset( $edits[ $slug ]['description'] ) ) {
			$item['description'] = (string) $edits[ $slug ]['description'];
		}
		$out[ $slug ] = $item;
	}
	return '(function (edits) {' . "\n" .
		'  window.INCABELLA_PRODUCTS.forEach(function (p) { var e = edits[p.slug]; if (e) for (var k in e) p[k] = e[k]; });' . "\n" .
		'})(' . wp_json_encode( (object) $out, JSON_UNESCAPED_UNICODE ) . ');';
}

/* ---------- hero photos ---------- */

/** Photos that can be swapped in the dashboard: slot => original file, original alt text, label. */
function ib_photo_slots() {
	return array(
		'home_1'  => array( 'file' => 'hero.jpg', 'alt' => 'Jugs of home-grown wildflowers along a rustic wedding table', 'label' => 'Home page slideshow: photo 1' ),
		'home_2'  => array( 'file' => 'ceremony.jpg', 'alt' => 'The ceremony room at Sopley Mill dressed with lanterns and olive trees', 'label' => 'Home page slideshow: photo 2' ),
		'home_3'  => array( 'file' => 'long-table.jpg', 'alt' => 'Long tables dressed with greenery garlands and candles', 'label' => 'Home page slideshow: photo 3' ),
		'home_4'  => array( 'file' => 'chess.jpg', 'alt' => 'Giant chess and deckchairs on the lawn', 'label' => 'Home page slideshow: photo 4' ),
		'about'   => array( 'file' => 'river-window.jpg', 'alt' => 'Potted flowers and a rustic table on the terrace beside the river at Sopley Mill', 'label' => 'About page: top photo' ),
		'flowers' => array( 'file' => 'bouquets.jpg', 'alt' => 'Bridesmaids holding white rose and greenery bouquets', 'label' => 'Flowers page: top photo' ),
		'hire'    => array( 'file' => 'long-table.jpg', 'alt' => 'Long banqueting tables dressed with greenery and candles at Sopley Mill', 'label' => 'Hire page: top photo' ),
	);
}

function ib_photo_edits() {
	$edits = get_option( 'ib_photo_edits', array() );
	return is_array( $edits ) ? $edits : array();
}

/** One of the site's own photos in assets/img/site/. */
function ib_site_img( $file ) {
	return get_template_directory_uri() . '/assets/img/site/' . $file;
}

/** Address of a hero photo: the uploaded replacement if there is one, otherwise the original. */
function ib_photo_url( $slot ) {
	$edits = ib_photo_edits();
	if ( ! empty( $edits[ $slot ] ) ) {
		$url = wp_get_attachment_image_url( (int) $edits[ $slot ], 'ib-hero' );
		if ( $url ) {
			return $url;
		}
	}
	return ib_site_img( ib_photo_slots()[ $slot ]['file'] );
}

/** Alt text for a hero photo: the replacement's own alt text if it has one, otherwise the original. */
function ib_photo_alt( $slot ) {
	$edits = ib_photo_edits();
	if ( ! empty( $edits[ $slot ] ) ) {
		$alt = trim( (string) get_post_meta( (int) $edits[ $slot ], '_wp_attachment_image_alt', true ) );
		if ( '' !== $alt ) {
			return $alt;
		}
	}
	return ib_photo_slots()[ $slot ]['alt'];
}
