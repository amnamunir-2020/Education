<?php
add_filter( 'consulting_theme_options', function( $setups ) {

    $customFields = array(
        'name' => esc_html__( 'Pages Settings', 'stm_post_type' ),
        'icon' => 'fas fa-pager',
        'fields' => array(
            'page_settings_information_notice' => array(
                'description' => esc_html__( 'These options will be enabled for the new pages and posts only. They can not be applied to the publish posts and pages.', 'stm_post_type' ),
                'type' => 'notice'
            ),
            'metabox_header_inverse' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Style - Inverse', 'stm_post_type' ),
                'description' => sprintf( 'When the inverse option is enabled, a header with a dark background will display the white logo, fonts, etc. This option can be enabled for the specific header style in a particular layout. To change the header style go to Header > Main > Header Style. <a href="https://docs.google.com/spreadsheets/d/1QIoiEzBrx1T4AjAULobd9382mjyZk8cIS7PZ2HpcU6Y/edit#gid=1505040253" target="_blank" rel="nofollow">' . esc_html__( 'See More Details', 'stm_post_type' ) . '</a>' ),
            ),
            'metabox_disable_title_box' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Disable Title Box', 'stm_post_type' ),
                'group' => 'started'
            ),
            'metabox_enable_transparent' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Transparent Title Box', 'stm_post_type' ),
                'description' => esc_html__( 'Make the Title Box section background transparent', 'stm_post_type' )
            ),
            'metabox_disable_title' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Disable Title', 'stm_post_type' ),
                'description' => esc_html__( 'Don’t show title on the page', 'stm_post_type' ),
            ),
            'metabox_title_box_title_color' => array(
                'type' => 'color',
                'label' => esc_html__( 'Title Color', 'stm_post_type' ),
                'dependency' => array(
                    'key' => 'metabox_disable_title',
                    'value' => 'empty'
                )
            ),
            'metabox_title_box_title_line_color' => array(
                'type' => 'color',
                'label' => esc_html__( 'Title Line Color', 'stm_post_type' ),
                'dependency' => array(
                    'key' => 'metabox_disable_title',
                    'value' => 'empty'
                )
            ),
            'metabox_title_box_bg_image' => array(
                'type' => 'image',
                'label' => esc_html__( 'Background Image', 'stm_post_type' ),
                'description' => esc_html__( 'Upload the background image or enter the image URL and set up its appearance', 'stm_post_type' ),
            ),
            'metabox_title_box_bg_position' => array(
                'type' => 'text',
                'label' => esc_html__( 'Background Position', 'stm_post_type' ),
                'description' => esc_html__( 'Example: left top, x% y%, etc', 'stm_post_type' ),
            ),
            'metabox_title_box_bg_size' => array(
                'type' => 'text',
                'label' => esc_html__( 'Background Size', 'stm_post_type' ),
                'description' => esc_html__( 'Example: contain, cover, etc', 'stm_post_type' ),
            ),
            'metabox_title_box_bg_repeat' => array(
                'type' => 'select',
                'label' => esc_html__( 'Background Repeat', 'stm_post_type' ),
                'group' => 'ended',
                'options' => array(
                    'repeat' => esc_html__( 'Repeat', 'stm_post_type' ),
                    'no-repeat' => esc_html__( 'No Repeat', 'stm_post_type' ),
                    'repeat-x' => esc_html__( 'Repeat-X', 'stm_post_type' ),
                    'repeat-y' => esc_html__( 'Repeat-Y', 'stm_post_type' )
                ),
                'value' => esc_html__( 'no-repeat', 'stm_post_type' ),
            ),
            'metabox_disable_breadcrumbs' => array(
                'type' => 'checkbox',
                'label' => esc_html__( 'Disable Breadcrumbs', 'stm_post_type' )
            ),
            'metabox_enable_header_transparent' => array(
                'type' => 'checkbox',
                'description' => esc_html__( 'Make the header background transparent', 'stm_post_type' ),
                'label' => esc_html__( 'Enable Header Transparent', 'stm_post_type' )
            ),
            'metabox_content_bg_transparent' => array(
                'type' => 'checkbox',
                'description' => esc_html__( 'The option works only if the “Boxed Mode” is enabled. It removes the background and shadows from the container', 'stm_post_type' ),
                'label' => esc_html__( 'Content Background - Transparent', 'stm_post_type' )
            ),
            'metabox_footer_copyright_border_t' => array(
                'type' => 'checkbox',
                'description' => esc_html__( 'Removes the border in copyright', 'stm_post_type' ),
                'label' => esc_html__( 'Border Top - Hide', 'stm_post_type' )
            )
        )
    );

    $setups[ 'page_settings' ] = $customFields;

    return $setups;

}, 10, 1 );