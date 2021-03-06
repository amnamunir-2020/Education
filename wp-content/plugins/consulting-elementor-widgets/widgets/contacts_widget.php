<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Contacts_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_contacts_widget';
    }

    public function get_title()
    {
        return esc_html__('Contacts', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-users';
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
            'section_content',
            [
                'label' => __('Content', 'consulting-elementor-widgets'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Widget Style', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __('Style 1', 'consulting-elementor-widgets'),
                    'style_2' => __('Style 2', 'consulting-elementor-widgets'),
                    'style_3' => __('Style 3', 'consulting-elementor-widgets'),
                    'style_4' => __('Style 4', 'consulting-elementor-widgets'),
                    'style_5' => __('Style 5', 'consulting-elementor-widgets'),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => array('style_5')
                ]
            ]
        );

        $this->add_control(
            'address',
            [
                'label' => __( 'Address', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'condition' => [
                    'style' => array('style_1', 'style_3', 'style_4', 'style_5')
                ]
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => __('Phone', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => array('style_1', 'style_2', 'style_4')
                ]
            ]
        );

        $this->add_control(
            'phone_two',
            [
                'label' => __('Phone 2', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => array('style_4')
                ]
            ]
        );

        $this->add_control(
            'fax',
            [
                'label' => __('Fax', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => array('style_4')
                ]
            ]
        );

        $this->add_control(
            'phones',
            [
                'label' => __( 'Phones', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'condition' => [
                    'style' => array('style_3', 'style_5')
                ]
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __('E-mail', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'schedule',
            [
                'label' => __( 'Schedule', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'condition' => [
                    'style' => array('style_3', 'style_4', 'style_5')
                ]
            ]
        );

        $this->add_control(
            'facebook',
            [
                'label' => __('Facebook', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label' => __('Twitter', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'linkedin',
            [
                'label' => __('Linkedin', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'google_plus',
            [
                'label' => __('Google+', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'skype',
            [
                'label' => __('Skype', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'class',
            [
                'label' => __('Extra class name', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stm_contacts_widget ul li, {{WRAPPER}} .stm_contacts_widget h4' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();

        $this->add_dimensions('.stm_contacts_widget');

    }

    protected function render()
    {
        if (function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_contacts_widget ' . $settings['style'] . ' ' . $settings['class'];

            consulting_show_template('contacts_widget', $settings);
        }
    }

}