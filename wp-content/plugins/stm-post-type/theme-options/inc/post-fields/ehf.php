<?php

add_filter( 'consulting_post_options', function( $setups ) {

    if( isset( $_GET[ 'source' ] ) || get_the_ID() ) {
        $post_id = ( isset( $_GET[ 'source' ] ) ) ? $_GET[ 'source' ] : get_the_ID();

        $custom_post_type = get_post_type( $post_id );

        if( $custom_post_type === 'elementor-hf' ) {
            $fields = array(
                'ehf_position' => array(
                    'label' => esc_html__( 'Position', 'stm_post_type' ),
                    'type' => 'select',
                    'options' => array(
                        'relative' => esc_html__( 'Relative', 'stm_post_type' ),
                        'absolute' => esc_html__( 'Absolute', 'stm_post_type' ),
                        'fixed' => esc_html__( 'Fixed', 'stm_post_type' ),
                        'sticky' => esc_html__( 'Sticky', 'stm_post_type' )
                    ),
                    'value' => 'relative'
                )
            );

            $customFields = array(
                'name' => esc_html__( 'Header Settings', 'stm_post_type' ),
                'fields' => $fields
            );

            $setups[ 'page_setup' ][ 'section_data_ehf' ] = $customFields;
        }
    }

    return $setups;

} );