<?php

// If this file is call directyl, abort.
if (!defined('ABSPATH')) {
    die;
}

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
 * Functionality for our custom post types.
 *
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/public
 * @author     Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Post_Types')) {
    class Rocket_Books_Post_Types
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
         * Temple loader class
         */

        private $template_loader;

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
            $this->template_loader = rbr_get_template_loader();
        }

        /**
         * hooked into 'init' action hook
         */

        public function init()
        {
            $this->register_cpt_book();
            $this->register_taxonomy_genre();
        }

        /**
         * Registering custom post type Book
         */

        public function register_cpt_book()
        {
            register_post_type('book',
                apply_filters('rbr/cpt/register/book/args',
                    array(
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
                        // 'register_meta_box_cb' => array($this, 'register_metabox_book'), // turn on to add meta box fields
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
                    )
                )
            );
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
                'show_in_rest' => true,
            ));
        }

        /**
         * filter content for CPT:Book
         * @param mixed $the_content
         * the content of the post/post type.
         */

        public function content_single_book($the_content)
        {
            // filter contents  for just books
            if (in_the_loop() && is_singular('book')) {
                // return "<pre>" . $the_content . "</pre>";
                ob_start();
                include ROCKET_BOOKS_BASE_DIR . 'templates/book-content.php';
                return ob_get_clean();
            }
            return $the_content;
        }

        /**
         * Single Template for CPT: Book
         */

        public function single_template_book($template)
        {
            if (is_singular('book')) {

                return $this->template_loader->get_template_part('single', 'book', false);

            }
            return $template;
        }

        /**
         * Archive Template for CPT: Book
         */

        public function archive_template_book($template)
        {
            if (rbr_is_archive_book()) {
                // template for CPT book

                return $this->template_loader->get_template_part('archive', 'book', false);
            }
            return $template;
        }

        // public function get_template_loader()
        // {
        // require_once ROCKET_BOOKS_BASE_DIR . 'public/class-rocket-books-template-loader.php';
        // return new Rocket_Books_Template_Loader();

        // return Rocket_Books_Global::template_loader();

        // }

        /**
         * Register metabox for CPT: Book
         */

        public function register_metabox_book($post)
        {
            $is_gutenberg_active = (
                function_exists('use_block_editor_for_post_type') &&
                use_block_editor_for_post_type(get_post_type())
            );
            add_meta_box(
                'book-details',
                __('Book Details', 'rocket-books'),
                array($this, 'book_metabox_display_cb'),
                'book',
                ($is_gutenberg_active) ? 'side' : 'normal',
                'default',
            );

        }

        /**
         * Display for Metabox for CPT: Book
         */

        public function book_metabox_display_cb($post)
        {
            wp_nonce_field('rbr_meta_box_nonce_action', 'rbr_meta_box_nonce');

            ?>
<p>
    <label for="rbr-book-pages">
        <?php _e('Number of Pages:', 'rocket-books');?>
    </label>
    <input type="text" name="rbr-book-pages" class="widefat" value="<?php echo esc_html(get_post_meta(get_the_ID(), 'rbr_book_pages', true)); ?>">
</p>

<p>
    <label for="rbr-is-featured">
        <?php _e('is Featured Book? ', 'rocket-books');?>
    </label>
    <input type="checkbox" name="rbr-is-featured"
    value="yes"
    <?php checked(get_post_meta(get_the_ID(), 'rbr_is_featured', true), 'yes');?>>
</p>

<?php $book_format_from_db = esc_html(get_post_meta(get_the_ID(), 'rbr_book_format', true));?>

<p>
    <label for="rbr-book-format"><?php _e('Book Format', 'rocket-books');?></label>
    <select name="rbr-book-format" id="rbr-book-format" class="widefat">
        <option value=""><?php _e('Select Options...', 'rocket-books');?></option>
        <option value="hardcover" <?php selected($book_format_from_db, 'hardcover');?>><?php _e('Hardcover', 'rocket-books');?></option>
        <option value="audio" <?php selected($book_format_from_db, 'audio');?>><?php _e('Audio', 'rocket-books');?></option>
        <option value="pdf" <?php selected($book_format_from_db, 'pdf');?>><?php _e('PDF', 'rocket-books');?></option>
    </select>
</p>

<?php

            // var_export(get_post_meta($post->ID));

        }

        /**
         * Saving Custom fields for CPT: Book
         **/

        public function metabox_save_book($post_id, $post, $update)
        {

            /**
             * Prevent saving if its triggered for:
             * 1. Auto save
             * 2. User does not have permission to edi
             * 3. Invalid nonce
             */

            // if this is an autosave, our form has not been submitted, so do nothing
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // check user permission
            if (!current_user_can('edit_posts', $post_id)) {
                print __('Sorry, you do not have access to edit post', 'rocket-books');
                exit;
            }

            // verify nonce
            if (!isset($_POST['rbr_meta_box_nonce']) || !wp_verify_nonce($_POST['rbr_meta_box_nonce'], 'rbr_meta_box_nonce_action')) {
                return null;
            }
            // update_post_meta(get_the_ID(), 'rbr_book_pages', $_POST['rbr-book-pages']);

            if (array_key_exists('rbr-book-pages', $_POST)) {

                update_post_meta(
                    $post_id,
                    'rbr_book_pages',
                    absint($_POST['rbr-book-pages'])
                );
            }

            // Validation : we know what are expecting to receive

            if (array_key_exists('rbr-is-featured', $_POST)) {

                update_post_meta(
                    $post_id,
                    'rbr_is_featured',
                    ('yes' === $_POST['rbr-is-featured']) ? 'yes' : 'no' // yes / no
                );
            }

            if (array_key_exists('rbr-book-format', $_POST)) {

                $book_format = (
                    in_array($_POST['rbr-book-format'], array('hardcover', 'audio', 'pdf'))
                ) ? sanitize_key($_POST['rbr-book-format']) : 'no-format';

                update_post_meta(
                    $post_id,
                    'rbr_book_format',
                    $book_format
                );
            }

        }

        /**
         * Adding Metaboxes using CMB2 framework
         */

        public function register_cmb2_metabox_book()
        {
            $metabox = new_cmb2_box(array(
                'id' => 'book-details',
                'title' => __('Book Details from CMB2', 'rocket-books'),
                'object_types' => array('book'),
                'context' => 'side',
            ));
            $metabox->add_field(array(
                'id' => 'rbr_is_featured',
                'name' => __('Is Featured Book', 'rocket-books'),
                'type' => 'checkbox',
            ));

            $metabox->add_field(array(
                'id' => 'rbr_book_pages',
                'name' => __('Number of Pages', 'rocket-books'),
                'type' => 'text',
                'sanitization_cb' => 'absint',
            ));

            $metabox->add_field(array(
                'id' => 'rbr_book_format',
                'name' => __('Book Format ', 'rocket-books'),
                'type' => 'select',
                'options' => array(
                    'no-format' => __('Select Format...', 'rocket-books'),
                    'hardcover' => __('Hardcover', 'rocket-books'),
                    'audio' => __('Audio', 'rocket-books'),
                    'pdf' => __('PDF', 'rocket-books'),
                ),
                'default' => 'no-format',
            ));

        }

    }
}