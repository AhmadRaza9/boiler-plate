<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link               https://ahmadraza.ga
 * @since             1.0.0
 * @package           Rocket_Books
 *
 * @wordpress-plugin
 * Plugin Name:       Rocket Books Shelf
 * Plugin URI:        https://ahmadraza.ga
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ahmad
 * Author URI:         https://ahmadraza.ga
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rocket-books
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ROCKET_BOOKS_VERSION', '1.0.0');

define('ROCKET_BOOKS_NAME', 'rocket_books');

/**
 * Plugin Directly Path.
 * Plugin base dir path.
 * user to locate plugin resources primarily code files
 * start at version 1.0.0
 */
define('ROCKET_BOOKS_BASE_DIR', plugin_dir_path(__FILE__));

/**
 * Plugin Directly URL
 * Plugin url to access its resources through browser
 * used to access assets images/css/js files
 * Start at version 1.0.0
 */
define('ROCEKT_BOOKS_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rocket-books-activator.php
 */
function activate_rocket_books()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-rocket-books-activator.php';
    Rocket_Books_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rocket-books-deactivator.php
 */
function deactivate_rocket_books()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-rocket-books-deactivator.php';
    Rocket_Books_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_rocket_books');
register_deactivation_hook(__FILE__, 'deactivate_rocket_books');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-rocket-books.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rocket_books()
{

    $plugin = new Rocket_Books();
    $plugin->run();

}
run_rocket_books();

/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_book_init()
{
    $labels = array(
        'name' => _x('Books', 'Post type general name', 'textdomain'),
        'singular_name' => _x('Book', 'Post type singular name', 'textdomain'),
        'menu_name' => _x('Books', 'Admin Menu text', 'textdomain'),
        'name_admin_bar' => _x('Book', 'Add New on Toolbar', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'add_new_item' => __('Add New Book', 'textdomain'),
        'new_item' => __('New Book', 'textdomain'),
        'edit_item' => __('Edit Book', 'textdomain'),
        'view_item' => __('View Book', 'textdomain'),
        'all_items' => __('All Books', 'textdomain'),
        'search_items' => __('Search Books', 'textdomain'),
        'parent_item_colon' => __('Parent Books:', 'textdomain'),
        'not_found' => __('No books found.', 'textdomain'),
        'not_found_in_trash' => __('No books found in Trash.', 'textdomain'),
        'featured_image' => _x('Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives' => _x('Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item' => _x('Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list' => _x('Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
        'items_list' => _x('Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('book', $args);
}

add_action('init', 'wpdocs_codex_book_init');
