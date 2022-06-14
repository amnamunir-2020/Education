<?php

use Elementor\Controls_Manager;

class Elementor_STM_Staff_List extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_staff_list';
    }

    public function get_title()
    {
        return esc_html__('Staff List', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-users';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    public function get_script_depends() {
        return [ 'slick' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

    public function add_dimensions($selector = '')
    {
        $this->start_controls_section(
            'section_dimensions',
            [
                'label' => __('Dimensions', 'consulting-elementor-widgets'),
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __('Margin', 'consulting-elementor-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'consulting-elementor-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls()
    {

        $staff_categories_array = get_terms('stm_staff_category');
        $staff_categories = array(
            esc_html__('All', 'consulting') => 'all'
        );
        if ($staff_categories_array && !is_wp_error($staff_categories_array)) {
            foreach ($staff_categories_array as $cat) {
                $staff_categories[$cat->name] = $cat->slug;
            }
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array_flip($staff_categories),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array_flip(array(
                    esc_html__('List', 'consulting') => 'list',
                    esc_html__('Grid', 'consulting') => 'grid',
                    esc_html__('Carousel', 'consulting') => 'carousel',
                    esc_html__('List two columns', 'consulting') => 'list_2'
                )),
            ]
        );

        $this->add_control(
            'carousel_style',
            [
                'label' => __( 'Carousel Style', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                )),
                'condition' => [
                    'style' => 'carousel'
                ]
            ]
        );

        $this->add_control(
            'grid_view',
            [
                'label' => __( 'Grid View', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array_flip(array(
                    esc_html__('Default', 'consulting') => 'default',
                    esc_html__('Short', 'consulting') => 'short',
                    esc_html__('With social icons', 'consulting') => 'social_icons',
                    esc_html__('Minimal', 'consulting') => 'minimal'
                )),
                'condition' => [
                    'style' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'items_title',
            [
                'label' => __( 'Items Title', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => 'carousel'
                ]
            ]
        );

        $this->add_control(
            'image_style',
            [
                'label' => __( 'Image Style', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array_flip(array(
                    esc_html__('Default', 'consulting') => 'img_default',
                    esc_html__('Square', 'consulting') => 'img_square',
                    esc_html__('Rounded', 'consulting') => 'img_rounded',
                    esc_html__('Circular', 'consulting') => 'img_circular',
                    esc_html__('Leaf Shaped', 'consulting') => 'img_leaf',
                )),
                'condition' => [
                    'style' => array( 'list', 'grid', 'list_2' )
                ]
            ]
        );

        $this->add_control(
            'image_leaf_rounded_corners',
            [
                'label' => __( 'Rounded corners', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left_top_right_bottom',
                'options' => array_flip(array(
                    esc_html__('Left-top, right-bottom', 'consulting') => 'left_top_right_bottom',
                    esc_html__('Left-bottom, right-top', 'consulting') => 'left_bottom_right_top',
                )),
                'condition' => [
                    'image_style' => 'img_leaf',
                    'style' => array( 'list', 'grid', 'list_2' )
                ]
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'consulting-image-350x250-croped',
                'options' => array_flip(array(
                    esc_html__('Default (cropped)', 'consulting') => 'consulting-image-350x250-croped',
                    esc_html__('Medium (proportional)', 'consulting') => 'medium',
                )),
                'condition' => [
                    'style' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'per_row',
            [
                'label' => __( 'Staff Per Row', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    2 => 2,
                    3 => 3,
                    4 => 4,
                ),
                'condition' => [
                    'style' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'count',
            [
                'label' => __( 'Count', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' => __( 'Staff Per Row', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5
                ),
                'condition' => [
                    'style' => 'carousel'
                ]
            ]
        );

        $this->add_control(
            'carousel_arrows',
            [
                'label' => __( 'Carousel - Show Arrows', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'style' => 'carousel'
                ]
            ]
        );

        $this->add_control(
            'show_custom_link',
            [
                'label' => __( 'Custom link in list', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'grid_view' => 'short'
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'condition' => [
                    'show_custom_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label' => __( 'Subtitle', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show_custom_link' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.consulting_elementor_staff_list');

    }

    protected function render()
    {
        if (function_exists('consulting_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_staff_list ';

            if(!empty($settings['link']['url'])) {
                $settings['link'] = Consulting_Elementor_Widgets::build_link($settings);
            }

            if( $settings[ 'style' ] == 'carousel' ) {
                consulting_load_vc_element( 'staff_carousel', $settings, $settings[ 'carousel_style' ] );
            } else {
                consulting_load_vc_element( 'staff_list', $settings, $settings[ 'style' ] );
            }
        }
    }
}