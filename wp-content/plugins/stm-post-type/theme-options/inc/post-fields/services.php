<?php

add_filter( 'consulting_post_options', function( $setups ) {

    if( isset( $_GET[ 'source' ] ) || get_the_ID() ) {
        $post_id = ( isset( $_GET[ 'source' ] ) ) ? $_GET[ 'source' ] : get_the_ID();

        $custom_post_type = get_post_type( $post_id );

        if( $custom_post_type === 'stm_service' ) {
            $fields = array(
                'service_label' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Label', 'stm_post_type' ),
                    'group' => 'started'
                ),
                'service_cost' => array(
                    'label' => esc_html__( 'Cost', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'service_icon' => array(
                    'label' => esc_html__( 'Icon', 'stm_post_type' ),
                    'type' => 'icon-picker',
                    'group' => 'ended'
                )
            );

            $customFields = array(
                'name' => esc_html__( 'Service Information', 'stm_post_type' ),
                'fields' => $fields
            );

            $setups[ 'page_setup' ][ 'section_data_service' ] = $customFields;
        }
    }

    return $setups;

} );