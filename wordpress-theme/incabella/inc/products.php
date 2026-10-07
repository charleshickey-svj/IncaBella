<?php
/**
 * Hire items: a "Hire items" section in the dashboard with price, unit, category and photos.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

/** The six categories on the Hire page, in display order. */
function ib_groups() {
	return array(
		'packages' => array( 'Packages', 'Let Lucy style a whole room, the ceremony or your tables.' ),
		'lanterns' => array( 'Lanterns & candles', 'Lanterns, tealights and vases for tables, aisles and trees.' ),
		'lights'   => array( 'Lights', 'Fairy lights and light-up letters, fitted by Lucy.' ),
		'props'    => array( 'Props & décor', 'Post boxes, crates, churns and the finishing details.' ),
		'outdoor'  => array( 'Outdoor & greenery', 'Firepit, hay bales and potted olive trees.' ),
		'games'    => array( 'Garden games & kids', 'Giant games for the lawn and a play tent for little guests.' ),
	);
}

add_action( 'init', 'ib_register_products' );
function ib_register_products() {
	register_post_type(
		'ib_product',
		array(
			'labels'        => array(
				'name'               => 'Hire items',
				'singular_name'      => 'Hire item',
				'add_new'            => 'Add hire item',
				'add_new_item'       => 'Add a hire item',
				'edit_item'          => 'Edit hire item',
				'new_item'           => 'New hire item',
				'view_item'          => 'View hire item',
				'search_items'       => 'Search hire items',
				'not_found'          => 'No hire items yet',
				'all_items'          => 'All hire items',
				'menu_name'          => 'Hire items',
			),
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-store',
			'supports'      => array( 'title', 'editor', 'page-attributes', 'revisions' ),
			'rewrite'       => array( 'slug' => 'hire', 'with_front' => false ),
		)
	);
}

/* ---------- product data helpers ---------- */

function ib_product_price( $id ) {
	return (float) get_post_meta( $id, '_ib_price', true );
}

/** "From £695", "£10 per bale" … with the unit in a smaller span, as on the static site. */
function ib_price_label( $id ) {
	$unit = get_post_meta( $id, '_ib_unit', true );
	$out  = ( get_post_meta( $id, '_ib_from', true ) ? 'From ' : '' ) . ib_money( ib_product_price( $id ) );
	if ( $unit ) {
		$out .= ' <span class="unit">' . esc_html( $unit ) . '</span>';
	}
	return $out;
}

function ib_product_group( $id ) {
	$g = get_post_meta( $id, '_ib_group', true );
	return array_key_exists( $g, ib_groups() ) ? $g : 'props';
}

/** Photo tokens for a product; the first is the main photo. */
function ib_product_photos( $id ) {
	return ib_tokens( get_post_meta( $id, '_ib_photos', true ) );
}

/** Main photo URL for a product. */
function ib_product_photo_url( $id, $size = 'large' ) {
	$photos = ib_product_photos( $id );
	return $photos ? ib_token_url( $photos[0], $size ) : ib_asset( 'img/site/hero.jpg' );
}

/** All hire items, in the order Lucy sets (Order box), then by name. */
function ib_get_products( $args = array() ) {
	return get_posts(
		array_merge(
			array(
				'post_type'      => 'ib_product',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			),
			$args
		)
	);
}

/* ---------- dashboard: edit boxes ---------- */

add_action( 'add_meta_boxes_ib_product', 'ib_product_boxes' );
function ib_product_boxes() {
	add_meta_box( 'ib_price_box', 'Price & details', 'ib_price_box', 'ib_product', 'side', 'high' );
	add_meta_box( 'ib_photos_box', 'Photos', 'ib_photos_box', 'ib_product', 'side', 'high' );
}

function ib_price_box( $post ) {
	wp_nonce_field( 'ib_save_product', 'ib_product_nonce' );
	$price = get_post_meta( $post->ID, '_ib_price', true );
	$unit  = get_post_meta( $post->ID, '_ib_unit', true );
	$from  = get_post_meta( $post->ID, '_ib_from', true );
	$group = ib_product_group( $post->ID );
	$home  = get_post_meta( $post->ID, '_ib_featured', true );
	?>
	<p><label for="ib_price"><strong>Price (£)</strong></label><br>
		<input type="number" id="ib_price" name="ib_price" value="<?php echo esc_attr( $price ); ?>" min="0" step="0.01" style="width:100%" placeholder="e.g. 25 or 6.95"></p>
	<p><label for="ib_unit"><strong>Shown after the price</strong> (optional)</label><br>
		<input type="text" id="ib_unit" name="ib_unit" value="<?php echo esc_attr( $unit ); ?>" style="width:100%" placeholder="e.g. each, per table, per 10"></p>
	<p><label><input type="checkbox" name="ib_from" value="1" <?php checked( $from ); ?>> Show “From” before the price</label></p>
	<p><label for="ib_group"><strong>Category on the Hire page</strong></label><br>
		<select id="ib_group" name="ib_group" style="width:100%">
			<?php foreach ( ib_groups() as $id => $g ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $group, $id ); ?>><?php echo esc_html( $g[0] ); ?></option>
			<?php endforeach; ?>
		</select></p>
	<p><label><input type="checkbox" name="ib_featured" value="1" <?php checked( $home ); ?>> Feature on the home page (packages section, up to three)</label></p>
	<?php
}

