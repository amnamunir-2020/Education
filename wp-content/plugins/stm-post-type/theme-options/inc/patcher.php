<?php
new STM_ME_Patcher();

class STM_ME_Patcher
{
    private static $currentLayout = '';
    private static $updates = [
        '1.0.1' => [
            'migrate_from_customizer_to_wpcfto'
        ],
        '1.0.2' => [
            'migrate_from_meta_to_wpcfto'
        ],
        '1.0.3' => [
            'check_pearl_hb_option'
        ],
        '1.0.4' => [
            'header_styles_inverse'
        ]
    ];

    public function __construct()
    {
        self::$currentLayout = get_option( 'consulting_config' );

        add_action( 'init', array( self::class, 'init_patcher' ), 100, 1 );
    }

    public static function init_patcher()
    {
        if( version_compare( get_option( 'consulting_extends_version', '3.4' ), STM_POST_TYPE_PLUGIN_VERSION, '<' ) ) {
            self::update_version();
        }
    }

    public static function get_updates()
    {
        return self::$updates;
    }

    public static function needs_to_update()
    {
        $current_db_version = get_option( 'consulting_extends_db_version' );
        $update_versions = array_keys( self::get_updates() );
        usort( $update_versions, 'version_compare' );

        return !is_null( $current_db_version ) && version_compare( $current_db_version, end( $update_versions ), '<' );
    }

    private static function maybe_update_db_version()
    {
        if( self::needs_to_update() ) {
            $current_db_version = get_option( 'consulting_extends_db_version', '1.0.0' );
            $updates = self::get_updates();

            foreach ( $updates as $version => $callback_arr ) {
                if( version_compare( $current_db_version, $version, '<' ) ) {
                    foreach ( $callback_arr as $callback ) {
                        call_user_func( [ self::class, $callback ] );
                    }
                }
            }
        }

        update_option( 'consulting_extends_db_version', STM_POST_TYPE_DB_VERSION, true );
    }

    public static function update_version()
    {
        update_option( 'consulting_extends_version', STM_POST_TYPE_PLUGIN_VERSION, true );
        self::maybe_update_db_version();
    }

