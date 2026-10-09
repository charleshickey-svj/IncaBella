<?php
/**
 * Bottom of every page. The visible footer is drawn by assets/js/site.js; products.js and site.js
 * are printed by wp_footer(), followed by the page's own script, as on the original site.
 */
?>

<div data-site-footer></div>
<?php wp_footer(); ?>
<?php
if ( ! empty( $args['script'] ) ) {
	echo $args['script']; // phpcs:ignore WordPress.Security.EscapeOutput -- the page's own inline script from its template.
	echo "\n";
}
?>
</body>
</html>
