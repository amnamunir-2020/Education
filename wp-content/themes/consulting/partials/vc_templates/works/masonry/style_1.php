<?php
$css_class .= ' cols_' . $cols;
$css_class .= ' ' . $style;

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'owl.carousel' );

if( empty( $works_count ) ) {
    $works_count = -1;
}
$works_count = 4;

$all_works = new WP_Query( array(
    'post_type' => 'stm_works',
    'posts_per_page' => $works_count
) );

$works_id = uniqid( 'stm_works_' );

$has_user_size = false;
if( !$img_size ) {
    $img_size = 'consulting-image-255x182-croped';
}
else {
    $has_user_size = true;
}

$count = $all_works->found_posts;
if( $count > $works_count ) $count = $works_count;
$i = 0; ?>
<?php if( $all_works->have_posts() ): ?>
    <div class="stm_works<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $works_id ); ?>">
        <?php while ( $all_works->have_posts() ):
        $all_works->the_post(); ?>
        <?php if( $i == 0 || $i == 1 ): ?>
        <div class="stm_works_col">
        <?php endif; ?>
        <?php $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' ); ?>
        <?php
        $image_size = '261x261';
        $tile_class = 'default';
        if( $i == 0 ) {
            $image_size = '552x552';
            $tile_class = 'big';
        }
        elseif( $i == 1 ) {
            $image_size = '552x261';
            $tile_class = 'medium';
        }
        $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $image_size );
        ?>
        <div class="stm_works_item <?php echo esc_attr( $tile_class ); ?>">
            <div class="inner">
                <?php echo wp_kses_post( $post_thumbnail ); ?>
                <div class="date third_bg_color">
                    <span class="day"><?php echo get_the_date( 'd' ); ?></span>
                    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                </div>
                <div class="content">
                    <a href="<?php the_permalink(); ?>" class="title">
                        <h4><?php the_title(); ?></h4>
                    </a>
                    <?php
                    if( !empty( $term_list ) ):
                        foreach( $term_list as $term ):
                            ?>
                            <a href="<?php echo get_term_link( $term->term_id, 'stm_works_category' ); ?>" class="term">
                                <?php echo esc_html( $term->name ); ?>
                            </a>
                        <?php
                        endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
        <?php
        if( $i == 0 || $i == ( intval( $count ) - 1 ) ) echo '</div>';
        $i++;
        endwhile; ?>
    </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

