<?php
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_filter('rbr/admin/settings/advance/fields', 'adding_color_field_to_advance_section');

function adding_color_field_to_advance_section($fields_array)
{

    // Modify this fields array

    $fields_array[] = array(
        'id' => 'advance_color_field',
        'label' => 'Advance Color Field',
        'type' => 'color',
    );

    return $fields_array;

}

add_filter('rbr/cpt/register/book/args', function ($args_array) {
    // Modify
    $args_array['menu_icon'] = 'dashicons-book';
    return $args_array;
});
