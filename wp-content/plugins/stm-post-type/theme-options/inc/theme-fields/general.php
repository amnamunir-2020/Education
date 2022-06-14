<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $consulting_config = '';
    $base_color = '';
    $secondary_color = '';
    $third_color = '';

    if( function_exists( 'consulting_config' ) ) {
        $consulting_config = consulting_config();

        if( !empty( $consulting_config[ 'base_color' ] ) ) {
            $base_color = $consulting_config[ 'base_color' ];
        }
        if( !empty( $consulting_config[ 'secondary_color' ] ) ) {
            $secondary_color = $consulting_config[ 'secondary_color' ];
        }
        if( !empty( $consulting_config[ 'third_color' ] ) ) {
            $third_color = $consulting_config[ 'third_color' ];
        }
    }

    if( !empty( $consulting_config[ 'layout' ] ) && $consulting_config[ 'layout' ] == 'layout_1' ) {
        $skin_arr = array(
            'skin_default' => esc_html__( 'Default', 'stm_post_type' ),
            'skin_turquoise' => esc_html__( 'Turquoise', 'stm_post_type' ),
            'skin_dark_denim' => esc_html__( 'Dark Denim', 'stm_post_type' ),
            'skin_arctic_black' => esc_html__( 'Arctic and Black', 'stm_post_type' ),
            'skin_custom' => esc_html__( 'Custom Colors', 'stm_post_type' ),
        );
    } else {
        $skin_arr = array(
            'skin_default' => esc_html__( 'Default', 'stm_post_type' ),
            'skin_custom' => esc_html__( 'Custom Colors', 'stm_post_type' ),
        );
    }

    $fields = array(
        'logo' => array(
            'type' => 'image',
            'label' => esc_html__( 'Logo', 'stm_post_type' ),
            'description' => sprintf( 'This logo appears on specific layouts. <a href="https://docs.stylemixthemes.com/consulting-theme-documentation/theme-options/theme-customization#logo" target="_blank" rel="nofollow">' . esc_html__( 'See more details ', 'stm_post_type' ) . '</a>' ),
            'group' => 'started',
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'dark_logo' => array(
            'type' => 'image',
            'label' => esc_html__( 'Dark logo', 'stm_post_type' ),
            'description' => sprintf( 'This logo appears on specific layouts and on mobile header. <a href="https://docs.stylemixthemes.com/consulting-theme-documentation/theme-options/theme-customization#logo" target="_blank" rel="nofollow">' . esc_html__( 'See more details ', 'stm_post_type' ) . '</a>' ),
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'logo_width' => array(
            'type' => 'number',
            'label' => esc_html__( 'Logo width', 'stm_post_type' ),
            'step' => 200,
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'logo_height' => array(
            'type' => 'number',
            'label' => esc_html__( 'Logo height', 'stm_post_type' ),
            'step' => 200,
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'logo_margin' => array(
            'type' => 'spacing',
            'label' => esc_html__( 'Logo indent', 'stm_post_type' ),
            'group' => 'ended',
            'units' => ['px', 'em'],
            'value' => [
                'top' => '0',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
                'unit' => 'px',
            ],
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'enable_preloader' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Enable Preloader', 'stm_post_type' ),
            'value' => false,
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'site_skin' => array(
            'type' => 'select',
            'label' => esc_html__( 'Skin', 'stm_post_type' ),
            'description' => esc_html__( 'Select the skin color layout', 'stm_post_type' ),
            'group' => 'started',
            'options' => $skin_arr,
            'value' => 'skin_default',
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'site_skin_base_color' => array(
            'type' => 'color',
            'label' => esc_html__( 'Custom Base Color', 'stm_post_type' ),
            'value' => $base_color,
            'dependency' => array(
                'key' => 'site_skin',
                'value' => 'skin_custom'
            ),
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'site_skin_secondary_color' => array(
            'type' => 'color',
            'label' => esc_html__( 'Custom Secondary Color', 'stm_post_type' ),
            'value' => $secondary_color,
            'dependency' => array(
                'key' => 'site_skin',
                'value' => 'skin_custom'
            ),
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'site_skin_third_color' => array(
            'type' => 'color',
            'label' => esc_html__( 'Custom Third Color', 'stm_post_type' ),
            'group' => 'ended',
            'value' => $third_color,
            'dependency' => array(
                'key' => 'site_skin',
                'value' => 'skin_custom'
            ),
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'site_boxed' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Enable Boxed Layout', 'stm_post_type' ),
            'description' => esc_html__( 'Set the page layout as boxed and select the background from available options or upload your own', 'stm_post_type' ),
            'group' => 'started',
            'value' => false,
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'bg_image' => array(
            'type' => 'image_select',
            'label' => esc_html__( 'Background Image', 'stm_post_type' ),
            'width' => 100,
            'height' => 100,
            'options' => [
                'bg_img_1' => [
                    'alt'   => 'Image 1',
                    'img'   => get_template_directory_uri() . '/assets/images/bg/prev_img_1.png'
                ],
                'bg_img_2' => [
                    'alt'   => 'Image 2',
                    'img'   => get_template_directory_uri() . '/assets/images/bg/prev_img_2.png'
                ],
                'bg_img_3' => [
                    'alt'   => 'Image 3',
                    'img'   => get_template_directory_uri() . '/assets/images/bg/prev_img_3.png'
                ],
                'bg_img_4' => [
                    'alt'   => 'Image 4',
                    'img'   => get_template_directory_uri() . '/assets/images/bg/prev_img_4.png'
                ],
            ],
            'value' => 'bg_img_1',
            'dependency' => array(
                'key' => 'site_boxed',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'custom_bg_image' => array(
            'type' => 'image',
            'label' => esc_html__( 'Custom Background Image', 'stm_post_type' ),
            'group' => 'ended',
            'dependency' => array(
                'key' => 'site_boxed',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        ),
        'google_api_key' => array(
            'type' => 'text',
            'label' => esc_html__( 'Google Maps API key', 'stm_post_type' ),
            'description' => sprintf( 'Enable Google Maps Service. To obtain the keys please visit: <a href="https://cloud.google.com/maps-platform/" target="_blank" rel="nofollow">' . esc_html__( 'https://cloud.google.com/maps-platform/', 'stm_post_type' ) . '</a>' ),
            'submenu' => esc_html__( 'Google API', 'stm_post_type' )
        ),
        'enable_recaptcha' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Google Recaptcha API Settings', 'stm_post_type' ),
            'description' => sprintf( 'Enable Google reCaptcha. To obtain the keys please visit: <a href="https://www.google.com/recaptcha/admin" target="_blank" rel="nofollow">' . esc_html__( 'https://www.google.com/recaptcha/admin', 'stm_post_type' ) . '</a>' ),
            'group' => 'started',
            'submenu' => esc_html__( 'Google API', 'stm_post_type' )
        ),
        'recaptcha_public_key' => array(
            'type' => 'text',
            'label' => esc_html__( 'Recaptcha Public key', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'enable_recaptcha',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Google API', 'stm_post_type' )
        ),
        'recaptcha_secret_key' => array(
            'type' => 'text',
            'label' => esc_html__( 'Recaptcha Secret key', 'stm_post_type' ),
            'group' => 'ended',
            'dependency' => array(
                'key' => 'enable_recaptcha',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Google API', 'stm_post_type' )
        )
    );

    if( !empty( $consulting_config[ 'layout' ] ) && $consulting_config[ 'layout' ] == 'layout_melbourne' ) {
        $fields[ 'enable_black_and_white_images' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Enable Black and White Images', 'stm_post_type' ),
            'value' => 'true',
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        );
    }
    if( !empty( $consulting_config[ 'layout' ] ) && $consulting_config[ 'layout' ] == 'layout_14' ) {
        $fields[ 'enable_page_switcher' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Enable Page Scroll', 'stm_post_type' ),
            'value' => 'true',
            'submenu' => esc_html__( 'Style Settings', 'stm_post_type' )
        );
    }

    $customFields = array(
        'name' => esc_html__( 'General', 'stm_post_type' ),
        'icon' => 'fas fa-sliders-h',
        'fields' => $fields
    );

    $setups[ 'general' ] = $customFields;

    return $setups;

}, 10, 1 );