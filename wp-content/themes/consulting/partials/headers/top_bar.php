<div class="top_bar <?php echo esc_attr( consulting_top_bar_classes() ); ?>">
	<div class="container">

		<?php
		if ( function_exists( 'icl_object_id' ) && consulting_theme_option( 'wpml_switcher', false ) ) {
			if ( consulting_theme_option( 'wpml_switcher_style', false ) == 'wpml_default' ) {
				echo '<div class="lang_sel header_lang_sel">';
				do_action( 'wpml_add_language_selector' );
				echo '</div>';
			} else {
				consulting_topbar_lang();
			}
		}
		?>

		<?php
		$top_bar_info_display = consulting_theme_option( 'offices_contact_display' );
		$top_bar_info = consulting_theme_option( 'offices_contact', array() );
		$top_bar_align = ( consulting_theme_option( 'offices_contact_align' ) ) ? consulting_theme_option( 'offices_contact_align' ) : 'right';
		if ( ! empty( $top_bar_info_display ) ) {
			?>
			<div class="top_bar_info_wr" style="justify-content: <?php echo esc_attr( $top_bar_align ); ?>">
				<?php if ( count( $top_bar_info ) > 1 ) : ?>
					<div class="top_bar_info_switcher">
						<div class="active">
                        <span>
                            <?php printf( _x( '%s', 'Top bar Active Office', 'consulting' ), $top_bar_info[ 0 ][ 'top_bar_contact_office' ] ); ?>
                        </span>
						</div>
						<ul>
							<?php foreach ( $top_bar_info as $key => $val ): ?>
								<li>
									<a href="top_bar_info_<?php echo esc_attr( $key ); ?>">
										<?php printf( _x( '%s', 'Top bar Office', 'consulting' ), $val[ 'top_bar_contact_office' ] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php foreach ( $top_bar_info as $key => $val ): ?>
					<ul class="top_bar_info" id="top_bar_info_<?php echo esc_attr( $key ); ?>"<?php if ( $key == 0 ) {
						echo ' style="display: block;"';
					} ?>>
						<?php if ( ! empty( $val[ 'top_bar_contact_address' ] ) ): ?>
							<li>
								<?php if ( ! empty( $val[ 'top_bar_contact_address_icon' ] ) ) : ?>
									<i class="<?php echo esc_attr( $val[ 'top_bar_contact_address_icon' ][ 'icon' ] ); ?>" style="font-size: <?php echo esc_attr( $val[ 'top_bar_contact_address_icon' ][ 'size' ] ); ?>px; color: <?php echo esc_attr( $val[ 'top_bar_contact_address_icon' ][ 'color' ] ); ?>;"></i>
								<?php endif; ?>
								<span>
                            <?php printf( _x( '%s', 'Top bar address', 'consulting' ), $val[ 'top_bar_contact_address' ] ); ?>
                        </span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val[ 'top_bar_contact_hours' ] ) ): ?>
							<li>
								<?php if ( ! empty( $val[ 'top_bar_contact_hours_icon' ] ) ) : ?>
									<i class="<?php echo esc_attr( $val[ 'top_bar_contact_hours_icon' ][ 'icon' ] ); ?>" style="font-size: <?php echo esc_attr( $val[ 'top_bar_contact_hours_icon' ][ 'size' ] ); ?>px; color: <?php echo esc_attr( $val[ 'top_bar_contact_hours_icon' ][ 'color' ] ); ?>;"></i>
								<?php endif; ?>
								<span>
                            <?php printf( _x( '%s', 'Top bar hours', 'consulting' ), $val[ 'top_bar_contact_hours' ] ); ?>
                        </span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val[ 'top_bar_contact_email' ] ) ): ?>
							<li>
								<?php if ( ! empty( $val[ 'top_bar_contact_email_icon' ] ) ) : ?>
									<i class="<?php echo esc_attr( $val[ 'top_bar_contact_email_icon' ][ 'icon' ] ); ?>" style="font-size: <?php echo esc_attr( $val[ 'top_bar_contact_email_icon' ][ 'size' ] ); ?>px; color: <?php echo esc_attr( $val[ 'top_bar_contact_email_icon' ][ 'color' ] ); ?>;"></i>
								<?php endif; ?>
								<span>
                            <?php printf( _x( '%s', 'Top bar email', 'consulting' ), $val[ 'top_bar_contact_email' ] ); ?>
                        </span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val[ 'top_bar_contact_phone' ] ) ): ?>
							<li>
								<?php if ( ! empty( $val[ 'top_bar_contact_phone_icon' ] ) ) : ?>
									<i class="<?php echo esc_attr( $val[ 'top_bar_contact_phone_icon' ][ 'icon' ] ); ?>" style="font-size: <?php echo esc_attr( $val[ 'top_bar_contact_phone_icon' ][ 'size' ] ); ?>px; color: <?php echo esc_attr( $val[ 'top_bar_contact_phone_icon' ][ 'color' ] ); ?>;"></i>
								<?php endif; ?>
								<span>
                            <?php printf( _x( '%s', 'Top bar phone', 'consulting' ), $val[ 'top_bar_contact_phone' ] ); ?>
                        </span>
							</li>
						<?php endif; ?>
					</ul>
				<?php endforeach; ?>
			</div>
		<?php } ?>

		<?php
		$socials = consulting_get_socials();
		if ( consulting_theme_option( 'top_bar_socials', false ) ) { ?>
			<div class="top_bar_socials">
				<?php foreach ( $socials as $key => $val ): ?>
					<a target="_blank" href="<?php echo esc_attr( $val ); ?>">
						<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
					</a>
				<?php endforeach; ?>
			</div>
		<?php } ?>

		<?php if ( class_exists( 'WooCommerce' ) && consulting_theme_option( 'wc_topbar_cart_hide', false ) ) : ?>
			<div class="top_bar_cart">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<i class="stm-shopping-cart8">&nbsp;</i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
			</div>
		<?php endif; ?>

		<?php if ( consulting_theme_option( 'top_bar_search', false ) ) { ?>
			<div class="top_bar_search header_search_in_popup">
				<i class="fa fa-search search-icon">&nbsp;</i>
				<?php get_search_form( true ); ?>
			</div>
		<?php } ?>
	</div>
</div>