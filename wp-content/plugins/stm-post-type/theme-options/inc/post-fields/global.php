<?php

add_filter( 'stm_wpcfto_boxes', function( $boxes ) {

    $boxes[ 'page_setup' ] = array(
        'post_type' => array( 'page', 'post', 'stm_event', 'stm_service', 'stm_careers', 'stm_staff', 'stm_works', 'stm_portfolio', 'product', 'elementor-hf' ),
        'label' => esc_html__( 'Settings', 'stm_post_type' ),
    );

    return $boxes;

});

add_filter( 'consulting_post_options', function( $fields ) {
    // Default Values
    $metabox_header_inverse = consulting_theme_option( 'metabox_header_inverse', false );
    $metabox_disable_title_box = consulting_theme_option( 'metabox_disable_title_box', false );
    $metabox_enable_transparent = consulting_theme_option( 'metabox_enable_transparent', false );
    $metabox_title_box_title_color = consulting_theme_option( 'metabox_title_box_title_color' );
    $metabox_title_box_title_line_color = consulting_theme_option( 'metabox_title_box_title_line_color' );
    $metabox_title_box_title_bg_color = consulting_theme_option( 'metabox_title_box_title_bg_color' );
    $metabox_title_box_bg_image = consulting_theme_option( 'metabox_title_box_bg_image' );
    $metabox_title_box_bg_position = consulting_theme_option( 'metabox_title_box_bg_position' );
    $metabox_title_box_bg_size = consulting_theme_option( 'metabox_title_box_bg_size' );
    $metabox_title_box_bg_repeat = consulting_theme_option( 'metabox_title_box_bg_repeat', 'no-repeat' );
    $metabox_disable_title = consulting_theme_option( 'metabox_disable_title', false );
    $metabox_disable_breadcrumbs = consulting_theme_option( 'metabox_disable_breadcrumbs', false );
    $metabox_enable_header_transparent = consulting_theme_option( 'metabox_enable_header_transparent', false );
    $metabox_content_bg_transparent = (bool)consulting_theme_option( 'metabox_content_bg_transparent', false );
    $metabox_footer_copyright_border_t = consulting_theme_option( 'metabox_footer_copyright_border_t', false );

    if( isset( $_GET[ 'source' ] ) || get_the_ID() ) {
        $post_id = ( isset( $_GET[ 'source' ] ) ) ? $_GET[ 'source' ] : get_the_ID();

        $custom_post_type = get_post_type( $post_id );

        if( $custom_post_type != 'elementor-hf' ) {
            $fields[ 'page_setup' ] = array(
        'section_page_settings' => array(
            'name' => esc_html__( 'Page Settings', 'stm_post_type' ),
            'fields' => array(
                'header_inverse' => array(
                    'label' => esc_html__( 'Style - Inverse', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'submenu' => esc_html__( 'Header Options', 'stm_post_type' ),
                    'value' => $metabox_header_inverse
                ),
                'disable_title_box' => array(
                    'label' => esc_html__( 'Disable Title Box', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_disable_title_box,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'enable_transparent' => array(
                    'label' => esc_html__( 'Enable Transparent', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_enable_transparent,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_title_color' => array(
                    'label' => esc_html__( 'Title Color', 'stm_post_type' ),
                    'type' => 'color',
                    'value' => $metabox_title_box_title_color,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_title_line_color' => array(
                    'label' => esc_html__( 'Title Line Color', 'stm_post_type' ),
                    'type' => 'color',
                    'value' => $metabox_title_box_title_line_color,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_title_bg_color' => array(
                    'label' => esc_html__( 'Title Background Color', 'stm_post_type' ),
                    'type' => 'color',
                    'value' => $metabox_title_box_title_bg_color,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_bg_image' => array(
                    'label' => esc_html__( 'Background Image', 'stm_post_type' ),
                    'type' => 'image',
                    'value' => $metabox_title_box_bg_image,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_bg_position' => array(
                    'label' => esc_html__( 'Background Position', 'stm_post_type' ),
                    'type' => 'text',
                    'value' => $metabox_title_box_bg_position,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_bg_size' => array(
                    'label' => esc_html__( 'Background Size', 'stm_post_type' ),
                    'type' => 'text',
                    'value' => $metabox_title_box_bg_size,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'title_box_bg_repeat' => array(
                    'label' => esc_html__( 'Background Repeat', 'stm_post_type' ),
                    'type' => 'select',
                    'options' => array(
                        'repeat' => esc_html__( 'Repeat', 'stm_post_type' ),
                        'no-repeat' => esc_html__( 'No Repeat', 'stm_post_type' ),
                        'repeat-x' => esc_html__( 'Repeat-X', 'stm_post_type' ),
                        'repeat-y' => esc_html__( 'Repeat-Y', 'stm_post_type' )
                    ),
                    'value' => $metabox_title_box_bg_repeat,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'disable_title' => array(
                    'label' => esc_html__( 'Disable Title', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_disable_title,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'disable_breadcrumbs' => array(
                    'label' => esc_html__( 'Disable Breadcrumbs', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_disable_breadcrumbs,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'enable_header_transparent' => array(
                    'label' => esc_html__( 'Enable Header Transparent', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_enable_header_transparent,
                    'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' )
                ),
                'content_bg_transparent' => array(
                    'label' => esc_html__( 'Background - Transparent (Work only with "Boxed Mode")', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_content_bg_transparent,
                    'submenu' => esc_html__( 'Content Options', 'stm_post_type' )
                ),
                'separator_footer_copyright_border_t' => array(
                    'label' => esc_html__( 'Border Top - Hide', 'stm_post_type' ),
                    'type' => 'checkbox',
                    'value' => $metabox_footer_copyright_border_t,
                    'submenu' => esc_html__( 'Footer Options', 'stm_post_type' )
                )
            )
        ),
    );
        }
    }

    return $fields;

} );