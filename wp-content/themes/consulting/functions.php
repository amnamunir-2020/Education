<?php
// Product Registration
define( 'STM_THEME_NAME', 'Consulting');
define( 'STM_ENVATO_ID', '14740561' );
define( 'STM_TOKEN_OPTION', 'stm_consulting_token' );
define( 'STM_TOKEN_CHECKED_OPTION', 'stm_consulting_token_checked' );
define( 'STM_THEME_SETTINGS_URL', 'consulting_settings' );
define( 'GENERATE_TOKEN', 'https://docs.stylemixthemes.com/consulting-theme-documentation/getting-started/theme-activation' );
define( 'SUBMIT_A_TICKET', 'https://support.stylemixthemes.com/tickets/new/support?item_id=12' );
define( 'STM_DEMO_SITE_URL', 'https://consulting.stylemixthemes.com/' );
define( 'STM_DOCUMENTATION_URL', 'https://docs.stylemixthemes.com/consulting-theme-documentation/' );
define( 'STM_CHANGELOG_URL', 'https://docs.stylemixthemes.com/consulting-theme-documentation/extra-materials/changelog' );
define( 'STM_INSTRUCTIONS_URL', 'https://docs.stylemixthemes.com/consulting-theme-documentation/getting-started/theme-activation' );
define( 'STM_INSTALL_VIDEO_URL', 'https://www.youtube.com/watch?v=WkZnOS1ZDFM' );
define( 'STM_VOTE_URL', 'https://stylemixthemes.cnflx.io/boards/consulting-business-finance-wordpress-theme' );
define( 'STM_BUY_ANOTHER_LICENSE', 'https://themeforest.net/item/consulting-business-finance-wordpress-theme/14740561?s_rank=3' );
define( 'STM_VIDEO_TUTORIALS', 'https://www.youtube.com/playlist?list=PL3Pyh_1kFGGCfPdptK3Q9HXFZKL5RI6Ht' );
define( 'FACEBOOK_COMMUNITY', '' );

add_filter( 'stm_theme_demos', 'consulting_get_demos' );

add_filter( 'stm_theme_default_layout', 'get_stm_theme_default_layout' );
function get_stm_theme_default_layout() {
	return 'default';
}

add_filter( 'stm_theme_default_layout_name', 'get_stm_theme_default_layout_name' );
function get_stm_theme_default_layout_name() {
	return 'new_york';
}

add_filter( 'stm_theme_demo_layout', 'get_stm_theme_demo_layout' );
function get_stm_theme_demo_layout() {
	return get_option('consulting_layout', '');
}

add_filter( 'stm_theme_enable_elementor', 'get_stm_theme_enable_elementor' );
function get_stm_theme_enable_elementor() {
	return true;
}

add_filter( 'stm_theme_plugins', 'get_stm_theme_plugins' );
function get_stm_theme_plugins() {
	return consulting_require_plugins( true );
}

add_filter( 'stm_theme_layout_plugins', 'get_stm_theme_layout_plugins', 10, 1 );
function get_stm_theme_layout_plugins( $layout ) {
	return consulting_layout_plugins( $layout );
}

add_filter( 'stm_theme_secondary_required_plugins', 'get_stm_theme_secondary_required_plugins' );
function get_stm_theme_secondary_required_plugins() {
	$plugins = [
		'js_composer',
		'elementor',
		'consulting-elementor-widgets',
		'pearl-header-builder'
	];
	return $plugins;
}

add_filter( 'stm_theme_elementor_addon', 'get_stm_theme_elementor_addon' );
function get_stm_theme_elementor_addon() {
	return 'consulting-elementor-widgets';
}

add_action( 'stm_reset_theme_options', 'do_stm_reset_theme_options' );
function do_stm_reset_theme_options() {
	delete_option( 'consulting_layout' );
	delete_option( 'theme_mods_consulting' );
	delete_option( 'plugins_mods_consulting' );
	delete_option( 'stm_hb_settings' );
}

require_once(get_template_directory() . '/admin/admin.php');
require_once(get_template_directory() . '/inc/header.php');
require_once(get_template_directory() . '/inc/footer.php');

function stm_glob_wpdb()
{
    global $wpdb;
    return $wpdb;
}

