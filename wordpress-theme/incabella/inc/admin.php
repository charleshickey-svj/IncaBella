<?php
/**
 * Dashboard screens: IncaBella → Hire prices & photos, and IncaBella → Hero photos.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_menu',
	function () {
		add_menu_page( 'Hire prices & photos', 'IncaBella', 'edit_theme_options', 'incabella', 'ib_products_screen', 'dashicons-store', 3 );
		add_submenu_page( 'incabella', 'Hire prices & photos', 'Hire prices & photos', 'edit_theme_options', 'incabella', 'ib_products_screen' );
		add_submenu_page( 'incabella', 'Hero photos', 'Hero photos', 'edit_theme_options', 'incabella-photos', 'ib_photos_screen' );
	}
);

add_action(
	'admin_enqueue_scripts',
	function ( $hook ) {
		if ( false === strpos( $hook, 'incabella' ) ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_style( 'ib-admin', get_template_directory_uri() . '/assets/admin/admin.css', array(), IB_VERSION );
		wp_enqueue_script( 'ib-admin', get_template_directory_uri() . '/assets/admin/admin.js', array( 'jquery' ), IB_VERSION, true );
	}
);

/** Thumbnail address for the dashboard. */
function ib_admin_thumb( $image, $theme_folder ) {
	if ( is_int( $image ) || ctype_digit( (string) $image ) ) {
		$url = wp_get_attachment_image_url( (int) $image, 'thumbnail' );
		if ( $url ) {
			return $url;
		}
	}
	return get_template_directory_uri() . '/assets/img/' . $theme_folder . '/' . $image;
}

