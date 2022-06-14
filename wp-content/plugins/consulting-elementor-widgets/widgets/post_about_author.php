<?php

use Elementor\Controls_Manager;

class Elementor_STM_Post_About_Author extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_post_about_author';
    }

    public function get_title()
    {
        return esc_html__('Post About Author', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-portrait';
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


        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Style', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                )),
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.consulting_elementor_post_about_author');

    }

    protected function render()
    {
        if (function_exists('consulting_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_post_about_author';

            consulting_show_template('post_about_author', $settings);

        }
    }
}