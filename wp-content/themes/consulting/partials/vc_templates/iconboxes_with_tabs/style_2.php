<?php
$tabs_count = 3;
$icons_tabs = [];
$icons_tabs_content = [];

for ( $i = 1; $i <= $tabs_count; $i++ ) {
    $postfix = ( $i == 1 ) ? '' : '_' . $i;
    $icons_tabs[ 'tab' . $i ] = array (
        'id' => ${ 'tab_id' . $postfix },
        'name' => ${ 'tab_name' . $postfix },
        'class' => ( $i == 1 ) ? 'active' : ''
    );
    $icons_tabs_content[ 'tab' . $i ] = array (
        'id' => ${ 'tab_id' . $postfix },
        'content_title' => ${ 'content_title' . $postfix },
        'icons' => ${ 'icon_sections' . $postfix },
        'class' => ( $i == 1 ) ? 'active' : ''
    );
}

?>
<div class="icon_box_with_tabs <?php if ( isset( $box_style ) ) echo esc_attr( $box_style ); ?>">
    <div class="icon_box_tab_links">
        <?php foreach ( $icons_tabs as $tab ) : ?>
            <a href="javascript:void(0);" class="icon_box_tab_link <?php echo esc_attr( $tab['class'] ); ?>" onclick="openCity(event, '<?php echo esc_attr($tab['id']); ?>')"><?php echo esc_attr( $tab['name'] ); ?></a>
        <?php endforeach; ?>
    </div>
    <?php foreach ( $icons_tabs_content as $content ) : ?>
        <div id="<?php echo esc_attr( $content['id'] ); ?>" class="icon_box_tab_content <?php echo esc_attr( $content['class'] ); ?>">

            <?php if ( isset( $content['icons'] ) ) : ?>
                <div class="icon_box_icons">
                    <ul>
                        <?php foreach ( $content['icons'] as $icon ) : ?>
                            <li>
                                <div class="icon_box_icon">
                                    <?php if( $icon['icons']['library'] != 'svg' ) : ?>
                                        <i class="<?php echo esc_attr( $icon['icons']['value'] ); ?>"></i>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url( $icon['icons']['value']['url'] ); ?>" alt="<?php echo esc_attr( $icon['title'] ); ?>" />
                                    <?php endif;?>
                                </div>
                                <div class="icon_box_info">
                                    <div class="icon_box_title"><?php echo esc_attr( $icon['title'] ); ?></div>
                                    <div class="icon_box_description"><?php echo esc_attr( $icon['icon_info'] ); ?></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
</div>

<script>
    function openCity(evt, cityName) {
        var i, icon_box_tab_content, icon_box_tab_links;
        icon_box_tab_content = document.getElementsByClassName("icon_box_tab_content");
        for (i = 0; i < icon_box_tab_content.length; i++) {
            icon_box_tab_content[i].style.display = "none";
        }
        icon_box_tab_link = document.getElementsByClassName("icon_box_tab_link");
        for (i = 0; i < icon_box_tab_link.length; i++) {
            icon_box_tab_link[i].className = icon_box_tab_link[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "flex";
        evt.currentTarget.className += " active";
    }
</script>
