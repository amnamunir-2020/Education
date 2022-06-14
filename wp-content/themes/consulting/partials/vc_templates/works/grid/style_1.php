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

        <div class="stm_works clearfix">
            <?php while ( $all_works->have_posts() ) : $all_works->the_post(); ?>
                <?php
                $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' );
                ?>
                <div class="item">
                    <div class="item_wr">
                        <?php

                        if( stm_check_layout( 'layout_13' ) and !$has_user_size ) {
                            $img_size = 'consulting-image-320x320-croped';
                        }

                        $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $img_size );
                        echo consulting_filtered_output( $post_thumbnail );
                        if( strlen( get_the_title() ) > 50 ) {
                            $title = substr( get_the_title(), 0, 50 ) . "...";
                        }
                        else {
                            $title = get_the_title();
                        }
                        ?>

                        <?php if ( stm_check_layout( 'layout_13' ) ) : ?>
                            <div class="stm_item_wr-content">
                                <?php if( $term_list ): ?>
                                    <div class="category"><?php echo esc_html( $term_list[ 0 ]->name ); ?>
                                        <i class="fa fa-chevron-right"></i></div>
                                <?php endif; ?>
                                <div class="title"><?php echo sanitize_text_field( $title ); ?></div>
                            </div>
                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        <?php else: ?>
                            <div class="title"><?php echo sanitize_text_field( $title ); ?></div>
                            <?php if( $term_list ): ?>
                                <div class="category"><?php echo esc_html( $term_list[ 0 ]->name ); ?></div>
                            <?php endif; ?>
                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>

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