    private static function migrate_from_customizer_to_wpcfto()
    {
        $cto = apply_filters( 'consulting_theme_options', array() );

        if( !empty( $cto ) ) {
            $settings = array();

            $optionsTypography = array(
                'body_font_family',
                'secondary_font_family',
                'typography_p',
                'typography_h1',
                'typography_h2',
                'typography_h3',
                'typography_h4',
                'typography_h5',
                'typography_h6',
            );

            $optionsSpacing = array(
                'logo_margin'
            );

            $optionsRepeater = array(
                'offices_contact'
            );

            $optionsIcons = array(
                'header_address_icon',
                'header_working_hours_icon',
                'header_phone_icon'
            );

            foreach ( $cto as $section_name => $section ) {
                foreach ( $section[ 'fields' ] as $field_name => $field ) {

                    if( in_array( $field_name, $optionsTypography ) ) {
                        switch ( $field_name ) {
                            case 'body_font_family':
                                $value = self::get_default_body_font_settings();
                                break;
                            case 'secondary_font_family':
                                $value = self::get_default_heading_font_settings();
                                break;
                            case 'typography_p':
                                $value = self::get_default_paragraph_font_settings();
                                break;
                            case 'typography_h1':
                                $value = self::get_default_h1_font_settings();
                                break;
                            case 'typography_h2':
                                $value = self::get_default_h2_font_settings();
                                break;
                            case 'typography_h3':
                                $value = self::get_default_h3_font_settings();
                                break;
                            case 'typography_h4':
                                $value = self::get_default_h4_font_settings();
                                break;
                            case 'typography_h5':
                                $value = self::get_default_h5_font_settings();
                                break;
                            case 'typography_h6':
                                $value = self::get_default_h6_font_settings();
                                break;
                        }

                        $settings[ $field_name ] = $value;
                        continue;
                    }

                    if( in_array( $field_name, $optionsSpacing ) ) {
                        $value = array(
                            'top' => get_theme_mod( 'logo_margin_top', '' ),
                            'right' => '',
                            'bottom' => '',
                            'left' => get_theme_mod( 'logo_margin_bottom', '' ),
                            'unit' => 'px',
                        );

                        $settings[ $field_name ] = $value;
                    }

                    if( in_array( $field_name, $optionsRepeater ) ) {
                        $value = [];
                        for ( $i = 1; $i <= 10; $i ++ ) {
                            $value[] = array(
                                'top_bar_contact_office' => get_theme_mod( "top_bar_info_{$i}_office" ),
                                'top_bar_contact_address' => get_theme_mod( "top_bar_info_{$i}_address" ),
                                'top_bar_contact_address_icon' => array(
                                    'icon' => get_theme_mod( "top_bar_info_{$i}_address_icon" ),
                                    'color' => '',
                                    'size' => ''
                                ),
                                'top_bar_contact_hours' => get_theme_mod( "top_bar_info_{$i}_hours" ),
                                'top_bar_contact_hours_icon' => array(
                                    'icon' => get_theme_mod( "top_bar_info_{$i}_hours_icon" ),
                                    'color' => '',
                                    'size' => ''
                                ),
                                'top_bar_contact_phone' => get_theme_mod( "top_bar_info_{$i}_phone" ),
                                'top_bar_contact_phone_icon' => array(
                                    'icon' => get_theme_mod( "top_bar_info_{$i}_phone_icon" ),
                                    'color' => '',
                                    'size' => ''
                                ),
                            );
                        }

                        $new_value = [];
                        foreach ( $value as $key => $val ) {
                            $key++;
                            if( !empty( $val[ 'top_bar_contact_office' ] ) ) {
                                $new_value[] = array(
                                    'top_bar_contact_office' => get_theme_mod( "top_bar_info_{$key}_office" ),
                                    'top_bar_contact_address' => get_theme_mod( "top_bar_info_{$key}_address" ),
                                    'top_bar_contact_address_icon' => array(
                                        'icon' => get_theme_mod( "top_bar_info_{$key}_address_icon", "fa fa-map-marker" ),
                                        'color' => '',
                                        'size' => ''
                                    ),
                                    'top_bar_contact_hours' => get_theme_mod( "top_bar_info_{$key}_hours" ),
                                    'top_bar_contact_hours_icon' => array(
                                        'icon' => get_theme_mod( "top_bar_info_{$key}_hours_icon", "fa fa-clock-o" ),
                                        'color' => '',
                                        'size' => ''
                                    ),
                                    'top_bar_contact_phone' => get_theme_mod( "top_bar_info_{$key}_phone" ),
                                    'top_bar_contact_phone_icon' => array(
                                        'icon' => get_theme_mod( "top_bar_info_{$key}_phone_icon", "fa fa-phone" ),
                                        'color' => '',
                                        'size' => ''
                                    )
                                );
                            }
                        }

                        $settings[ $field_name ] = $new_value;
                    }

                    if( in_array( $field_name, $optionsIcons ) ) {
                        switch ( $field_name ) {
                            case 'header_address_icon':
                                $value = self::get_default_header_address_icon();
                                break;
                            case 'header_working_hours_icon':
                                $value = self::get_default_header_working_hours_icon();
                                break;
                            case 'header_phone_icon':
                                $value = self::get_default_header_phone_icon();
                                break;
                        }

                        $settings[ $field_name ] = $value;
                        continue;
                    }

                    if( !empty( get_theme_mod( $field_name ) ) ) {

                        $value = get_theme_mod( $field_name );

                        if( $field[ 'type' ] == 'image' ) {
                            $value = attachment_url_to_postid( $value );
                        }

                        if( in_array( $field_name, array( 'header_socials', 'footer_socials' ) ) ) {
                            $value = explode( ',', $value );
                        }

                        if( $field_name == 'socials' ) {
                            $socials_values = array();
                            parse_str( $value, $socials_values );

                            $value = array();
                            foreach ( $socials_values as $k => $val ) {
                                $value[] = array(
                                    'key' => $k,
                                    'value' => $val
                                );
                            }
                        }

                        if( $field_name == 'stocks' ) {
                            $values_str = substr_replace( $value, "", -2 );
                            $values = explode( ',', $values_str );

                            $value = array();
                            foreach ( $values as $val ) {
                                $value[] = array(
                                    'label' => $val,
                                    'value' => $val
                                );
                            }
                        }

                        $settings[ $field_name ] = $value;
                    }
                }
            }

            update_option( 'consulting_settings', $settings );

            $layout = 'layout_1';
            if( function_exists( 'consulting_config' ) ) {
                $consulting_config = consulting_config();
                if( !empty( $consulting_config[ 'layout' ] ) ) {
                    $base_color = $consulting_config[ 'base_color' ];
                }
            }
            do_action( 'consulting_patch_done', $layout );
        }
    }

