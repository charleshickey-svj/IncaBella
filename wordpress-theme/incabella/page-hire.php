<?php
/**
 * Hire collection: every hire item, grouped by category, with filter buttons.
 *
 * @package IncaBella
 */

get_header();

$ib_by_group = array();
foreach ( ib_get_products() as $p ) {
	$ib_by_group[ ib_product_group( $p->ID ) ][] = $p;
}
?>
<main>
  <section class="page-hero">
    <?php echo ib_photo_img( 'hire_hero' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    <div class="wrap inner">
      <p class="script">The hire collection</p>
      <h1>Everything to style your day</h1>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <p class="lede">Find what you love, then send Lucy an enquiry. She'll confirm what's available for your date and send you a quote. Each price shows what it covers, such as per table or per 10.</p>
      </div>
      <div class="filters" role="group" aria-label="Show a category" data-filters>
        <button class="chip" type="button" data-filter="all" aria-pressed="true">All</button>
        <?php foreach ( ib_groups() as $id => $g ) : ?>
          <?php if ( ! empty( $ib_by_group[ $id ] ) ) : ?>
            <button class="chip" type="button" data-filter="<?php echo esc_attr( $id ); ?>" aria-pressed="false"><?php echo esc_html( $g[0] ); ?></button>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div data-groups>
        <?php foreach ( ib_groups() as $id => $g ) : ?>
          <?php if ( empty( $ib_by_group[ $id ] ) ) { continue; } ?>
          <section class="group" id="<?php echo esc_attr( $id ); ?>" data-group="<?php echo esc_attr( $id ); ?>">
            <div class="group-head reveal"><h2><?php echo esc_html( $g[0] ); ?></h2><p><?php echo esc_html( $g[1] ); ?></p></div>
            <div class="grid<?php echo 'packages' === $id ? ' grid--packages' : ''; ?>">
              <?php
              foreach ( $ib_by_group[ $id ] as $p ) {
                echo ib_product_card( $p ); // phpcs:ignore WordPress.Security.EscapeOutput
              }
              ?>
            </div>
          </section>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
