<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link        https://ahmadraza.ga
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/public
 * @author     Ahmad <raza.ataki@gmail.com>
 */
class Rocket_Books_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rocket_Books_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rocket_Books_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'css/rocket-books-public.css', array(), $this->version, 'all');

        wp_register_style($this->plugin_name . '-widget', plugin_dir_url(__FILE__) . 'css/rocket-books-widgets.css', array(),
            $this->version, 'all');

        if (is_singular('book')) {
            wp_enqueue_style($this->plugin_name . '-single-book', plugin_dir_url(__FILE__) . 'css/rocket-books-book-single.css', array(), $this->version, 'all');
        }

        if (rbr_is_single_or_archive_book()) {
            wp_enqueue_style($this->plugin_name . '-fontawesome', ROCEKT_BOOKS_PLUGIN_URL . 'vendor/fontawesome/css/all.css', array(), $this->version, 'all');
        }

        if (is_active_widget(false, false, 'rbr_books_list', true)) {
            wp_enqueue_style($this->plugin_name . '-widget');
        }

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rocket_Books_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rocket_Books_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rocket-books-public.js', array('jquery'), $this->version, false);

    }

    /**
     * Register custom post type
     */

    public function register_book_post_type()
    {
        register_post_type('book', array(
            'description' => __('Books', 'rocket-books'),
            'labels' => array(
                'name' => _x('Books', 'post type general name', 'rocket-books'),
                'singular_namme' => _x('Book', 'post type singular name', 'rocket-books'),
                'menu_name' => _x('Books', 'admin menu', 'rocket-books'),
                'name_admin_bar' => _x('Book', 'add new book on admin bar', 'rocket-books'),
                'add_new' => _x('Add New', 'post_type', 'rocket-books'),
                'add_new_item' => __('Add New Book', 'rocket-books'),
                'edit_item' => __('Edit Book', 'rocket-books'),
                'new_item' => __('New Book', 'rocket-books'),
                'view_item' => __('View Book', 'rocket-books'),
                'search_item' => __('Search Book', 'rocket-books'),
                'not_found' => __('No books found', 'rocket-books'),
                'not_found_in_trash' => __('No books found in Trash.', 'rocket-books'),
                'parent_item_colon' => __('Parent Book:', 'rocket-books'),
                'all_items' => __('All Books', 'rocket-books'),
            ),
            'public' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-book-alt',
            'capability_type' => 'post',
            'capabilities' => array(),
            'map_meta_cap' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            'register_meta_box_cb' => null,
            'taxonomies' => array('genre'),
            'has_archive' => true,
            'rewrite' => array(
                'slug' => 'book',
                'with_front' => true,
                'feeds' => true,
                'pages' => true,
            ),
            'query_var' => true,
            'can_export' => true,
            'show_in_rest' => true,
        ));
    }

    /**
     * Register Taxonomy: Genre
     */

    public function register_taxonomy_genre()
    {
        register_taxonomy('genre', array('book'), array(
            'description' => 'Genre',
            'labels' => array(
                'name' => _x('Genre', 'taxonomy general name', 'rocket-books'),
                'singular_name' => _x('Genre', 'taxonomy singular name', 'rocket-books'),
                'search_items' => _x('Search Genre', 'rocket-books'),
                'popular_items' => _x('Popular Genre', 'rocket-books'),
                'all_items' => _x('All Genre', 'rocket-books'),
                'parent_item' => _x('Parent Genre', 'rocket-books'),
                'parent__item_colon' => _x('Parent Genre', 'rocket-books'),
                'edit_item' => _x('Edit Genre', 'rocket-books'),
                'view_item' => _x('View Genre', 'rocket-books'),
                'update_item' => _x('Update Genre', 'rocket-books'),
                'add_new_item' => _x('Add New Genre', 'rocket-books'),
                'new_item_name' => _x('New Genre Name', 'rocket-books'),
                'separate_items_with_commas' => _x('Separate genre with commas', 'rocket-books'),
                'add_or_remove_items' => _x('Add or remove genre', 'rocket-books'),
                'choose_from_most_user' => _x('Choose from the most used genre', 'rocket-books'),
                'not_found' => _x('No genre found', 'rocket-books'),
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_nav_manus' => true,
            'show_tagcloud' => true,
            'meta_box_cb' => null,
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => 'genre',
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => true,
                'hierarchical' => true,
            ),
            'capabilities' => array(),
        ));
    }

}
