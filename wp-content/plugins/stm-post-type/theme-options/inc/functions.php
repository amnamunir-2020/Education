<?php
/*
* Getting WordPress sidebars
*/
function consulting_wp_sidebars()
{
    $sidebars = array();

    foreach ( $GLOBALS[ 'wp_registered_sidebars' ] as $sidebar ) {
        $sidebars[ $sidebar[ 'id' ] ] = $sidebar[ 'name' ];
    }

    return $sidebars;
}

/*
* Getting custom sidebars
*/
function consulting_vc_sidebars()
{
    $sidebars = array();

    $query = get_posts( array( 'post_type' => 'stm_vc_sidebar', 'posts_per_page' => -1 ) );

    if( $query ) {
        foreach ( $query as $post ) {
            $sidebars[ $post->ID ] = get_the_title( $post->ID );
        }
    }

    return $sidebars;
}

/*
* Getting socials
*/
function consulting_socials()
{
    $socials = array(
        'facebook' => esc_html__( 'Facebook', 'stm_post_type' ),
        'twitter' => esc_html__( 'Twitter', 'stm_post_type' ),
        'instagram' => esc_html__( 'Instagram', 'stm_post_type' ),
        'google-plus' => esc_html__( 'Google+', 'stm_post_type' ),
        'vimeo' => esc_html__( 'Vimeo', 'stm_post_type' ),
        'linkedin' => esc_html__( 'Linkedin', 'stm_post_type' ),
        'behance' => esc_html__( 'Behance', 'stm_post_type' ),
        'dribbble' => esc_html__( 'Dribbble', 'stm_post_type' ),
        'flickr' => esc_html__( 'Flickr', 'stm_post_type' ),
        'github' => esc_html__( 'Git', 'stm_post_type' ),
        'pinterest' => esc_html__( 'Pinterest', 'stm_post_type' ),
        'yahoo' => esc_html__( 'Yahoo', 'stm_post_type' ),
        'delicious' => esc_html__( 'Delicious', 'stm_post_type' ),
        'dropbox' => esc_html__( 'Dropbox', 'stm_post_type' ),
        'reddit' => esc_html__( 'Reddit', 'stm_post_type' ),
        'soundcloud' => esc_html__( 'Soundcloud', 'stm_post_type' ),
        'google' => esc_html__( 'Google', 'stm_post_type' ),
        'skype' => esc_html__( 'Skype', 'stm_post_type' ),
        'youtube' => esc_html__( 'Youtube', 'stm_post_type' ),
        'youtube-play' => esc_html__( 'Youtube Play', 'stm_post_type' ),
        'tumblr' => esc_html__( 'Tumblr', 'stm_post_type' ),
        'whatsapp' => esc_html__( 'Whatsapp', 'stm_post_type' ),
        'odnoklassniki' => esc_html__( 'Odnoklassniki', 'stm_post_type' ),
        'vk' => esc_html__( 'Vk', 'stm_post_type' ),
        'xing' => esc_html__( 'Xing', 'stm_post_type' )
    );

    return $socials;
}

/*
* Getting socials links
*/
function consulting_socials_links()
{
    $socials = consulting_socials();

    $socialsLink = array();

    foreach ( $socials as $key => $social ) {
        $socialsLink[] = array(
            'key' => $key,
            'label' => $social
        );
    }

    return $socialsLink;
}

/*
* Added custom icons to theme option
*/
add_filter( 'wpcfto_icons_set', 'consulting_wpcfto_custom_icons' );

function consulting_wpcfto_custom_icons( $icons )
{

    if( defined( 'CEI_VERSION' ) ) {
        $custom_fonts = get_option( 'stm_fonts' );
        $upload_dir         = wp_upload_dir();
        $fontawesome_file   = get_template_directory() . '/assets/fonts/fontawesome.json';
        $fontawesome_json   = [];

        if ( file_exists( $fontawesome_file ) ) {
            $fontawesome_json = json_decode(file_get_contents($fontawesome_file));
        }

        $fontawesome_icons = [];
        foreach ( $fontawesome_json as $key => $val ) {
            foreach ( $val as $k => $v ) {
                $fontawesome_icons[] = array(
                    'title' => $v,
                    'searchTerms' => array( $v )
                );
            }
        }

        $custom_fonts_json = [];
        foreach ( $custom_fonts as $fontName => $info ) {
            $custom_json_file = $upload_dir['basedir'] . '/stm_fonts/' . $fontName . '/charmap.json';
            if ( file_exists( $custom_json_file ) ) {
                $custom_fonts_json = json_decode( file_get_contents( $custom_json_file ) );
            }
        }

        $custom_fonts = [];
        foreach ( $custom_fonts_json as $key => $val ) {
            foreach ( $val as $k => $v ) {
                $custom_fonts[] = array(
                    'title' => $v,
                    'searchTerms' => array( $v )
                );
            }
        }

        $icons = array_merge($fontawesome_icons, $custom_fonts);
    }

    return $icons;
}