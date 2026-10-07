<?php
/**
 * Any other page (for example a privacy policy): title and the page's own content.
 *
 * @package IncaBella
 */

get_header();
while ( have_posts() ) :
	the_post();
	?>
<main>
  <header class="plain-head wrap">
    <h1><?php the_title(); ?></h1>
    <hr class="rule">
  </header>
  <section class="section" style="padding-top:clamp(40px,5vw,64px)">
    <div class="wrap narrow"><div class="desc"><?php the_content(); ?></div></div>
  </section>
</main>
	<?php
endwhile;
get_footer();
