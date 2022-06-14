<?php

add_filter( 'stm_wpcfto_boxes', function( $boxes ) {

    $boxes[ 'consulting_testimonials' ] = array(
        'post_type' => array( 'post_type', 'stm_testimonials' ),
        'label' => esc_html__( 'Testimonials Information', 'stm_post_type' ),
    );

    return $boxes;

} );

add_filter( 'stm_wpcfto_fields', function( $fields ) {

    $fields[ 'consulting_testimonials' ] = array(
        'section_testimonials' => array(
            'name' => esc_html__( 'Field Settings', 'stm_post_type' ),
            'fields' => array(
                'testimonial_position' => array(
                    'label' => esc_html__( 'Position', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'testimonial_company' => array(
                    'label' => esc_html__( 'Company', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'testimonial_bg_img' => array(
                    'label' => esc_html__( 'Background Image', 'stm_post_type' ),
                    'type' => 'image'
                ),
                'testimonial_video_url' => array(
                    'label' => esc_html__( 'Video url', 'stm_post_type' ),
                    'type' => 'text'
                )
            ),
        ),
    );

    return $fields;

} );