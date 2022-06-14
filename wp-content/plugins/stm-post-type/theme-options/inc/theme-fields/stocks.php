<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $consulting_stocks = '';

    if( function_exists( 'consulting_config' ) ) {
        $consulting_stocks = consulting_get_stocks_indexes_symbols();
    }

    $customFields = array(
        'name' => esc_html__( 'Stocks', 'stm_post_type' ),
        'icon' => 'fas fa-chart-line',
        'fields' => array(
            'stocks_information_notice' => array(
                'description' => esc_html__( 'These options only work with an active Pearl Header Builder Plugin', 'stm_post_type' ),
                'type' => 'notice'
            ),
            'stocks' => array(
                'type' => 'multiselect',
                'label' => esc_html__( 'Stock indexes', 'stm_post_type' ),
                'description' => esc_html__( 'Enter stock index name', 'stm_post_type' ),
                'options' => $consulting_stocks
            ),
            'stocks_ticker' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Ticker', 'stm_post_type' ),
                'description' => esc_html__( 'Enable ticker', 'stm_post_type' )
            ),
            'stocks_transient' => array(
                'type' => 'select',
                'label' => esc_html__( 'Update stock indexes', 'stm_post_type' ),
                'description' => esc_html__( 'Set a time interval when the stocks will be updated', 'stm_post_type' ),
                'options' => array(
                    '3600' => esc_html__( '1 hour', 'stm_post_type' ),
                    '7200' => esc_html__( '2 hours', 'stm_post_type' ),
                    '10800' => esc_html__( '3 hours', 'stm_post_type' ),
                    '216000' => esc_html__( '6 hours', 'stm_post_type' ),
                    '43200' => esc_html__( '12 hours', 'stm_post_type' ),
                    '86400' => esc_html__( '24 hours', 'stm_post_type' )
                ),
                'value' => '3600'
            )
        )
    );

    $setups[ 'stocks' ] = $customFields;

    return $setups;

}, 10, 1 );