function ib_photos_box( $post ) {
	$tokens = ib_product_photos( $post->ID );
	ib_photo_picker( 'ib_photos', $tokens, 'The first photo is the main one, shown on the Hire page and at the top of this item’s page. Drag photos to change the order.' );
}

/** A sortable list of photos with "Add photos" and remove buttons (used for hire items and the gallery). */
function ib_photo_picker( $name, $tokens, $help ) {
	?>
	<div class="ib-photos" data-name="<?php echo esc_attr( $name ); ?>">
		<p class="description"><?php echo esc_html( $help ); ?></p>
		<ul class="ib-photo-list">
			<?php foreach ( $tokens as $t ) : ?>
				<li data-token="<?php echo esc_attr( $t ); ?>">
					<img src="<?php echo esc_url( ib_token_url( $t, 'thumbnail' ) ); ?>" alt="">
					<button type="button" class="ib-photo-remove" aria-label="Remove this photo">×</button>
				</li>
			<?php endforeach; ?>
		</ul>
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( implode( ',', $tokens ) ); ?>">
		<p><button type="button" class="button button-primary ib-photo-add">Add photos</button></p>
	</div>
	<?php
}

add_action( 'save_post_ib_product', 'ib_save_product' );
function ib_save_product( $post_id ) {
	if ( ! isset( $_POST['ib_product_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ib_product_nonce'] ) ), 'ib_save_product' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$price = isset( $_POST['ib_price'] ) ? (float) str_replace( array( '£', ',' ), '', sanitize_text_field( wp_unslash( $_POST['ib_price'] ) ) ) : 0;
	update_post_meta( $post_id, '_ib_price', $price );
	update_post_meta( $post_id, '_ib_unit', isset( $_POST['ib_unit'] ) ? sanitize_text_field( wp_unslash( $_POST['ib_unit'] ) ) : '' );
	update_post_meta( $post_id, '_ib_from', empty( $_POST['ib_from'] ) ? '' : '1' );
	update_post_meta( $post_id, '_ib_featured', empty( $_POST['ib_featured'] ) ? '' : '1' );
	$group = isset( $_POST['ib_group'] ) ? sanitize_key( $_POST['ib_group'] ) : 'props';
	update_post_meta( $post_id, '_ib_group', array_key_exists( $group, ib_groups() ) ? $group : 'props' );
	if ( isset( $_POST['ib_photos'] ) ) {
		update_post_meta( $post_id, '_ib_photos', ib_clean_tokens( wp_unslash( $_POST['ib_photos'] ) ) );
	}
}

/** Keep only attachment IDs and theme photo tokens. */
function ib_clean_tokens( $value ) {
	$keep = array();
	foreach ( ib_tokens( $value ) as $t ) {
		if ( ctype_digit( $t ) || preg_match( '#^t:[a-z0-9/_.-]+$#i', $t ) ) {
			$keep[] = $t;
		}
	}
	return implode( ',', $keep );
}

/* ---------- dashboard: list columns ---------- */

add_filter( 'manage_ib_product_posts_columns', 'ib_product_columns' );
function ib_product_columns( $cols ) {
	return array(
		'cb'       => $cols['cb'],
		'ib_photo' => 'Photo',
		'title'    => 'Name',
		'ib_price' => 'Price',
		'ib_group' => 'Category',
		'date'     => $cols['date'],
	);
}

add_action( 'manage_ib_product_posts_custom_column', 'ib_product_column', 10, 2 );
function ib_product_column( $col, $id ) {
	if ( 'ib_photo' === $col ) {
		echo '<img src="' . esc_url( ib_product_photo_url( $id, 'thumbnail' ) ) . '" alt="" style="width:56px;height:56px;object-fit:cover;border-radius:4px">';
	} elseif ( 'ib_price' === $col ) {
		echo wp_kses_post( ib_price_label( $id ) );
	} elseif ( 'ib_group' === $col ) {
		$groups = ib_groups();
		echo esc_html( $groups[ ib_product_group( $id ) ][0] );
	}
}

/* Show items in the dashboard in the same order as the website. */
add_action( 'pre_get_posts', 'ib_admin_product_order' );
function ib_admin_product_order( $q ) {
	if ( is_admin() && $q->is_main_query() && 'ib_product' === $q->get( 'post_type' ) && ! $q->get( 'orderby' ) ) {
		$q->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}
}

/** A product card for the Hire page and "You might also like" (same markup as the original site). */
function ib_product_card( $p, $reveal = true ) {
	$name = get_the_title( $p );
	ob_start();
	?>
	<article class="card<?php echo $reveal ? ' reveal' : ''; ?>"><a class="card-link" href="<?php echo esc_url( get_permalink( $p ) ); ?>"><div class="ph"><img src="<?php echo esc_url( ib_product_photo_url( $p->ID ) ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy"></div><h3><?php echo esc_html( $name ); ?></h3></a><p class="price"><?php echo wp_kses_post( ib_price_label( $p->ID ) ); ?></p><?php echo ib_add_button( $p->ID ); // phpcs:ignore WordPress.Security.EscapeOutput ?></article>
	<?php
	return trim( ob_get_clean() );
}
