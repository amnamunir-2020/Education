<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if( !class_exists( 'STL_WPB_INIT' ) ) {

    if( class_exists( 'WPBakeryShortCode' ) ) {
        require_once( trailingslashit( STL_PATH ) . 'core/wpbakery/templates-panel/filter.php' );
        require_once( trailingslashit( STL_PATH ) . 'core/wpbakery/templates-panel/templates.php' );

        add_filter( 'vc_load_default_templates', 'vc_reset_templates' );
        function vc_reset_templates() {
            return array();
        }

        function vc_add_templates() {
            $templates = getTemplatesFile();
            return array_map( 'vc_add_default_templates', $templates );
        }
        vc_add_templates();

        require_once( trailingslashit( STL_PATH ) . 'core/wpbakery/templates-panel/class-vc-templates-panel-editor.php' );
    }

    class STL_WPB_INIT
    {
        function __construct()
        {
            add_action( 'admin_enqueue_scripts', array( $this, 'stl_styles_scripts' ) );
            $this->stl_templates();
        }

        public function stl_templates()
        {
            if( class_exists( 'WPBakeryShortCode' ) ) {
                $WPBakeryTemplates = new STL_Templates_Panel_Editor();
                return $WPBakeryTemplates->init();
            }
        }

        public function stl_styles_scripts()
        {
            if ( is_admin() ) {
                wp_enqueue_style( 'wpbakery-css', plugins_url( 'assets/css/wpbakery.css', STL_PLUGIN_FILE ) );
                wp_enqueue_script( 'isotope', plugins_url( 'assets/js/isotope.pkgd.min.js', STL_PLUGIN_FILE ) );
                wp_enqueue_script( 'wpbakery-js', plugins_url( 'assets/js/wpbakery.js', STL_PLUGIN_FILE ) );
            }
        }

    }
}

new STL_WPB_INIT();