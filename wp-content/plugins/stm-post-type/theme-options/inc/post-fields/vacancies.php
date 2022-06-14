<?php

add_filter( 'consulting_post_options', function( $setups ) {

    if( isset( $_GET[ 'source' ] ) || get_the_ID() ) {
        $post_id = ( isset( $_GET[ 'source' ] ) ) ? $_GET[ 'source' ] : get_the_ID();

        $custom_post_type = get_post_type( $post_id );

        if( $custom_post_type === 'stm_careers' ) {
            $fields = array(
                'department' => array(
                    'label' => esc_html__( 'Department', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'location' => array(
                    'label' => esc_html__( 'Location', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'education' => array(
                    'label' => esc_html__( 'Education', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'compensation' => array(
                    'label' => esc_html__( 'Compensation', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'contact_link' => array(
                    'label' => esc_html__( 'Contact Us Link', 'stm_post_type' ),
                    'type' => 'text'
                )
            );

            $customFields = array(
                'name' => esc_html__( 'Vacancies Information', 'stm_post_type' ),
                'fields' => $fields
            );

            $setups[ 'page_setup' ]['section_data_vacancies'] = $customFields;
        }
    }

    return $setups;

});