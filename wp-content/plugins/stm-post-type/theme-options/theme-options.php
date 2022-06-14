<?php

new Consulting_WPCFTO();

class Consulting_WPCFTO
{
    private $currentLayout = '';

    public function __construct()
    {
        $this->currentLayout = get_option( 'consulting_layout', 'layout_1' );

        add_action( 'init', array( $this, 'consulting_config_autoload' ) );
        add_action( 'wp_ajax_wpcfto_save_settings', array( $this, 'consulting_styles_generation' ), 9, 1 );
        add_action( 'consulting_importer_done', array( $this, 'consulting_styles_generation' ), 20, 1 );
        add_action( 'consulting_patch_done', array( $this, 'consulting_styles_generation' ), 20, 1 );
        add_filter( 'wpcfto_options_page_setup', array( $this, 'consulting_layout_options' ) );
    }

    public function consulting_config_autoload()
    {
        $configMap = array(
            'general',
            'header',
            'page_settings',
            'archive_pages',
            'post_types',
            'stocks',
            'footer',
            'typography',
            'socials',
            'styles'
        );

        foreach ( $configMap as $file ) {
            if( file_exists( STM_POST_TYPE_PATH . '/theme-options/inc/theme-fields/' . $file . '.php' ) ) {
                require_once( STM_POST_TYPE_PATH . '/theme-options/inc/theme-fields/' . $file . '.php' );
            }
        }
    }

    public function consulting_layout_options( $setups )
    {
        $cto = apply_filters( 'consulting_theme_options', array() );

        $setups[] = array(
            /*
             * Here we specify option name. It will be a key for storing in wp_options table
             */
            'option_name' => 'consulting_settings',

            'title' => esc_html__( 'Theme options', 'stm_post_type' ),
            'sub_title' => esc_html__( 'by StylemixThemes', 'stm_post_type' ),
            'logo' => get_template_directory_uri() . '/assets/admin/images/icon_theme_options.png',
            'admin_bar_title' => esc_html__( 'Theme Options', 'stm_post_type' ),

            /*
             * Next we add a page to display our awesome settings.
             * All parameters are required and same as WordPress add_menu_page.
             */
            'page' => array(
                'page_title' => 'Consulting Settings',
                'menu_title' => 'Theme Options',
                'menu_slug' => 'consulting_settings',
                'icon' => 'dashicons-admin-tools',
                'position' => 2,
            ),

            /*
             * And Our fields to display on a page. We use tabs to separate settings on groups.
             */
            'fields' => $cto
        );

        return $setups;
    }

    public function consulting_styles_generation( $layout = '' )
    {
        if( !current_user_can( 'manage_options' ) ) {
            die;
        }

        if( empty( $layout ) ) {
            check_ajax_referer( 'wpcfto_save_settings', 'nonce' );
            if( empty( $_REQUEST[ 'name' ] ) ) {
                die;
            }
        }

        global $wp_filesystem;

        if( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $styles = '';

        if( empty( $layout ) ) {
            $request_body = file_get_contents( 'php://input' );
            if( !empty( $request_body ) ) {
                $request_body = json_decode( $request_body, true );
                $styles = self::consulting_collect_wpcfto_styles( $request_body );
            }
        } else {
            $options = wpcfto_get_settings_map( 'settings', 'consulting_settings' );

            $styles = self::consulting_collect_wpcfto_styles( $options );
        }

        $upload_dir = wp_upload_dir();

        if (!$wp_filesystem->is_dir($upload_dir['basedir'] . '/stm_uploads')) {
            wp_mkdir_p($upload_dir['basedir'] . '/stm_uploads');
        }

        if ( !empty( $styles ) ) {
            $css_to_filter = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles );
            $css_to_filter = str_replace( array(
                "\r\n",
                "\r",
                "\n",
                "\t",
                '  ',
                '    ',
                '    '
            ), '', $css_to_filter );

            $custom_style_file = $upload_dir['basedir'] . '/stm_uploads/theme_options.css';

            $wp_filesystem->put_contents( $custom_style_file, $css_to_filter, FS_CHMOD_FILE );

            $current_style = get_option( 'consulting_wpcfto_style', '1' );
            update_option( 'consulting_wpcfto_style', $current_style + 1 );
        }

    }

