<?php

if ( class_exists('\CEI\Classes\Admin\CustomIcons') ) {
	add_action( 'admin_init', 'stm_move_default_fonts' );

	function stm_move_default_fonts() {
		$defaults = get_option( 'stm_fonts' );

		if ( ! $defaults ) {
			$customIcons    = new \CEI\Classes\Admin\CustomIcons();
			$fonts_dir      = trailingslashit( $customIcons->paths['basedir'] ) . $customIcons->paths['fonts'] . '/stm';

			if ( $customIcons->create_directory( $fonts_dir ) ) {
				foreach ( glob( STM_POST_TYPE_PATH . '/assets/fonts/stm/' . '*' ) as $file ) {
					$new_file = basename( $file );
					@copy( $file, $fonts_dir . '/' . $new_file );
				}

				$fonts['stm'] = [
					'include'   => trailingslashit( $customIcons->paths['fonts'] ) . 'stm',
					'folder'    => trailingslashit( $customIcons->paths['fonts'] ) . 'stm',
					'style'     => 'stm' . '/' . 'stm' . '.css',
					'config'    => $customIcons->paths['config'],
					'json'      => $customIcons->paths['json']
				];

				update_option( 'stm_fonts', $fonts );
			}
		}
	}
}
