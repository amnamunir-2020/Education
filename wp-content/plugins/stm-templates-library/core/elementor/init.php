<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action( 'elementor/init', function() {
    require_once( trailingslashit( STL_PATH ) . 'core/elementor/templates-panel/source.php' );

    $unregister_source = function($id) {
        unset( $this->_registered_sources[ $id ] );
    };

    $unregister_source->call( \Elementor\Plugin::instance()->templates_manager, 'remote');
    \Elementor\Plugin::instance()->templates_manager->register_source( 'Elementor\TemplateLibrary\Source_Custom' );
}, 15 );