function ib_admin_notice() {
	if ( isset( $_GET['saved'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		echo '<div class="notice notice-success is-dismissible"><p><strong>Saved.</strong> The website now shows your changes.</p></div>';
	}
}

/* ---------- Hire prices & photos ---------- */

function ib_products_screen() {
	$defaults = ib_default_products();
	$edits    = ib_product_edits();
	?>
	<div class="wrap ib-admin">
		<h1>Hire prices &amp; photos</h1>
		<?php ib_admin_notice(); ?>
		<p class="ib-intro">Click an item to open it. Change the price, the description or the photos, then press <strong>Save changes</strong> at the bottom of the page.</p>
		<p><label class="screen-reader-text" for="ib-search">Find an item</label><input type="search" id="ib-search" class="regular-text" placeholder="Find an item, e.g. lantern"></p>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="ib_save_products">
			<?php wp_nonce_field( 'ib_save_products' ); ?>

			<?php foreach ( ib_product_groups() as $group ) : ?>
				<h2 class="ib-group"><?php echo esc_html( $group['name'] ); ?></h2>
				<?php
				foreach ( $defaults as $slug => $p ) :
					if ( $p['group'] !== $group['id'] ) {
						continue;
					}
					$price  = isset( $edits[ $slug ]['price'] ) ? $edits[ $slug ]['price'] : $p['price'];
					$desc   = isset( $edits[ $slug ]['description'] ) ? $edits[ $slug ]['description'] : $p['description'];
					$images = ib_product_images( $slug );
					$field  = 'ib[' . $slug . ']';
					?>
					<details class="ib-item" data-name="<?php echo esc_attr( strtolower( $p['name'] ) ); ?>">
						<summary>
							<img src="<?php echo esc_url( ib_admin_thumb( $images[0], 'products' ) ); ?>" alt="">
							<span class="ib-name"><?php echo esc_html( $p['name'] ); ?></span>
							<span class="ib-price">£<?php echo esc_html( number_format( (float) $price, 2 ) ); ?><?php echo ! empty( $p['unit'] ) ? ' ' . esc_html( $p['unit'] ) : ''; ?></span>
						</summary>
						<div class="ib-fields">
							<p>
								<label for="ib-price-<?php echo esc_attr( $slug ); ?>"><strong>Price (£)</strong></label><br>
								<input type="number" step="0.01" min="0" class="small-text ib-price-input" id="ib-price-<?php echo esc_attr( $slug ); ?>" name="<?php echo esc_attr( $field ); ?>[price]" value="<?php echo esc_attr( $price ); ?>">
								<span class="description">
									Numbers only, e.g. 25 or 10.50.
									<?php if ( ! empty( $p['from'] ) ) : ?> Shown as “From £…”.<?php endif; ?>
									<?php if ( ! empty( $p['unit'] ) ) : ?> Shown with “<?php echo esc_html( $p['unit'] ); ?>” after it.<?php endif; ?>
								</span>
							</p>
							<p>
								<label for="ib-desc-<?php echo esc_attr( $slug ); ?>"><strong>Description</strong></label><br>
								<textarea rows="7" class="large-text" id="ib-desc-<?php echo esc_attr( $slug ); ?>" name="<?php echo esc_attr( $field ); ?>[description]"><?php echo esc_textarea( $desc ); ?></textarea>
								<span class="description">Leave a blank line to start a new paragraph. Start a line with “- ” (a dash and a space) to make a bullet point.</span>
							</p>
							<div>
								<strong>Photos</strong>
								<span class="description">The first photo is the main one, shown on the hire page.</span>
								<?php ib_photo_list( $field . '[images]', $images, $p['images'], 'products' ); ?>
							</div>
						</div>
					</details>
				<?php endforeach; ?>
			<?php endforeach; ?>

			<p class="ib-save"><?php submit_button( 'Save changes', 'primary large', 'submit', false ); ?></p>
		</form>
	</div>
	<?php
}

/** Editable list of photos. Each photo is a Media Library id or one of the theme's own file names. */
function ib_photo_list( $name, $images, $originals, $theme_folder ) {
	$base = get_template_directory_uri() . '/assets/img/' . $theme_folder . '/';
	?>
	<div class="ib-photos" data-base="<?php echo esc_url( $base ); ?>" data-originals="<?php echo esc_attr( implode( ',', $originals ) ); ?>">
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( implode( ',', $images ) ); ?>">
		<ul>
			<?php foreach ( $images as $image ) : ?>
				<li data-image="<?php echo esc_attr( $image ); ?>">
					<img src="<?php echo esc_url( ib_admin_thumb( $image, $theme_folder ) ); ?>" alt="">
					<button type="button" class="button-link ib-replace">Replace</button>
					<button type="button" class="button-link ib-remove">Remove</button>
				</li>
			<?php endforeach; ?>
		</ul>
		<p>
			<button type="button" class="button ib-add">Add a photo</button>
			<button type="button" class="button-link ib-reset">Put the original photos back</button>
		</p>
	</div>
	<?php
}

add_action(
	'admin_post_ib_save_products',
	function () {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( 'Sorry, you are not allowed to do that.' );
		}
		check_admin_referer( 'ib_save_products' );

		$posted = isset( $_POST['ib'] ) && is_array( $_POST['ib'] ) ? wp_unslash( $_POST['ib'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- sanitised field by field below.
		$edits  = array();

		foreach ( ib_default_products() as $slug => $p ) {
			if ( empty( $posted[ $slug ] ) || ! is_array( $posted[ $slug ] ) ) {
				continue;
			}
			$in   = $posted[ $slug ];
			$item = array();

			$raw = isset( $in['price'] ) ? str_replace( array( '£', ',', ' ' ), '', (string) $in['price'] ) : '';
			if ( is_numeric( $raw ) && (float) $raw >= 0 ) {
				$price = round( (float) $raw, 2 );
				if ( abs( $price - (float) $p['price'] ) > 0.001 ) {
					$item['price'] = $price;
				}
			}

			if ( isset( $in['description'] ) ) {
				$desc = sanitize_textarea_field( str_replace( "\r\n", "\n", (string) $in['description'] ) );
				if ( '' !== $desc && sanitize_textarea_field( $p['description'] ) !== $desc ) {
					$item['description'] = $desc;
				}
			}

			if ( isset( $in['images'] ) ) {
				$images = array();
				foreach ( explode( ',', (string) $in['images'] ) as $image ) {
					$image = trim( $image );
					if ( ctype_digit( $image ) && wp_attachment_is_image( (int) $image ) ) {
						$images[] = (int) $image;
					} elseif ( in_array( $image, $p['images'], true ) ) {
						$images[] = $image;
					}
				}
				if ( $images && $images !== $p['images'] ) {
					$item['images'] = $images;
				}
			}

			if ( $item ) {
				$edits[ $slug ] = $item;
			}
		}

		update_option( 'ib_product_edits', $edits, true );
		wp_safe_redirect( admin_url( 'admin.php?page=incabella&saved=1' ) );
		exit;
	}
);

/* ---------- Hero photos ---------- */

function ib_photos_screen() {
	$edits = ib_photo_edits();
	?>
	<div class="wrap ib-admin">
		<h1>Hero photos</h1>
		<?php ib_admin_notice(); ?>
		<p class="ib-intro">These are the large photos at the top of the pages. Press <strong>Replace</strong> to choose a new photo, then <strong>Save changes</strong>. Wide (landscape) photos work best.</p>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="ib_save_photos">
			<?php wp_nonce_field( 'ib_save_photos' ); ?>

			<div class="ib-hero-grid">
				<?php foreach ( ib_photo_slots() as $slot => $info ) : ?>
					<?php $image = ! empty( $edits[ $slot ] ) ? (int) $edits[ $slot ] : $info['file']; ?>
					<div class="ib-hero">
						<h2><?php echo esc_html( $info['label'] ); ?></h2>
						<div class="ib-photos ib-photos--single" data-base="<?php echo esc_url( get_template_directory_uri() . '/assets/img/site/' ); ?>" data-originals="<?php echo esc_attr( $info['file'] ); ?>">
							<input type="hidden" name="ib_photo[<?php echo esc_attr( $slot ); ?>]" value="<?php echo esc_attr( $image ); ?>">
							<ul>
								<li data-image="<?php echo esc_attr( $image ); ?>">
									<img src="<?php echo esc_url( is_int( $image ) ? wp_get_attachment_image_url( $image, 'medium' ) : ib_site_img( $image ) ); ?>" alt="">
									<button type="button" class="button ib-replace">Replace</button>
								</li>
							</ul>
							<p><button type="button" class="button-link ib-reset">Put the original photo back</button></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<p class="ib-save"><?php submit_button( 'Save changes', 'primary large', 'submit', false ); ?></p>
		</form>
	</div>
	<?php
}

add_action(
	'admin_post_ib_save_photos',
	function () {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( 'Sorry, you are not allowed to do that.' );
		}
		check_admin_referer( 'ib_save_photos' );

		$posted = isset( $_POST['ib_photo'] ) && is_array( $_POST['ib_photo'] ) ? wp_unslash( $_POST['ib_photo'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- only image ids are kept.
		$edits  = array();
		foreach ( array_keys( ib_photo_slots() ) as $slot ) {
			$value = isset( $posted[ $slot ] ) ? trim( (string) $posted[ $slot ] ) : '';
			if ( ctype_digit( $value ) && wp_attachment_is_image( (int) $value ) ) {
				$edits[ $slot ] = (int) $value;
			}
		}

		update_option( 'ib_photo_edits', $edits, true );
		wp_safe_redirect( admin_url( 'admin.php?page=incabella-photos&saved=1' ) );
		exit;
	}
);
