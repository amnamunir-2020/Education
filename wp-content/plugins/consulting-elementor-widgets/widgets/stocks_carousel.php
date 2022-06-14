<?php

use Elementor\Controls_Manager;

class Elementor_STM_Stocks_Carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'stm_stocks_carousel';
    }

    public function get_title() {
        return esc_html__('Stocks Carousel', 'consulting-elementor-widgets');
    }

    public function get_icon() {
        return 'fa fa-chart-bar';
    }

    public function get_categories() {
        return [ 'consulting-widgets' ];
    }

    public function get_script_depends() {
        return [ 'vue', 'vue-resource', 'stocks-carousel', 'owl.carousel' ];
    }

    public function get_style_depends() {
        return [ 'owl.carousel' ];
    }

    public function add_dimensions($selector = '') {
        $this->start_controls_section(
            'section_dimensions',
            [
                'label' => __( 'Dimensions', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __( 'Margin', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'consulting-elementor-widgets' ),
            ]
        );

        $stock_index_data = consulting_get_stocks_indexes_symbols();

        $stock_indexes = array();

        foreach($stock_index_data as $stock) {
            $stock_indexes[$stock['value']] = $stock['label'];
        }

        $this->add_control(
            'stocks_carousel',
            [
                'label' => __( 'Select index symbol', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $stock_indexes
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Slider loop', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label' => __( 'Slider arrows', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Enable arrows mode.', 'consulting'),
            ]
        );

        Consulting_Elementor_Widgets::add_text_field(
            $this,
            'count_desktop',
            esc_html__('Count item on desktop', 'consulting-elementor-widgets'),
            6
        );

        Consulting_Elementor_Widgets::add_text_field(
            $this,
            'count_landscape',
            esc_html__('Count item on landscape', 'consulting-elementor-widgets'),
            5
        );

        Consulting_Elementor_Widgets::add_text_field(
            $this,
            'count_portrait',
            esc_html__('Count item on portrait', 'consulting-elementor-widgets'),
            4
        );

        Consulting_Elementor_Widgets::add_text_field(
            $this,
            'count_mobile',
            esc_html__('Count item on mobile', 'consulting-elementor-widgets'),
            2
        );

        Consulting_Elementor_Widgets::add_text_field(
            $this,
            'count_mobile_portrait',
            esc_html__('Count item on mobile portrait', 'consulting-elementor-widgets'),
            1
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .regular-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.consulting_stocks_box');

    }

    protected function render() {
        if(function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            if(!empty($settings['stocks_carousel']) && is_array($settings['stocks_carousel'])) {
                $settings['stocks_carousel'] = implode(', ', $settings['stocks_carousel']);
            }

            consulting_show_template('stocks_carousel', $settings);
        }
    }
}