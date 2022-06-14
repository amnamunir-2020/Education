<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

class Elementor_Header_Cart extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_header_cart';
    }

    public function get_title()
    {
        return esc_html__( 'Consulting Cart', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'eicon-cart-medium consulting_icon_hb';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_cart',
            [
                'label' => __( 'Cart', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'cart_font_size',
            [
                'label'      => __( 'Cart Size', 'consulting-elementor-widgets' ),
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
                    '{{WRAPPER}} .consulting-wc-cart .cart_count' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .cart_count' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'cart_color_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .cart_count:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .cart_count:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .cart_count:focus' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_count',
            [
                'label' => __( 'Count', 'consulting-elementor-widgets' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'count_intents',
            [
                'label' => __( 'Indents', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => 'count_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .consulting-wc-cart .count',
            ]
        );

        $this->add_responsive_control(
            'count_color',
            [
                'label'     => __( 'Color', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .count' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'count_color_action',
            [
                'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .count:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .count:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .count:focus' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'count_bg_color',
            [
                'label'     => __( 'Background', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .count' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'count_bg_color_action',
            [
                'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-wc-cart .count:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .count:active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .consulting-wc-cart .count:focus' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'count_width',
            [
                'label'      => __( 'Width', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting-wc-cart .count' => 'width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'count_height',
            [
                'label'      => __( 'Height', 'consulting-elementor-widgets' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .consulting-wc-cart .count' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        if ( null === WC()->cart ) {
            return;
        }

        ?>

        <div class="consulting-wc-cart">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart_count">
                <i class="stm-shopping-cart8"></i> <?php if ( null !== WC()->cart ) { get_template_part( 'partials/mini', 'cart' ); } ?>
            </a>
        </div>

        <?php

    }
}