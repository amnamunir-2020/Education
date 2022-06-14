<?php
/**
 * Plugin Name: STM Templates Library
 * Plugin URI: #
 * Description: STM Templates Library - Theme Templates for Visual Composer and Elementor WordPress Plugins.
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * Text Domain: stm-templates-library
 * Version: 1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'STL_VERSION', '1.2' );
define( 'STL_PATH', dirname( __FILE__ ) );
define( 'STL_URL', plugins_url( '', __FILE__ ) );
define( 'STL_PLUGIN_FILE', __FILE__ );

if( class_exists( 'WPBakeryShortCode' ) ) {
    require_once( trailingslashit( STL_PATH ) . 'core/wpbakery/init.php' );
}

if( defined( 'ELEMENTOR_VERSION' ) ) {
    require_once( trailingslashit( STL_PATH ) . 'core/elementor/init.php' );
}
