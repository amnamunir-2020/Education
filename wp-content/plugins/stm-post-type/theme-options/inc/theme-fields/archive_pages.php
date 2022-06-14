<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $customFields = array(
        'name' => esc_html__( 'Archive Pages', 'stm_post_type' ),
        'icon' => 'fas fa-edit',
        'fields' => array(
            'blog_layout' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Layout', 'stm_post_type' ),
                'description' => esc_html__( 'Select the layout type', 'stm_post_type' ),
                'options' => array(
                    'grid' => esc_html__( 'Grid View', 'stm_post_type' ),
                    'list' => esc_html__( 'List View', 'stm_post_type' )
                ),
                'value' => 'list',
                'submenu' => esc_html__( 'General', 'stm_post_type' )
            ),
            'blog_sidebar_type' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Sidebar Type', 'stm_post_type' ),
                'group' => 'started',
                'options' => array(
                    'wp' => esc_html__( 'Wordpress Sidebars', 'stm_post_type' ),
                    'vc' => esc_html__( 'VC Sidebars', 'stm_post_type' )
                ),
                'value' => 'wp',
                'submenu' => esc_html__( 'General', 'stm_post_type' )
            ),
            'blog_wp_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'Wordpress Sidebar', 'stm_post_type' ),
                'options' => consulting_wp_sidebars(),
                'dependency' => array(
                    'key' => 'blog_sidebar_type',
                    'value' => 'wp'
                ),
                'submenu' => esc_html__( 'General', 'stm_post_type' )
            ),
            'blog_vc_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'VC Sidebar', 'stm_post_type' ),
                'options' => consulting_vc_sidebars(),
                'dependency' => array(
                    'key' => 'blog_sidebar_type',
                    'value' => 'vc'
                ),
                'submenu' => esc_html__( 'General', 'stm_post_type' )
            ),
            'blog_sidebar_position' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Sidebar - Position', 'stm_post_type' ),
                'group' => 'ended',
                'options' => array(
                    'left' => esc_html__( 'Left', 'stm_post_type' ),
                    'right' => esc_html__( 'Right', 'stm_post_type' )
                ),
                'value' => 'right',
                'submenu' => esc_html__( 'General', 'stm_post_type' )
            ),
            'header_information_notice' => array(
                'label' => esc_html__( 'Single Page Settings', 'stm_post_type' ),
                'type' => 'notice',
                'group' => 'started',
                'submenu' => esc_html__( 'Events', 'stm_post_type' ),
            ),
            'event_sidebar_type' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Sidebar Type', 'stm_post_type' ),
                'options' => array(
                    'wp' => esc_html__( 'Wordpress Sidebars', 'stm_post_type' ),
                    'vc' => esc_html__( 'VC Sidebars', 'stm_post_type' )
                ),
                'value' => 'wp',
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'event_wp_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'Wordpress Sidebar', 'stm_post_type' ),
                'options' => consulting_wp_sidebars(),
                'dependency' => array(
                    'key' => 'event_sidebar_type',
                    'value' => 'wp'
                ),
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'event_vc_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'VC Sidebar', 'stm_post_type' ),
                'options' => consulting_vc_sidebars(),
                'dependency' => array(
                    'key' => 'event_sidebar_type',
                    'value' => 'vc'
                ),
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'event_terms_conditions' => array(
                'label' => esc_html__( 'Terms and Conditions Page Link', 'stm_post_type' ),
                'type' => 'text',
                'group' => 'ended',
                'value' => 'I agree with the all additional <a href=\'#\'>Terms and Conditions</a>',
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'top_bar_information_notice' => array(
                'type' => 'notice',
                'submenu' => esc_html__( 'Top Bar', 'stm_post_type' ),
                'description' => esc_html__( 'These settings will be applied only with installed and activated WooCommerce plugin', 'stm_post_type' ),
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
            'shop_sidebar_type' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Sidebar Type', 'stm_post_type' ),
                'group' => 'started',
                'options' => array(
                    'wp' => esc_html__( 'Wordpress Sidebars', 'stm_post_type' ),
                    'vc' => esc_html__( 'VC Sidebars', 'stm_post_type' )
                ),
                'value' => 'wp',
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
            'shop_wp_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'Wordpress Sidebar', 'stm_post_type' ),
                'options' => consulting_wp_sidebars(),
                'dependency' => array(
                    'key' => 'shop_sidebar_type',
                    'value' => 'wp'
                ),
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
            'shop_vc_sidebar' => array(
                'type' => 'select',
                'label' => esc_html__( 'VC Sidebar', 'stm_post_type' ),
                'options' => consulting_vc_sidebars(),
                'dependency' => array(
                    'key' => 'shop_sidebar_type',
                    'value' => 'vc'
                ),
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
            'shop_sidebar_position' => array(
                'type' => 'radio',
                'label' => esc_html__( 'Sidebar - Position', 'stm_post_type' ),
                'options' => array(
                    'left' => esc_html__( 'Left', 'stm_post_type' ),
                    'right' => esc_html__( 'Right', 'stm_post_type' )
                ),
                'value' => 'right',
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
            'shop_products_per_page' => array(
                'type' => 'text',
                'label' => esc_html__( 'Products Per Page', 'stm_post_type' ),
                'value' => '9',
                'group' => 'ended',
                'submenu' => esc_html__( 'Shop', 'stm_post_type' )
            ),
        )
    );

    $setups[ 'archive_pages' ] = $customFields;

    return $setups;

}, 10, 1 );