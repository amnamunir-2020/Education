<?php

use Elementor\Controls_Manager;

class Elementor_STM_Testimonials_Carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'stm_testimonials_carousel';
    }

    public function get_title() {
        return esc_html__('Testimonials Carousel', 'consulting-elementor-widgets');
    }

    public function get_icon() {
        return 'fa fa-comments';
    }

    public function get_categories() {
        return [ 'consulting-widgets' ];
    }

    public function get_script_depends() {
        return [ 'slick' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

    public function add_dimensions($selector = '') {
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

    protected function _register_controls() {

        $testimonial_categories_array = get_terms('stm_testimonials_category');
        $testimonial_categories = array(
            esc_html__('All', 'consulting') => 'all'
        );
        if ($testimonial_categories_array && !is_wp_error($testimonial_categories_array)) {
            foreach ($testimonial_categories_array as $cat) {
                $testimonial_categories[$cat->name] = $cat->slug;
            }
        }


        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'consulting-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => array_flip(array(
                    esc_html__('Style 1', 'consulting') => 'style_1',
                    esc_html__('Style 2', 'consulting') => 'style_2',
                    esc_html__('Style 3', 'consulting') => 'style_3',
                    esc_html__('Style 4', 'consulting') => 'style_4',
                    esc_html__('Style 5', 'consulting') => 'style_5',
                    esc_html__('Style 6', 'consulting') => 'style_6',
                    esc_html__('Style 7', 'consulting') => 'style_7',
                    esc_html__('Style 8', 'consulting') => 'style_8',
                )),
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => array_flip($testimonial_categories),
            ]
        );

        $this->add_control(
            'count',
            [
                'label' => __( 'Count', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 2
            ]
        );

        $this->add_control(
            'thumb_size',
            [
                'label' => __( 'Photo - Size', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter photo size 350x250', 'consulting'),
                'condition' => array(
                    'style' => 'style_1'
                )
            ]
        );

        $this->add_control(
            'per_row',
            [
                'label' => __( 'Testimonials Per Row', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ),
            ]
        );

        $this->add_control(
            'colorpicker',
            [
                'label' => __( 'Text Color', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials_carousel.style_7 .item .testimonial-info .testimonial p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testimonials_carousel.style_7 .item .testimonial-info .company' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'autoplay_carousel',
            [
                'label' => __( 'Carousel Autoplay', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => esc_html__('Enable autoplay mode.', 'consulting'),
            ]
        );

        $this->add_control(
            'disable_carousel',
            [
                'label' => __( 'Disable Carousel', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => esc_html__('Enable autoplay mode.', 'consulting'),
            ]
        );

        $this->add_control(
            'disable_carousel_arrows',
            [
                'label' => __( 'Disable Carousel Arrows', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'disable_image',
            [
                'label' => __( 'Disable Image', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
            ]
        );

        $this->add_control(
            'navigation_type',
            [
                'label' => __( 'Navigation', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array_flip(
                    array(
                        esc_html__('Arrows', 'consulting') => 'arrows',
                        esc_html__('Bullets', 'consulting') => 'bullets'
                    )
                ),
                'condition' => array(
                    'style' => array('style_3', 'style_4', 'style_5')
                )
            ]
        );


        $this->add_control(
            'timeout',
            [
                'label' => __( 'Autoplay Timeout', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 5000,
                'description' => esc_html__('Autoplay interval timeout (in ms).', 'consulting'),
                'condition' => array(
                    'autoplay' => 'yes'
                )
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Slider Loop', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => esc_html__('Enable slider loop mode.', 'consulting'),
                'condition' => array(
                    'style' => array('style_3', 'style_4', 'style_5')
                )
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Slider Navigation', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'hide',
                'description' => esc_html__('Disable navigation.', 'consulting'),
                'condition' => array(
                    'style' => array('style_3', 'style_4', 'style_5')
                )
            ]
        );

        $this->add_control(
            'smart_speed',
            [
                'label' => __( 'Smart Speed', 'consulting-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 250,
                'condition' => array(
                    'style' => array('style_3', 'style_4', 'style_5')
                )
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.consulting_elementor_testimonials_carousel');

    }

    protected function render() {
        if(function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_testimonials_carousel testimonials_carousel';

            if(!empty($settings['link']['url'])) {
                $settings['link'] = Consulting_Elementor_Widgets::build_link($settings);
            }

            consulting_load_vc_element('testimonials_carousel', $settings, $settings['style']);
        }
    }

}