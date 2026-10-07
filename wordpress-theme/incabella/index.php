<?php
/**
 * Fallback for blog posts and archives.
 *
 * @package IncaBella
 */

get_header();
?>
<main>
  <header class="plain-head wrap">
    <h1><?php echo esc_html( is_singular() ? get_the_title() : wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
    <hr class="rule">
  </header>
  <section class="section" style="padding-top:clamp(40px,5vw,64px)">
    <div class="wrap narrow" style="display:grid;gap:40px">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="desc">
            <?php if ( ! is_singular() ) : ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
            <?php is_singular() ? the_content() : the_excerpt(); ?>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <p class="lede">Nothing here yet.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
