<?php
/**
 * Site footer.
 *
 * @package IncaBella
 */

$ib_email = ib_opt( 'email' );
?>
<footer class="site-footer"><div class="wrap"><div class="footer-top">
	<div class="footer-brand">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="IncaBella home"><?php echo ib_logo_mark(); // phpcs:ignore WordPress.Security.EscapeOutput ?><span class="brand-text"><span class="brand-name">IncaBella</span><span class="brand-sub">Floristry &amp; Wedding Hire</span></span></a>
		<p>Flowers, lanterns and finishing touches for weddings at Sopley Mill, set up by Lucy before you arrive.</p>
		<?php echo ib_social_links(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
	<div><h3>Address</h3><address><?php echo ib_address_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></address></div>
	<div><h3>Contact</h3><ul><li><a href="mailto:<?php echo esc_attr( $ib_email ); ?>"><?php echo esc_html( $ib_email ); ?></a></li><li><a href="<?php echo esc_attr( ib_phone_href() ); ?>"><?php echo esc_html( ib_opt( 'phone' ) ); ?></a></li></ul></div>
	<div><h3>Explore</h3><ul><li><a href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Hire collection</a></li><li><a href="<?php echo esc_url( ib_page_url( 'flowers' ) ); ?>">Flowers</a></li><li><a href="<?php echo esc_url( ib_enquire_url() ); ?>">Send an enquiry</a></li><li><a href="https://sopleymill.co.uk/" target="_blank" rel="noopener">Sopley Mill</a></li></ul></div>
</div><div class="footer-bottom"><span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> IncaBella Floristry &amp; Wedding Hire</span><span>Weddings at Sopley Mill, Christchurch</span></div></div></footer>
<?php wp_footer(); ?>
</body>
</html>