$theme_info = wp_get_theme();
define('CONSULTING_THEME_VERSION', (WP_DEBUG) ? time() : $theme_info->get('Version'));
define('CONSULTING_INC_PATH', get_template_directory() . '/inc');
//define('CONSULTING_CUSTOMIZER_PATH', get_template_directory() . '/inc/customizer');
//define('CONSULTING_CUSTOMIZER_URI', get_template_directory_uri() . '/inc/customizer');

// Theme Config
require_once(CONSULTING_INC_PATH . '/theme-config.php');

/*Custom Header Builder*/
require_once(CONSULTING_INC_PATH . '/header/main.php');

require_once(CONSULTING_INC_PATH . '/elementor.php');

require_once(CONSULTING_INC_PATH . '/custom_colors.php');

if (!isset($content_width)) {
    $content_width = 1120;
}

add_action('after_setup_theme', 'consulting_theme_setup');

if (!function_exists('consulting_theme_setup')) {

    function consulting_theme_setup()
    {

        load_theme_textdomain('consulting', get_template_directory() . '/languages');

        add_image_size('consulting-image-350x204-croped', 350, 204, true);
        if (stm_check_layout('layout_16')) {
            add_image_size('consulting-image-350x250-croped', 350, 250, array('center', 'top'));
        } else {
            add_image_size('consulting-image-350x250-croped', 350, 250, true);
        }
        add_image_size('consulting-image-1110x550-croped', 1110, 550, true);
        add_image_size('consulting-image-50x50-croped', 50, 50, true);
        add_image_size('consulting-image-320x320-croped', 320, 320, true);
        add_image_size('consulting-image-255x182-croped', 255, 182, true);
        add_image_size('consulting-image-350x195-croped', 350, 195, true);
        add_image_size('consulting-image-900x640-croped', 900, 640, true);
        add_image_size('consulting-image-900w', 900, 9999);
        add_image_size('consulting-image-358x250-cropped', 358, 250, true);

        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('woocommerce');
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));

        register_nav_menus(
            array(
                'consulting-primary_menu' => esc_html__('Top Menu', 'consulting'),
                'consulting-sidebar_menu_1' => esc_html__('Sidebar Menu 1', 'consulting'),
                'consulting-sidebar_menu_2' => esc_html__('Sidebar Menu 2', 'consulting'),
                'consulting-sidebar_menu_3' => esc_html__('Sidebar Menu 3', 'consulting'),
            )
        );

    }

}

