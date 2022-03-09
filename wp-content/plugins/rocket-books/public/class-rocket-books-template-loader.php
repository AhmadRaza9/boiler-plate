<?php

if (!class_exists('Rocket_Books_Template_Loader')) {
    if (!class_exists('Gamajo_Template_Loader')) {
        require_once ROCKET_BOOKS_BASE_DIR . 'vendor/class-gamajo-template-loader.php';
    }

    class Rocket_Books_Template_Loader extends Gamajo_Template_Loader
    {

        /** Prefix for filter names... */
        protected $filter_prefix = 'rocket_books';

        /** Direcotry name where custom templates for this plugin should be found in the theme... */
        protected $theme_template_directory = 'rocket-books';

        /** Reference to the root directory path of this plugin */

        protected $plugin_directory = ROCKET_BOOKS_BASE_DIR;

        /** Directory name where templates are found in this plugin... */

        protected $plugin_template_directory = 'templates';

    }
}
