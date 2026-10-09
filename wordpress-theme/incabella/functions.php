<?php
/**
 * IncaBella theme.
 *
 * The front end is the original static site: assets/css/style.css, assets/js/site.js and
 * assets/js/products.js are the site's own files, unchanged. The templates hold each page's
 * original markup. Pages keep their original addresses (about.html, hire.html, …) so every
 * link, the page fade and the "current page" styling work exactly as before.
 *
 * Editing (IncaBella menu in the dashboard) only swaps values: a hire item's price, description
 * and photos, and the hero photos. Nothing else about the page changes.
 */

defined( 'ABSPATH' ) || exit;

define( 'IB_VERSION', '1.0.0' );

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/content.php';

if ( is_admin() ) {
	require get_template_directory() . '/inc/admin.php';
}
