<?php

use Elementor\Controls_Manager;

class Elementor_STM_Vacancy_Bottom extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_vacancy_bottom';
    }

    public function get_title()
    {
        return esc_html__('Vacancy bottom', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-user-tie';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
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

        $this->add_dimensions('.consulting_elementor_vacancy_bottom');

    }

    protected function render()
    {
        if (function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_vacancy_bottom';

            consulting_show_template('vacancy_bottom', $settings);
        }
    }
}