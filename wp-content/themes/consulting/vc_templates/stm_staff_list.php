<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$atts['link'] = vc_build_link( $link );

if( $style == 'carousel' ) : ?>

    <?php consulting_load_vc_element( 'staff_carousel', $atts, $carousel_style ); ?>

<?php else: ?>

    <?php consulting_load_vc_element('staff_list', $atts, $style); ?>

<?php endif; ?>