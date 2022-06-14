<?php
new Consulting_EHF();

class Consulting_EHF
{
    public function __construct()
    {
        add_action( 'save_post', array( $this, 'update_header_builder_option' ), 10 );
    }

    public static function update_header_builder_option( $post_id )
    {
        $post_meta = get_post_meta( $post_id, 'ehf_template_type', true );

        if ($post_meta == 'type_header') {
            $consulting_theme_option = get_option( 'consulting_settings' );
            $consulting_theme_option['header_builder'] = 'elementor_builder';

            update_option( 'consulting_settings', $consulting_theme_option );
        }

        if ($post_meta == 'type_footer') {
            $consulting_theme_option = get_option( 'consulting_settings' );
            $consulting_theme_option['footer_builder'] = 'elementor_footer_builder';

            update_option( 'consulting_settings', $consulting_theme_option );
        }

    }

}
