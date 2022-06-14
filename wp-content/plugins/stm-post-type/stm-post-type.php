<?php
/*
Plugin Name: STM Configurations
Plugin URI: http://stylemixthemes.com/
Description: STM Post Type
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_post_type
Version: 3.5.7
*/

define( 'STM_POST_TYPE', 'stm_post_type' );
define( 'STM_POST_TYPE_DB_VERSION', '1.0.4' );
define( 'STM_POST_TYPE_PLUGIN_VERSION', '3.5.7' );
define( 'STM_POST_TYPE_PATH', dirname( __FILE__ ) );
define( 'STM_POST_TYPE_URL', plugin_dir_url( __FILE__ ) );
if (!is_textdomain_loaded('stm_post_type')) {
    load_plugin_textdomain('stm_post_type', false, STM_POST_TYPE_PATH . '/languages');
}
require_once STM_POST_TYPE_PATH . '/post_type.class.php';
require_once STM_POST_TYPE_PATH . '/theme/helpers.php';
require_once STM_POST_TYPE_PATH . '/theme/vc.php';

require_once STM_POST_TYPE_PATH . '/theme-options/nuxy/NUXY.php';
require_once STM_POST_TYPE_PATH . '/theme-options/inc/functions.php';
require_once STM_POST_TYPE_PATH . '/theme-options/theme-options.php';
require_once STM_POST_TYPE_PATH . '/theme-options/post-options.php';
require_once STM_POST_TYPE_PATH . '/theme-options/inc/patcher.php';
require_once STM_POST_TYPE_PATH . '/theme-options/inc/elementor_hf.php';
require_once STM_POST_TYPE_PATH . '/theme-options/inc/metaboxes/fields/main.php';
require_once STM_POST_TYPE_PATH . '/theme/stm-icons.php';

//Custom Widgets
require_once(STM_POST_TYPE_PATH . '/widgets/socials.php');
require_once(STM_POST_TYPE_PATH . '/widgets/contacts.php');

function stm_plugin_styles() {
    wp_enqueue_style( 'nuxy-styles', STM_POST_TYPE_URL . '/theme-options/inc/assets/css/styles.css', null, null, 'all' );
    wp_enqueue_style( 'nuxy-styles' );

	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'stm_plugin_styles' );
