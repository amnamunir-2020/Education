<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Anchors_Text extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'stm_anchors_text';
    }

    public function get_title()
    {
        return esc_html__('Anchors Text', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-calendar-week';
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
                'label' => __( 'Style', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip( array(
                    esc_html__( 'Style 1', 'consulting' ) => 'style_1'
                ) ),
            ]
        );

        $this->add_control(
            'links_position',
            [
                'label' => __( 'Links position', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => array_flip( array(
                    esc_html__( 'Left', 'consulting' ) => 'left',
                    esc_html__( 'Right', 'consulting' ) => 'right'
                ) ),
            ]
        );

        $this->add_control(
            'sticky_nav',
            [
                'label' => __( 'Sticky nav', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tab_id', [
                'label' => __('Unique ID', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Unique ID', 'elementor'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => __('Title', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Tab Title', 'elementor'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'text',
            [
                'label' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your text', 'elementor'),
                'label_block' => true,
                'rows' => 5,
            ]
        );

        $this->add_control(
            'sections',
            [
                'label' => __('Sections', 'elementor'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'tab_id' => __('Section 1', 'elementor'),
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_id }}}',
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.events_lessons_box');

    }

    protected function render()
    {
        if (function_exists('consulting_load_vc_element')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_anchors_text';

            consulting_load_vc_element('anchors_text', $settings, $settings[ 'style' ] );
        }
    }
}