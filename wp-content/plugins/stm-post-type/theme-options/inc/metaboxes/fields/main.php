<?php
add_filter( 'wpcfto_field_icon-picker', function() {
    return STM_POST_TYPE_PATH . '/theme-options/inc/metaboxes/fields/icon-picker.php';
} );