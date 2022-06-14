<?php
$css_class .= ' ' . $style;

if ( empty( $works_count ) ) {
    $works_count = -1;
}

$works_count = 5;

$all_works = new WP_Query( array(
    'post_type' => 'stm_works',
    'posts_per_page' => $works_count
) );

$works_id = uniqid( 'stm_works_' );
?>

<?php if ( $all_works->have_posts() ) : ?>

    <?php $count = 0; ?>
    <div class="stm_works<?php echo esc_attr( $css_class ); ?> style_1">
        <?php while ( $all_works->have_posts() ) : $all_works->the_post(); ?>
            <?php
            $count++;
            $image_size = ( $count === 1 ) ? '360x360' : '360x165';
            $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' );
            ?>
            <div class="stm_works__item text-center item-<?php echo esc_attr( $count ); ?>">
                <div class="stm_works__item_wrapper">
                    <?php if ( has_post_thumbnail() ) {
                        $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $image_size );
                        echo wp_kses_post( $post_thumbnail );
                    } ?>
                    <div class="info">
                        <h3 class="work-title stripe_center">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <?php if( !empty( $term_list ) ) : ?>
                            <div class="work-category">
                                <?php echo esc_html( $term_list[ 0 ]->name ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

