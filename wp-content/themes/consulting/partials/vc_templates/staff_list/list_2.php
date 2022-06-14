<?php
$css_class .= ' ' . $style;

if ( !empty( $image_style ) ){
    $css_class .= ' ' . $image_style;
}

$args = array(
    'post_type' => 'stm_staff',
    'posts_per_page' => $count
);

if ( $category != 'all' ) {
    $args[ 'stm_staff_category' ] = $category;
}

$testimonials = new WP_Query( $args );

$image_size = 'consulting-image-350x250-croped';

if ( stm_check_layout( 'layout_geneva' ) ) {
    $image_size = '164x200';
}

?>

<?php if( $testimonials->have_posts() ) : ?>

    <div class="staff_list<?php echo esc_attr( $css_class ); ?>">
        <ul class="">
            <?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
                <li>
                    <?php $len = 155; ?>

                    <div class="inner">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="staff_image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail($image_size); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="staff_content remove_padding">
                            <a href="<?php the_permalink(); ?>" class="base_font_color text_decoration_none">
                                <h4 class="secondary_font_color_hv">
                                    <?php the_title(); ?>
                                </h4>
                            </a>
                            <?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
                                <div class="staff_department">
                                    <?php echo esc_html( $department ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if( has_excerpt() ): ?>
                                <div class="staff_excerpt">
                                    <?php echo wp_kses_post(consulting_substr_text( get_the_excerpt(), 100 )); ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="read_more base_font_color">
                                <i class="stm-lnr-arrow-right third_bg_color"></i>
                                <?php esc_html_e('Read more', 'consulting'); ?>
                            </a>
                        </div>
                    </div>

                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
            <?php if( isset( $link ) && $link[ 'url' ] ): ?>
                <li class="staff_custom_link">
                    <a href="<?php echo esc_url( $link[ 'url' ] ); ?>">
                        <?php if( !empty( $link[ 'title' ] ) || !empty( $link_text ) ) : ?>
                            <span>
                            <?php if( !empty( $link[ 'title' ] ) ) : ?>
                                <span class="staff_custom_link_title"><?php echo esc_html( $link[ 'title' ] ); ?></span>
                            <?php endif; ?>
                                <?php echo esc_html( $link_text ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>
        </ul>

    </div>

<?php endif; ?>