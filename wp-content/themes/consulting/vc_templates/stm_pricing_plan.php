<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$atts['link'] = vc_build_link( $link );
$atts['content'] = wpb_js_remove_wpautop($content, true);

consulting_load_vc_element('pricing_plan', $atts, $style);