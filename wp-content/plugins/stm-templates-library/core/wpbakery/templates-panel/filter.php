<?php

if( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_filter( 'filter_list', function() {

    $filters = array(
        "All" => array(
            'id' => "*",
            'active' => " is-checked",
        ),
        "About Us Page" => array(
            'id' => "templates-about",
        ),
        "Services" => array(
            'id' => "templates-services",
        ),
        "Careers" => array(
            'id' => "templates-careers",
        ),
        "Our Team" => array(
            'id' => "templates-our_team",
        ),
        "Cases" => array(
            'id' => "templates-cases",
        ),
        "News" => array(
            'id' => "templates-news",
        ),
        "Portfolio" => array(
            'id' => "templates-portfolio",
        ),
        "Events" => array(
            'id' => "templates-events",
        ),
        "Testimonials" => array(
            'id' => "templates-testimonials",
        ),
        "Webinars" => array(
            'id' => "templates-webinars",
        ),
        "Calculator" => array(
            'id' => "templates-calculator",
        ),
        "Contacts Page" => array(
            'id' => "templates-contacts",
        ),
        "Miscellaneous" => array(
            'id' => "templates-miscellaneous",
        ),
    );

    $filters = array_map( function( $filter ) {
        $count = getCategoryTemplatesCount();
        $filter[ 'count' ] = ( !empty( $count[ $filter[ 'id' ] ] ) ) ? $count[ $filter[ 'id' ] ] : 0;
        return $filter;
    }, $filters );

    $totals = getCategoryTemplatesTotal();

    ?>

    <div class="filter-button-group button-group js-radio-button-group">
        <?php foreach ( $filters as $filter_name => $filter ) : ?>
            <button class="button<?php if( !empty( $filter[ 'active' ] ) ) {
                echo esc_attr( $filter[ 'active' ] );
            } ?>" data-filter="<?php if( $filter[ 'id' ] !== '*' ) { echo '.'; } echo esc_attr( $filter[ 'id' ] ); ?>">
                <span><?php echo esc_attr( $filter_name ); ?></span>
                <span class="templates-count">
                <?php if( $filter[ 'id' ] == '*' ) {
                    echo esc_attr( $totals );
                } else {
                    echo esc_attr( $filter[ 'count' ] );
                } ?></span>
            </button>
        <?php endforeach; ?>
    </div>

<?php } );