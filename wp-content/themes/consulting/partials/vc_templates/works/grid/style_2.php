<?php
$css_class .= ' cols_' . $cols;
$css_class .= ' ' . $style;

if( $style == 'grid' ) {
    $css_class .= ' ' . esc_attr( $grid_style );
}

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );

if( empty( $works_count ) ) {
    $works_count = -1;
}
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
?>

<?php if( $all_works->have_posts() ): ?>

    <div id="<?php echo esc_attr( $works_id ); ?>" class="stm_works_wr<?php echo esc_attr( $css_class ); ?>">

        <?php if( stm_check_layout( 'layout_17' ) ): ?>

            <div class="stm_works_masonry_disabled">
                <?php $i = 0;
                while ( $all_works->have_posts() ): $all_works->the_post();
                    $i++; ?>
                    <?php $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' ); ?>
                    <div class="item">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            $generated_img_size = $img_size;
                            $class = 'default';
                            if( $i == 1 ) {
                                $generated_img_size = '539x540';
                                $class = 'large';
                            }
                            elseif( $i == 2 ) {
                                $generated_img_size = '539x255';
                                $class = 'medium';
                            }
                            else {
                                $generated_img_size = '254x255';
                            }

                            $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $generated_img_size );
                            ?>
                            <?php echo consulting_filtered_output( $post_thumbnail ); ?>
                        </a>
                        <div class="info <?php echo esc_attr( $class ); ?>">
                            <?php if( $term_list ): ?>
                                <div class="category">
                                    <a href="<?php echo esc_url( get_term_link( $term_list[ 0 ] ) ); ?>"><span><?php echo esc_html( $term_list[ 0 ]->name ); ?></span>
                                        <i class="fa fa-chevron-left"></i></a>
                                </div>
                            <?php endif; ?>
                            <div class="title heading_font"><a
                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

        <?php elseif(
            stm_check_layout( 'layout_19' )
            || stm_check_layout( 'layout_zurich' )
            || stm_check_layout( 'layout_san_francisco' )
            || stm_check_layout( 'layout_stockholm' )
            || stm_check_layout( 'layout_geneva' )
            || stm_check_layout( 'layout_osaka' )
            || stm_check_layout( 'layout_budapest' )
            || stm_check_layout( 'layout_barcelona' ) ): ?>

            <div class="stm_works_masonry_disabled">
                <?php $i = 0;
                while ( $all_works->have_posts() ): $all_works->the_post();
                    $i++; ?>
                    <?php $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' ); ?>
                    <div class="item">
                        <?php
                        $generated_img_size = $img_size;
                        $class = 'default';
                        if( $i == 1 ) {
                            $generated_img_size = '550x525';
                            $class = 'large';
                        }
                        elseif( $i == 2 ) {
                            $generated_img_size = '545x255';
                            $class = 'medium';
                        }
                        else {
                            $generated_img_size = '265x255';
                        }

                        $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $generated_img_size );
                        ?>
                        <?php echo consulting_filtered_output( $post_thumbnail ); ?>
                        <a href="<?php the_permalink(); ?>">
                    <span class="work-title">
                        <?php the_title(); ?>
                        <?php if( $term_list ): ?>
                            <span class="work-description"><?php echo esc_html( $term_list[ 0 ]->name ); ?></span>
                        <?php endif; ?>
                    </span>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

        <?php else: ?>
            <div class="stm_works">
                <?php while ( $all_works->have_posts() ): $all_works->the_post(); ?>
                    <?php $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' ); ?>
                    <div class="item">
                        <div class="image">
                            <?php


                            $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $img_size );
                            if( strlen( get_the_title() ) > 71 ) {
                                $title = substr( get_the_title(), 0, 71 ) . "...";
                            }
                            else {
                                $title = get_the_title();
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>"><?php echo consulting_filtered_output( $post_thumbnail ); ?></a>
                            <?php if( stm_check_layout( 'layout_16' ) ): ?>
                                <div class="stm_l16_works_bot">
                                    <?php if( $term_list ): ?>
                                        <div class="category"><a
                                                    href="<?php echo esc_url( get_term_link( $term_list[ 0 ] ) ); ?>"><span><?php echo esc_html( $term_list[ 0 ]->name ); ?></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="title heading-font"><a
                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="info">
                            <?php if( stm_check_layout( 'layout_16' ) ): ?>
                                <div class="stm_the_excerpt"><?php the_excerpt(); ?></div>
                                <a class="stm_link_bordered"
                                   href="<?php echo esc_url( get_the_permalink() ) ?>"><?php esc_html_e( 'Read more', 'consulting' ); ?></a>
                            <?php else: ?>
                                <?php if( $term_list ): ?>
                                    <div class="category"><a
                                                href="#<?php echo esc_attr( $term_list[ 0 ]->slug ); ?>"><span><?php echo esc_html( $term_list[ 0 ]->name ); ?></span>
                                            <i class="fa fa-chevron-right"></i></a></div>
                                <?php endif; ?>
                                <div class="title"><a
                                            href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var $container = $("#<?php echo esc_js( $works_id ); ?> .stm_works");
                var originLeft = true;
                if ($('body').hasClass('rtl')) {
                    originLeft = false;
                }
                $container.isotope({
                    layoutMode: 'fitRows',
                    itemSelector: '.item',
                    transitionDuration: '0.7s',
                    isOriginLeft: originLeft,
                    <?php if(!empty( $works_count_visible )): ?>
                    filter: function () {
                        return $(this).index() < <?php echo esc_js( intval( $works_count_visible ) ); ?>
                    }
                    <?php endif; ?>
                });
                $container.imagesLoaded().progress(function () {
                    $container.isotope('layout');
                });
                $container.isotope('layout');
                $('#<?php echo esc_js( $works_id ); ?> .works_filter a').on('click', function () {
                    var i = 0;
                    if (!$(this).hasClass("stm_works_grid_switcher")) {

                        $(this).closest('ul').find('li.active').removeClass('active');
                        $(this).parent().addClass('active');
                        var sort = $(this).attr('href');
                        sort = sort.substring(1);
                        <?php if(empty( $works_count_visible )): ?>
                        $container.isotope({
                            filter: '.' + sort
                        });
                        <?php else: ?>
                        $container.isotope({
                            filter: function () {
                                if ($(this).hasClass(sort) && i < <?php echo esc_js( intval( $works_count_visible ) ); ?>) {
                                    i++;
                                    return $(this);
                                }
                            }
                        });
                        <?php endif; ?>
                        return false;
                    }
                });
                $(document).on('click', '.stm_works_grid_switcher', function () {
                    $(this).toggleClass('active');
                    var $container_wrapper = $(this).closest('.stm_works_wr');
                    if ($('body').hasClass('boxed_layout')) {
                        $container_wrapper.toggleClass('wide');
                    } else {
                        $container_wrapper.toggleClass('wide container');
                    }
                    //$container_wrapper.find('.stm_works_grid_switcher').closest('.works_filter').toggleClass('container');
                    $container.isotope('layout');
                    $container.closest('.stm_works').animate({'height': $container.height() + $('#stm_works_<?php echo esc_js( $works_id ); ?> .stm_works').height()}, 300);
                    return false;
                });
                $('#<?php echo esc_js( $works_id ); ?> .item .category a').on('click', function () {
                    if (!$(this).hasClass("stm_works_grid_switcher")) {
                        var sort = $(this).attr('href');
                        sort = sort.substring(1);
                        $('#<?php echo esc_js( $works_id ); ?> .works_filter li.active').removeClass('active');
                        $('#<?php echo esc_js( $works_id ); ?> .works_filter li a[href="#' + sort + '"]').closest('li').addClass('active');
                        $container.isotope({
                            filter: '.' + sort
                        });
                        return false;
                    }
                });
            });
        </script>
        <?php
        if( stm_check_layout( 'layout_20' ) ):?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {

                    var works_filter = $(".works_filter"),
                        elem_width,
                        elem_left_offset,
                        elem_parent,
                        slider_line;

                    $(window).load(function () {

                        works_filter.each(function () {
                            $(this).append('<li class="magic-line"></li>');

                            var start_elem_width = 0;
                            var start_elem_offset = 0;
                            var active_elem = $(this).find(".active");

                            if (active_elem.length) {
                                start_elem_width = active_elem.outerWidth();
                                start_elem_offset = active_elem.position().left;
                            }

                            $(this).find(".magic-line").css({
                                "width": start_elem_width + "px",
                                "left": start_elem_offset + "px"
                            })
                                .data("width", start_elem_width)
                                .data("left", start_elem_offset);
                        });

                    });

                    works_filter.find("li a").on('click', function () {
                        works_filter.each(function () {
                            var start_elem_width = 0;
                            var start_elem_offset = 0;
                            var active_elem = $(this).find(".active");

                            if (active_elem.length) {
                                start_elem_width = active_elem.outerWidth();
                                start_elem_offset = active_elem.position().left;
                            }

                            $(this).find(".magic-line").css({
                                "width": start_elem_width + "px",
                                "left": start_elem_offset + "px"
                            })
                                .data("width", start_elem_width)
                                .data("left", start_elem_offset);
                        });
                    });

                    works_filter.find("li a").on('hover', function () {

                        elem_parent = $(this).parent();
                        elem_width = elem_parent.outerWidth();
                        elem_left_offset = $(this).position().left;
                        slider_line = elem_parent.siblings(".magic-line");
                        slider_line.stop().animate({
                            "width": elem_width + "px",
                            "left": elem_left_offset + "px"
                        });

                    }, function () {

                        slider_line.stop().animate({
                            "width": slider_line.data("width") + "px",
                            "left": slider_line.data("left") + "px"
                        });

                    });

                });
            </script>
        <?php endif; ?>
    </div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
