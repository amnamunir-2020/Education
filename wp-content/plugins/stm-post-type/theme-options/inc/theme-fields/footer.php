<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $consulting_config = '';

    if( function_exists( 'consulting_config' ) ) {
        $consulting_config = consulting_config();
    }

    $fields = array(
        'footer_builder' => array(
            'type' => 'select',
            'label' => esc_html__( 'Footer Builder', 'stm_post_type' ),
            'options' => array(
                'theme_footer_builder' => esc_html__( 'Default Theme Footer', 'stm_post_type' ),
                'elementor_footer_builder' => esc_html__( 'Elementor Footer Builder', 'stm_post_type' )
            ),
            'value' => 'theme_footer_builder',
            'submenu' => esc_html__( 'Footer Builder', 'stm_post_type' )
        ),
        'consulting_footer_information_notice' => array(
            'type' => 'notification_message',
            'image' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/consulting.png',
            'description' => sprintf( '
                <h1>Default Theme Footer</h1>
                <p>The <strong>Default Theme Footer</strong> can be customized through items in the <strong>Footer</strong> menu of the <strong>Theme Options</strong>.</p>
                ' ),
            'buttons' => array (
                array (
                    'url' => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/footer/default-theme-footer',
                    'text' => 'How it works'
                )
            ),
            'submenu' => esc_html__( 'Footer Builder', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            )
        ),
        'ehf_footer_plugin_information_notice' => array(
            'type' => 'notification_message',
            'image' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
            'description' => sprintf( '
                <h1>Elementor Header & Footer Builder</h1>
                <p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
                ' ),
            'buttons' => array (
                array(
                    'url' => admin_url( "plugin-install.php" ),
                    'text' => 'Install & Activate',
                    'class' => 'button_black'
                ),
                array (
                    'url' => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/footer/elementor-footer-builder',
                    'text' => 'How it works'
                )
            ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Footer Builder', 'stm_post_type' )
        ),
        'footer_show_hide' => array(
            'label' => esc_html__( 'Hide Footer', 'stm_post_type' ),
            'type' => 'checkbox',
            'value' => false,
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' )
        ),
        'footer_style' => array(
            'label' => esc_html__( 'Style', 'stm_post_type' ),
            'description' => esc_html__( 'Select the footer layout', 'stm_post_type' ),
            'type' => 'select',
            'options' => array(
                'style_1' => esc_html__( 'Style 1', 'stm_post_type' ),
                'style_2' => esc_html__( 'Style 2', 'stm_post_type' ),
                'style_3' => esc_html__( 'Style 3', 'stm_post_type' )
            ),
            'value' => 'style_1',
            'dependency' => array(
                array(
                    'key' => 'footer_show_hide',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Main', 'stm_post_type' )
        ),
        'footer_custom_settings' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Custom settings', 'stm_post_type' ),
            'description' => esc_html__( 'Enable custom settings and select text, links and background options', 'stm_post_type' ),
            'group' => 'started',
            'value' => false,
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                array(
                    'key' => 'footer_show_hide',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&'
        ),
        'footer_custom_settings_color_text' => array(
            'type' => 'color',
            'label' => esc_html__( 'Text color', 'stm_post_type' ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                array(
                    'key' => 'footer_custom_settings',
                    'value' => 'not_empty'
                ),
                array(
                    'key' => 'footer_show_hide',
                    'value' => 'empty'
                )
            ),
            'dependencies' => '&&'
        ),
        'footer_custom_settings_color_link' => array(
            'type' => 'color',
            'label' => esc_html__( 'Links color', 'stm_post_type' ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_custom_settings',
                'value' => 'not_empty'
            )
        ),
        'footer_custom_settings_color_link_hover' => array(
            'type' => 'color',
            'label' => esc_html__( 'Links color on hover', 'stm_post_type' ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_custom_settings',
                'value' => 'not_empty'
            )
        ),
        'footer_custom_settings_color_bg' => array(
            'type' => 'color',
            'label' => esc_html__( 'Background color', 'stm_post_type' ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_custom_settings',
                'value' => 'not_empty'
            )
        ),
        'footer_custom_settings_bg_img' => array(
            'type' => 'image',
            'label' => esc_html__( 'Background image', 'stm_post_type' ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_custom_settings',
                'value' => 'not_empty'
            )
        ),
        'footer_custom_settings_bg_overlay' => array(
            'type' => 'color',
            'label' => esc_html__( 'Background image overlay', 'stm_post_type' ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_custom_settings',
                'value' => 'not_empty'
            )
        ),
        'footer_main_information_notice' => array(
            'type' => 'notice',
            'description' => sprintf( 'These settings are available only for <strong>Default Theme Footer</strong>.<br />You can change the builder in Footer Builder Section.', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Main', 'stm_post_type' ),
        ),
        'footer_logo_show_hide' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Hide Logo', 'stm_post_type' ),
            'value' => false,
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Logo', 'stm_post_type' )
        ),
        'footer_logo' => array(
            'type' => 'image',
            'label' => esc_html__( 'Logo', 'stm_post_type' ),
            'submenu' => esc_html__( 'Logo', 'stm_post_type' ),
            'dependency' => array(
                array(
                    'key' => 'footer_logo_show_hide',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&'
        ),
        'footer_logo_width' => array(
            'type' => 'text',
            'label' => esc_html__( 'Width', 'stm_post_type' ),
            'mode' => 'width',
            'units' => 'px',
            'output' => '#footer .widgets_row .footer_logo a img, #footer .footer-top .footer_logo a img',
            'submenu' => esc_html__( 'Logo', 'stm_post_type' ),
            'dependency' => array(
                array(
                    'key' => 'footer_logo_show_hide',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&'
        ),
        'footer_logo_height' => array(
            'type' => 'text',
            'label' => esc_html__( 'Height', 'stm_post_type' ),
            'mode' => 'height',
            'units' => 'px',
            'output' => '#footer .widgets_row .footer_logo a img, #footer .footer-top .footer_logo a img',
            'submenu' => esc_html__( 'Logo', 'stm_post_type' ),
            'dependency' => array(
                array(
                    'key' => 'footer_logo_show_hide',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&'
        ),
        'footer_logo_information_notice' => array(
            'type' => 'notice',
            'description' => sprintf( 'These settings are available only for <strong>Default Theme Footer</strong>.<br />You can change the builder in Footer Builder Section.', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Logo', 'stm_post_type' ),
        ),
        'footer_show_hide_socials' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Hide Socials', 'stm_post_type' ),
            'value' => false,
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Socials', 'stm_post_type' )
        ),
        'footer_socials_information_notice' => array(
            'description' => esc_html__( 'The social networks buttons will be displayed only if the links to these social networks are provided in the Socials tab', 'stm_post_type' ),
            'type' => 'notice',
            'group' => 'started',
            'dependency' => array(
                array(
                    'key' => 'footer_show_hide_socials',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Socials', 'stm_post_type' )
        ),
        'footer_socials' => array(
            'type' => 'multi_checkbox',
            'label' => esc_html__( 'Socials Links', 'stm_post_type' ),
            'options' => consulting_socials(),
            'group' => 'ended',
            'dependency' => array(
                array(
                    'key' => 'footer_show_hide_socials',
                    'value' => 'empty'
                ),
                array(
                    'key' => 'footer_builder',
                    'value' => 'theme_footer_builder'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Socials', 'stm_post_type' )
        ),
        'footer_builder_socials_information_notice' => array(
            'type' => 'notice',
            'description' => sprintf( 'These settings are available only for <strong>Default Theme Footer</strong>.<br />You can change the builder in Footer Builder Section.', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Socials', 'stm_post_type' ),
        ),
        'footer_sidebar_count' => array(
            'type' => 'select',
            'label' => esc_html__( 'Additional Widgets Area', 'stm_post_type' ),
            'description' => esc_html__( 'Specify the number of additional widgets for display', 'stm_post_type' ),
            'value' => 4,
            'options' => array(
                'disable' => esc_html__( 'Disable', 'stm_post_type' ),
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4'
            ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Widgets', 'stm_post_type' )
        ),
        'footer_text' => array(
            'type' => 'textarea',
            'label' => esc_html__( 'Footer Text', 'stm_post_type' ),
            'value' => '',
            'description' => esc_html__( 'This text will appear in the first widget area under footer logo', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Widgets', 'stm_post_type' )
        ),
        'footer_copyright' => array(
            'type' => 'textarea',
            'label' => esc_html__( 'Copyright', 'stm_post_type' ),
            'value' => '',
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Widgets', 'stm_post_type' )
        ),
        'footer_current_year' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Show current year', 'stm_post_type' ),
            'value' => false,
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'theme_footer_builder'
            ),
            'submenu' => esc_html__( 'Widgets', 'stm_post_type' )
        ),
        'footer_widgets_information_notice' => array(
            'type' => 'notice',
            'description' => sprintf( 'These settings are available only for <strong>Default Theme Footer</strong>.<br />You can change the builder in Footer Builder Section.', 'stm_post_type' ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Widgets', 'stm_post_type' ),
        ),
    );

    if( defined( 'HFE_VER' ) ) {
        $fields['ehf_footer_plugin_information_notice'] = array(
            'type' => 'notification_message',
            'image' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
            'description' => sprintf( '
                <h1>Elementor Header & Footer Builder</h1>
                <p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
                ' ),
            'buttons' => array (
                array (
                    'url' => admin_url( "edit.php?post_type=elementor-hf" ),
                    'text' => 'Open header Builder'
                ),
                array (
                    'url' => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/footer/elementor-footer-builder',
                    'text' => 'How it works'
                )
            ),
            'dependency' => array(
                'key' => 'footer_builder',
                'value' => 'elementor_footer_builder'
            ),
            'submenu' => esc_html__( 'Footer Builder', 'stm_post_type' )
        );
    }

    if( !empty( $consulting_config[ 'layout' ] ) && $consulting_config[ 'layout' ] == 'layout_14' ) {
        $fields[ 'footer_enable_menu_top' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Show Menu', 'stm_post_type' ),
            'value' => 'true',
            'submenu' => esc_html__( 'Main', 'stm_post_type' )
        );
    }

    $customFields = array(
        'name' => esc_html__( 'Footer', 'stm_post_type' ),
        'icon' => 'fas fa-digital-tachograph',
        'fields' => $fields
    );

    $setups[ 'footer' ] = $customFields;

    return $setups;

}, 10, 1 );