    private static function migrate_from_meta_to_wpcfto()
    {
        $args = array(
            'post_type' => 'stm_event',
            'posts_per_page' => -1
        );

        $q = new WP_Query( $args );
        if( $q->have_posts() ) {
            while ( $q->have_posts() ) {
                $q->the_post();
                $id = get_the_ID();
                $nuxy_data = array();
                $stm_event_date_start = get_post_meta( $id, 'stm_event_date_start', true );
                $stm_event_date_end = get_post_meta( $id, 'stm_event_date_end', true );
                $speakerIDs = get_post_meta( $id, 'stm_event_speakers', true );
                if( !empty( $stm_event_date_start ) ) {
                    $stm_event_date_start = intval( $stm_event_date_start ) * 1000;
                    update_post_meta( $id, 'stm_event_date_start', strval( $stm_event_date_start ) );
                }
                if( !empty( $stm_event_date_end ) ) {
                    $stm_event_date_end = intval( $stm_event_date_end ) * 1000;
                    update_post_meta( $id, 'stm_event_date_end', strval( $stm_event_date_end ) );
                }
                if( !empty( $speakerIDs ) && !is_array( json_decode( $speakerIDs, true ) ) ) {
                    $speakerIDs = explode( ',', $speakerIDs );
                    if( !empty( $speakerIDs ) ) {
                        foreach ( $speakerIDs as $speakerID ) {
                            $nuxy_data[] = array(
                                'label' => get_the_title( $speakerID ),
                                'value' => (string)$speakerID
                            );
                        }
                        $nuxy_data = json_encode( $nuxy_data );
                    }
                    update_post_meta( $id, 'stm_event_speakers', $nuxy_data );
                }
            }
        }
    }

    private static function check_pearl_hb_option() {
        if( defined( 'STM_HB_VER' ) ) {
            $consulting_theme_option = get_option( 'consulting_settings' );
            $consulting_theme_option['header_builder'] = 'pear_builder';

            update_option( 'consulting_settings', $consulting_theme_option );
        }
    }

