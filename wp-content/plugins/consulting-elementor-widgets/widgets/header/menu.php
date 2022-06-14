<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

class Elementor_Header_Menu extends \Elementor\Widget_Base
{

    protected $nav_menu_index = 1;

    public function get_name()
    {
        return 'stm_header_menu';
    }

    public function get_title()
    {
        return esc_html__( 'Consulting Menu', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'eicon-menu-bar consulting_icon_hb';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

    public static function is_elementor_updated() {
        if ( class_exists( 'Elementor\Icons_Manager' ) ) {
            return true;
        } else {
            return false;
        }
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __( 'Consulting Menu', 'consulting-elementor-widgets' ),
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'consulting-elementor-widgets' ),
                    'type'         => \Elementor\Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'consulting-elementor-widgets' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'consulting-elementor-widgets' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'navmenu_align',
            [
                'label'        => __( 'Alignment', 'consulting-elementor-widgets' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => __( 'Left', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-stretch',
                    ],
                ],
                'default'      => 'left',
                'prefix_class' => 'consulting_menu_nav__align-',
            ]
        );
        $this->add_responsive_control(
            'menu_background_color',
            [
                'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'html body .consulting_menu_nav__breakpoint-tablet .consulting_menu_nav' => 'background-color: {{VALUE}} !important'
                ]
            ]
        );

        $this->add_control(
            'flyout_layout',
            [
                'label'     => __( 'Flyout Orientation', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => __( 'Left', 'consulting-elementor-widgets' ),
                    'right' => __( 'Right', 'consulting-elementor-widgets' ),
                ],
                'condition' => [
                    'layout' => 'flyout',
                ],
            ]
        );

