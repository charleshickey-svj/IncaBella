<?php
/**
 * About (originally about.html).
 */

get_header();
?>

<main>
  <section class="page-hero">
    <img src="<?php echo esc_url( ib_photo_url( 'about' ) ); ?>" alt="<?php echo esc_attr( ib_photo_alt( 'about' ) ); ?>">
    <div class="wrap inner">
      <p class="script">Hello, I'm Lucy</p>
      <h1>The story of IncaBella</h1>
    </div>
  </section>

  <section class="section">
    <div class="wrap split reveal">
      <div class="split-media split-media--wide">
        <img src="<?php echo esc_url( ib_site_img( 'crate-display-mill.jpg' ) ); ?>" alt="Vintage crates filled with potted lavender, cow parsley and jars of flowers" loading="lazy">
      </div>
      <div class="split-copy">
        <p class="script">Flowers &amp; finishing touches</p>
        <h2>This is IncaBella</h2>
        <p>IncaBella is my floristry and wedding hire company. I create simple, seasonal flowers, and almost every arrangement has something home-grown in it, so they're fresh and full of scent.</p>
        <p>Alongside the flowers there's a collection of lanterns, fairy lights, vintage props and garden games to hire. You choose what you love, and I deliver it, style it and clear it away afterwards, so you can simply enjoy your day.</p>
      </div>
    </div>
  </section>

  <section class="section section--mist">
    <div class="wrap">
      <div class="section-head reveal">
        <p class="script">As much or as little as you like</p>
        <p class="lede">Some couples hand everything over to me, and some just want a couple of crates or a set of garden games. Either is lovely.</p>
      </div>
      <div class="features reveal stagger">
        <div class="feature"><h3>Full decoration</h3><p>All three floors of the Mill styled for you, from the ceremony room to the tables.</p><a class="text-link" href="hire.html#packages">Packages</a></div>
        <div class="feature"><h3>Pick and choose</h3><p>Add individual lanterns, lights, props and games to your list and I'll set them up.</p><a class="text-link" href="hire.html">Hire collection</a></div>
        <div class="feature"><h3>Flowers</h3><p>Seasonal, often home-grown flowers, arranged or potted, planned together with you.</p><a class="text-link" href="flowers.html">Flowers</a></div>
        <div class="feature"><h3>Come and see</h3><p>You're welcome to see any of the hire items at Sopley Mill before you decide, by arrangement.</p><a class="text-link" href="contact.html">Arrange a visit</a></div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap split split--flip reveal">
      <div class="split-media">
        <img src="<?php echo esc_url( ib_site_img( 'ceremony.jpg' ) ); ?>" alt="The ceremony room at Sopley Mill dressed with lanterns and olive trees" loading="lazy">
      </div>
      <div class="split-copy">
        <p class="script">Rooted at Sopley Mill</p>
        <h2>Where it all happens</h2>
        <p>Sopley Mill has been in our family since 1870, and David and I lovingly restored it into the wedding venue it is today. IncaBella works mainly at the Mill, so I know every room, window and corner.</p>
        <p>Everything in the collection is chosen to suit it, from the river window to the stairwell and the lawns, and you're welcome to come and see it all before you decide.</p>
        <p><a class="text-link" href="https://sopleymill.co.uk/" target="_blank" rel="noopener">Visit Sopley Mill</a></p>
      </div>
    </div>
  </section>

  <section class="sister">
    <img src="<?php echo esc_url( ib_site_img( 'mill-lawn.jpg' ) ); ?>" alt="" loading="lazy">
    <div class="wrap inner reveal">
      <p class="script">See you at the Mill</p>
      <div class="btn-row"><a class="btn" href="hire.html">Start your list</a><a class="btn" href="https://sopleymill.co.uk/" target="_blank" rel="noopener">Visit Sopley Mill</a></div>
    </div>
  </section>
</main>

<?php
get_footer();
