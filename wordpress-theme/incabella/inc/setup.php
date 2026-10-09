<?php
/**
 * Theme setup: page addresses, scripts and styles, and keeping WordPress's own front-end
 * extras out of the page so it renders exactly like the original site.
 */

defined( 'ABSPATH' ) || exit;

/**
 * The site's pages, by their original file name.
 * title and description are the original <title> and meta description; page is <body data-page>.
 */
function ib_pages() {
	return array(
		'index'   => array(
			'template'    => 'front-page.php',
			'title'       => 'IncaBella',
			'description' => 'Wedding flowers and hire at Sopley Mill. Lanterns, fairy lights, props, garden games and home-grown flowers, set up by Lucy before you arrive.',
			'page'        => 'home',
		),
		'about'   => array(
			'template'    => 'page-about.php',
			'title'       => 'About · IncaBella',
			'description' => "IncaBella is Lucy's floristry and wedding hire company, the sister company to Sopley Mill.",
			'page'        => 'about',
		),
		'flowers' => array(
			'template'    => 'page-flowers.php',
			'title'       => 'Flowers · IncaBella',
			'description' => 'Seasonal, home-grown wedding flowers and potted flower hire by Lucy at IncaBella, Sopley Mill.',
			'page'        => 'flowers',
		),
		'hire'    => array(
			'template'    => 'page-hire.php',
			'title'       => 'Hire Collection · IncaBella',
			'description' => 'Hire lanterns, fairy lights, props, garden games and decoration packages for your wedding at Sopley Mill.',
			'page'        => 'hire',
		),
		'product' => array(
			'template'    => 'page-product.php',
			'title'       => 'Hire Item · IncaBella',
			'description' => '',
			'page'        => 'hire',
		),
		'gallery' => array(
			'template'    => 'page-gallery.php',
			'title'       => 'Gallery · IncaBella',
			'description' => 'Weddings at Sopley Mill styled by IncaBella.',
			'page'        => 'gallery',
		),
		'contact' => array(
			'template'    => 'page-contact.php',
			'title'       => 'Contact · IncaBella',
			'description' => 'Contact Lucy at IncaBella about wedding flowers and hire at Sopley Mill.',
			'page'        => 'contact',
		),
		'list'    => array(
			'template'    => 'page-list.php',
			'title'       => 'My List · IncaBella',
			'description' => '',
			'page'        => 'list',
		),
	);
}

/** Key of the site page being shown ('index', 'about', …), or '' for anything else. */
function ib_current_page() {
	$page = get_query_var( 'ib_page' );
	if ( $page && isset( ib_pages()[ $page ] ) ) {
		return $page;
	}
	return is_front_page() ? 'index' : '';
}

/* ---------- theme supports ---------- */

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		// Uploaded photos are served at the same sizes as the site's own photos.
		add_image_size( 'ib-product', 1200, 1200, false );
		add_image_size( 'ib-hero', 2000, 2000, false );
	}
);

/* ---------- page addresses: index.html, about.html, … ---------- */

add_action(
	'init',
	function () {
		add_rewrite_tag( '%ib_page%', '([a-z]+)' );
		add_rewrite_rule( '^(' . implode( '|', array_keys( ib_pages() ) ) . ')\.html$', 'index.php?ib_page=$matches[1]', 'top' );
		if ( get_option( 'ib_rewrite_version' ) !== IB_VERSION ) {
			flush_rewrite_rules( false );
			update_option( 'ib_rewrite_version', IB_VERSION );
		}
	}
);

// The .html addresses need "pretty" permalinks. Turn them on if the site still uses ?p=123 links.
add_action(
	'after_switch_theme',
	function () {
		global $wp_rewrite;
		if ( ! get_option( 'permalink_structure' ) ) {
			$wp_rewrite->set_permalink_structure( '/%postname%/' );
		}
		flush_rewrite_rules();
		update_option( 'ib_rewrite_version', IB_VERSION );
	}
);

add_filter(
	'template_include',
	function ( $template ) {
		$page = ib_current_page();
		if ( $page ) {
			$found = locate_template( ib_pages()[ $page ]['template'] );
			if ( $found ) {
				return $found;
			}
		}
		return $template;
	}
);

// Keep about.html as about.html (WordPress would otherwise try to "correct" the address).
add_filter(
	'redirect_canonical',
	function ( $redirect ) {
		return get_query_var( 'ib_page' ) ? false : $redirect;
	}
);

/* ---------- <head> ---------- */

add_filter(
	'pre_get_document_title',
	function ( $title ) {
		$page = ib_current_page();
		return $page ? ib_pages()[ $page ]['title'] : $title;
	}
);

add_action(
	'wp_head',
	function () {
		$page = ib_current_page();
		if ( $page && ib_pages()[ $page ]['description'] ) {
			echo '<meta name="description" content="' . esc_attr( ib_pages()[ $page ]['description'] ) . '">' . "\n";
		}
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	},
	1
);

add_action(
	'wp_enqueue_scripts',
	function () {
		$uri = get_template_directory_uri();

		wp_enqueue_style( 'ib-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&family=Gilda+Display&family=Mrs+Saint+Delafield&display=swap', array(), null );
		wp_enqueue_style( 'ib-style', $uri . '/assets/css/style.css', array( 'ib-fonts' ), IB_VERSION );

		// Same order and placement as the original pages: end of <body>, products first.
		wp_enqueue_script( 'ib-products', $uri . '/assets/js/products.js', array(), IB_VERSION, true );
		wp_add_inline_script( 'ib-products', ib_product_edits_script(), 'after' );
		wp_enqueue_script( 'ib-site', $uri . '/assets/js/site.js', array( 'ib-products' ), IB_VERSION, true );
	}
);

/* ---------- leave out WordPress's own front-end additions ---------- */

// None of these exist on the original site, and some add styles or markup that would change it.
add_action(
	'init',
	function () {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
		remove_action( 'wp_head', 'wp_print_auto_sizes_contain_css_fix', 1 );
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_img_auto_sizes_contain_css_fix', 0 );
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
		remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );
		remove_action( 'wp_footer', 'wp_enqueue_stored_styles', 1 );
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		remove_action( 'wp_footer', 'the_block_template_skip_link' );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'classic-theme-styles', 'global-styles', 'core-block-supports', 'wp-img-auto-sizes-contain' ) as $handle ) {
			wp_dequeue_style( $handle );
		}
	},
	100
);

add_filter( 'wp_speculation_rules_configuration', '__return_null' );
add_filter( 'show_admin_bar', '__return_false' );