	private static function header_styles_inverse() {

		$consulting_theme_option = get_option( 'consulting_settings' );
		$consulting_layout = get_option('consulting_layout');

		$headers = array(
			'header_style_1'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
			'header_style_2'  => array(
				'top_bar'                 => true,
				'wpml_switcher'           => true,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => true,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
				'header_inverse'          => 'off',
			),
			'header_style_3'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
				'header_inverse'          => 'off',
			),
			'header_style_4'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
			'header_style_5'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => true,
				'header_socials_box'      => false,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
			'header_style_6'  => array(
				'top_bar'                 => true,
				'wpml_switcher'           => true,
				'wc_topbar_cart_hide'     => true,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => true,
				'offices_contact_align'   => 'center',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => false,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
				'header_inverse'          => 'off',
			),
			'header_style_7'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
				'header_inverse'          => 'off',
			),
			'header_style_8'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => true,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
			),
			'header_style_9'  => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
				'header_inverse'          => 'off',
			),
			'header_style_10' => array(
				'top_bar'                 => true,
				'wpml_switcher'           => true,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => true,
				'offices_contact_display' => true,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => false,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
			),
			'header_style_11' => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => false,
				'header_search_box'       => true,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
				'header_inverse'          => 'off',
			),
			'header_style_12' => array(
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_wpml_switcher'    => false,
				'header_socials_box'      => false,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
		);

		if ( $headers[ $consulting_theme_option[ 'header_style' ] ] ) {
			$header = $headers[ $consulting_theme_option[ 'header_style' ] ];
			$consulting_theme_option[ 'top_bar' ] = $header[ 'top_bar' ];
			$consulting_theme_option[ 'wpml_switcher' ] = $header[ 'wpml_switcher' ];
			$consulting_theme_option[ 'wc_topbar_cart_hide' ] = $header[ 'wc_topbar_cart_hide' ];
			$consulting_theme_option[ 'top_bar_search' ] = $header[ 'top_bar_search' ];
			$consulting_theme_option[ 'top_bar_socials' ] = $header[ 'top_bar_socials' ];
			$consulting_theme_option[ 'offices_contact_display' ] = $header[ 'offices_contact_display' ];
			$consulting_theme_option[ 'offices_contact_align' ] = $header[ 'offices_contact_align' ];
			$consulting_theme_option[ 'header_wpml_switcher' ] = $header[ 'header_wpml_switcher' ];
			$consulting_theme_option[ 'header_socials_box' ] = $header[ 'header_socials_box' ];
			$consulting_theme_option[ 'header_search_box' ] = $header[ 'header_search_box' ];
			$consulting_theme_option[ 'wc_cart_hide' ] = $header[ 'wc_cart_hide' ];
			$consulting_theme_option[ 'header_information_box' ] = $header[ 'header_information_box' ];

			if( isset( $header[ 'header_inverse' ] ) ) {
				$pageID = get_option( 'page_on_front' );

				update_post_meta( $pageID, 'header_inverse', '' );
			}

			update_option( 'consulting_settings', $consulting_theme_option );
		}

		$layouts = array(
			'layout_2'  => array(
				'layout_header_style'     => 'header_style_4',
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_11',
				'header_socials_box'      => true,
				'header_search_box'       => true,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
				'header_inverse'          => 'off',
			),
			'layout_4'  => array(
				'layout_header_style'     => 'header_style_4',
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_11',
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
			'layout_13' => array(
				'layout_header_style'     => 'header_style_4',
				'top_bar'                 => true,
				'wpml_switcher'           => true,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => true,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_12',
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => true,
			),
			'layout_19' => array(
				'layout_header_style'     => 'header_style_6',
				'top_bar'                 => true,
				'wpml_switcher'           => true,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => true,
				'offices_contact_display' => true,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_10',
				'header_socials_box'      => false,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
			),
			'layout_11' => array(
				'layout_header_style'     => 'header_style_7',
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_9',
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
			),
			'layout_18' => array(
				'layout_header_style'     => 'header_style_7',
				'top_bar'                 => false,
				'wpml_switcher'           => false,
				'wc_topbar_cart_hide'     => false,
				'top_bar_search'          => false,
				'top_bar_socials'         => false,
				'offices_contact_display' => false,
				'offices_contact_align'   => 'right',
				'header_style'            => 'header_style_9',
				'header_socials_box'      => true,
				'header_search_box'       => false,
				'wc_cart_hide'            => false,
				'header_information_box'  => false,
			),
		);

		if ( isset( $layouts[ $consulting_layout ][ 'layout_header_style' ] ) == $consulting_theme_option[ 'header_style' ] ) {
			$layout = $layouts[ $consulting_layout ];
			$consulting_theme_option[ 'top_bar' ] = $layout[ 'top_bar' ];
			$consulting_theme_option[ 'wpml_switcher' ] = $layout[ 'wpml_switcher' ];
			$consulting_theme_option[ 'wc_topbar_cart_hide' ] = $layout[ 'wc_topbar_cart_hide' ];
			$consulting_theme_option[ 'top_bar_search' ] = $layout[ 'top_bar_search' ];
			$consulting_theme_option[ 'top_bar_socials' ] = $layout[ 'top_bar_socials' ];
			$consulting_theme_option[ 'offices_contact_display' ] = $layout[ 'offices_contact_display' ];
			$consulting_theme_option[ 'offices_contact_align' ] = $layout[ 'offices_contact_align' ];
			$consulting_theme_option[ 'header_style' ] = $layout[ 'header_style' ];
			$consulting_theme_option[ 'header_socials_box' ] = $layout[ 'header_socials_box' ];
			$consulting_theme_option[ 'header_search_box' ] = $layout[ 'header_search_box' ];
			$consulting_theme_option[ 'wc_cart_hide' ] = $layout[ 'wc_cart_hide' ];
			$consulting_theme_option[ 'header_information_box' ] = $layout[ 'header_information_box' ];

			if( isset( $layout[ 'header_inverse' ] ) ) {
				$pageID = get_option( 'page_on_front' );

				update_post_meta( $pageID, 'header_inverse', '' );
			}

			update_option( 'consulting_settings', $consulting_theme_option );
		}

	}

    private static function get_font_data_by_font_name( $fontName )
    {
        $fontsData = json_decode( file_get_contents( STM_POST_TYPE_PATH . '/theme-options/nuxy/metaboxes/assets/webfonts/google-fonts.json' ), true );

        foreach ( $fontsData[ 'items' ] as $item ) {
            if( $item[ 'family' ] == $fontName ) {
                return $item;
            }
        }
    }

    private static function get_default_body_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'body_font_family', 'Open Sans' ),
            'google-weight' => get_theme_mod( 'body_font_weight', '400' ),
            'font-weight' => get_theme_mod( 'body_font_weight', '400' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'body_font_size', '14' ),
            'line-height' => '26',
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => 'normal',
            'letter-spacing' => '0',
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'body_font_family', 'Open Sans' ) )
        );
    }

    private static function get_default_heading_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => '700',
            'font-weight' => '700',
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'body_font_size', '14' ),
            'line-height' => '26',
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => 'normal',
            'letter-spacing' => '0',
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_paragraph_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'body_font_family', 'Open Sans' ),
            'google-weight' => get_theme_mod( 'p_font_weight', '400' ),
            'font-weight' => get_theme_mod( 'p_font_weight', '400' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'p_font_size', '14' ),
            'line-height' => get_theme_mod( 'p_line_height', '26' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => 'normal',
            'letter-spacing' => '0',
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'body_font_family', 'Open Sans' ) )
        );
    }

    private static function get_default_h1_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h1_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h1_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h1_font_size', '45' ),
            'line-height' => get_theme_mod( 'h1_line_height', '60' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h1_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h1_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_h2_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h2_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h2_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h2_font_size', '36' ),
            'line-height' => get_theme_mod( 'h2_line_height', '45' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h2_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h2_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_h3_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h3_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h3_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h3_font_size', '28' ),
            'line-height' => get_theme_mod( 'h3_line_height', '36' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h3_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h3_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_h4_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h4_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h4_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h4_font_size', '20' ),
            'line-height' => get_theme_mod( 'h4_line_height', '28' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h4_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h4_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_h5_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h5_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h5_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h5_font_size', '18' ),
            'line-height' => get_theme_mod( 'h5_line_height', '22' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h5_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h5_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_h6_font_settings()
    {
        return array(
            'font-family' => get_theme_mod( 'secondary_font_family', 'Montserrat' ),
            'google-weight' => get_theme_mod( 'h6_font_weight', '700' ),
            'font-weight' => get_theme_mod( 'h6_font_weight', '700' ),
            'font-style' => 'normal',
            'subset' => 'latin',
            'color' => '',
            'font-size' => get_theme_mod( 'h6_font_size', '16' ),
            'line-height' => get_theme_mod( 'h6_line_height', '20' ),
            'text-align' => 'left',
            'word-spacing' => '0',
            'text-transform' => get_theme_mod( 'h6_text_transform', 'normal' ),
            'letter-spacing' => get_theme_mod( 'h6_letter_spacing', '0' ),
            'backup-font' => 'Arial',
            'font-data' => self::get_font_data_by_font_name( get_theme_mod( 'secondary_font_family', 'Montserrat' ) )
        );
    }

    private static function get_default_header_address_icon()
    {
        return array(
            'icon' => get_theme_mod( 'header_address_icon' ),
            'color' => '',
            'size' => '',
        );
    }

    private static function get_default_header_working_hours_icon()
    {
        return array(
            'icon' => get_theme_mod( 'header_working_hours_icon' ),
            'color' => '',
            'size' => '',
        );
    }

    private static function get_default_header_phone_icon()
    {
        return array(
            'icon' => get_theme_mod( 'header_phone_icon' ),
            'color' => '',
            'size' => '',
        );
    }
}
