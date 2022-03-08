<?php
/**
 * Plugin name: My Fluffy cat
 */

add_action('admin_menu', 'mfc_plugin_menu');

function mfc_plugin_menu()
{
    // Code to be processed ata admin_menu action hook
    add_menu_page(
        'My fluffy cat', // page_title
        'My fluffy cat', // menu_title
        'manage_options', // capability
        'my-fluffy-cat', // menu_slug
        'mfc_page_display', // function
        'dashicons-heart' // icon_url
    );
}

function mfc_page_display()
{
    echo "My cats will play here";
}

add_filter('the_content', 'mfc_content_filter');

function mfc_content_filter($content)
{
    $content = "My fluffy cat says: " . $content;
    return $content;
}

add_filter('body_class', 'mfc_add_body_class');

function mfc_add_body_class($body_classes)
{
    if (is_single()) {
        $body_classes[] = 'my-fluffy-cat-class';
    }
    return $body_classes;
}