    private function consulting_collect_wpcfto_styles( $request_body )
    {
        $styles = '';
        foreach ( $request_body as $section_name => $section ) {
            foreach ( $section['fields'] as $field_name => $field ) {
                if ( !empty( $field['output'] ) && !empty( $field['value'] ) ) {
                    $units = '';
                    $important = ( isset( $field['style_important'] ) ) ? ' !important' : '';

                    if ( !empty( $field['units'] ) ) {
                        $units = $field['units'];
                    }

                    if ( isset( $field['mode'] ) ) {
                        foreach ( $field['mode'] as $mode ) {
                            $styles .= $field['output'] . '{' . $mode . ':' . $field['value'] . $units . $important . ';}';
                        }
                    } else {
                        if( $field[ 'type' ] == 'spacing' && !empty( $field[ 'mode' ] ) ) {
                            $unit = $field[ 'value' ][ 'unit' ];
                            $top = ( !empty( $field[ 'value' ][ 'top' ] ) ) ? $field[ 'value' ][ 'top' ] : 0;
                            $left = ( !empty( $field[ 'value' ][ 'left' ] ) ) ? $field[ 'value' ][ 'left' ] : 0;
                            $right = ( !empty( $field[ 'value' ][ 'right' ] ) ) ? $field[ 'value' ][ 'right' ] : 0;
                            $bottom = ( !empty( $field[ 'value' ][ 'bottom' ] ) ) ? $field[ 'value' ][ 'bottom' ] : 0;

                            $styles .= $field[ 'output' ] . '{' . $field[ 'mode' ] . ':' . $top . $unit . ' ' . $right . $unit . ' ' . $bottom . $unit . ' ' . $left . $unit . ';}';
                        } elseif( $field[ 'type' ] == 'typography' ) {
                            $styles .= $field[ 'output' ] . '{';
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'font-family', $field[ 'excluded' ] ) ) ) $styles .= 'font-family:' . $field[ 'value' ][ 'font-family' ];
                            if( !in_array( 'font-family', $field[ 'excluded' ] ) && !empty( $field[ 'value' ][ 'backup-font' ] ) )
                                $styles .= ', ' . $field[ 'value' ][ 'backup-font' ];
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'color', $field[ 'excluded' ] ) ) ) $styles .= '; color:' . $field[ 'value' ][ 'color' ];
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'font-size', $field[ 'excluded' ] ) ) ) $styles .= '; font-size:' . $field[ 'value' ][ 'font-size' ] . 'px';
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'line-height', $field[ 'excluded' ] ) ) ) $styles .= '; line-height:' . $field[ 'value' ][ 'line-height' ] . 'px';
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'font-weight', $field[ 'excluded' ] ) ) ) $styles .= '; font-weight:' . $field[ 'value' ][ 'font-weight' ];
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'font-style', $field[ 'excluded' ] ) ) ) $styles .= '; font-style:' . $field[ 'value' ][ 'font-style' ];
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'text-align', $field[ 'excluded' ] ) ) ) $styles .= '; text-align:' . $field[ 'value' ][ 'text-align' ];
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'letter-spacing', $field[ 'excluded' ] ) ) ) $styles .= '; letter-spacing:' . $field[ 'value' ][ 'letter-spacing' ] . 'px';
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'word-spacing', $field[ 'excluded' ] ) ) ) $styles .= '; word-spacing:' . $field[ 'value' ][ 'word-spacing' ] . 'px';
                            if( !isset( $field[ 'excluded' ] ) || ( isset( $field[ 'excluded' ] ) && !in_array( 'text-transform', $field[ 'excluded' ] ) ) ) $styles .= '; text-transform:' . $field[ 'value' ][ 'text-transform' ];
                            $styles .= '; }';
                        } else {
                            $styles .= $field[ 'output' ] . '{' . $field[ 'mode' ] . ':' . $field[ 'value' ] . $units . $important . ';}';
                        }
                    }
                }
            }
        }

        return $styles;
    }

}

