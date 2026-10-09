<?php
/**
 * Flowers (originally flowers.html).
 */

get_header();
?>

<main>
  <section class="page-hero">
    <img src="<?php echo esc_url( ib_photo_url( 'flowers' ) ); ?>" alt="<?php echo esc_attr( ib_photo_alt( 'flowers' ) ); ?>">
    <div class="wrap inner">
      <p class="script">Wedding flowers</p>
      <h1>Seasonal, simple and home-grown</h1>
    </div>
  </section>

  <section class="section">
    <div class="wrap narrow" style="text-align:center;display:grid;gap:22px;justify-items:center">
      <p class="kicker reveal">Every wedding is different</p>
      <p class="lede reveal" style="margin-inline:auto">Lucy loves simple, beautiful arrangements. She uses in-season flowers wherever she can, and almost every arrangement includes something home-grown, so your flowers are as fresh and fragrant as possible. She'll work with your ideas and your budget.</p>
    </div>
  </section>

  <section class="section section--mist">
    <div class="wrap split reveal">
      <div class="split-media">
        <img src="<?php echo esc_url( ib_site_img( 'delphinium-bouquet.jpg' ) ); ?>" alt="Hand-tied bouquet of pale blue delphiniums, white lisianthus and feverfew" loading="lazy">
        <img class="inset" src="<?php echo esc_url( ib_site_img( 'jars-on-bench.jpg' ) ); ?>" alt="" loading="lazy">
      </div>
      <div class="split-copy">
        <p class="script">Arranged flowers</p>
        <h2>Bouquets, buttonholes and table centre pieces</h2>
        <p>Lucy has a large collection of vintage-style containers to arrange your flowers in, from milk churns to glass bottles and jugs. You're also welcome to bring your own.</p>
        <p>Because every couple's ideas are different, flowers are priced by quote. The best first step is a chat with Lucy about what you have in mind.</p>
        <p><a class="btn" href="contact.html#flowers">Arrange a flower chat</a></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap split split--flip reveal">
      <div class="split-media split-media--wide">
        <img src="<?php echo esc_url( ib_site_img( 'potted-aisle.jpg' ) ); ?>" alt="Terracotta pots of lavender, gypsophila and seasonal flowers lining a wedding aisle" loading="lazy">
      </div>
      <div class="split-copy">
        <p class="script">Potted flowers &amp; trees</p>
        <h2>Living flowers you hire, not buy</h2>
        <p>Lucy's potted flowers grow in lovely containers, from pretty pots to vintage buckets. Because you're hiring them, they cost less and nothing goes to waste. They change with the seasons and are usually home-grown, so they're far more likely to smell wonderful.</p>
        <p>Potted flowers come as part of the River Window set-up and the apple crate set-up, and you can hire potted olive trees on their own.</p>
        <p style="display:flex;flex-wrap:wrap;gap:22px"><a class="text-link" href="product.html#riverwindowsetup">River Window set-up</a><a class="text-link" href="hire.html#outdoor">Potted olive trees</a></p>
      </div>
    </div>
  </section>

  <section class="section section--mist">
    <div class="wrap" style="display:grid;gap:clamp(48px,6vw,80px)">
      <blockquote class="quote reveal" style="margin-block:0">I like to work personally with each couple, so we share the same ideas for the day.<cite>Lucy, IncaBella</cite></blockquote>
      <div class="trio reveal stagger">
        <img src="<?php echo esc_url( ib_site_img( 'wildflower-bouquet.jpg' ) ); ?>" alt="Bride holding a wildflower bouquet of yarrow, daisies, sweet peas and stocks" loading="lazy">
        <img src="<?php echo esc_url( ib_site_img( 'white-daisy-vase.jpg' ) ); ?>" alt="White roses, feverfew and olive in a glass vase" loading="lazy">
        <img src="<?php echo esc_url( ib_site_img( 'riverside-bouquet.jpg' ) ); ?>" alt="White ranunculus and eucalyptus bouquet held above the river at Sopley Mill" loading="lazy">
      </div>
      <div class="btn-row reveal">
        <a class="btn" href="contact.html#flowers">Arrange a flower chat</a>
        <a class="btn" href="hire.html">Browse the hire collection</a>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
