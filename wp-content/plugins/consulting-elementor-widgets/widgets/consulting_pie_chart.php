<?php

use Elementor\Controls_Manager;

class Elementor_STM_Pie_Chart extends \Elementor\Widget_Base {

    public function get_name() {
        return 'stm_pie_chart';
    }

    public function get_title() {
        return esc_html__('Consulting Pie chart', 'consulting-elementor-widgets');
    }

    public function get_icon() {
        return 'fa fa-chart-pie';
    }

    public function get_categories() {
        return [ 'consulting-widgets' ];
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'box_style',
            [
                'label' => __('Pie chart style', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                )),
            ]
        );

        $this->add_control(
            'widget_width',
            [
                'label' => __( 'Width', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'value',
            [
                'label' => __( 'Value', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'label_value',
            [
                'label' => __( 'Value Label', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'units',
            [
                'label' => __( 'Units', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'custom_color',
            [
                'label' => __( 'Custom Color', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .radial-progress .circle .mask .fill' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => __( 'Content Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                ],

            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        if(function_exists('consulting_show_template')) {

            $settings = $this->get_settings_for_display();

            consulting_load_vc_element( 'stm_pie_chart', $settings,  $settings['box_style'] );

        }
    }
}