if (!function_exists('consulting_register_default_sidebars')) {
    function consulting_register_default_sidebars()
    {
        register_sidebar(array(
            'id' => 'consulting-right-sidebar',
            'name' => esc_html__('Right Sidebar', 'consulting'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget_title">',
            'after_title' => '</h5>',
        ));

        register_sidebar(array(
            'id' => 'consulting-left-sidebar',
            'name' => esc_html__('Left Sidebar', 'consulting'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget_title">',
            'after_title' => '</h5>',
        ));

        register_sidebar(
            array(
                'id' => 'consulting-shop',
                'name' => esc_html__('Shop Sidebar', 'consulting'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s shop_widgets">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget_title">',
                'after_title' => '</h5>',
            )
        );
        // Register Footer Sidebars

        for ($footer = 1; $footer < 5; $footer++) {
            register_sidebar(array(
                'id' => 'consulting-footer-' . $footer,
                'name' => esc_html__('Footer ', 'consulting') . $footer,
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h4 class="widget_title no_stripe">',
                'after_title' => '</h4>',
            ));
        }
    }
}

add_action('widgets_init', 'consulting_register_default_sidebars', 50);

if (!function_exists('_wp_render_title_tag')) {
    function consulting_render_title()
    {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php
    }

    add_action('wp_head', 'consulting_render_title');
}

add_action('wp_enqueue_scripts', 'consulting_load_theme_scripts_and_styles');

if (!function_exists('consulting_load_theme_scripts_and_styles')) {
    function consulting_load_theme_scripts_and_styles()
    {

        if (!is_admin()) {

            $consulting_config = consulting_config();
            $google_api_key = consulting_theme_option('google_api_key', false);

            wp_deregister_style('font-awesome');
            wp_deregister_style('header_builder');
            wp_deregister_style('select2');
            wp_deregister_style('slick');
            wp_deregister_style('owl.carousel');


            /* Register Styles */
            wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-style', get_stylesheet_uri(), null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-layout', get_template_directory_uri() . '/assets/css/layouts/' . $consulting_config['layout'] . '/main.css', null, CONSULTING_THEME_VERSION, 'all' );
            wp_register_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('select2', get_template_directory_uri() . '/assets/css/select2.min.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('header_builder', get_template_directory_uri() . '/assets/css/header_builder.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('slick', get_template_directory_uri() . '/assets/css/slick.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-animate.min.css', get_template_directory_uri() . '/assets/css/animate.min.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-skin_turquoise', get_template_directory_uri() . '/assets/css/skin_turquoise.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-skin_dark_denim', get_template_directory_uri() . '/assets/css/skin_dark_denim.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-skin_arctic_black', get_template_directory_uri() . '/assets/css/skin_arctic_black.css', null, CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-default-font', consulting_fonts_url(), array(), CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-cost-calculator', get_template_directory_uri() . '/assets/css/layouts/global_styles/site/cost-calc.css', array(), CONSULTING_THEME_VERSION, 'all');
            wp_register_style('consulting-global-styles', get_template_directory_uri() . '/assets/css/layouts/global_styles/main.css', array(), CONSULTING_THEME_VERSION, 'all');

            $fa_5_css_shims = "body #wrapper .fa.fa-facebook{font-family:'Font Awesome 5 Brands' !important;}";
            $fa_5_css = "body #wrapper .fa.fa-map-marker{font-family:'FontAwesome' !important;} body .fa.fa-map-marker:before{content:" .  '"\f041"}';
            wp_add_inline_style('vc_font_awesome_5_shims', $fa_5_css_shims);
            wp_add_inline_style('vc_font_awesome_5', $fa_5_css);

            /* Register Scripts */
            wp_register_script('stm_grecaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('countUp', get_template_directory_uri() . '/assets/js/countUp.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('select2', get_template_directory_uri() . '/assets/js/select2.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.pack.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('jquery.appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('jquery.tablesorter', get_template_directory_uri() . '/assets/js/jquery.tablesorter.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('consulting-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('Chart', get_template_directory_uri() . '/assets/js/Chart.min.js', array('jquery'), '2.9.3', true);
            if (!empty($google_api_key)) {
                wp_register_script('gmap', 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key, array('jquery'), CONSULTING_THEME_VERSION, true);
            } else {
                wp_register_script('gmap', 'https://maps.googleapis.com/maps/api/js', array('jquery'), CONSULTING_THEME_VERSION, true);
            }
            wp_register_script('stm-hfe', get_template_directory_uri() . '/assets/js/stm-hfe.js', array('jquery'), CONSULTING_THEME_VERSION, true);

            wp_register_script('isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('packery', get_template_directory_uri() . '/assets/js/packery-mode.pkgd.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('jquery.cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('fullPage', get_template_directory_uri() . '/assets/js/jquery.fullPage.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('vue', get_template_directory_uri() . '/assets/js/vue.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('vue-resource', get_template_directory_uri() . '/assets/js/vue-resource.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('charts-js', get_template_directory_uri() . '/assets/js/charts.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('stocks-charts', get_template_directory_uri() . '/assets/js/stocks-indexes/stm-stocks-charts.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('stocks-tables', get_template_directory_uri() . '/assets/js/stocks-indexes/stm-stocks-tables.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('stocks-carousel', get_template_directory_uri() . '/assets/js/stocks-indexes/stm-stocks-carousel.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('stocks-header', get_template_directory_uri() . '/assets/js/stocks-indexes/stm-stocks-header.js', array('jquery'), CONSULTING_THEME_VERSION, true);
            wp_register_script('simplemarquee', get_template_directory_uri() . '/assets/js/stocks-indexes/jquery.simplemarquee.js', array('jquery'), CONSULTING_THEME_VERSION, true);

            /* Enqueue Styles */
            wp_enqueue_style('bootstrap');
            wp_enqueue_style('vc_font_awesome_5');
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('consulting-style');
            wp_enqueue_style('consulting-layout');
            wp_enqueue_style('select2');
            wp_enqueue_style('header_builder');
            wp_enqueue_style('consulting-default-font');

            if (stm_check_layout('layout_13')
                || stm_check_layout('layout_14')
                || stm_check_layout('layout_15')
                || stm_check_layout('layout_san_francisco')
                || stm_check_layout('layout_stockholm')
                || stm_check_layout('layout_barcelona')
                || stm_check_layout('layout_osaka')
                || stm_check_layout('layout_budapest')) {
                wp_enqueue_style('fancybox');
                wp_enqueue_script('fancybox');
            }

            if (consulting_theme_option('site_skin') && consulting_theme_option('site_skin') != 'skin_default' && consulting_theme_option('site_skin') != 'skin_custom') {
                wp_enqueue_style('consulting-' . consulting_theme_option('site_skin'));
            }
            if (defined('STM_CALCULATE')) {
                wp_enqueue_style('consulting-cost-calculator');
            }

            /* Enqueue Scripts */
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
            wp_enqueue_script('bootstrap');
            wp_enqueue_script('select2');
            wp_enqueue_script('consulting-custom');
            if( defined( 'HFE_DIR' ) ) {
                wp_enqueue_script( 'stm-hfe' );
            }

            $upload_dir = wp_upload_dir();
            $stm_upload_dir = $upload_dir['baseurl'] . '/stm_uploads';
            $skin = consulting_theme_option('site_skin', 'skin_default');
            $current_style = get_option('stm_custom_style', '4');
            update_option('stm_custom_style', $current_style + 1);

            if ($skin == 'skin_custom' and is_dir($upload_dir['basedir'] . '/stm_uploads')) {
                wp_enqueue_style('stm-skin-custom-generated', $stm_upload_dir . '/skin-custom.css', null, get_option('stm_custom_style', '4'), 'all');
            }

            $theme_options_dir = $upload_dir[ 'basedir' ] . '/stm_uploads/theme_options.css';
            if( file_exists( $theme_options_dir ) ) {
                wp_enqueue_style( 'consulting-theme-options', $stm_upload_dir . '/theme_options.css', null, CONSULTING_THEME_VERSION, 'all' );
            }

            /* Enqueue Global styles */
            wp_enqueue_style('consulting-global-styles');

            $inline_css = consulting_inline_css();
            if (!empty($inline_css)) wp_add_inline_style('consulting-global-styles', $inline_css);
        }

    }
}

add_action('admin_enqueue_scripts', 'consulting_admin_styles');

if (!function_exists('consulting_admin_styles')) {
    function consulting_admin_styles()
    {
        wp_enqueue_style('consulting-default-font', consulting_fonts_url(), array(), CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_style('consulting-admin', get_template_directory_uri() . '/assets/css/admin.css', null, CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_style('consulting-admin-gutenberg', get_template_directory_uri() . '/assets/admin/css/gutenberg.css', null, CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('consulting-jquery.fonticonpicker', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.min.css', array(), CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_style('consulting-jquery.fonticonpicker.bootstrap.min.css', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.bootstrap.min.css', array(), CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_script('jquery.fonticonpicker', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.min.js', array('jquery'), CONSULTING_THEME_VERSION, true);
        wp_enqueue_style('consulting-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, CONSULTING_THEME_VERSION, 'all');
        wp_enqueue_script('stm-theme-multiselect', get_template_directory_uri() . '/assets/js/jquery.multi-select.js', array('jquery'), CONSULTING_THEME_VERSION, true);
        wp_enqueue_script('jquery-ui-autocomplete', '', array('jquery-ui-widget', 'jquery-ui-position'), '1.8.6');
    }
}

add_action( 'customize_controls_enqueue_scripts', 'consulting_customize_scripts' );

if (!function_exists('consulting_customize_scripts')) {
	function consulting_customize_scripts()
	{
		wp_enqueue_script('consulting-customize-script', get_template_directory_uri() . '/assets/js/customize.js', array('customize-controls'), CONSULTING_THEME_VERSION);

		wp_localize_script( 'consulting-customize-script', 'customize_data', [
		    'message' => sprintf(
		        __('Consulting theme Customize Settings were moved to <a href="%s">Dashboard > Theme Options</a>.', 'consulting'),
                admin_url( 'admin.php?page=consulting_settings' )
            )
        ] );
	}
}

if (!function_exists('consulting_fonts_url')) {
    function consulting_fonts_url()
    {
        $firstFontsName = consulting_theme_option( 'body_font_family' );
        $secondFontsName = consulting_theme_option( 'secondary_font_family' );

        if ( !empty( $firstFontsName['font-data']['family'] ) ) $font_families[strtolower( str_replace( ' ', '_', $firstFontsName['font-data']['family'] ) )] = $firstFontsName['font-data']['family'] . ':' . implode( ',', $firstFontsName['font-data']['variants'] );
        if ( !empty( $secondFontsName['font-data']['family'] ) ) $font_families[strtolower( str_replace( ' ', '_', $secondFontsName['font-data']['family'] ) )] = $secondFontsName['font-data']['family'] . ':' . implode( ',', $secondFontsName['font-data']['variants'] );

        $consulting_config = consulting_config();

        if(!empty($font_families)) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) )
            );
            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        } else {
            $font_families = array();

            if ($consulting_config['fonts']) {
                foreach ($consulting_config['fonts'] as $consulting_font) {
                    $font_families[] = $consulting_font;
                }
            }

            if ($font_families) {
                $query_args = array(
                    'family' => urlencode(implode('|', $font_families))
                );

                $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
            } else {
                $fonts_url = '';
            }
        }

        return esc_url_raw($fonts_url);
    }
}

if (!function_exists('consulting_excerpt_more')) {
    function consulting_excerpt_more($more)
    {
        return '';
    }
}

add_filter('excerpt_more', 'consulting_excerpt_more');

add_action('wp_head', 'consulting_ajaxurl');
add_action('admin_head', 'consulting_ajaxurl');

if (!function_exists('consulting_ajaxurl')) {
    function consulting_ajaxurl()
    {
        $stm_ajax_load_events = wp_create_nonce('stm_ajax_load_events');
        $stm_ajax_load_portfolio = wp_create_nonce('stm_ajax_load_portfolio');
        $stm_ajax_add_event_member = wp_create_nonce('stm_ajax_add_event_member');
        $stm_custom_register = wp_create_nonce('stm_custom_register');
        $stm_get_prices = wp_create_nonce('stm_get_prices');
        $stm_get_history = wp_create_nonce('stm_get_history');
        $stm_ajax_add_review = wp_create_nonce('stm_ajax_add_review');
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
            var stm_ajax_load_events = '<?php echo esc_js($stm_ajax_load_events); ?>';
            var stm_ajax_load_portfolio = '<?php echo esc_js($stm_ajax_load_portfolio); ?>';
            var stm_ajax_add_event_member_sc = '<?php echo esc_js($stm_ajax_add_event_member); ?>';
            var stm_custom_register = '<?php echo esc_js($stm_custom_register); ?>';
            var stm_get_prices = '<?php echo esc_js($stm_get_prices); ?>';
            var stm_get_history = '<?php echo esc_js($stm_get_history); ?>';
            var stm_ajax_add_review = '<?php echo esc_js($stm_ajax_add_review); ?>';
        </script>
        <?php
    }
}

if (!function_exists('consulting_body_class')) {
    function consulting_body_class($classes)
    {
        global $post;
        global $wp_customize;

        if (isset($wp_customize)) {
            $classes[] = 'customizer_page';
        }

        $consulting_config = consulting_config();
        if ($consulting_config['layout']) {
            $classes[] = 'site_' . $consulting_config['layout'];
        }

        if ($consulting_config['layout'] == 'layout_13' || $consulting_config['layout'] == 'layout_barcelona') {
            $classes[] = 'stm_top_bar_' . consulting_theme_option('top_bar_style', 'style_1');
        }

        if( stm_check_layout( 'layout_melbourne' ) and consulting_theme_option( 'enable_black_and_white_images', false ) ) {
            $classes[] = 'black_and_white_images';
        }

        $wpml_switcher_mobile = consulting_theme_option('wpml_switcher_mobile', false);

        if($wpml_switcher_mobile) {
            $classes[] = 'show-mobile-switcher';
        }

        $classes[] = consulting_theme_option('color_skin');
        $classes[] = consulting_get_header_style();
        if( consulting_theme_option( 'sticky_menu' ) ) {
            $classes[] = 'sticky_menu';
        }

        if (stm_check_layout('layout_17')) {
            $user_agent = getenv("HTTP_USER_AGENT");

            if (strpos($user_agent, "Win") !== FALSE)
                $classes[] = "stm_windows";
            elseif (strpos($user_agent, "Mac") !== FALSE)
                $classes[] = "stm_mac";
        }

        if (consulting_theme_option('site_boxed')) {
            $classes[] = 'boxed_layout';
            if (consulting_theme_option('bg_image')) {
                $classes[] = consulting_theme_option('bg_image');
            }
            if (consulting_theme_option('custom_bg_image')) {
                $classes[] = 'custom_bg_image';
            }

            if (!is_404()) {
                $content_bg_transparent = get_post_meta($post->ID, 'content_bg_transparent', true);
                if ($content_bg_transparent) {
                    $classes[] = 'content_bg_transparent';
                }
            }
        }

        if (!is_404() and !empty($post)) {
            if (!empty($post->ID) && get_post_meta($post->ID, 'enable_header_transparent', true)) {
                $classes[] = 'header_transparent';
            }

            $header_inverse = get_post_meta($post->ID, 'header_inverse', true);
            if ($header_inverse) {
                $classes[] = 'header_inverse';
            }

            $title_box_bg_image = get_post_meta($post->ID, 'title_box_bg_image', true);
            if (!empty($title_box_bg_image)) {
                $classes[] = 'title_box_image_added';
            }
        }

        $mobile_grid = consulting_theme_option( 'mobile_grid' );

        if ($mobile_grid == 'landscape') {
            $classes[] = 'mobile_grid_landscape';
        } else {
			$classes[] = 'mobile_grid_tablet';
        }

        if (defined('STM_HB_VER')) {
            $header_full_width = stm_hb_get_option('header_full_width', false, $hb = 'stm_hb_settings');
            if ($header_full_width == 'header_full_width') {
                $classes[] = $header_full_width;
            }
        }

        $sidebar_type = consulting_theme_option('blog_sidebar_type', 'wp');

        if($sidebar_type !== 'wp'){
            $classes[] = 'vc_sidebar_page';
        }

        if (defined('STM_ZOOM_FILE')) {
            $classes[] = 'eroom-enabled';
        }

        return $classes;
    }
}

add_filter('body_class', 'consulting_body_class');

require_once(CONSULTING_INC_PATH . '/stock-indexes/stock-indexes.php');
//require_once(CONSULTING_CUSTOMIZER_PATH . '/customizer.class.php');
require_once(CONSULTING_INC_PATH . '/extras.php');
require_once(CONSULTING_INC_PATH . '/tgm/tgm-plugin-registration.php');
if (class_exists('WPBakeryShortCodesContainer')) {
    require_once(CONSULTING_INC_PATH . '/visual_composer.php');
}
if (class_exists('STM_PostType')) {
    require_once CONSULTING_INC_PATH . '/post_types-config.php';
}
if (class_exists('WooCommerce')) {
    require_once(CONSULTING_INC_PATH . '/woocommerce_configuration.php');
}
/*
 *  Load Custom Styles
 */
require_once CONSULTING_INC_PATH . '/megamenu/main.php';
require_once CONSULTING_INC_PATH . '/print_styles.php';

// Header Switcher
if (function_exists('icl_object_id')) {
    function consulting_topbar_lang()
    {
        $languages = icl_get_languages('skip_missing=0&orderby=code');

        if (!empty($languages)) : ?>

	        <div class="lang_sel header_lang_sel">
                <ul>
                    <li>
                        <?php foreach ($languages

                        as $l) : ?>
                        <?php if ($l['active']) : ?>
                        <a href="#" class="lang_sel_sel"><?php echo icl_disp_language($l['translated_name']); ?></a>
                        <ul>
                            <?php endif; ?>
                            <?php endforeach; ?>

                            <?php foreach ($languages as $l) : ?>
                                <?php if (!$l['active']) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($l['url']); ?>"><?php echo icl_disp_language($l['translated_name']); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>

        <?php endif; ?>

        <?php
    }
}

function stm_check_layout($layout) {
    $consulting_layout = get_option('consulting_layout', 'layout_1');
    if($consulting_layout == $layout) {
        return true;
    } else {
        return false;
    }
}

add_filter('elementor/frontend/the_content', function ($content) {
    return $content;
}, 10, 1);

//Header position for Elementor header
add_filter('elementor/frontend/builder_content_data', function ($data, $post_id) {

    $header_view = get_post_meta($post_id, 'ehf_view', true);
    $header_position = get_post_meta($post_id, 'ehf_position', true);

    wp_localize_script('stm-hfe', "consulting_ehf_position_{$post_id}", array(
        'id' => $post_id,
        'header_view' => $header_view,
        'header_position' => $header_position
    ));

    return $data;

}, 10, 2);