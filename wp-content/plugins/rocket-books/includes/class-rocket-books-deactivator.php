<?php

// If this file is call directyl, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * Fired during plugin deactivation
 *
 * @link        https://ahmadraza.ga
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author     Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Deactivator')) {
    class Rocket_Books_Deactivator
    {

        /**
         * Short Description. (use period)
         *
         * Long Description.
         *
         * @since    1.0.0
         */
        public static function deactivate()
        {

            // un register CPT
            unregister_post_type('book');

            // un regiater Taxonomy
            unregister_taxonomy('genre');

            // flush rewrite rule
            flush_rewrite_rules();
        }

    }
}
