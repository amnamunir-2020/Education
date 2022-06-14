<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$substyle = ( isset( $atts[ $atts[ 'style' ] . '_style' ] ) ) ? $atts[ $atts[ 'style' ] . '_style' ] : 'style_1';
consulting_load_vc_element( 'works/' . $atts[ 'style' ], $atts, $substyle );
