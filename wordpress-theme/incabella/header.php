<?php
/**
 * Site header: top bar, logo, menu and "My list" button.
 *
 * @package IncaBella
 */

$ib_current = ib_current_section();
$ib_nav     = array(
	'home'    => 'Home',
	'about'   => 'About',
	'flowers' => 'Flowers',
	'hire'    => 'Hire',
	'gallery' => 'Gallery',
	'contact' => 'Contact',
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="topbar"></div>
<header class="site-header"><div class="header-inner">
	<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="IncaBella home"><?php echo ib_logo_mark( 'bloom' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span class="brand-text"><span class="brand-name">IncaBella</span><span class="brand-sub">Floristry &amp; Wedding Hire</span></span></a>
	<nav class="nav" id="site-nav" aria-label="Main">
		<ul class="nav-links">
			<?php foreach ( $ib_nav as $slug => $label ) : ?>
				<li><a href="<?php echo esc_url( ib_page_url( $slug ) ); ?>"<?php echo $slug === $ib_current ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $label ); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<a class="list-btn" href="<?php echo esc_url( ib_page_url( 'list' ) ); ?>"<?php echo 'list' === $ib_current ? ' aria-current="page"' : ''; ?>><span class="label">My list</span><span class="list-count" data-count="0" aria-label="0 items">0</span></a>
	</nav>
	<div class="header-actions">
		<a class="list-btn list-btn--compact" href="<?php echo esc_url( ib_page_url( 'list' ) ); ?>"<?php echo 'list' === $ib_current ? ' aria-current="page"' : ''; ?>><span class="label">My list</span><span class="list-count" data-count="0" aria-label="0 items">0</span></a>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav"><span></span><span></span><span></span><span class="visually-hidden">Menu</span></button>
	</div>
</div></header>
