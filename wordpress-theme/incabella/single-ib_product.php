<?php
/**
 * One hire item: photos, price, description, quantity and "Add to my list".
 *
 * @package IncaBella
 */

get_header();

while ( have_posts() ) :
	the_post();
	$ib_id     = get_the_ID();
	$ib_groups = ib_groups();
	$ib_group  = ib_product_group( $ib_id );
	$ib_photos = ib_product_photos( $ib_id );
	$ib_name   = get_the_title();
	$ib_main   = $ib_photos ? ib_token_url( $ib_photos[0] ) : ib_product_photo_url( $ib_id );
	$ib_related = ib_get_products(
		array(
			'posts_per_page' => 4,
			'post__not_in'   => array( $ib_id ),
			'meta_key'       => '_ib_group', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $ib_group, // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
	?>
<main>
  <div class="wrap">
    <p class="crumbs"><a href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Hire collection</a> / <a href="<?php echo esc_url( ib_page_url( 'hire' ) . '#' . $ib_group ); ?>"><?php echo esc_html( $ib_groups[ $ib_group ][0] ); ?></a></p>
    <div class="product">
      <div class="product-gallery">
        <img class="main" src="<?php echo esc_url( $ib_main ); ?>" alt="<?php echo esc_attr( $ib_photos ? ib_token_alt( $ib_photos[0], $ib_name ) : $ib_name ); ?>">
        <?php if ( count( $ib_photos ) > 1 ) : ?>
          <div class="thumbs">
            <?php foreach ( $ib_photos as $i => $t ) : ?>
              <button type="button" data-src="<?php echo esc_url( ib_token_url( $t ) ); ?>"<?php echo 0 === $i ? ' aria-current="true"' : ''; ?>><img src="<?php echo esc_url( ib_token_url( $t, 'thumbnail' ) ); ?>" alt="Photo <?php echo (int) $i + 1; ?>"></button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="product-info">
        <h1><?php echo esc_html( $ib_name ); ?></h1>
        <p class="price"><?php echo wp_kses_post( ib_price_label( $ib_id ) ); ?></p>
        <div class="desc"><?php the_content(); ?></div>
        <div class="qty-row">
          <span class="qty"><button type="button" data-step="-1" aria-label="One fewer">−</button><input id="qty" type="number" inputmode="numeric" min="1" max="999" value="1" aria-label="Quantity"><button type="button" data-step="1" aria-label="One more">+</button></span>
          <?php echo ib_add_button( $ib_id, '#qty' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
        </div>
        <p class="note">Add everything you'd like to your list, then send it to Lucy with your wedding date. She'll confirm availability and send you a quote. There's nothing to pay yet.</p>
        <p><a class="text-link" href="<?php echo esc_url( ib_enquire_url( array( 'item' => $ib_id ) ) ); ?>">Ask Lucy a question about this item</a> &nbsp; <a class="text-link" href="<?php echo esc_url( ib_page_url( 'hire' ) ); ?>">Back to the hire collection</a></p>
      </div>
    </div>
  </div>

  <?php if ( $ib_related ) : ?>
  <section class="section section--mist">
    <div class="wrap">
      <div class="section-head reveal"><p class="script">You might also like</p></div>
      <div class="grid">
        <?php
        foreach ( $ib_related as $r ) {
          echo ib_product_card( $r, false ); // phpcs:ignore WordPress.Security.EscapeOutput
        }
        ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
</main>
	<?php
endwhile;

get_footer();
