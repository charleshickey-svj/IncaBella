<?php
/**
 * IncaBella theme setup.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

define( 'IB_VERSION', '1.0.0' );

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/products.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/enquiry.php';
require get_template_directory() . '/inc/setup-content.php';

add_action( 'after_setup_theme', 'ib_setup' );
function ib_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
}

/* Page titles read "Hire Collection · IncaBella", like the original site. */
add_filter( 'document_title_separator', function () {
	return '·';
} );

add_action( 'wp_enqueue_scripts', 'ib_assets' );
function ib_assets() {
	wp_enqueue_style( 'ib-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&family=Gilda+Display&family=Mrs+Saint+Delafield&display=swap', array(), null );
	wp_enqueue_style( 'ib-site', ib_asset( 'css/site.css' ), array( 'ib-fonts' ), IB_VERSION );
	wp_enqueue_script( 'ib-site', ib_asset( 'js/site.js' ), array(), IB_VERSION, true );

	// The theme styles everything itself; WordPress's default block styles would shift the design.
	foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'global-styles', 'classic-theme-styles' ) as $handle ) {
		wp_dequeue_style( $handle );
	}
}

add_action( 'wp_head', 'ib_head_extras', 1 );
function ib_head_extras() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	$desc = ib_meta_description();
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
}

function ib_meta_description() {
	if ( is_front_page() ) {
		return 'Wedding flowers and hire at Sopley Mill. Lanterns, fairy lights, props, garden games and home-grown flowers, set up by Lucy before you arrive.';
	}
	if ( is_singular( 'ib_product' ) ) {
		return wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_queried_object_id() ) ), 28, '…' );
	}
	$map = array(
		'about'   => "IncaBella is Lucy's floristry and wedding hire company at Sopley Mill.",
		'flowers' => 'Seasonal, home-grown wedding flowers and potted flower hire by Lucy at IncaBella, Sopley Mill.',
		'hire'    => 'Hire lanterns, fairy lights, props, garden games and decoration packages for your wedding at Sopley Mill.',
		'gallery' => 'Weddings at Sopley Mill styled by IncaBella.',
		'contact' => 'Contact Lucy at IncaBella about wedding flowers and hire at Sopley Mill.',
	);
	$slug = ib_current_section();
	return isset( $map[ $slug ] ) ? $map[ $slug ] : '';
}

/* Dashboard: photo pickers for hire items and the gallery. */
add_action( 'admin_enqueue_scripts', 'ib_admin_assets' );
function ib_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'ib-admin', ib_asset( 'js/admin.js' ), array( 'jquery', 'jquery-ui-sortable' ), IB_VERSION, true );
	wp_add_inline_style(
		'wp-admin',
		'.ib-photo-list{display:flex;flex-wrap:wrap;gap:10px;margin:12px 0}' .
		'.ib-photo-list li{position:relative;width:110px;height:110px;margin:0;cursor:move;border-radius:4px;overflow:hidden;box-shadow:0 0 0 1px #dcdcde}' .
		'[data-name=ib_photos] .ib-photo-list li:first-child{box-shadow:0 0 0 3px #7a7f55}' .
		'[data-name=ib_photos] .ib-photo-list li:first-child::after{content:"Main photo";position:absolute;left:0;right:0;bottom:0;background:#7a7f55;color:#fff;font-size:11px;text-align:center;padding:2px 0}' .
		'.ib-photo-list img{width:100%;height:100%;object-fit:cover;display:block}' .
		'.ib-photo-remove{position:absolute;top:4px;right:4px;width:24px;height:24px;border-radius:50%;border:0;background:rgba(0,0,0,.65);color:#fff;font-size:16px;line-height:1;cursor:pointer}' .
		'.ib-photo-placeholder{width:110px;height:110px;border:2px dashed #c3c4c7;border-radius:4px}' .
		'#side-sortables .ib-photo-list li,#side-sortables .ib-photo-placeholder,.edit-post-meta-boxes-area.is-side .ib-photo-list li{width:76px;height:76px}'
	);
}
