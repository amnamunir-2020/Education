<?php

add_filter( 'consulting_theme_options', function( $setups ) {

    $primary_font_classes = '';
    $secondary_font_classes = '';

    if( function_exists( 'consulting_config' ) ) {
        $consulting_config = consulting_config();

        if( !empty( $consulting_config['primary_font_classes'] ) ) {
            $primary_font_classes = $consulting_config['primary_font_classes'];
        }

        if( !empty( $consulting_config['secondary_font_classes'] ) ) {
            $secondary_font_classes = $consulting_config['secondary_font_classes'];
        }
    }

    $customFields = array(
        'name' => esc_html__( 'Typography', 'stm_post_type' ),
        'icon' => 'fas fa-font',
        'fields' => array(
            'body_font_family' => array(
                'type' => 'typography',
                'label' => esc_html__( 'Base Font Family', 'stm_post_type' ),
                'description' => esc_html__( 'Select the main content font', 'stm_post_type' ),
                'output' => $primary_font_classes,
                'excluded' => array(
                    'color',
                    'letter-spacing',
                    'word-spacing',
                    'subset',
                    'text-align',
                    'text-transform'
                )
            ),
            'secondary_font_family' => array(
                'type' => 'typography',
                'label' => esc_html__( 'Secondary Font Family', 'stm_post_type' ),
                'description' => esc_html__( 'Select the secondary content font', 'stm_post_type' ),
                'output' => $secondary_font_classes,
                'excluded' => array(
                    'color',
                    'font-size',
                    'font-weight',
                    'google-weight',
                    'letter-spacing',
                    'line-height',
                    'word-spacing',
                    'subset',
                    'text-align',
                    'text-transform'
                )
            ),
            'typography_p' => array(
                'type' => 'typography',
                'label' => esc_html__( 'Paragraph', 'stm_post_type' ),
                'description' => esc_html__( 'Adjust the paragraph appearance. Base Font Family is applied to Paragraph', 'stm_post_type' ),
                'output' => '.wpb_wrapper p, .elementor-element',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'letter-spacing',
                    'word-spacing',
                    'subset',
                    'text-align',
                    'text-transform'
                )
            ),
            'typography_h1' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H1', 'stm_post_type' ),
                'description' => esc_html__( 'Set up your custom font options for headings (H1, H2, H3, etc.). Secondary Font Family is applied to H1', 'stm_post_type' ),
                'output' => 'h1, .h1',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            ),
            'typography_h2' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H2', 'stm_post_type' ),
                'description' => esc_html__( 'Secondary Font Family is applied to H2', 'stm_post_type' ),
                'output' => 'h2, .h2',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            ),
            'typography_h3' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H3', 'stm_post_type' ),
                'description' => esc_html__( 'Secondary Font Family is applied to H3', 'stm_post_type' ),
                'output' => 'h3, .h3',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            ),
            'typography_h4' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H4', 'stm_post_type' ),
                'description' => esc_html__( 'Secondary Font Family is applied to H4', 'stm_post_type' ),
                'output' => 'h4, .h4',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            ),
            'typography_h5' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H5', 'stm_post_type' ),
                'description' => esc_html__( 'Secondary Font Family is applied to H5', 'stm_post_type' ),
                'output' => 'h5, .h5',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            ),
            'typography_h6' => array(
                'type' => 'typography',
                'label' => esc_html__( 'H6', 'stm_post_type' ),
                'description' => esc_html__( 'Secondary Font Family is applied to H6', 'stm_post_type' ),
                'output' => 'h6, .h6',
                'excluded' => array(
                    'color',
                    'font-family',
                    'backup-font',
                    'subset',
                    'text-align'
                )
            )
        )
    );

    $setups[ 'typography' ] = $customFields;

    return $setups;

}, 10, 1 );