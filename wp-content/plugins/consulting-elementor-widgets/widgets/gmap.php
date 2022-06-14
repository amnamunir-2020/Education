<?php

use Elementor\Controls_Manager;

class Elementor_STM_Gmap extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_gmap';
    }

    public function get_title()
    {
        return esc_html__('Gmap', 'consulting-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-map-pin';
    }

    public function get_categories()
    {
        return [ 'consulting-widgets' ];
    }

    public function get_script_depends() {
        return [ 'gmap', 'owl.carousel' ];
    }

    public function get_style_depends() {
        return [ 'owl.carousel' ];
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
            'map_height',
            [
                'label' => __('Map height', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '733px',
            ]
        );

        $this->add_control(
            'map_zoom',
            [
                'label' => __('Map zoom', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 18,
            ]
        );

        $this->add_control(
            'marker',
            [
                'label' => __('Map marker', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'disable_mouse_whell',
            [
                'label' => __('Map zoom on wheel', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'disable',
                'options' => [
                    'disable' => __('Disable map zoom on mouse wheel scroll', 'consulting-elementor-widgets'),
                    'enable' => __('Enable map zoom on mouse wheel scroll', 'consulting-elementor-widgets'),
                ],
            ]
        );

        $this->add_control(
            'gmap_style_text',
            [
                'label' => __('Style Code', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label' => __('Extra class name', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );


        /*Addresses*/
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title', [
                'label' => __('Title', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'consulting-elementor-widgets'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'address', [
                'label' => __('Address', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __('Address', 'consulting-elementor-widgets'),
            ]
        );

        $repeater->add_control(
            'phone', [
                'label' => __('Phone', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'email', [
                'label' => __('Email', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'lat', [
                'label' => __('Latitude', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'lng', [
                'label' => __('Longitude', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => wp_kses(__('<a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting'), array('a' => array('href' => array(), 'target' => array())))
            ]
        );


        $this->add_control(
            'addresses',
            [
                'label' => __('Repeater List', 'consulting-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Title #1', 'consulting-elementor-widgets'),
                    ],
                    [
                        'title' => __('Title #2', 'consulting-elementor-widgets'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.stm_gmap');

    }

    protected function render()
    {
        if (function_exists('consulting_show_template')) {
            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' consulting_elementor_gmap';

            $settings['marker'] = (!empty($settings['marker']['id'])) ? $settings['marker']['id'] : '';

            if(!empty($_GET['action']) && ($_GET['action'] === 'elementor' || $_GET['action'] === 'elementor_ajax')) {
                echo "<div class='consulting-elementor-notice'>" . esc_html__('Check module in preview mode.', 'consulting-elementor-widgets') . "</div>";
            } else {
                consulting_show_template('gmap', $settings);
            }
        }
    }

    protected function _content_template()
    {
        echo "<div class='consulting-elementor-notice'>" . esc_html__('Check module in preview mode.', 'consulting-elementor-widgets') . "</div>";
    }

}