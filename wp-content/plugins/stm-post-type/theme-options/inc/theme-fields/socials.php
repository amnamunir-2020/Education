<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $customFields = array(
        'name' => esc_html__( 'Socials', 'stm_post_type' ),
        'icon' => 'fas fa-share-alt',
        'fields' => array(
            'socials' => array(
                'type' => 'multi_input',
                'label' => esc_html__( 'Socials Links', 'stm_post_type' ),
                'description' => esc_html__( 'Enter the URL for the respective social accounts', 'stm_post_type' ),
                'options' => consulting_socials_links(),
            )
        )
    );

    $setups[ 'socials' ] = $customFields;

    return $setups;

}, 10, 1 );