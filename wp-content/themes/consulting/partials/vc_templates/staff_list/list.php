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

<?php if ( $testimonials->have_posts() ) : ?>

    <div class="staff_list<?php echo esc_attr( $css_class ); ?>">
        <ul class="">
            <?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
                <li>
                    <?php $len = 155; ?>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="staff_image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if ( $grid_view == 'social_icons' ) {
                                        the_post_thumbnail( 'consulting-image-550x550-croped' );
                                    }
                                    else {
                                        if( stm_check_layout( 'layout_osaka' ) || stm_check_layout( 'layout_ankara' ) ) {
                                            the_post_thumbnail( 'thumbnail' );
                                        }
                                        else {
                                            the_post_thumbnail( $image_size );
                                        }
                                    }
                                    ?>
                                </a>
                                <ul class="staff_socials hidden">
                                    <?php if( $facebook = get_post_meta( get_the_ID(), 'facebook', true ) ): ?>
                                        <li class="staff_facebook">
                                            <a href="<?php echo esc_html( $facebook ); ?>"><i
                                                    class="fa fa-facebook"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( $twitter = get_post_meta( get_the_ID(), 'twitter', true ) ): ?>
                                        <li class="staff_twitter">
                                            <a href="<?php echo esc_html( $twitter ); ?>"><i
                                                    class="fa fa-twitter"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( $google_plus = get_post_meta( get_the_ID(), 'google_plus', true ) ): ?>
                                        <li class="staff_google_plus">
                                            <a href="<?php echo esc_html( $google_plus ); ?>"><i
                                                    class="fa fa-google-plus"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( $linkedin = get_post_meta( get_the_ID(), 'linkedin', true ) ): ?>
                                        <li class="staff_linkedin">
                                            <a href="<?php echo esc_html( $linkedin ); ?>"><i
                                                    class="fa fa-linkedin"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="staff_info">
                            <h4 class="no_stripe">
                                <a href="<?php the_permalink(); ?>" class="secondary_font_color_hv text_decoration_none"><?php the_title(); ?></a>
                            </h4>
                            <?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
                                <div class="staff_department">
                                    <?php echo esc_html( $department ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if( $excerpt = consulting_substr_text( get_the_excerpt(), $len ) ): ?>
                                <p><?php echo esc_html( $excerpt ); ?></p>
                            <?php endif; ?>
                            <?php if( $style != 'grid' ) : ?>
                                <a href="<?php the_permalink(); ?>"
                                   class="button bordered size-sm icon_right"><?php esc_html_e( 'view profile', 'consulting' ); ?>
                                    <i class="fa fa-chevron-right"></i></a>
                            <?php else: ?>
                                <a class="read_more" href="<?php the_permalink(); ?>">
                                    <span><?php esc_html_e( 'view profile', 'consulting' ); ?></span>
                                    <i class=" fa fa-chevron-right stm_icon"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
            <?php if ( isset( $link ) && $link[ 'url' ] ) : ?>
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