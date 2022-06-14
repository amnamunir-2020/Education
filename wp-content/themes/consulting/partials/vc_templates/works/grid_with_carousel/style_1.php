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

$all_works = new WP_Query( array(
    'post_type' => 'stm_works',
    'posts_per_page' => $works_count
) );

$works_id = uniqid( 'stm_works_' );

if( $all_works->have_posts() ): ?>

    <div id="<?php echo esc_attr( $works_id ); ?>"
         class="stm_works_wr<?php echo esc_attr( $css_class ); ?>">
        <?php while ( $all_works->have_posts() ) : $all_works->the_post(); ?>
            <?php $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' ); ?>
            <div class="item">
                <div class="image">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail( 'consulting-image-550x550-croped' ); ?></a>
                </div>
                <div class="info">
                    <?php if( $term_list ): ?>
                        <div class="category">
                            <a href="#<?php echo esc_attr( $term_list[ 0 ]->slug ); ?>">
                                <span><?php echo esc_html( $term_list[ 0 ]->name ); ?></span>
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#<?php echo esc_js( $works_id ); ?>").owlCarousel({
                <?php if( $loop ): ?>
                loop: true,
                <?php endif; ?>
                <?php if( $autoplay ): ?>
                autoplay: true,
                <?php endif; ?>
                <?php if( $dots ): ?>
                dots: true,
                <?php endif; ?>
                <?php if( $nav ): ?>
                nav: true,
                <?php endif; ?>
                smartSpeed: <?php echo esc_js( $smart_speed ); ?>,
                responsive: {
                    0: {
                        items: <?php echo esc_js( $items_mobile ); ?>
                    },
                    480: {
                        items: <?php echo esc_js( $items_land ); ?>
                    },
                    768: {
                        items: <?php echo esc_js( $items_tablet ); ?>
                    },
                    992: {
                        items: <?php echo esc_js( $items_small_desktop ); ?>
                    },
                    1024: {
                        items: <?php echo esc_js( $items ); ?>
                    }
                }
            });
        });
    </script>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

