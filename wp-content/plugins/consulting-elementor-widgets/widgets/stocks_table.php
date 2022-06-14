<?php

use Elementor\Controls_Manager;

class Elementor_STM_Stocks_Table extends \Elementor\Widget_Base {

    public function get_name() {
        return 'stm_stocks_table';
    }

    public function get_title() {
        return esc_html__('Stocks Table', 'consulting-elementor-widgets');
    }

    public function get_icon() {
        return 'fa fa-table';
    }

    public function get_categories() {
        return [ 'consulting-widgets' ];
    }

    public function get_script_depends() {
        return [ 'vue', 'vue-resource', 'stocks-tables' ];
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

        $stock_index_data = consulting_get_stocks_indexes_symbols();

        $stock_indexes = array();

        foreach($stock_index_data as $stock) {
            $stock_indexes[$stock['value']] = $stock['label'];
        }

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'stocks_table',
            [
                'label' => __( 'Stocks table', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $stock_indexes
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.consulting_stocks_table');

    }

    protected function render() {
        if(function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            if(!empty($settings['stocks_table']) && is_array($settings['stocks_table'])) {
                $settings['stocks_table'] = implode(', ', $settings['stocks_table']);
            }

            consulting_show_template('stocks_table', $settings);
        }
    }
}