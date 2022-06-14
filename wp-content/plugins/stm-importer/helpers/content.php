<?php
function stm_theme_import_content($layout, $builder, $import_media)
{
    set_time_limit(0);

    if (!defined('WP_LOAD_IMPORTERS')) {
        define('WP_LOAD_IMPORTERS', true);
    }

    require_once(STM_CONFIGURATIONS_PATH . '/wordpress-importer/class-stm-wp-import.php');

    $wp_import                      = new STM_WP_Import();
    $wp_import->theme               = 'consulting';
    $wp_import->layout              = $layout;
    $wp_import->builder             = $builder;
    $wp_import->fetch_attachments   = true;

    if($builder === 'elementor') {
        if (defined('STM_DEV_MODE')) {
            consulting_upload_placeholder();
            $ready = STM_CONFIGURATIONS_PATH . '/demos/elementor/elementor-' . $layout . '.xml';
        } else {
            consulting_upload_placeholder();
            $ready = stm_importer_download_demo( $builder . '-' . $layout);
        }
    } else {
        if (defined('STM_DEV_MODE')) {
            $ready = STM_CONFIGURATIONS_PATH . '/demos/' . $layout . '/xml/demo.xml';
        } else {
            $ready = stm_importer_download_demo($layout);
        }
    }

    if ( is_wp_error( $ready ) ) {
    	return $ready;
    }

    if ($ready) {
	    // Delete Menu
	    stm_delete_all_menu();

	    // Delete Widgets
	    delete_option( 'sidebars_widgets' );

        ob_start();
        $wp_import->import($ready);
        ob_end_clean();
    }

    return true;
}

function stm_importer_download_demo( $layout )
{
	if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	}

	$upgrader = new WP_Upgrader( new Automatic_Upgrader_Skin() );
	$result = $upgrader->run( [
		'package'                     => "downloads://consulting/demos/{$layout}.zip",
		'destination'                 => get_temp_dir(),
		'clear_destination'           => false,
		'abort_if_destination_exists' => false,
		'clear_working'               => true,
	] );

	if ( false === $result ) {
		$result = new WP_Error( '', 'WP_Upgrader returned "false" when downloading demo ZIP.');
	}

	if ( is_wp_error( $result ) ) {
		return $result;
	}

	return $result['destination'] . "{$layout}.xml";
}

function stm_delete_all_menu() {
	$taxonomy_name  = 'nav_menu';
	$terms          = get_terms([
		'taxonomy'      => $taxonomy_name,
		'hide_empty'    => false
	]);
	foreach ( $terms as $term ) {
		wp_delete_term($term->term_id, $taxonomy_name);
	}
}

function consulting_upload_placeholder() {

    $placeholder = consulting_importer_get_placeholder();
    if(empty($placeholder)) {

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $image_url = 'http://consulting.stylemixthemes.com/demo/wp-content/uploads/2016/06/placeholder.gif';

        $upload_dir = wp_upload_dir();

        $placeholder_path = STM_CONFIGURATIONS_PATH . '/assets/images/placeholder.gif';
        $image_data = $wp_filesystem->get_contents($placeholder_path);

        $filename = basename($image_url);

        if (wp_mkdir_p($upload_dir['path'])) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
        $wp_filesystem->put_contents($file, $image_data, FS_CHMOD_FILE);
//        file_put_contents($file, $image_data);

        $wp_filetype = wp_check_filetype($filename, null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $file);
        update_post_meta($attach_id, '_wp_attachment_image_alt', 'consulting_placeholder');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
    }
}

function consulting_importer_get_placeholder()
{
    $placeholder_id = 0;
    $placeholder_array = get_posts(
        array(
            'post_type' => 'attachment',
            'posts_per_page' => 1,
            'meta_key' => '_wp_attachment_image_alt',
            'meta_value' => 'consulting_placeholder'
        )
    );
    if ($placeholder_array) {
        foreach ($placeholder_array as $val) {
            $placeholder_id = $val->ID;
        }
    }
    return $placeholder_id;
}

function consulting_import_rebuilder_elementor_data(&$data) {

    $placeholder_id = consulting_importer_get_placeholder();
    $placeholder_url = wp_get_attachment_image_src($placeholder_id, 'full');
    $placeholder_url = $placeholder_url[0];
    $placeholder = array(
        'id' => $placeholder_id,
        'url' => $placeholder_url,
    );

    if(!empty($data)) {
		$data = maybe_unserialize($data);
		if (!is_array($data)) {
			if (consulting_import_is_elementor_data_unslash_required()) {
				$data = wp_unslash($data);
			}
			$data = json_decode($data, true);
		}
        consulting_import_rebuilder_elementor_data_walk($data, $placeholder_id, $placeholder_url, $placeholder);
		$data = wp_slash(wp_json_encode($data));
    }

}

function consulting_import_is_elementor_data_unslash_required() {
	// No elementor plugin is active - so no unslash is required
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return false;
	}

	// before version 2.9.10 it was required
	if ( version_compare( ELEMENTOR_VERSION, '2.9.10', '<' ) ) {
		return true;
	}

	// otherwise not required
	return false;
}

function consulting_import_rebuilder_elementor_data_walk(&$data_arg, $placeholder_id, $placeholder_url, $placeholder) {

    if( is_array( $data_arg ) ) {

        $svg_files = array(
            'circuit.svg',
            'triangle_transparent.svg',
            'industrial.svg',
            'reimbursement.svg',
            'financial.svg',
            'government.svg',
            'triangle_service.svg',
            'triangle.svg',
            'air_travel.svg',
            'schedule.svg',
            'products.svg',
            'truck.svg',
            'earth.svg',
            'money_schedule.svg',
            'triangle_staff.svg',
            'circuit_transparent.svg',
            'circuit_transparent_2.svg',
            'triangle_contact.svg',
            'triangle_for_slide_4.svg',
            'triangle_for_slide_5.svg',
            'manchester_inner_circle.svg',
            'manchester_inner_circle_transparent.svg',
            'manchester_inner_triangle-1.svg',
            'manchester_inner_triangle-2.svg',
            'manchester-heading-triangle-1.svg'
        );

        foreach ( $data_arg as &$args ) {

            if( !empty( $args[ 'url' ] ) ) {
                if( !in_array( basename( $args[ 'url' ] ), $svg_files ) ) {
                    if( !empty( $args[ 'id' ] ) ) {
                        $args = $placeholder;
                    } else {
                        $localhost = 'http://consulting.loc';
                        $host = get_bloginfo( 'url' );
                        $args[ 'url' ] = str_replace( $localhost, $host, $args[ 'url' ] );
                    }
                }
            }

            consulting_import_rebuilder_elementor_data_walk( $args, $placeholder_id, $placeholder_url, $placeholder );
        }
    }
}
