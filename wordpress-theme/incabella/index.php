<?php
/**
 * Fallback for any address that isn't one of the site's pages (blog posts, search, not found).
 * The site's pages themselves use front-page.php and the page-*.php templates.
 */

get_header();
?>
<main>
  <header class="plain-head wrap">
    <h1><?php echo is_404() ? 'Page not found' : esc_html( is_singular() ? single_post_title( '', false ) : wp_get_document_title() ); ?></h1>
    <hr class="rule">
  </header>

  <section class="section" style="padding-top:clamp(48px,6vw,80px)">
    <div class="wrap narrow" style="display:grid;gap:22px">
      <?php if ( is_404() || ! have_posts() ) : ?>
        <p class="lede" style="margin-inline:auto;text-align:center">Sorry, there's nothing here. <a class="text-link" href="index.html">Back to the home page</a></p>
      <?php else : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <article>
            <?php if ( ! is_singular() ) : ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
            <?php is_singular() ? the_content() : the_excerpt(); ?>
          </article>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
