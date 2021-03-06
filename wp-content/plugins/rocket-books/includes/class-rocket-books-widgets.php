<?php

// If this file is call directyl, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * Controlling all the widgets for plugin
 *
 * @package Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Widgets')) {
    class Rocket_Books_Widgets
    {

        /**
         * The ID of this plugin.
         *
         * @since 1.0.0
         * @access private
         * @var string $plugin_name This id of this plugin
         */

        private $plugin_name;

        /**
         * The version of this plugin
         *
         * @since 1.0.0
         * @access private
         * @param string $plugin_version The Current version of this plugin
         */

        private $version;

        /**
         * Initialize the class and set its properties
         * @since 1.0.0
         * @param string $plugin_name The name of the plugin.
         * @param string $version The version of this plugin.
         */

        public function __construct($plugin_name, $version)
        {
            $this->plugin_name = $plugin_name;
            $this->version = $version;
            $this->load_dependency();
        }

        /**
         * Load Widget Class Deps
         */

        public function load_dependency()
        {

            require_once ROCKET_BOOKS_BASE_DIR . "vendor/boo-widget-helper/class-boo-widget-helper.php";

        }

        /**
         * Register widgets for the plugin
         */

        public function register_widgets()
        {
            require_once ROCKET_BOOKS_BASE_DIR . 'includes/widgets/class-rocket-book-widgets-books-list.php';
            register_widget('Rocket_Books_Widget_Books_List');

            require_once ROCKET_BOOKS_BASE_DIR . "includes/widgets/class-rocket-book-widgets-featured-book.php";
            register_widget('Rocket_Books_Widget_Featured_Book');
        }

    }
}
