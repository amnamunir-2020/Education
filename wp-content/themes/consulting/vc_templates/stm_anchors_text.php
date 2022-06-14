<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$atts[ 'css_class' ] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['sections'] = vc_param_group_parse_atts( $sections );

consulting_load_vc_element( 'anchors_text', $atts, $style );