        $this->add_control(
            'flyout_type',
            [
                'label'       => __( 'Appear Effect', 'consulting-elementor-widgets' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'normal',
                'label_block' => false,
                'options'     => [
                    'normal' => __( 'Slide', 'consulting-elementor-widgets' ),
                    'push'   => __( 'Push', 'consulting-elementor-widgets' ),
                ],
                'render_type' => 'template',
                'condition'   => [
                    'layout' => 'flyout',
                ],
            ]
        );

        $this->add_responsive_control(
            'hamburger_align',
            [
                'label'                => __( 'Hamburger Align', 'consulting-elementor-widgets' ),
                'type'                 => \Elementor\Controls_Manager::CHOOSE,
                'default'              => 'center',
                'options'              => [
                    'left'   => [
                        'title' => __( 'Left', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors_dictionary' => [
                    'left'   => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right'  => 'margin-left: auto',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .consulting_menu_nav__toggle,
						{{WRAPPER}} .consulting_menu_nav-icon' => '{{VALUE}}',
                ],
                'default'              => 'center',
                'condition'            => [
                    'layout' => [ 'expandible', 'flyout' ],
                ],
                'label_block'          => false,
            ]
        );

        $this->add_responsive_control(
            'hamburger_menu_align',
            [
                'label'        => __( 'Menu Items Align', 'consulting-elementor-widgets' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'    => [
                        'title' => __( 'Left', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'        => [
                        'title' => __( 'Center', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'      => [
                        'title' => __( 'Right', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => __( 'Justify', 'consulting-elementor-widgets' ),
                        'icon'  => 'eicon-h-align-stretch',
                    ],
                ],
                'default'      => 'space-between',
                'condition'    => [
                    'layout' => [ 'expandible', 'flyout' ],
                ],
                'prefix_class' => 'consulting-menu-item-',
            ]
        );

        $this->add_control(
            'submenu_icon',
            [
                'label'       => __( 'Submenu Arrow', 'header-footer-elementor' ),
                'type'        => Controls_Manager::SWITCHER,
                'yes'         => __( 'Yes', 'header-footer-elementor' ),
                'no'          => __( 'No', 'header-footer-elementor' ),
                'default'     => '',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'menu_separator',
            [
                'label'       => __( 'Separator', 'header-footer-elementor' ),
                'type'        => Controls_Manager::SWITCHER,
                'yes'         => __( 'Yes', 'header-footer-elementor' ),
                'no'          => __( 'No', 'header-footer-elementor' ),
                'default'     => 'no',
                'render_type' => 'template',
            ]
        );
        $this->add_responsive_control(
            'menu_separator_color',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav__separator-yes .consulting_menu_nav>li>a:after' => 'background-color: {{VALUE}}'
                ],
                'condition' => [
                    'menu_separator' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'dropdown',
            [
                'label'        => __( 'Breakpoint', 'consulting-elementor-widgets' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 'tablet',
                'options'      => [
                    'tablet' => __( 'Tablet Landscape', 'consulting-elementor-widgets' ),
                    'mobile' => __( 'Tablet Portrait', 'consulting-elementor-widgets' ),
                    'none'   => __( 'None', 'consulting-elementor-widgets' ),
                ],
                'prefix_class' => 'consulting_menu_nav__breakpoint-',
                'render_type'  => 'template',
                'description'  => __( 'Select the mobile header breakpoint (Landscape - 1024px resolution, Portrait 991px resolution).', 'consulting-elementor-widgets' ),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_menu_1',
            [
                'label'     => __( 'Menu Level 1', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'menu_level_1_padding',
            [
                'label' => __( 'Padding', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_1_margin',
            [
                'label' => __( 'Margin', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'menu_level_1_pointer',
            [
                'label'     => __( 'Link Hover Effect', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'        => __( 'None', 'consulting-elementor-widgets' ),
                    'underline'   => __( 'Underline', 'consulting-elementor-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'menu_level_1_menu_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting_menu_nav > li > a',
            ]
        );

        $this->add_responsive_control(
            'menu_level_1_color_menu_item',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_1_color_menu_item_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.current-menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.active > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > .arrow.active' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_level_1_bg_color_menu_item',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_1_bg_color_menu_item_action',
            [
                'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > a:active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > a:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_menu_2',
            [
                'label'     => __( 'Menu Level 2', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'menu_level_2_padding',
            [
                'label' => __( 'Padding', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_2_margin',
            [
                'label' => __( 'Margin', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'menu_level_2_pointer',
            [
                'label'     => __( 'Link Hover Effect', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'        => __( 'None', 'consulting-elementor-widgets' ),
                    'underline'   => __( 'Underline', 'consulting-elementor-widgets' ),
                ]
            ]
        );

        $this->add_control(
            'style_divider_2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'menu_level_2_menu_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a',
            ]
        );

        $this->add_responsive_control(
            'menu_level_2_color_menu_item',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_2_color_menu_item_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_level_2_bg_color_menu_item',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_level_2_bg_color_menu_item_action',
            [
                'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > a:focus' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'style_divider_2_1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'menu_level_2_bg_color_submenu',
            [
                'label'     => __( 'Submenu Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_menu_3',
            [
                'label'     => __( 'Menu Level 3', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'menu_level_3_padding',
            [
                'label' => __( 'Padding', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_3_margin',
            [
                'label' => __( 'Margin', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'menu_level_3_pointer',
            [
                'label'     => __( 'Link Hover Effect', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'        => __( 'None', 'consulting-elementor-widgets' ),
                    'underline'   => __( 'Underline', 'consulting-elementor-widgets' ),
                ]
            ]
        );

        $this->add_control(
            'style_divider_3',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'menu_level_3_menu_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a',
            ]
        );

        $this->add_responsive_control(
            'menu_level_3_color_menu_item',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_level_3_color_menu_item_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_level_3_bg_color_menu_item',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_level_3_bg_color_menu_item_action',
            [
                'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul > li > a:focus' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'style_divider_3_1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'menu_level_3_bg_color_submenu',
            [
                'label'     => __( 'Submenu Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li > ul > li > ul' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_mega_menu',
            [
                'label'     => __( 'Mega Menu', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mega_menu_padding_horizontal_menu_item',
            [
                'label'      => __( 'Horizontal Padding', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'size' => 26,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'mega_menu_padding_vertical_menu_item',
            [
                'label'      => __( 'Vertical Padding', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'size' => 8,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a' => 'padding-top: {{SIZE}}{{UNIT}} !important; padding-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mega_menu_menu_space_between',
            [
                'label'      => __( 'Space Between', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '.consulting_menu_nav > li.stm_megamenu > ul > li > ul > li' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'mega_menu_pointer',
            [
                'label'     => __( 'Link Hover Effect', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'        => __( 'None', 'consulting-elementor-widgets' ),
                    'underline'   => __( 'Underline', 'consulting-elementor-widgets' ),
                ]
            ]
        );

        $this->add_control(
            'style_divider_mega',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'mega_menu_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector' => '
                    {{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > a, 
                    {{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a, 
                    {{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a .stm_mega_textarea
                ',
            ]
        );

        $this->add_responsive_control(
            'mega_menu_color_menu_item',
            [
                'label'     => __( 'Link Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_menu_color_menu_item_action',
            [
                'label'     => __( 'Link Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > ul > li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mega_menu_text_color_menu_item',
            [
                'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li > a' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li .stm_mega_textarea' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul > li .megamenu-contacts a' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'mega_menu_icon_color',
            [
                'label'     => __( 'Icons Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu i' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'mega_menu_icon_size',
            [
                'label' => __( 'Icon Size', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 14,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mega_menu_bg_color_menu_item',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav > li.stm_megamenu > ul' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hamburger',
            [
                'label' => __( 'Hamburger on mobile', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'hamburger_position',
            [
                'label' => __( 'Position', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav .menu_toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'hamburger_button_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting_menu_nav .menu_toggle button' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav .menu_toggle button:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting_menu_nav .menu_toggle button:after' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $menus = $this->get_available_menus();

        if ( empty( $menus ) ) {
            return false;
        }

        $settings = $this->get_settings_for_display();

        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'consulting_menu_nav',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => '',
        ];
        
        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute(
            'consulting_menu',
            'class',
            [
                'consulting_menu_nav',
            ]
        );

        $this->add_render_attribute( 'consulting_menu', 'class', 'consulting_menu_nav-layout' );

        $this->add_render_attribute(
            'consulting_menu_nav',
            'class',
            [
                'consulting_menu_nav__separator-' . $settings['menu_separator'],
            ]
        );

        if ( $settings['menu_level_1_pointer'] ) {
            $this->add_render_attribute( 'consulting_menu_nav', 'class', 'consulting_menu_nav__pointer_' . $settings['menu_level_1_pointer'] );
        }

        if ( $settings['submenu_icon'] == true ) {
            $this->add_render_attribute( 'consulting_menu_nav', 'class', 'consulting_menu_nav__submenu-icon-arrow' );
        } else {
            $this->add_render_attribute( 'consulting_menu_nav', 'class', 'consulting_menu_nav__submenu-icon-none' );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'consulting_menu' ); ?>>
            <div class="menu_toggle"><button></button></div>
            <nav <?php echo $this->get_render_attribute_string( 'consulting_menu_nav' ); ?>><?php echo $menu_html; ?></nav>
        </div>
        <?php

    }

}