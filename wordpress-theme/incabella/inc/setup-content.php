<?php
/**
 * One-click setup: creates the site's pages, loads the hire items and sets the home page.
 * Also the photo picker for the Gallery page.
 *
 * @package IncaBella
 */

defined( 'ABSPATH' ) || exit;

/** The pages the theme designs, by slug. */
function ib_site_pages() {
	return array(
		'home'    => 'Home',
		'about'   => 'About',
		'flowers' => 'Flowers',
		'hire'    => 'Hire',
		'gallery' => 'Gallery',
		'contact' => 'Contact',
		'list'    => 'My list',
	);
}

/** Gallery photos used until Lucy picks her own. */
function ib_default_gallery() {
	$site  = array( 'wildflower-bouquet', 'crate-display-mill', 'delphinium-bouquet', 'jars-on-bench', 'riverside-bouquet', 'potted-aisle', 'nigella-closeup', 'white-daisy-vase', 'potted-violas-thyme', 'hero', 'ceremony', 'bouquets', 'long-table', 'arch', 'chess', 'centrepiece', 'river-window', 'games', 'crates', 'vase-pink', 'firepit-night', 'jenga', 'churn-flowers', 'potted-aisle', 'ladder-toss' );
	$picks = array( 'fairy-light-globes-1', 'love-light-letters-1', 'wooden-arch-1', 'outdoor-ceremony-set-up-2', 'table-centre-piece-package-2-1', 'large-heart-light-1', 'hay-bales-1', 'mohani-lantern-1', 'passu-hanging-tea-light-1', 'fairylight-wall-net-ceremony-room-1', 'kids-play-tent-1', 'ground-floor-decoration-package-4' );
	$out   = array();
	foreach ( $site as $i => $s ) {
		$out[] = 't:site/' . $s . '.jpg';
		if ( isset( $picks[ $i ] ) ) {
			$out[] = 't:products/' . $picks[ $i ] . '.jpg';
		}
	}
	return array_values( array_unique( $out ) );
}

function ib_gallery_tokens() {
	$page   = get_page_by_path( 'gallery' );
	$stored = $page ? get_post_meta( $page->ID, '_ib_gallery', true ) : '';
	return '' === $stored ? ib_default_gallery() : ib_tokens( $stored );
}

/* ---------- setup notice and action ---------- */

function ib_needs_setup() {
	return ! get_option( 'ib_setup_done' );
}

add_action( 'after_switch_theme', 'ib_after_switch' );
function ib_after_switch() {
	ib_register_products();
	flush_rewrite_rules();
}

add_action( 'admin_notices', 'ib_setup_notice' );
function ib_setup_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['ib_setup'] ) && 'done' === $_GET['ib_setup'] ) {
		echo '<div class="notice notice-success is-dismissible"><p><strong>IncaBella is set up.</strong> Your pages and hire items are ready. <a href="' . esc_url( home_url( '/' ) ) . '">View the website</a> · <a href="' . esc_url( admin_url( 'edit.php?post_type=ib_product' ) ) . '">Edit hire items</a></p></div>';
		return;
	}
	if ( ! ib_needs_setup() ) {
		return;
	}
	$url = wp_nonce_url( admin_url( 'admin-post.php?action=ib_setup' ), 'ib_setup' );
	?>
	<div class="notice notice-info">
		<p><strong>Finish setting up IncaBella.</strong> This creates the Home, About, Flowers, Hire, Gallery, Contact and My list pages (or uses yours if they already exist), loads all 60 hire items with their prices and photos, and makes Home your front page.</p>
		<p><a class="button button-primary" href="<?php echo esc_url( $url ); ?>">Set up IncaBella</a></p>
	</div>
	<?php
}

add_action( 'admin_post_ib_setup', 'ib_run_setup' );
function ib_run_setup() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Only an administrator can run the setup.' );
	}
	check_admin_referer( 'ib_setup' );
	ib_do_setup();
	wp_safe_redirect( admin_url( 'edit.php?post_type=ib_product&ib_setup=done' ) );
	exit;
}

