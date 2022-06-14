<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $customFields = array(
        'name' => esc_html__( 'Post Types', 'stm_post_type' ),
        'icon' => 'fas fa-copy',
        'fields' => array(
            'post_type_services_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_enable_single' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Service', 'stm_post_type' ),
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Services', 'stm_post_type' ),
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Services', 'stm_post_type' ),
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'service',
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_services_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-clipboard',
                'submenu' => esc_html__( 'Services', 'stm_post_type' )
            ),
            'post_type_careers_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_enable_single' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Vacancy', 'stm_post_type' ),
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Vacancies', 'stm_post_type' ),
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Vacancies', 'stm_post_type' ),
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'careers_archive',
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_careers_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-id',
                'submenu' => esc_html__( 'Vacancies', 'stm_post_type' )
            ),
            'post_type_staff_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_enable_archive' => array(
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'type' => 'checkbox',
                'value' => true,
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_enable_single' => array(
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'type' => 'checkbox',
                'value' => true,
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Staff', 'stm_post_type' ),
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Staff', 'stm_post_type' ),
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Staff', 'stm_post_type' ),
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'staff',
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_staff_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-groups',
                'submenu' => esc_html__( 'Staff', 'stm_post_type' )
            ),
            'post_type_works_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_enable_single' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Work', 'stm_post_type' ),
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Works', 'stm_post_type' ),
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Works', 'stm_post_type' ),
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'works',
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_works_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-portfolio',
                'submenu' => esc_html__( 'Works', 'stm_post_type' )
            ),
            'post_type_testimonials_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Testimonial', 'stm_post_type' ),
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Testimonials', 'stm_post_type' ),
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Testimonials', 'stm_post_type' ),
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'testimonials',
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_testimonials_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-testimonial',
                'submenu' => esc_html__( 'Testimonials', 'stm_post_type' )
            ),
            'post_type_events_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_enable_single' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Events', 'stm_post_type' ),
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Events', 'stm_post_type' ),
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Events', 'stm_post_type' ),
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'events',
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_events_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-clipboard',
                'submenu' => esc_html__( 'Events', 'stm_post_type' )
            ),
            'post_type_portfolio_information_notice' => array(
                'description' => esc_html__( 'Please update permalinks after changing the settings', 'stm_post_type' ),
                'type' => 'notice',
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_enable_archive' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Archive', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_enable_single' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Enable Single Page', 'stm_post_type' ),
                'value' => true,
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_title' => array(
                'type' => 'text',
                'label' => esc_html__( 'Title', 'stm_post_type' ),
                'value' => esc_html__( 'Portfolio', 'stm_post_type' ),
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_plural' => array(
                'type' => 'text',
                'label' => esc_html__( 'Plural Title', 'stm_post_type' ),
                'value' => esc_html__( 'Portfolio', 'stm_post_type' ),
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_all_items' => array(
                'type' => 'text',
                'label' => esc_html__( 'All Items', 'stm_post_type' ),
                'value' => esc_html__( 'All Portfolio', 'stm_post_type' ),
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_rewrite' => array(
                'type' => 'text',
                'label' => esc_html__( 'Rewrite (URL text)', 'stm_post_type' ),
                'value' => 'portfolio',
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            ),
            'post_type_portfolio_icon' => array(
                'type' => 'text',
                'label' => esc_html__( 'Icon', 'stm_post_type' ),
                'description' => sprintf( 'Use the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="nofollow">' . esc_html__( 'Wordpress Dashicons ', 'stm_post_type' ) . '</a>' ),
                'value' => 'dashicons-clipboard',
                'submenu' => esc_html__( 'Portfolio', 'stm_post_type' )
            )
        )
    );

    $setups[ 'post_types' ] = $customFields;

    return $setups;

}, 10, 1 );