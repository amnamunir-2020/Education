<?php

add_filter( 'stm_wpcfto_boxes', function( $boxes ) {

    $boxes[ 'consulting_event_member' ] = array(
        'post_type' => array( 'post_type', 'event_member' ),
        'label' => esc_html__( 'Contact Info', 'stm_post_type' ),
    );

    return $boxes;

} );

add_filter( 'stm_wpcfto_fields', function( $fields ) {

    $fields[ 'consulting_event_member' ] = array(
        'section_event_member' => array(
            'name' => esc_html__( 'Contact Info', 'stm_post_type' ),
            'fields' => array(
                'name' => array(
                    'label' => esc_html__( 'Name', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'email' => array(
                    'label' => esc_html__( 'Email', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'phone' => array(
                    'label' => esc_html__( 'Phone', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'company' => array(
                    'label' => esc_html__( 'Company', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'memberId' => array(
                    'label' => esc_html__( 'Member ID', 'stm_post_type' ),
                    'type' => 'text'
                )
            ),
        ),
    );

    return $fields;

} );