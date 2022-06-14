<?php

if( empty( $posts_per_row ) ) $posts_per_row = 3;
$css_class .= ' ' . $style;
$css_class .= ' cols_' . $posts_per_row;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'stm_service',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged
);

$categories = get_terms( 'stm_service_category' );

if( empty( $img_size ) ) {
    $img_size = 'consulting-image-255x182-croped';
}

if( $category != 'all' ) {
    $args[ 'stm_service_category' ] = $category;
}

$services = new WP_Query( $args );

$count_posts = wp_count_posts( 'stm_service' );
$published_posts = $count_posts->publish;

?>

<?php if( $services->have_posts() ): ?>

    <div class="stm_services<?php echo esc_attr( $css_class ); ?>">
        <?php while ( $services->have_posts() ): $services->the_post(); $term_list = wp_get_post_terms( get_the_ID(), 'stm_service_category' ); ?>
            <div class="item">
                <div class="service-content">

                    <?php if ( !$service_image and has_post_thumbnail() ) : ?>

                        <a href="<?php the_permalink(); ?>" class="service-image-box">
                            <?php if( has_post_thumbnail() ): ?>
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="<?php the_title() ?>" />
                            <?php endif; ?>
                            <span class="service-title"><?php the_title(); ?></span>
                        </a>

                    <?php endif; ?>

                    <div class="service-description">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="service-more">
                        <?php echo esc_html__( 'See More', 'consulting' ); ?>
                        <i class="stm-right-arrow"></i>
                    </a>

                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif;
wp_reset_postdata(); ?>