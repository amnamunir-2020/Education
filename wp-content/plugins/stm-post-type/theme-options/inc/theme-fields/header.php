<?php
add_filter(
	'consulting_theme_options', function ( $setups ) {

	$consulting_config = '';

	if ( function_exists( 'consulting_config' ) ) {
		$consulting_config = consulting_config();
	}

	$fields = array(
		'header_builder'                        => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Header Builder', 'stm_post_type' ),
			'options' => array(
				'theme_builder'     => esc_html__( 'Default Theme Headers', 'stm_post_type' ),
				'pear_builder'      => esc_html__( 'Pearl Header Builder', 'stm_post_type' ),
				'elementor_builder' => esc_html__( 'Elementor Header Builder', 'stm_post_type' )
			),
			'value'   => 'theme_builder',
			'submenu' => esc_html__( 'Header Builder', 'stm_post_type' )
		),
		'consulting_headers_information_notice' => array(
			'type'        => 'notification_message',
			'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/consulting.png',
			'description' => sprintf(
				'
                <h1>Default Theme Headers</h1>
                <p>The <strong>Default Theme Headers</strong> can be customized through items in the <strong>Header</strong> menu of the <strong>Theme Options</strong>.</p>
                '
			),
			'buttons'     => array(
				array(
					'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header',
					'text' => 'How it works'
				)
			),
			'submenu'     => esc_html__( 'Header Builder', 'stm_post_type' ),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			)
		),
		'pearl_plugin_information_notice'       => array(
			'type'        => 'notification_message',
			'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/pearl_hb.png',
			'description' => sprintf(
				'
                <h1>WordPress Header Builder Plugin – Pearl</h1>
                <p>The installation and activation of the <strong>WordPress Header Builder Plugin – Pearl</strong> plugin required. You can manage and customize the header in the Header Builder section.</p>
                '
			),
			'buttons'     => array(
				array(
					'url'   => admin_url( "plugin-install.php" ),
					'text'  => 'Install & Activate',
					'class' => 'button_black'
				),
				array(
					'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/pearl-header-builder',
					'text' => 'How it works'
				)
			),
			'submenu'     => esc_html__( 'Header Builder', 'stm_post_type' ),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'pear_builder'
			)
		),
		'ehf_plugin_active_information_notice'  => array(
			'type'        => 'notification_message',
			'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
			'description' => sprintf(
				'
                <h1>Elementor Header & Footer Builder</h1>
                <p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
                '
			),
			'buttons'     => array(
				array(
					'url'   => admin_url( "plugin-install.php" ),
					'text'  => 'Install & Activate',
					'class' => 'button_black'
				),
				array(
					'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/elementor-header-builder',
					'text' => 'How it works'
				)
			),
			'submenu'     => esc_html__( 'Header Builder', 'stm_post_type' ),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'elementor_builder'
			)
		),
		'top_bar_information_notice'            => array(
			'type'         => 'notice',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'pear_builder'
				),
				array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder'
				)
			),
			'dependencies' => '||'
		),
		'top_bar'                               => array(
			'type'       => 'checkbox',
			'label'      => esc_html__( 'Enable Top Bar', 'stm_post_type' ),
			'group'      => 'started',
			'value'      => false,
			'dependency' => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'    => esc_html__( 'Top Bar', 'stm_post_type' )
		),
		'top_bar_bg'                            => array(
			'type'       => 'color',
			'label'      => esc_html__( 'Background Color', 'stm_post_type' ),
			'group'      => 'ended',
			'value'      => '',
			'dependency' => array(
				'key'   => 'top_bar',
				'value' => 'not_empty',
			),
			'submenu'    => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wpml_switcher'                         => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable Language Switcher', 'stm_post_type' ),
			'description'  => esc_html__( 'You need the WPML plugin to be installed', 'stm_post_type' ),
			'group'        => 'started',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wpml_switcher_style'                   => array(
			'type'         => 'radio',
			'label'        => esc_html__( 'Switcher Style', 'stm_post_type' ),
			'description'  => esc_html__( 'Select the style option for the switcher', 'stm_post_type' ),
			'options'      => array(
				'wpml_theme'   => esc_html__( 'Theme', 'stm_post_type' ),
				'wpml_default' => esc_html__( 'WPML', 'stm_post_type' ),
			),
			'value'        => 'wpml_theme',
			'dependency'   => array(
				array(
					'key'   => 'wpml_switcher',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wpml_switcher_mobile'                  => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show Language Switcher on mobile', 'stm_post_type' ),
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'wpml_switcher',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wpml_switcher_color'                   => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'wpml_switcher',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wc_topbar_cart_hide'                   => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable WooCommerce Cart', 'stm_post_type' ),
			'description'  => esc_html__( 'You need to install and set up the Woocommerce plugin.', 'stm_post_type' ),
			'group'        => 'started',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wc_top_bar_cart_mobile'                => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show Cart on mobile', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'wc_topbar_cart_hide',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'wc_top_bar_cart_color'                 => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'wc_topbar_cart_hide',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_search'                        => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable Search', 'stm_post_type' ),
			'value'        => false,
			'group'        => 'started',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_search_mobile'                 => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show Search on mobile', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar_search',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_search_color'                  => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar_search',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_socials'                       => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable Socials', 'stm_post_type' ),
			'value'        => false,
			'group'        => 'started',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_socials_mobile'                => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show Socials on mobile', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar_socials',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_socials_color'                 => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar_socials',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'top_bar_socials_color_on_hover'        => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Color on hover', 'stm_post_type' ),
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar_socials',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'offices_contact_display'               => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable Addresses', 'stm_post_type' ),
			'value'        => false,
			'group'        => 'started',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'offices_contact_align'                 => array(
			'type'         => 'select',
			'label'        => esc_html__( 'Text align', 'stm_post_type' ),
			'description'  => esc_html__( 'Set up the display of the office address, working hours, and phone number', 'stm_post_type' ),
			'options'      => array(
				'flex-end'   => esc_html__( 'Right', 'stm_post_type' ),
				'center'     => esc_html__( 'Center', 'stm_post_type' ),
				'flex-start' => esc_html__( 'Left', 'stm_post_type' ),
			),
			'value'        => 'right',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'offices_contact_display',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' )
		),
		'offices_contact_mobile'                => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Enable on mobile', 'stm_post_type' ),
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'offices_contact_display',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'offices_contact_color'                 => array(
			'type'         => 'color',
			'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'offices_contact_display',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
		),
		'offices_contact'                       => array(
			'type'         => 'repeater',
			'label'        => esc_html__( 'Office', 'stm_post_type' ),
			'fields'       => array(
				'top_bar_contact_office'       => array(
					'type'  => 'text',
					'label' => esc_html__( 'Name', 'stm_post_type' ),
					'value' => '',
				),
				'top_bar_contact_address'      => array(
					'type'  => 'text',
					'label' => esc_html__( 'Address', 'stm_post_type' ),
					'value' => '',
				),
				'top_bar_contact_address_icon' => array(
					'type'  => 'icon_picker',
					'label' => esc_html__( 'Address Icon', 'stm_post_type' ),
					'value' => 'fa-map-marker',
				),
				'top_bar_contact_email'        => array(
					'type'  => 'text',
					'label' => esc_html__( 'Email', 'stm_post_type' ),
					'value' => '',
				),
				'top_bar_contact_email_icon'   => array(
					'type'  => 'icon_picker',
					'label' => esc_html__( 'Email Icon', 'stm_post_type' ),
					'value' => 'fa-envelope',
				),
				'top_bar_contact_hours'        => array(
					'type'  => 'text',
					'label' => esc_html__( 'Working Hours', 'stm_post_type' ),
					'value' => '',
				),
				'top_bar_contact_hours_icon'   => array(
					'type'  => 'icon_picker',
					'label' => esc_html__( 'Hours Icon', 'stm_post_type' ),
					'value' => 'fa-map-marker',
				),
				'top_bar_contact_phone'        => array(
					'type'  => 'text',
					'label' => esc_html__( 'Phone Number', 'stm_post_type' ),
					'value' => '',
				),
				'top_bar_contact_phone_icon'   => array(
					'type'  => 'icon_picker',
					'label' => esc_html__( 'Phone Icon', 'stm_post_type' ),
					'value' => 'fa-map-marker',
				),
			),
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				array(
					'key'   => 'offices_contact_display',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'top_bar',
					'value' => 'not_empty',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' )
		),
		'header_style_information_notice'       => array(
			'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
			'type'         => 'notice',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'pear_builder',
				),
				array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder',
				),
			),
			'dependencies' => '||',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
		),
		'header_style'                          => array(
			'type'       => 'image_select',
			'label'      => esc_html__( 'Header Styles', 'consulting' ),
			'width'      => 270,
			'height'     => 500,
			'options'    => [
				'header_style_1'  => [
					'alt' => 'Header Style 1',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_01.svg',
				],
				'header_style_2'  => [
					'alt' => 'Header Style 2',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_02.svg',
				],
				'header_style_3'  => [
					'alt' => 'Header Style 3',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_03.svg',
				],
				'header_style_4'  => [
					'alt' => 'Header Style 4',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_04.svg',
				],
				'header_style_5'  => [
					'alt' => 'Header Style 5',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_05.svg',
				],
				'header_style_6'  => [
					'alt' => 'Header Style 6',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_06.svg',
				],
				'header_style_10' => [
					'alt' => 'Header Style 7',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_07.svg',
				],
				'header_style_11' => [
					'alt' => 'Header Style 8',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_08.svg',
				],
				'header_style_12' => [
					'alt' => 'Header Style 9',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_09.svg',
				],
				'header_style_7'  => [
					'alt' => 'Header Style 10',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_10.svg',
				],
				'header_style_8'  => [
					'alt' => 'Header Style 11',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_11.svg',
				],
				'header_style_9'  => [
					'alt' => 'Header Style 12',
					'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_12.svg',
				],
			],
			'dependency' => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'    => esc_html__( 'Main', 'stm_post_type' )
		),
		'mega_menu'                             => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Mega Menu', 'stm_post_type' ),
			'description' => esc_html__( 'Enable the display of mega menu', 'stm_post_type' ),
			'value'       => false,
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'sticky_menu'                           => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Sticky Menu', 'stm_post_type' ),
			'description' => esc_html__( 'Enable Sticky menu', 'stm_post_type' ),
			'value'       => false,
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'wc_cart_hide'                          => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'WooCommerce Cart', 'stm_post_type' ),
			'group'       => 'started',
			'description' => esc_html__( 'You need to install and set up the Woocommerce plugin.', 'stm_post_type' ),
			'value'       => false,
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'wc_cart_mobile_hide'                   => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
			'description'  => esc_html__( 'Enable the display of cart on mobile', 'stm_post_type' ),
			'group'        => 'ended',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'wc_cart_hide',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_wpml_switcher'                  => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'WPML switcher', 'stm_post_type' ),
			'description' => esc_html__( 'You need to install and set up the WPML plugin.', 'stm_post_type' ),
			'group'       => 'started',
			'value'       => false,
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_wpml_switcher_style'            => array(
			'type'         => 'radio',
			'label'        => esc_html__( 'Switcher Style', 'stm_post_type' ),
			'description'  => esc_html__( 'Select the style option for the switcher', 'stm_post_type' ),
			'options'      => array(
				'wpml_theme'   => esc_html__( 'Theme', 'stm_post_type' ),
				'wpml_default' => esc_html__( 'WPML', 'stm_post_type' ),
			),
			'value'        => 'wpml_theme',
			'dependency'   => array(
				array(
					'key'   => 'header_wpml_switcher',
					'value' => 'not_empty',
				),
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
		),
		'header_wpml_switcher_mobile'           => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
			'description'  => esc_html__( 'Enable the display of WPML on mobile', 'stm_post_type' ),
			'group'        => 'ended',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_wpml_switcher',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_socials_box'                    => array(
			'type'       => 'checkbox',
			'label'      => esc_html__( 'Enable Socials', 'stm_post_type' ),
			'value'      => false,
			'group'      => 'started',
			'dependency' => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'    => esc_html__( 'Main', 'stm_post_type' )
		),
		'mobile_socials_show_hide'              => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
			'description'  => esc_html__( 'Enable the display of socials on mobile', 'stm_post_type' ),
			'group'        => 'ended',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_socials_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_search_box'                     => array(
			'type'       => 'checkbox',
			'label'      => esc_html__( 'Enable Search', 'stm_post_type' ),
			'value'      => false,
			'group'      => 'started',
			'dependency' => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'    => esc_html__( 'Main', 'stm_post_type' )
		),
		'mobile_header_search_box'              => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
			'description'  => esc_html__( 'Enable the display of search on mobile', 'stm_post_type' ),
			'group'        => 'ended',
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_search_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'mobile_grid'                           => array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Mobile Header Breakpoint', 'stm_post_type' ),
			'description' => esc_html__( 'Select the mobile header breakpoint (Landscape - 1024px resolution, Portrait 991px resolution).', 'stm_post_type' ),
			'options'     => array(
				'landscape' => esc_html__( 'Tablet Landscape', 'stm_post_type' ),
				'portrait'  => esc_html__( 'Tablet Portrait', 'stm_post_type' )
			),
			'value'       => 'landscape',
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_builders_information_notice'    => array(
			'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
			'type'         => 'notice',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'pear_builder'
				),
				array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder'
				)
			),
			'dependencies' => '||',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
		),
		'header_information_box'                => array(
			'type'       => 'checkbox',
			'label'      => esc_html__( 'Enable Contact information', 'stm_post_type' ),
			'value'      => true,
			'group'      => 'started',
			'dependency' => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'    => esc_html__( 'Main', 'stm_post_type' )
		),
		'mobile_header_information_box'         => array(
			'type'         => 'checkbox',
			'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
			'description'  => esc_html__( 'Enable the display of information on mobile', 'stm_post_type' ),
			'value'        => false,
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_address'                        => array(
			'type'         => 'textarea',
			'label'        => esc_html__( 'Address', 'stm_post_type' ),
			'value'        => '',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_address_icon'                   => array(
			'type'         => 'icon_picker',
			'label'        => esc_html__( 'Address Icon', 'stm_post_type' ),
			'value'        => 'stm-pin_13',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_working_hours'                  => array(
			'type'         => 'textarea',
			'label'        => esc_html__( 'Working Hours', 'stm_post_type' ),
			'value'        => '',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_working_hours_icon'             => array(
			'type'         => 'icon_picker',
			'label'        => esc_html__( 'Working Hours Icon', 'stm_post_type' ),
			'value'        => 'stm-mail_13',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_phone'                          => array(
			'type'         => 'textarea',
			'label'        => esc_html__( 'Phone number', 'stm_post_type' ),
			'value'        => '',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_phone_icon'                     => array(
			'type'         => 'icon_picker',
			'label'        => esc_html__( 'Phone number Icon', 'stm_post_type' ),
			'value'        => 'stm-phone_13',
			'group'        => 'ended',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'theme_builder'
				),
				array(
					'key'   => 'header_information_box',
					'value' => 'not_empty'
				)
			),
			'dependencies' => '&&',
			'submenu'      => esc_html__( 'Main', 'stm_post_type' )
		),
		'header_copyright'                      => array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Copyright', 'stm_post_type' ),
			'value'       => '',
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'description' => sprintf( 'This option can be enabled for the specific header style. <a href="https://docs.stylemixthemes.com/consulting-theme-documentation/theme-options/header#copyright" target="_blank" rel="nofollow">' . esc_html__( 'See more details ', 'stm_post_type' ) . '</a>' ),
			'submenu'     => esc_html__( 'Main', 'stm_post_type' )
		),
		'socials_information_notice'            => array(
			'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
			'type'         => 'notice',
			'dependency'   => array(
				array(
					'key'   => 'header_builder',
					'value' => 'pear_builder'
				),
				array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder'
				)
			),
			'dependencies' => '||',
			'submenu'      => esc_html__( 'Socials', 'stm_post_type' ),
		),
		'header_socials_information_notice'     => array(
			'description' => esc_html__( 'The social networks buttons will be displayed only if the links to these social networks are provided in the Socials tab', 'stm_post_type' ),
			'type'        => 'notice',
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Socials', 'stm_post_type' )
		),
		'header_socials'                        => array(
			'type'        => 'multi_checkbox',
			'label'       => esc_html__( 'Socials Links', 'stm_post_type' ),
			'description' => esc_html__( 'Select what social networks to display', 'stm_post_type' ),
			'options'     => consulting_socials(),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'theme_builder'
			),
			'submenu'     => esc_html__( 'Socials', 'stm_post_type' )
		)
	);

	if ( defined( 'STM_HB_VER' ) ) {
		$fields[ 'pearl_plugin_information_notice' ] = array(
			'type'        => 'notification_message',
			'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/pearl_hb.png',
			'description' => sprintf(
				'
                <h1>WordPress Header Builder Plugin – Pearl</h1>
                <p>The installation and activation of the <strong>WordPress Header Builder Plugin – Pearl</strong> plugin required. You can manage and customize the header in the Header Builder section.</p>
                '
			),
			'buttons'     => array(
				array(
					'url'  => admin_url( "admin.php?page=stm_header_builder&hb=stm_hb_settings" ),
					'text' => 'Open header Builder'
				),
				array(
					'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/pearl-header-builder',
					'text' => 'How it works'
				)
			),
			'submenu'     => esc_html__( 'Header Builder', 'stm_post_type' ),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'pear_builder'
			)
		);
	}

	if ( defined( 'HFE_VER' ) ) {
		$fields[ 'ehf_plugin_active_information_notice' ] = array(
			'type'        => 'notification_message',
			'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
			'description' => sprintf(
				'
                <h1>Elementor Header & Footer Builder</h1>
                <p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
                '
			),
			'buttons'     => array(
				array(
					'url'  => admin_url( "edit.php?post_type=elementor-hf" ),
					'text' => 'Open header Builder'
				),
				array(
					'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/elementor-header-builder',
					'text' => 'How it works'
				)
			),
			'submenu'     => esc_html__( 'Header Builder', 'stm_post_type' ),
			'dependency'  => array(
				'key'   => 'header_builder',
				'value' => 'elementor_builder'
			)
		);
	}

	$customFields = array(
		'name'   => esc_html__( 'Header', 'stm_post_type' ),
		'icon'   => 'fas fa-ellipsis-v',
		'fields' => $fields
	);

	$setups[ 'header' ] = $customFields;

	return $setups;

}, 10, 1
);