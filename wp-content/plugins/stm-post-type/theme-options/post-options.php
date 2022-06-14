<?php

new Consulting_Post_WPCFTO();

class Consulting_Post_WPCFTO
{

    public function __construct()
    {
        add_action( 'init', array( $this, 'consulting_post_config_autoload' ) );
        add_filter( 'stm_wpcfto_fields', array( $this, 'consulting_layout_post_options' ) );
    }

    public function consulting_post_config_autoload()
    {
        $configMap = array(
            'global',
            'events',
            'events_member',
            'services',
            'vacancies',
            'staff',
            'testimonials',
            'portfolio',
            'ehf'
        );

        foreach ( $configMap as $file ) {
            if( file_exists( STM_POST_TYPE_PATH . '/theme-options/inc/post-fields/' . $file . '.php' ) ) {
                require_once( STM_POST_TYPE_PATH . '/theme-options/inc/post-fields/' . $file . '.php' );
            }
        }
    }

    public function consulting_layout_post_options( $setups )
    {

        $fields = apply_filters( 'consulting_post_options', $setups );

        return $fields;
    }

}

