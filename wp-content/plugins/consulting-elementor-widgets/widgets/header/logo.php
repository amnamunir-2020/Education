<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

class Elementor_Header_Logo extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_header_logo';
    }

    public function get_title()
    {
        return esc_html__( 'Consulting Logo', 'consulting-elementor-widgets' );
    }

    public function get_icon()
    {
        return 'hfe-icon-site-logo';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_logo',
            [
                'label' => __( 'Consulting Logo', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'consulting_custom_logo',
            [
                'label'     => __( 'Add Image', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => get_template_directory_uri() . '/assets/images/tmp/logo_dark.svg',
                ],
            ]
        );

        $this->add_responsive_control(
            'consulting_logo_align',
            [
                'label'     => __( 'Alignment', 'consulting-elementor-widgets' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'consulting-elementor-widgets' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .consulting-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __( 'Width', 'consulting-elementor-widgets' ),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => [ '%', 'px', 'vw' ],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .consulting-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __( 'Max Width', 'header-footer-elementor' ) . ' (%)',
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => [ '%' ],
                'range'          => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .consulting-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'consulting_logo_caption',
            [
                'label'       => __( 'Custom Caption', 'consulting-elementor-widgets' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => __( 'Enter caption', 'consulting-elementor-widgets' ),
                'condition'   => [
                    'caption_source' => 'yes',
                ],
                'dynamic'     => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'consulting_logo_link_to',
            [
                'label'   => __( 'Link', 'consulting-elementor-widgets' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'consulting-elementor-widgets' ),
                    'none'    => __( 'None', 'consulting-elementor-widgets' ),
                    'custom'  => __( 'Custom URL', 'consulting-elementor-widgets' ),
                ],
            ]
        );
        $this->add_control(
            'link',
            [
                'label'       => __( 'Link', 'consulting-elementor-widgets' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'consulting-elementor-widgets' ),
                'condition'   => [
                    'consulting_logo_link_to' => 'custom',
                ],
                'show_label'  => false,
            ]
        );

        $this->end_controls_section();

    }

    public function site_image_url( $size ) {
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['consulting_custom_logo']['url'] ) ) {
            $logo = wp_get_attachment_image_src( $settings['consulting_custom_logo']['id'], $size, true );
        } else {
            $logo = wp_get_attachment_image_src( get_theme_mod( 'consulting_custom_logo' ), $size, true );
        }
        return $logo[0];
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if( $settings['consulting_custom_logo']['id'] == '' ) {
            $image_url = get_template_directory_uri() . '/assets/images/tmp/logo_ehb.svg';
        } else {
            $image_url = $this->site_image_url( 'full' );
        }

        if( 'default' === $settings[ 'consulting_logo_link_to' ] ) {
            $link = site_url();
            $this->add_render_attribute( 'link', 'href', $link );
        } else {
            $link = $this->get_link_url( $settings );
            $link_url = isset( $link[ 'url' ] ) ? $link[ 'url' ] : '';
            $this->add_render_attribute( 'link', 'href', $link_url );
            if( !empty( $link[ 'nofollow' ] ) ) {
                $this->add_render_attribute( 'link', 'rel', 'nofollow' );
            }
            if( !empty( $link[ 'is_external' ] ) ) {
                $this->add_render_attribute( 'link', 'target', '_blank' );
            }
        }

        ?>

        <div class="consulting-logo">
            <?php if( $link ) : ?>
            <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
            <?php endif; ?>
                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
            <?php if( $link ) : ?>
            </a>
            <?php endif; ?>
        </div>

        <?php

    }

    private function get_link_url( $settings ) {
        if ( 'none' === $settings['consulting_logo_link_to'] ) {
            return false;
        }

        if ( 'custom' === $settings['consulting_logo_link_to'] ) {
            if ( empty( $settings['link']['url'] ) ) {
                return false;
            }
            return $settings['link'];
        }

        if ( 'default' === $settings['consulting_logo_link_to'] ) {
            if ( empty( $settings['link']['url'] ) ) {
                return false;
            }
            return site_url();
        }
    }

}