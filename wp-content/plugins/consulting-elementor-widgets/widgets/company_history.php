<?php

use Elementor\Controls_Manager;

class Elementor_STM_Company_History extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_company_history';
    }

    public function get_title()
    {
        return esc_html__( 'Company History', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'fa fa-building';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    public function add_dimensions( $selector = '' )
    {
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

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'box_style',
            [
                'label' => __('History style', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                )),
            ]
        );

        $this->add_control(
            'dark_bg_mode',
            [
                'label' => __('Dark background?', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'box_style' => array('style_2')
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'year',
            [
                'label' => __( 'Year', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Company Title', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => __( 'Content', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Company Description', 'consulting-elementor-widgets' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Repeater List', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Company Title #1', 'consulting-elementor-widgets' ),
                        'description' => __( 'Item content. Click the edit button to change this text.', 'consulting-elementor-widgets' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions( '.company_history' );

    }

    protected function render()
    {
        if( function_exists( 'consulting_show_template' ) ) {
            $settings = $this->get_settings_for_display();

            consulting_load_vc_element( 'company_history', $settings, $settings['box_style'] );
        }
    }
}