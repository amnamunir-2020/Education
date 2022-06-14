<?php
/**
 * @var $list
 */

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );
$id = uniqid('partners_carousel_');

if (!empty($list)) : ?>

    <div class="company_history <?php echo esc_attr($box_style); if ( isset( $dark_bg_mode ) && $dark_bg_mode == 'yes' ) echo ' dark-bg-mode' ?>">
        <ul id="<?php echo esc_attr($id); ?>">
            <?php foreach ($list as $company_item) : ?>
                <li class="history-item">

                    <?php if (!empty($company_item['year'])): ?>
                        <div class="year"><?php echo esc_html($company_item['year']); ?></div>
                    <?php endif; ?>

                    <div class="sep"></div>

                    <div class="company_history_text">

                        <?php if (!empty($company_item['title'])): ?>
                            <h4 class="no_stripe"><?php echo esc_html($company_item['title']); ?></h4>
                        <?php endif; ?>

                        <?php if (!empty($company_item['description'])): ?>
                            <?php echo wpautop($company_item['description']); ?>
                        <?php endif; ?>

                    </div>

                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            "use strict";
            var <?php echo esc_attr($id) ?> = $("#<?php echo esc_attr($id) ?>");
            var slickRtl = false;

            if ($('body').hasClass('rtl')) {
                slickRtl = true;
            }

            <?php
            $opt = 'arrows: true,';
            $opt .= 'prevArrow:"<div class=\"slick_prev\"><i class=\"fa fa-angle-left\"></i></div>",';
            $opt .= 'nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-angle-right\"></i></div>",';
            ?>

            <?php echo esc_attr($id) ?>.
            slick({
                rtl: slickRtl,
                dots: false,
                infinite: false,
                <?php echo consulting_filtered_output($opt); ?>
                autoplaySpeed: 5000,
                autoplay: false,
                slidesToShow: 4,
                slidesToScroll: 4,
                cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 680,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>

<?php endif;