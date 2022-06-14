<?php

add_filter( 'consulting_post_options', function( $setups ) {

    $speakers = get_posts( array(
        'posts_per_page' => -1,
        'post_type' => 'stm_staff'
    ) );

    $speakers_data[] = array(
        'label' => esc_html__( 'None', 'stm_post_type' ),
        'value' => ''
    );

    if( !empty( $speakers ) ) {
        foreach ( $speakers as $speaker ) {
            $speakers_data[] = array(
                'label' => $speaker->post_title,
                'value' => $speaker->ID
            );
        }
    }

    if( isset( $_GET[ 'source' ] ) || get_the_ID() ) {
        $post_id = ( isset( $_GET[ 'source' ] ) ) ? $_GET[ 'source' ] : get_the_ID();

        $custom_post_type = get_post_type( $post_id );

        if( $custom_post_type === 'stm_event' ) {

            $fields = array(
                'stm_event_speakers' => array(
                    'label' => esc_html__( 'Speaker', 'stm_post_type' ),
                    'type' => 'multiselect',
                    'options' => $speakers_data
                ),
                'stm_event_count' => array(
                    'label' => esc_html__( 'Max Participants:', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'stm_event_date_start' => array(
                    'label' => esc_html__( 'Date - Start:', 'stm_post_type' ),
                    'type' => 'date'
                ),
                'stm_event_date_end' => array(
                    'label' => esc_html__( 'Date - End:', 'stm_post_type' ),
                    'type' => 'date'
                ),
                'stm_event_time_text' => array(
                    'label' => esc_html__( 'Time - Text:', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'stm_event_time_start' => array(
                    'label' => esc_html__( 'Time - Start:', 'stm_post_type' ),
                    'type' => 'time'
                ),
                'stm_event_time_end' => array(
                    'label' => esc_html__( 'Time - End:', 'stm_post_type' ),
                    'type' => 'time'
                ),
                'stm_event_venue' => array(
                    'label' => esc_html__( 'Venue:', 'stm_post_type' ),
                    'type' => 'textarea'
                ),
                'stm_event_map_lat' => array(
                    'label' => esc_html__( 'Latitude:', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'stm_event_map_lng' => array(
                    'label' => esc_html__( 'Longitude:', 'stm_post_type' ),
                    'type' => 'text'
                ),
                'stm_event_tel' => array(
                    'label' => esc_html__( 'Telephone:', 'stm_post_type' ),
                    'type' => 'text'
                )
            );

            $customFields = array(
                'name' => esc_html__( 'Events Information', 'stm_post_type' ),
                'fields' => $fields
            );

            $setups[ 'page_setup' ][ 'section_data_events' ] = $customFields;

        }
    }

    return $setups;

});
