<?php
/*
Plugin Name: STM Importer
Plugin URI: https://stylemixthemes.com/
Description: STM Importer plugin for Demo Content Import.
Author: Stylemix Themes
Author URI: https://stylemixthemes.com/
Text Domain: stm_importer
Version: 5.8.9
*/

define('STM_CONFIGURATIONS_PATH', dirname(__FILE__));
define('STM_CONFIGURATIONS_URL', plugin_dir_url(__FILE__));

if ( is_admin() ) {
	add_action( 'wp_ajax_stm_demo_import_content', 'stm_demo_import_content' );
}

/**
 * Removed bookit redirect
 */
add_action('admin_init', function () {
	delete_transient('fs_plugin_bookit_activated');
});

require_once(STM_CONFIGURATIONS_PATH . '/helpers/before_content.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/content.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/theme_options.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/plugins_options.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/slider.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/widgets.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/set_content.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/set_hb_options.php');
require_once(STM_CONFIGURATIONS_PATH . '/helpers/megamenu/config.php');

/**
 * Demo Import Ajax Action
 */
function stm_demo_import_content()
{
	if ( ! current_user_can('administrator') ) die;
	check_ajax_referer('stm_demo_import_content', 'nonce');
	$layout         = !empty($_GET['demo_template']) ? sanitize_title($_GET['demo_template']) : 'default';
	$builder        = !empty($_GET['builder']) ? sanitize_title($_GET['builder']) : 'js_composer';
	$import_data    = !empty($_GET['import_data']) ? sanitize_title($_GET['import_data']) : '';
	$import_media   = !empty($_GET['import_media']) ? ($_GET['import_media'] === 'true') : false;

	// Run demo import parts
    $res = stm_demo_import_content_cli($layout, $builder, $import_data, $import_media);
    if ( is_wp_error( $res ) ) {
        wp_send_json_error( $res, 400 );
    }

	if ( ! empty( $import_data ) ) {
		wp_send_json([
			'imported' => $import_data
		]);
	} else {
		wp_send_json([
			'url' => get_bloginfo('url'),
			'title' => esc_html__('View site', 'consulting'),
			'theme_options_title' => esc_html__('Theme options', 'consulting'),
			'theme_options' => esc_url_raw(admin_url('customize.php'))
		]);
	}

	die();
}

/**
 * Run Demo Import
 *
 * @param $layout
 * @param $builder
 * @param $import_data
 * @param $import_media
 *
 * @return array|bool|string|\WP_Error
 */
function stm_demo_import_content_cli($layout, $builder, $import_data, $import_media) {
	switch ( $import_data ) {
		case 'content':
			stm_theme_before_import_content($layout, $builder);
			/** Import content */
			return stm_theme_import_content($layout, $builder, $import_media);
		case 'theme_options':
			/** Import theme options */
			stm_set_layout_options($layout);
			/** Import plugins options */
			stm_set_plugins_layout_options($layout);
			/** Import header builder */
			stm_set_hb_options($layout);
			break;
		case 'sliders':
			/** Import sliders */
			stm_theme_import_sliders($layout);
			break;
		case 'widgets':
			/** Import Widgets */
			stm_theme_import_widgets($layout);
			/** Set menu and pages */
			stm_set_content_options($layout, $builder);
			break;
		default:
			update_option('consulting_layout', $layout);
			do_action( 'consulting_importer_done', $layout );
	}
}

