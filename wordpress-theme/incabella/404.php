<?php
/**
 * Page not found.
 *
 * @package IncaBella
 */

get_header();
?>
<main>
  <header class="plain-head wrap">
    <p class="script">Oh dear</p>
    <h1>This page has wandered off</h1>
    <hr class="rule">
    <p class="lede" style="margin-inline:auto">The page you're looking for isn't here. Try the hire collection, or get in touch with Lucy.</p>
    <div class="btn-row" style="margin-top:40px;padding-bottom:120px">
      <a class="btn" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Browse the hire collection</a>
      <a class="btn" href="<?php echo esc_url( ib_enquire_url() ); ?>">Contact Lucy</a>
    </div>
  </header>
</main>
<?php
get_footer();
