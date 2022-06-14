<?php /* Template Name: Under Construction Template */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="page-under-construction uc" style="background-image: url(<?php the_post_thumbnail_url() ?>); background-repeat: no-repeat; background-size: cover;">

        <div class="uc__main">
            <div class="uc__header">
                <div class="container">
                    <?php
                    $logo_tmp_src = '';
                    $logo = consulting_get_logo_url('logo', get_template_directory_uri() . '/assets/images/tmp/' . $logo_tmp_src . 'logo_default.svg');
                    if($logo == false) {
                        $logo = get_template_directory_uri() . '/assets/images/tmp/logo_default.svg';
                    }
                    ?>
                    <a href="<?php echo esc_url(home_url()); ?>">
                        <img src="<?php echo esc_url($logo); ?>"
                             style="width: <?php echo esc_attr(consulting_theme_option('logo_width')) ?>px; height: <?php echo esc_attr(consulting_theme_option('logo_height')) ?>px;"
                             alt="<?php bloginfo('name'); ?>"/>
                    </a>
                </div>
            </div>
            <div class="uc__content">
                <div class="container">
                    <?php the_content() ?>
                </div>
            </div>
        </div>
        <div class="uc__footer">
            <div class="container">
                <div class="uc__footer-content">
                    <?php echo wp_kses_post( consulting_theme_option( 'footer_copyright' ) ) ?>
                </div>
            </div>
        </div>

    </div>

<?php endwhile; ?>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>