<?php

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Elementor_Header_Icon_Box extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_header_icon_box';
    }

    public function get_title()
    {
        return esc_html__( 'Consulting Icon Box', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'eicon-icon-box consulting_icon_hb';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
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
            'icon',
            [
                'label' => __('Icon', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'icon_url',
            [
                'label' => __( 'URL (Link)', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'icon_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'title_url',
            [
                'label' => __( 'URL (Link)', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
            ]
        );

        $this->add_control(
            'title_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'description_url',
            [
                'label' => __( 'URL (Link)', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
            ]
        );

        $this->add_control(
            'description_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'icon_align',
            [
                'label'     => __( 'Alignment', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => [
                        'title' => __( 'Left', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __( 'Right', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label'     => __( 'Icon Styles', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_font_size',
            [
                'label'      => __( 'Icon Size', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_color_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box:focus' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'icon_url[url]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_intents',
            [
                'label' => __( 'Indents', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_title',
            [
                'label'     => __( 'Title Styles', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting-header-icon-box .text-box .title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .title a' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'title_intents',
            [
                'label' => __( 'Indents', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_description',
            [
                'label'     => __( 'Description Styles', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting-header-icon-box .text-box .description',
            ]
        );
        $this->add_responsive_control(
            'description_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .description' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .description a' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'description_intents',
            [
                'label' => __( 'Indents', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting-header-icon-box .text-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $url_title = $settings[ 'title_url' ];
        $description = $settings['description'];
        $url_description = $settings['description_url'];

        /* Get Icon */
        $icon_tag = 'div';

        if ( ! empty( $settings['icon_url']['url'] ) ) {
            $this->add_link_attributes( 'icon-wrapper', $settings['icon_url'] );
            $icon_tag = 'a';
        }
        if ( empty( $settings['icon'] ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
            $settings['icon'] = 'fa fa-star';
        }
        if ( ! empty( $settings['icon'] ) ) {
            $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
        }

        /* Get Title */
        if ( ! empty( $url_title['url'] ) ) {
            $this->add_link_attributes( 'url', $url_title );
            $title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
        }
        $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', 'div class="title"', $this->get_render_attribute_string( 'title' ), $title );

        /* Get Description */
        if ( ! empty( $url_description['url'] ) ) {
            $this->add_link_attributes( 'url', $url_description );
            $description = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $description );
        }
        $description_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', 'div class="description"', $this->get_render_attribute_string( 'description' ), $description );

        ?>

        <div class="consulting-header-icon-box">
            <<?php echo $icon_tag . '  class="icon-box" ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>
                <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
            </<?php echo $icon_tag; ?>>
            <div class="text-box">
                <?php echo $title_html; ?>
                <?php echo $description_html; ?>
            </div>
        </div>
        <?php

    }

}