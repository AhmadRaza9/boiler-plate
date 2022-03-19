<?php

/**
 * Plugin Shortcode Functionaliity
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author     Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Shortcodes')) {

    class Rocket_Books_Shortcodes
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
         * It will be hold all the css for all shortcodes
         */

        protected $shortcode_css;

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
            $this->setup_hooks();
        }

        /**
         * Setup action / filter hooks
         */

        public function setup_hooks()
        {
            add_action('wp_enqueue_scripts', array($this, 'register_style'));

            add_action('get_footer', array($this, 'maybe_enqueue_scripts'));

        }

        /**
         * Register Placeholder Style
         */

        public function register_style()
        {
            wp_register_style(
                $this->plugin_name . '-shortcodes', // handle
                ROCEKT_BOOKS_PLUGIN_URL . 'public/css/rocket-books-shortcodes.css', // src

            );
        }

        /**
         * Shortcode for Books list
         * Usage => [book_list limit=5 column=3]Between Shortcode [/book_list]
         */

        public function book_list($atts, $content)
        {

            $atts = shortcode_atts(
                array(
                    'limit' => get_option('posts_per_page'),
                    'column' => 3,
                    'bgcolor' => '',
                    'genre' => '',
                ), // pairs
                $atts, // atts
                'book_list', // shortcode
            );

            $loop_args = array(
                'post_type' => 'book',
                'posts_per_page' => $atts['limit'],

            );

            if (!empty($atts['genre'])) {
                $loop_args['tax_query'] = array(array(
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => explode(',', $atts['genre']),
                ));
            }

            $loop = new WP_Query($loop_args);

            $grid_column = rbr_get_column_class($atts['column']);

            // $template_loader = rbr_get_template_loader();

            // Step 1: Register a placeholder stylesheet
            // Step 2: Build up a css
            $this->add_css_books_list($atts);

            ob_start();
            ?>


<div class="cpt-shortcodes cpt-cards <?php echo sanitize_html_class($grid_column); ?>" id="cpt-main-sec">
            <?php

            while ($loop->have_posts()):
                $loop->the_post();

                // $template_loader->get_template_part('archive/content', 'book');

                include ROCKET_BOOKS_BASE_DIR . 'templates/archive/content-book.php';
                // End the loop.
            endwhile;
            // restore original post
            wp_reset_postdata();
            ?>

</div>

            <?php
return ob_get_clean();
        }

        /**
         * Add css for books_list shortcode
         **/

        public function add_css_books_list($atts)
        {
            $css = '';
            if (!empty($atts['bgcolor'])) {
                $css .= ".cpt-shortcodes.cpt-cards .cpt-card{background-color:{$atts['bgcolor']}}";
            }
            $this->shortcode_css = $this->shortcode_css . $css;
        }

        /**
         * Enqueue Styles and scripts only if required
         **/

        public function maybe_enqueue_scripts()
        {
            if (!empty($this->shortcode_css)) {

                // Step 3: Add css to placeholder style
                wp_add_inline_style(
                    $this->plugin_name . '-shortcodes',
                    $this->shortcode_css
                );

                // Step 4: Enqueue Style
                wp_enqueue_style(
                    $this->plugin_name . '-shortcodes',
                );

            }
        }

    }

}
