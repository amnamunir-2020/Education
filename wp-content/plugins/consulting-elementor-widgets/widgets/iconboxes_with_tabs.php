<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Iconboxes_With_Tabs extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'stm_iconboxes_with_tabs';
    }

    public function get_title()
    {
        return esc_html__( 'Iconboxes with tabs', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'fa fa-calendar-week';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_0',
            [
                'label' => __( 'Appearance', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'box_style',
            [
                'label' => __('Widget style', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                )),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_1',
            [
                'label' => __( 'Tab 1', 'consulting-elementor-widgets' ),
            ]
        );
        $this->add_control(
            'tab_id', [
                'label' => __('Unique ID', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Unique ID', 'elementor'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab_name', [
                'label' => __( 'Tab name', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'content_title',
            [
                'label' => __( 'Content info', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
                'condition' => [
                    'box_style' => array('style_1')
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icons',
            [
                'label' => __( 'Icons', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon_info',
            [
                'label' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'label_block' => true,
                'rows' => 5,
            ]
        );
        $this->add_control(
            'icon_sections',
            [
                'label' => __( 'Icon', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_2',
            [
                'label' => __( 'Tab 2', 'consulting-elementor-widgets' ),
            ]
        );
        $this->add_control(
            'tab_id_2', [
                'label' => __('Unique ID', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Unique ID', 'elementor'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab_name_2', [
                'label' => __( 'Tab name', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'content_title_2',
            [
                'label' => __( 'Content info', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
                'condition' => [
                    'box_style' => array('style_1')
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icons',
            [
                'label' => __( 'Icons', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon_info',
            [
                'label' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'label_block' => true,
                'rows' => 5,
            ]
        );
        $this->add_control(
            'icon_sections_2',
            [
                'label' => __( 'Icon', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_3',
            [
                'label' => __( 'Tab 3', 'consulting-elementor-widgets' ),
            ]
        );
        $this->add_control(
            'tab_id_3', [
                'label' => __('Unique ID', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Unique ID', 'elementor'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tab_name_3', [
                'label' => __( 'Tab name', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'content_title_3',
            [
                'label' => __( 'Content info', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
                'condition' => [
                    'box_style' => array('style_1')
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icons',
            [
                'label' => __( 'Icons', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon_info',
            [
                'label' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
                'label_block' => true,
                'rows' => 5,
            ]
        );
        $this->add_control(
            'icon_sections_3',
            [
                'label' => __( 'Icon', 'consulting-elementor-widgets' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        consulting_load_vc_element('iconboxes_with_tabs', $settings, $settings['box_style'] );
    }
}