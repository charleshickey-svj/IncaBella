<?php
/**
 * Top of every page. The visible header itself is drawn by assets/js/site.js, as on the original site.
 */

$ib_page = ib_current_page();
?>
<!doctype html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php if ( ! $ib_page ) : ?>
<base href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body data-page="<?php echo esc_attr( $ib_page ? ib_pages()[ $ib_page ]['page'] : '' ); ?>">
<?php wp_body_open(); ?>
<div data-site-header></div>

