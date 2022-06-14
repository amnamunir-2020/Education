<?php

add_filter( 'consulting_theme_options', function( $setups ) {

    $customFields = array(
        'name' => esc_html__( 'Custom CSS', 'stm_post_type' ),
        'icon' => 'fas fa-code',
        'fields' => array(
            'custom_css' => array(
                'type' => 'ace_editor',
                'label' => esc_html__( 'Css Editor', 'stm_post_type' ),
                'lang' => 'css'
            )
        )
    );

    $setups[ 'css' ] = $customFields;

    return $setups;

}, 10, 1 );