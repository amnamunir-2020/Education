<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class Vc_Templates_Panel_Editor
 * @since 4.4
 */
class STL_Templates_Panel_Editor {

    /**
     * @since 4.4
     * @var string
     */
    protected $option_name = 'wpb_js_templates';
    /**
     * @since 4.4
     * @var bool
     */
	protected $stl_templates = false;
    /**
     * @since 4.4
     * @var bool
     */
    protected $initialized = false;

    /**
     * @since 4.4
     * Add ajax hooks, filters.
     */
	public function init() {
        if ( $this->initialized ) {
            return;
        }
		add_filter( 'vc_templates_render_category', array(
			$this,
			'renderTemplateBlock',
		), 10 );
		add_filter( 'vc_templates_render_template', array(
			$this,
			'renderTemplateWindow',
		), 10, 2 );
		add_filter( 'vc_get_all_templates', array(
			$this,
			'themeTemplates',
		) );
	}

	public function themeTemplates( $data ) {
        $TemplatesCategory = array(
            'category'        => 'stl_templates',
            'category_name'   => esc_html__( 'Theme Templates', 'stl' ),
            'templates'       => $this->getAllTemplates(),
        );
        $data[] = $TemplatesCategory;
        return $data;
	}

	public function stlTemplates() {
		$templates = getTemplatesFile();
		return $templates;
	}

    public function renderTemplateBlock( $category )
    {
        if( 'stl_templates' === $category[ 'category' ] ) {
            $category[ 'output' ] = '';
            $category[ 'output' ] .= apply_filters( 'filter_list', '' );
            $category[ 'output' ] .= '
            <div class="vc_column vc_col-sm-12 stl_templates_list" data-vc-hide-on-search="true" data-js="filtering-demo" >
				<div class="vc_ui-template-list grid vc_templates-list-my_templates vc_ui-list-bar" data-vc-action="collapseAll" id="theme-templates-list">';
            if( !empty( $category[ 'templates' ] ) ) {
                foreach ( $category[ 'templates' ] as $template ) {
                    $category[ 'output' ] .= $this->renderTemplateListItem( $template );
                }
            }
            $category[ 'output' ] .= '
				</div>
			</div>';
        }

        return $category;
    }

	function renderTemplateWindow( $template_name, $template_data ) {

		if ( 'stl_templates' === $template_data['type'] ) {
			return $this->renderTemplateWindowThemeTemplates( $template_name, $template_data );
		}

		return $template_name;
	}

	public function renderTemplateWindowThemeTemplates() {
		ob_start();
        $preview_template_title = esc_attr__( 'Add template', 'stl' );
        echo '<button type="button" class="vc_general vc_ui-control-button" title="' . esc_attr( $preview_template_title ) . '" data-template-handler="">Apply</button></div></div>';

		return ob_get_clean();
	}

	public function getAllTemplates() {
        $data = array();
        $stl_templates = $this->stlTemplates();
        $category_templates = array();
        if ( ! empty( $stl_templates ) ) {
            foreach ( $stl_templates as $template_id => $template_data ) {
                $category_templates[] = array(
                    'unique_id' => $template_id,
                    'name' => $template_data['name'],
                    'content' => $template_data['content'],
                    'custom_class' => $template_data['custom_class'],
                    'type' => 'stl_templates',
                    'image_path' => $template_data['image_path'],
                    'template_url' => $template_data['template_url'],
                );
                $data = $category_templates;
            }
        }
        return $data;
	}

	public function loadDefaultTemplates() {
		return $this->stl_templates;
	}

	public function getDefaultTemplates() {
		return $this->loadDefaultTemplates();
	}

	public function getDefaultTemplate( $template_index ) {
		$this->loadDefaultTemplates();
		if ( ! is_numeric( $template_index ) || ! is_array( $this->stl_templates ) || ! isset( $this->stl_templates[ $template_index ] ) ) {
			return false;
		}
		return $this->stl_templates[ $template_index ];
	}

	public function addDefaultTemplates( $data ) {
		if ( is_array( $data ) && ! empty( $data ) && isset( $data['name'], $data['content'] ) ) {
			if ( ! is_array( $this->stl_templates ) ) {
				$this->stl_templates = array();
			}
			$this->stl_templates[] = $data;

			return true;
		}

		return false;
	}

    public function renderTemplateListItem( $template )
    {
        $name = isset( $template[ 'name' ] ) ? esc_html( $template[ 'name' ] ) : esc_html__( 'No title', 'stl' );
        $template_id = esc_attr( $template[ 'unique_id' ] );
        $template_id_hash = md5( $template_id ); // needed for jquery target for TTA
        $template_name = esc_html( $name );
        $template_name_lower = esc_attr( vc_slugify( $template_name ) );
        $template_type = esc_attr( isset( $template[ 'type' ] ) ? $template[ 'type' ] : 'custom' );
        $custom_class = esc_attr( isset( $template[ 'custom_class' ] ) ? $template[ 'custom_class' ] : '' );

        $output = <<<HTML
        <div class="vc_ui-template vc_templates-template-type-$template_type $custom_class"
            data-template_id="$template_id"
            data-template_id_hash="$template_id_hash"
            data-category="$template_type"
            data-template_unique_id="$template_id"
            data-template_name="$template_name_lower"
            data-template_type="default_templates"
            data-vc-content=".vc_ui-template-content">
            <div class="vc_ui-list-bar-item">
HTML;
        $output .= '<img src="' . esc_url( $template[ 'image_path' ] ) . '"/>';
        $output .= '<div class="template-info-box"><div class="template-name">' . $template[ 'name' ] . '</div> <div class="button-box"><a href="' . $template[ 'template_url' ] . '" target="_blank" rel="nofollow" class="link-button">Preview</a>';
        $output .= apply_filters( 'vc_templates_render_template', $name, $template );
        $output .= <<<HTML
            </div>
            <div class="vc_ui-template-content" data-js-content>
            </div>
        </div>
HTML;

        return $output;
    }

    public function getOptionName()
    {
        return $this->option_name;
    }

}