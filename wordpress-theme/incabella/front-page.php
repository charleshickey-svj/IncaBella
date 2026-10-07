<?php
/**
 * Home page.
 *
 * @package IncaBella
 */

get_header();

$ib_featured = ib_get_products( array( 'meta_key' => '_ib_featured', 'meta_value' => '1', 'posts_per_page' => 3 ) ); // phpcs:ignore WordPress.DB.SlowDBQuery
if ( ! $ib_featured ) {
	$ib_featured = ib_get_products( array( 'meta_key' => '_ib_group', 'meta_value' => 'packages', 'posts_per_page' => 3 ) ); // phpcs:ignore WordPress.DB.SlowDBQuery
}
$ib_reviews = ib_reviews();
?>
<main>
  <section class="hero">
    <div class="slides" data-slides>
      <?php echo ib_photo_img( 'hero_1', 'fetchpriority="high"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
      <?php echo ib_photo_img( 'hero_2', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
      <?php echo ib_photo_img( 'hero_3', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
      <?php echo ib_photo_img( 'hero_4', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    </div>
    <div class="slide-dots" data-dots></div>
    <div class="wrap hero-copy">
      <h1><span class="script">Flowers &amp; finishing touches</span><span class="hero-line">for your day at Sopley Mill</span></h1>
    </div>
    <a class="hero-tab" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Browse the hire collection <?php echo ib_arrow(); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="script">A little bit about us…</p>
        <p class="kicker">Floristry &amp; wedding hire at Sopley Mill</p>
      </div>
      <div class="features reveal stagger">
        <div class="feature">
          <svg viewBox="0 0 72 72" fill="none" stroke="#b5854b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M36 64V34"/><path d="M36 50c-8 0-14-6-15-13 8 0 14 5 15 13Z"/><path d="M36 44c7 0 12-5 13-11-7 0-12 4-13 11Z"/><path d="M36 34c-7 0-11-6-11-13 3 2 6 2 8-1 1 3 2 4 3 4s2-1 3-4c2 3 5 3 8 1 0 7-4 13-11 13Z"/></svg>
          <h3>Home-grown flowers</h3>
          <p>Seasonal flowers and foliage, many grown by Lucy, for the freshest blooms and the best scent.</p>
        </div>
        <div class="feature">
          <svg viewBox="0 0 72 72" fill="none" stroke="#b4847f" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M30 12h12M36 8v4"/><path d="M26 22 30 14h12l4 8"/><rect x="24" y="22" width="24" height="34" rx="2"/><path d="M24 56h24l2 6H22Z"/><path d="M36 34c-3 4-3 7 0 9 3-2 3-5 0-9Z"/><path d="M33 47h6"/></svg>
          <h3>Set up before you arrive</h3>
          <p>Lucy delivers and styles everything at the Mill, then clears it away afterwards.</p>
        </div>
        <div class="feature">
          <svg viewBox="0 0 72 72" fill="none" stroke="#7a7f55" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 42h28l-4 22H26Z"/><path d="M20 42h32"/><path d="M36 42V26"/><path d="M36 32c-9 1-15-4-16-12 9-1 15 4 16 12Z"/><path d="M36 28c7 1 13-3 14-10-7-1-13 3-14 10Z"/></svg>
          <h3>Living potted flowers</h3>
          <p>Hire flowers growing in pots and vintage buckets. They cost less and nothing goes to waste.</p>
        </div>
        <div class="feature">
          <svg viewBox="0 0 72 72" fill="none" stroke="#5b7fa6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="36" cy="36" r="24"/><circle cx="36" cy="36" r="6"/><path d="M36 12v18M36 42v18M12 36h18M42 36h18M19 19l13 13M40 40l13 13M53 19 40 32M32 40 19 53"/></svg>
          <h3>Only at Sopley Mill</h3>
          <p>Every item is chosen for the Mill's rooms, riverside and lawns, so it all fits beautifully.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--mist">
    <div class="wrap split reveal">
      <div class="split-media">
        <?php echo ib_photo_img( 'home_flowers_main', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
        <?php echo ib_photo_img( 'home_flowers_inset', 'class="inset" loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
      </div>
      <div class="split-copy">
        <p class="script">Flowers</p>
        <h2>Simple, seasonal and grown close to home</h2>
        <p>Lucy loves simple, beautiful arrangements using in-season flowers, and almost every arrangement includes something home-grown. She works with your ideas and your budget, from bouquets and buttonholes to table centre pieces.</p>
        <p><a class="text-link" href="<?php echo esc_url( ib_page_url( 'flowers' ) ); ?>">About our flowers</a></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap split split--flip reveal">
      <div class="split-media">
        <?php echo ib_photo_img( 'home_hire_main', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
        <?php echo ib_photo_img( 'home_hire_inset', 'class="inset" loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
      </div>
      <div class="split-copy">
        <p class="script">Wedding hire</p>
        <h2>Lanterns, fairy lights, props and garden games</h2>
        <p>Choose as much or as little as you like: a full decoration package for all three floors, or just a couple of apple crates. Send Lucy an enquiry and she'll confirm availability and send you a quote.</p>
        <p><a class="text-link" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">See the hire collection</a></p>
      </div>
    </div>
  </section>

  <?php if ( $ib_featured ) : ?>
  <section class="section section--mist">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="script">Let Lucy do it all</p>
        <h2 style="font-size:var(--step-3)">Decoration packages</h2>
        <p class="lede">Take the stress out of doing it yourself. Lucy styles the rooms, the ceremony and your tables, using everything in the collection.</p>
      </div>
      <div class="packages reveal stagger">
        <?php foreach ( $ib_featured as $p ) : ?>
          <a class="package" href="<?php echo esc_url( get_permalink( $p ) ); ?>"><div class="ph"><img src="<?php echo esc_url( ib_product_photo_url( $p->ID ) ); ?>" alt="" loading="lazy"></div><h3><?php echo esc_html( get_the_title( $p ) ); ?></h3><p class="price"><?php echo wp_kses_post( ib_price_label( $p->ID ) ); ?></p></a>
        <?php endforeach; ?>
      </div>
      <p class="btn-row reveal" style="margin-top:56px"><a class="btn" href="<?php echo esc_url( ib_page_url( 'hire' ) . '#packages' ); ?>">See all packages</a></p>
    </div>
  </section>
  <?php endif; ?>

  <?php if ( $ib_reviews ) : ?>
  <section class="section">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="script">Kind words</p>
        <p class="kicker">From couples married at Sopley Mill</p>
      </div>
      <div class="reviews reveal stagger">
        <?php foreach ( $ib_reviews as $r ) : ?>
        <figure class="review">
          <span class="stars" aria-label="5 out of 5">★★★★★</span>
          <blockquote><?php echo esc_html( $r['text'] ); ?></blockquote>
          <?php if ( $r['name'] ) : ?><figcaption><cite><?php echo esc_html( $r['name'] ); ?></cite></figcaption><?php endif; ?>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="section">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="script">How it works</p>
        <p class="kicker">From your enquiry to your wedding day</p>
      </div>
      <ol class="steps reveal stagger">
        <li><h3>Choose what you love</h3><p>Browse the flowers and hire collection and note anything you'd like for your day.</p></li>
        <li><h3>Send an enquiry</h3><p>Tell Lucy your wedding date and what you have in mind. There's nothing to pay yet.</p></li>
        <li><h3>Get your quote</h3><p>Lucy checks availability for your date and replies with a quote and any ideas.</p></li>
        <li><h3>Arrive to find it ready</h3><p>Lucy sets everything up at the Mill before you arrive and collects it afterwards.</p></li>
      </ol>
    </div>
  </section>

  <section class="sister">
    <?php echo ib_photo_img( 'home_banner', 'loading="lazy"' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    <div class="wrap inner reveal">
      <p class="script">Getting married at Sopley Mill?</p>
      <p>IncaBella works hand in hand with Sopley Mill. Lucy knows every room, window and corner of the Mill, and you're welcome to see the hire collection there by arrangement.</p>
      <div class="btn-row">
        <a class="btn" href="<?php echo esc_url( ib_enquire_url( array( 'topic' => 'visit' ) ) ); ?>">Arrange a visit</a>
        <a class="btn" href="https://sopleymill.co.uk/" target="_blank" rel="noopener">Visit Sopley Mill</a>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
