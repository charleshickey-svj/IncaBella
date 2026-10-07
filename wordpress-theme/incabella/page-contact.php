<?php
/**
 * Contact page: enquiry form (emails Lucy) and a map of Sopley Mill.
 *
 * @package IncaBella
 */

get_header();

$ib_status = isset( $_GET['enquiry'] ) ? sanitize_key( $_GET['enquiry'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$ib_item   = isset( $_GET['item'] ) ? absint( $_GET['item'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
$ib_item   = ( $ib_item && 'ib_product' === get_post_type( $ib_item ) && 'publish' === get_post_status( $ib_item ) ) ? $ib_item : 0;
$ib_topic  = 'Hire items';
$ib_msg    = '';
if ( $ib_item ) {
	$ib_topic = 'packages' === ib_product_group( $ib_item ) ? 'A decoration package' : 'Hire items';
	$ib_msg   = "I'd like to ask about the " . get_the_title( $ib_item ) . '.';
} elseif ( isset( $_GET['topic'] ) && 'visit' === $_GET['topic'] ) { // phpcs:ignore WordPress.Security.NonceVerification
	$ib_topic = 'Visiting to see the hire items';
} elseif ( isset( $_GET['topic'] ) && 'flowers' === $_GET['topic'] ) { // phpcs:ignore WordPress.Security.NonceVerification
	$ib_topic = 'Flowers';
}
$ib_directions = 'https://www.google.com/maps/dir/?api=1&destination=Sopley+Mill%2C+Mill+Lane%2C+Sopley%2C+Christchurch+BH23+7AU';
$ib_email      = ib_opt( 'email' );
?>
<main>
  <header class="plain-head wrap">
    <h1>Contact us</h1>
    <hr class="rule">
    <div class="btn-row">
      <a class="btn" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Browse hire</a>
      <a class="btn" href="#flowers" data-topic="Flowers">Ask about flowers</a>
      <a class="btn" href="#find-us">Find us</a>
    </div>
  </header>

  <section class="section">
    <div class="wrap" style="display:grid;gap:clamp(56px,7vw,96px)">
      <div class="narrow" style="margin-inline:auto;width:100%;display:grid;gap:28px" id="flowers">
        <?php if ( 'sent' === $ib_status ) : ?>
          <?php $ib_sender = ib_enquiry_sender(); ?>
          <div class="success notice-sent" id="enquiry" tabindex="-1">
            <p class="script" style="font-size:3.2rem">Thank you</p>
            <h2>Message sent</h2>
            <p>Lucy will reply<?php echo $ib_sender ? ' to ' . esc_html( $ib_sender ) : ''; ?> as soon as she can, usually within two working days.</p>
            <p><a class="text-link" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Back to the hire collection</a></p>
          </div>
        <?php else : ?>
        <p class="lede reveal notice-sent" id="enquiry" style="text-align:center;margin-inline:auto">Ask Lucy anything about flowers or hire, or check availability for your date. You're welcome to see any of the hire items at Sopley Mill before you commit, by arrangement.</p>
        <form class="form-card reveal" id="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
          <input type="hidden" name="action" value="ib_enquiry">
          <input type="hidden" name="ib_started" value="<?php echo esc_attr( time() ); ?>">
          <?php if ( $ib_item ) : ?><input type="hidden" name="item" value="<?php echo (int) $ib_item; ?>"><?php endif; ?>
          <div style="position:absolute;left:-9999px" aria-hidden="true"><label for="c-website">Leave this empty</label><input id="c-website" name="website" tabindex="-1" autocomplete="off"></div>
          <div class="fields">
            <div class="field"><label for="c-name">Your name</label><input id="c-name" name="name" autocomplete="name" required></div>
            <div class="field"><label for="c-phone">Phone</label><input id="c-phone" name="phone" type="tel" autocomplete="tel" required></div>
            <div class="field"><label for="c-email">Email</label><input id="c-email" name="email" type="email" autocomplete="email" required></div>
            <div class="field"><label for="c-date">Wedding date</label><input id="c-date" name="date" type="date"><span class="hint">If you know it</span></div>
            <div class="field field--full"><label for="c-topic">What's it about?</label>
              <select id="c-topic" name="topic">
                <?php foreach ( ib_enquiry_topics() as $t ) : ?>
                  <option<?php selected( $ib_topic, $t ); ?>><?php echo esc_html( $t ); ?></option>
                <?php endforeach; ?>
              </select></div>
            <div class="field field--full"><label for="c-message">Message</label><textarea id="c-message" name="message" required><?php echo esc_textarea( $ib_msg ); ?></textarea></div>
          </div>
          <p class="error-msg" data-error<?php echo 'missing' === $ib_status ? '' : ' hidden'; ?>><?php echo 'missing' === $ib_status ? 'Please fill in your name, phone, email and message.' : ''; ?></p>
          <button class="btn" type="submit">Send message</button>
        </form>
        <?php endif; ?>
      </div>

      <div class="find-us reveal" id="find-us">
        <div class="map map--live">
          <iframe title="Map showing Sopley Mill, Mill Lane, Christchurch BH23 7AU" src="https://www.google.com/maps?q=Sopley+Mill,+Mill+Lane,+Sopley,+Christchurch+BH23+7AU&amp;z=13&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
        <div class="find-us-info">
          <h2>Find us at the Mill</h2>
          <div><h3>Address</h3><address><?php echo ib_address_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></address></div>
          <div><h3>Contact</h3><p><a href="mailto:<?php echo esc_attr( $ib_email ); ?>"><?php echo esc_html( $ib_email ); ?></a><br><a href="<?php echo esc_attr( ib_phone_href() ); ?>"><?php echo esc_html( ib_opt( 'phone' ) ); ?></a></p></div>
          <div><h3>Visits</h3><p>See the hire collection at Sopley Mill by appointment.</p></div>
          <div><h3>Follow IncaBella</h3><?php echo ib_social_links(); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
          <p><a class="btn btn--small" href="<?php echo esc_url( $ib_directions ); ?>" target="_blank" rel="noopener">Get directions</a></p>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
