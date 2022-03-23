<?php

/**
 * Register Widget : Featured Book
 *
 * @package Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Widget_Featured_Book')) {

    class Rocket_Books_Widget_Featured_Book extends Boo_Widget_Helper
    {

        /**
         * Sets up the widgets name etc
         */
        public function __construct()
        {

            $config_array = array(
                'id' => 'rbr_featured_book',
                'name' => __('Featured Book', 'rocket-books'),
                'desc' => __('Display Your Featured Book', 'rocket-books'),
            );

            $this->set_fields($this->get_fields_args());

            parent::__construct($config_array);
        }

        /**
         * fields arguments array
         */

        public function get_fields_args()
        {

            $fields_args = array(
                array(
                    'id' => 'title',
                    'label' => __('Title', 'rocket-books'),
                ),
                array(
                    'id' => 'text_color',
                    'label' => __('Color', 'rocket-books'),
                    'type' => 'color',
                ),
                array(
                    'id' => 'bgcolor',
                    'label' => __('BackgroundColor', 'rocket-books'),
                    'type' => 'color',
                ),
                array(
                    'id' => 'book_id',
                    'label' => __('Select Your Favorite Book', 'rocket-books'),
                    'type' => 'posts',
                    'options' => array(
                        'post_type' => 'book',
                    ),
                ),

            );

            return $fields_args;

        }

        /**
         * Display Widget after the title
         */

        public function widget_display($args, $instance)
        {

            // echo "<pre>";
            // var_export($instance);
            // echo "</pre>";

            // text color
            $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';

            // bg color
            $bg_color = isset($instance['bgcolor']) ? $instance['bgcolor'] : '';

            // book id
            $book_id = isset($instance['book_id']) ? $instance['book_id'] : '';

            // post id to be shown

            echo do_shortcode("[book_list column=1 limit=1 book_id=$book_id color='$text_color' bgcolor='$bg_color']");

        }

    }
}