/** Create the pages, set the front page and load the hire items. Safe to run more than once. */
function ib_do_setup() {
	foreach ( ib_site_pages() as $slug => $title ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$id = wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
				)
			);
		} else {
			$id = $page->ID;
		}
		if ( 'home' === $slug ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
	}

	ib_import_products();
	update_option( 'ib_setup_done', 1 );
	update_option( 'ib_list_page_done', 1 );
	flush_rewrite_rules();
}

/** Load the hire items bundled with the theme. Items that already exist (same web name) are left alone. */
function ib_import_products() {
	$file = get_template_directory() . '/data/products.json';
	$data = json_decode( (string) file_get_contents( $file ), true );
	if ( empty( $data['products'] ) ) {
		return;
	}
	foreach ( $data['products'] as $p ) {
		$existing = get_page_by_path( $p['slug'], OBJECT, 'ib_product' );
		if ( $existing ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_type'    => 'ib_product',
				'post_status'  => 'publish',
				'post_title'   => $p['title'],
				'post_name'    => $p['slug'],
				'post_content' => $p['content'],
				'menu_order'   => (int) $p['order'],
			)
		);
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		update_post_meta( $id, '_ib_price', (float) $p['price'] );
		update_post_meta( $id, '_ib_unit', $p['unit'] );
		update_post_meta( $id, '_ib_from', $p['from'] ? '1' : '' );
		update_post_meta( $id, '_ib_group', $p['group'] );
		update_post_meta( $id, '_ib_featured', $p['featured'] ? '1' : '' );
		update_post_meta( $id, '_ib_photos', implode( ',', $p['photos'] ) );
	}
}

/* ---------- Gallery page photos ---------- */

add_action( 'add_meta_boxes_page', 'ib_gallery_box' );
function ib_gallery_box( $post ) {
	if ( 'gallery' !== $post->post_name ) {
		return;
	}
	add_meta_box( 'ib_gallery_box', 'Gallery photos', 'ib_gallery_box_html', 'page', 'normal', 'high' );
}

function ib_gallery_box_html( $post ) {
	wp_nonce_field( 'ib_save_gallery', 'ib_gallery_nonce' );
	ib_photo_picker( 'ib_gallery', ib_gallery_tokens(), 'These photos appear on the Gallery page in this order. Drag to reorder, × to remove, “Add photos” to add from your Media Library.' );
}

add_action( 'save_post_page', 'ib_save_gallery' );
function ib_save_gallery( $post_id ) {
	if ( ! isset( $_POST['ib_gallery_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ib_gallery_nonce'] ) ), 'ib_save_gallery' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['ib_gallery'] ) ) {
		// An empty gallery is stored as a single space so it isn't mistaken for "never set".
		$clean = ib_clean_tokens( wp_unslash( $_POST['ib_gallery'] ) );
		update_post_meta( $post_id, '_ib_gallery', '' === $clean ? ' ' : $clean );
	}
}

/* Tell Lucy which pages the theme designs, so she knows not to look for their text in the editor. */
add_action( 'admin_notices', 'ib_designed_page_notice' );
function ib_designed_page_notice() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'page' !== $screen->id || empty( $_GET['post'] ) ) {
		return;
	}
	$slug = get_post_field( 'post_name', (int) $_GET['post'] );
	if ( ! array_key_exists( $slug, ib_site_pages() ) ) {
		return;
	}
	echo '<div class="notice notice-info"><p>This page is laid out by the IncaBella theme. Change its photos under <a href="' . esc_url( admin_url( 'customize.php' ) ) . '">Appearance → Customise → IncaBella</a>' . ( 'gallery' === $slug ? ', and the gallery photos in the box below' : '' ) . '.</p></div>';
}
