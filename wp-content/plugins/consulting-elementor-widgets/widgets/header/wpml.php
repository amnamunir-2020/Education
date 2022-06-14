<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

class Elementor_Header_Wpml extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_header_wpml';
    }

    public function get_title()
    {
        return esc_html__( 'Consulting WPML', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'eicon-global-settings consulting_icon_hb';
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
            'custom_links',
            [
                'label' => __( 'Switcher', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'WPML', 'consulting-elementor-widgets' ),
                    'custom' => __( 'Custom Links', 'consulting-elementor-widgets' ),
                ],
            ]
        );

        /*Items*/
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title', [
                'label' => __('Text', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'url',
            [
                'label' => __( 'URL (Link)', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => __('Items', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Item #1', 'consulting-elementor-widgets'),
                    ]
                ],
                'condition' => [
                    'custom_links' => 'custom',
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_switcher',
            [
                'label'     => __( 'Switcher Level 1', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'switcher_level_1_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_level_1_background',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'switcher_level_1_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel:after' => 'border-top-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_switcher_2',
            [
                'label'     => __( 'Switcher Level 2', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'switcher_level_2_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li > ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'switcher_level_2_background',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li > ul a' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'switcher_level_2_background_action',
            [
                'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li > ul a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .lang_sel > ul > li > ul a:active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .lang_sel > ul > li > ul a:focus' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'switcher_level_2_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li > ul a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'switcher_level_2_dropdown_background',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lang_sel > ul > li > ul' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = $settings['items'];

        if( $settings['custom_links'] == 'default' ) : {
            if( function_exists( 'icl_object_id' ) ) {
                if( consulting_theme_option( 'wpml_switcher_style', true ) == 'wpml_default' ) {
                    do_action( 'wpml_add_language_selector' );
                } else {
                    consulting_topbar_lang();
                }
            }
        } else : ?>
            <div class="lang_sel">
                <ul>
                    <li>
                        <a href="<?php echo esc_url( $items[ '0' ][ 'url' ][ 'url' ] ); ?>" class="lang_sel_sel"><?php echo esc_attr( $items[ '0' ][ 'title' ] ); ?></a>
                        <ul>
                            <?php foreach ( $items as $key => $val ) : if ($key != 0) { ?>
                            <li><a href="<?php echo esc_url( $val[ 'url' ][ 'url' ] ); ?>"><?php echo esc_attr( $val[ 'title' ] ); ?></a></li>
                            <?php } endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php endif;

    }
}