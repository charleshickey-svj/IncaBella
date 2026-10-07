<?php
/**
 * Gallery page. Photos are chosen in the "Gallery photos" box when editing this page.
 *
 * @package IncaBella
 */

get_header();
$ib_tokens = ib_gallery_tokens();
?>
<main>
  <header class="plain-head wrap">
    <p class="script">Gallery</p>
    <h1 class="visually-hidden">Gallery</h1>
    <hr class="rule">
    <p class="lede" style="margin-inline:auto">Real weddings at Sopley Mill, styled by IncaBella.</p>
  </header>
  <section class="section" style="padding-top:clamp(48px,6vw,80px)">
    <div class="wrap"><div class="masonry" data-gallery>
      <?php $i = 0; foreach ( $ib_tokens as $t ) : ?>
        <?php $ib_url = ib_token_url( $t ); if ( ! $ib_url ) { continue; } ?>
        <button type="button" class="reveal" data-i="<?php echo (int) $i; ?>" aria-label="Open photo <?php echo (int) $i + 1; ?>"><img src="<?php echo esc_url( $ib_url ); ?>" data-full="<?php echo esc_url( ctype_digit( $t ) ? ib_token_url( $t, 'full' ) : $ib_url ); ?>" alt="<?php echo esc_attr( ib_token_alt( $t ) ); ?>" loading="lazy"></button>
        <?php $i++; ?>
      <?php endforeach; ?>
    </div></div>
  </section>
</main>
<?php
get_footer();
