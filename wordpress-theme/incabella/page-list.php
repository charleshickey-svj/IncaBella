<?php
/**
 * My list: the items a couple has picked, an estimated total, and a form to send it to Lucy.
 *
 * @package IncaBella
 */

get_header();

$ib_status = isset( $_GET['list'] ) ? sanitize_key( $_GET['list'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>
<main>
  <header class="plain-head wrap">
    <p class="script">Your wedding list</p>
    <h1 class="visually-hidden">My list</h1>
    <hr class="rule">
    <?php if ( 'sent' !== $ib_status ) : ?>
      <p class="lede" style="margin-inline:auto">Check your items, then send your list to Lucy. She'll confirm what's available for your date and reply with a quote. You don't pay anything yet.</p>
    <?php endif; ?>
  </header>

  <section class="section" style="padding-top:clamp(48px,6vw,80px)">
    <?php if ( 'sent' === $ib_status ) : ?>
      <?php $ib_sent = ib_list_sent(); ?>
      <div class="wrap narrow" style="margin-inline:auto">
        <div class="success" data-list-sent tabindex="-1">
          <p class="script" style="font-size:3.2rem">Thank you</p>
          <h2>Lucy has your list</h2>
          <?php if ( $ib_sent ) : ?>
            <p>She'll check availability for <?php echo esc_html( $ib_sent['date'] ); ?> and reply to <?php echo esc_html( $ib_sent['email'] ); ?> within two working days. We've emailed you a copy.</p>
            <ul>
              <?php foreach ( $ib_sent['lines'] as $ib_line ) : ?>
                <li><?php echo esc_html( preg_replace( '/ \(.*\) = .*$/u', '', $ib_line ) ); ?></li>
              <?php endforeach; ?>
            </ul>
            <?php if ( $ib_sent['total'] ) : ?>
              <p>Estimated total: <strong><?php echo esc_html( $ib_sent['total'] ); ?></strong></p>
            <?php endif; ?>
          <?php else : ?>
            <p>She'll check availability for your date and reply within two working days.</p>
          <?php endif; ?>
          <p><a class="btn btn--small" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Back to the hire collection</a></p>
        </div>
      </div>
    <?php else : ?>
      <script type="application/json" id="ib-catalogue"><?php echo wp_json_encode( ib_list_catalogue(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?></script>
      <div class="wrap list-layout">
        <div data-list data-hire="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>" data-flowers="<?php echo esc_url( ib_page_url( 'flowers' ) ); ?>">
          <noscript><div class="empty"><p>Your list needs JavaScript switched on. You can still <a href="<?php echo esc_url( ib_enquire_url() ); ?>">send Lucy an enquiry</a>.</p></div></noscript>
        </div>

        <div>
          <form class="form-card" id="list-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
            <h2>Send your list to Lucy</h2>
            <input type="hidden" name="action" value="ib_list">
            <input type="hidden" name="ib_started" value="<?php echo esc_attr( time() ); ?>">
            <input type="hidden" name="items" value="">
            <div style="position:absolute;left:-9999px" aria-hidden="true"><label for="f-website">Leave this empty</label><input id="f-website" name="website" tabindex="-1" autocomplete="off"></div>
            <div class="fields">
              <div class="field field--full"><label for="f-names">Your names</label><input id="f-names" name="names" autocomplete="name" required placeholder="e.g. Amy &amp; David"></div>
              <div class="field"><label for="f-email">Email</label><input id="f-email" name="email" type="email" autocomplete="email" required></div>
              <div class="field"><label for="f-phone">Phone</label><input id="f-phone" name="phone" type="tel" autocomplete="tel" required></div>
              <div class="field"><label for="f-date">Wedding date</label><input id="f-date" name="date" type="date" required min="<?php echo esc_attr( wp_date( 'Y-m-d' ) ); ?>"></div>
              <div class="field"><label for="f-guests">Number of guests</label><input id="f-guests" name="guests" type="number" inputmode="numeric" min="1" placeholder="e.g. 90"></div>
              <div class="field field--full"><span class="label">Venue</span><div class="static">Sopley Mill, Christchurch</div></div>
              <div class="field field--full field--check"><input id="f-flowers" name="flowers" type="checkbox" value="1"><label for="f-flowers">I'd also like to talk to Lucy about flowers</label></div>
              <div class="field field--full"><label for="f-notes">Anything else Lucy should know?</label><textarea id="f-notes" name="notes" placeholder="Colours, themes, timings, or questions about any item"></textarea></div>
            </div>
            <p class="error-msg" data-error<?php echo 'missing' === $ib_status ? '' : ' hidden'; ?>><?php echo 'missing' === $ib_status ? 'Please fill in your names, email, phone and wedding date, and add at least one item.' : ''; ?></p>
            <button class="btn" type="submit">Send my list</button>
          </form>
        </div>
      </div>
    <?php endif; ?>
  </section>
</main>
<?php
get_footer();
