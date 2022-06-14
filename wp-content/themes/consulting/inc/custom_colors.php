<?php
function consulting_inline_css() {

    $css = '';

    $colors = consulting_get_actual_colors();

    $base_color = $colors['base_color'];
    $secondary_color = $colors['secondary_color'];
    $third_color = $colors['third_color'];

    $top_bar_bg = ( consulting_theme_option( 'top_bar_bg' ) ) ? consulting_theme_option( 'top_bar_bg' ) : $base_color;
    $wpml_switcher_color = ( consulting_theme_option( 'wpml_switcher_color' ) ) ? consulting_theme_option( 'wpml_switcher_color' ) : '#ffffff';
    $offices_contact_color = ( consulting_theme_option( 'offices_contact_color' ) ) ? consulting_theme_option( 'offices_contact_color' ) : '#ffffff';
    $cart_color = ( consulting_theme_option( 'wc_top_bar_cart_color' ) ) ? consulting_theme_option( 'wc_top_bar_cart_color' ) : '';
    $search_color = ( consulting_theme_option( 'top_bar_search_color' ) ) ? consulting_theme_option( 'top_bar_search_color' ) : '';
    $socials_color = ( consulting_theme_option( 'top_bar_socials_color' ) ) ? consulting_theme_option( 'top_bar_socials_color' ) : '';
    $socials_color_on_hover = ( consulting_theme_option( 'top_bar_socials_color_on_hover' ) ) ? consulting_theme_option( 'top_bar_socials_color_on_hover' ) : '';

    ob_start();

    ?>

    <style>
        .elementor-widget-video .eicon-play {
            border-color: <?php echo consulting_filtered_output($third_color); ?>;
            background-color: <?php echo consulting_filtered_output($third_color); ?>;
        }

        .elementor-widget-wp-widget-nav_menu ul li,
        .elementor-widget-wp-widget-nav_menu ul li a {
            color: <?php echo consulting_filtered_output($base_color); ?>;
        }

        .elementor-widget-wp-widget-nav_menu ul li.current-cat:hover>a,
        .elementor-widget-wp-widget-nav_menu ul li.current-cat>a,
        .elementor-widget-wp-widget-nav_menu ul li.current-menu-item:hover>a,
        .elementor-widget-wp-widget-nav_menu ul li.current-menu-item>a,
        .elementor-widget-wp-widget-nav_menu ul li.current_page_item:hover>a,
        .elementor-widget-wp-widget-nav_menu ul li.current_page_item>a,
        .elementor-widget-wp-widget-nav_menu ul li:hover>a {
            border-left-color: <?php echo consulting_filtered_output($secondary_color); ?>;
        }

        div.elementor-widget-button a.elementor-button,
        div.elementor-widget-button .elementor-button {
            background-color: <?php echo consulting_filtered_output($base_color); ?>;
        }

        div.elementor-widget-button a.elementor-button:hover,
        div.elementor-widget-button .elementor-button:hover {
            background-color: <?php echo consulting_filtered_output($third_color); ?>;
            color: <?php echo consulting_filtered_output($base_color); ?>;
        }

        .elementor-default .elementor-text-editor ul:not(.elementor-editor-element-settings) li:before,
        .elementor-default .elementor-widget-text-editor ul:not(.elementor-editor-element-settings) li:before {
            color: <?php echo consulting_filtered_output($secondary_color); ?>;
        }

        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title,
        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title {
            background-color: <?php echo consulting_filtered_output($third_color); ?>;
        }

        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title,
        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title a {
            color: <?php echo consulting_filtered_output($base_color); ?>;
        }

        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active,
        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active {
            background-color: <?php echo consulting_filtered_output($base_color); ?>;
        }

        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active,
        .consulting_elementor_wrapper .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active a {
            color: <?php echo consulting_filtered_output($third_color); ?>;
        }

        .radial-progress .circle .mask .fill {
            background-color: <?php echo consulting_filtered_output($third_color); ?>;
        }

        html body #header .top_bar {
            background-color: <?php echo esc_attr( $top_bar_bg ); ?>;
        }
        html body #header .top_bar .container .lang_sel>ul>li .lang_sel_sel,
        html body #header .top_bar .container .lang_sel>ul>li>ul a {
            color: <?php echo esc_attr( $wpml_switcher_color ); ?>;
        }
        html body #header .top_bar .container .lang_sel>ul>li .lang_sel_sel:after {
            border-top: 5px solid <?php echo esc_attr( $wpml_switcher_color ); ?>;
        }
        html body #header .top_bar .container .lang_sel>ul>li>ul {
            background-color: <?php echo esc_attr( $base_color ); ?>;
        }
        html body #header .top_bar .container .lang_sel>ul>li>ul a:hover {
            background-color: <?php echo esc_attr( $secondary_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_cart .count {
            background-color: <?php echo esc_attr( $cart_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_cart a {
            color: <?php echo esc_attr( $cart_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_search .search-icon {
            color: <?php echo esc_attr( $search_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_socials a {
            color: <?php echo esc_attr( $socials_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_socials a:hover {
            color: <?php echo esc_attr( $socials_color_on_hover ); ?>;
        }
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info li,
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info_switcher ul li a {
            color: <?php echo esc_attr( $offices_contact_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info_switcher {
            background-color: <?php echo esc_attr( $third_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info_switcher .active:after {
            border-top: 5px solid <?php echo esc_attr( $base_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info_switcher ul {
            background-color: <?php echo esc_attr( $base_color ); ?>;
        }
        html body #header .top_bar .container .top_bar_info_wr .top_bar_info_switcher ul li a:hover {
            background-color: <?php echo esc_attr( $secondary_color ); ?>;
        }

    </style>

    <?php

    $css = ob_get_contents();
    ob_end_clean();

    return str_replace(array('<style>', '</style>'), '', $css);
}