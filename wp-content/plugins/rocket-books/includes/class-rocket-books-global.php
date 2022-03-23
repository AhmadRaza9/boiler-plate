<?php

// If this file is call directyl, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * Global share class for the plugin
 * @package Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Global')) {
    class Rocket_Books_Global
    {

        protected static $template_loader;

        public static function template_loader()
        {
            if (empty(self::$template_loader)) {
                self::set_template_loader();
            }

            return self::$template_loader;
        }

        public static function set_template_loader()
        {
            require_once ROCKET_BOOKS_BASE_DIR . 'public/class-rocket-books-template-loader.php';
            self::$template_loader = new Rocket_Books_Template_Loader();
        }

    }
}
