<?php

/**
 * Register Widget : Books List
 *
 * @package Rocket_Books
 * @subpackage Rocket_Books/includes
 * @author Ahmad <raza.ataki@gmail.com>
 */

if (!class_exists('Rocket_Books_Widget_Books_List')) {

    class Rocket_Books_Widget_Books_List extends WP_Widget
    {

        /**
         * Sets up the widgets name etc
         */
        public function __construct()
        {
            $widget_ops = array(
                'classname' => 'rbr_books_list_class',
                'description' => __("Display Roocket Books List", "rocket-books"),
            );
            parent::__construct('rbr_books_list', __("Books List ", "rocket-books"), $widget_ops);
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance)
        {
            // outputs the content of the widget

            // $args array keys
            // array(
            //     0 => 'name',
            //     1 => 'id',
            //     2 => 'description',
            //     3 => 'class',
            //     4 => 'before_widget',
            //     5 => 'after_widget',
            //     6 => 'before_title',
            //     7 => 'after_title',
            //     8 => 'before_sidebar',
            //     9 => 'after_sidebar',
            //     10 => 'show_in_rest',
            //     11 => 'widget_id',
            //     12 => 'widget_name',
            // );

            echo $args['before_widget'];
            echo $args['before_title'];
            // Title will be displayed here
            $title = isset($instance['title']) ? $instance['title'] : '';
            $limit = isset($instance['limit']) ? $instance['limit'] : 5;
            $format = isset($instance['format']) ? $instance['format'] : 5;

            // echo esc_html($title);
            // echo "<br/>";
            // echo esc_html($limit);

            // Loops for CPTs

            $loop_args = array(
                'post_type' => 'book',
                'posts_per_page' => $limit,
            );

            if (!empty($format)) {
                $loop_args['meta_query'] = array(
                    array(
                        'key' => 'rbr_book_format ',
                        'value' => $format,
                        'compare' => '=',
                    ),
                );
            }

            $loop = new WP_Query($loop_args);

            echo "<div class='cpt-cards-widget'>";
            // start the loop
            while ($loop->have_posts()):
                $loop->the_post();
                include ROCKET_BOOKS_BASE_DIR . 'templates/widgets/content-book.php';
            endwhile;
            echo "</div>";

            echo $args['after_title'];
            echo $args['after_widget'];

        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form($instance)
        {
            // outputs the options form on admin

            $title = isset($instance['title']) ? $instance['title'] : '';
            $limit = isset($instance['limit']) ? $instance['limit'] : '';
            $format = isset($instance['format']) ? $instance['format'] : '';

            ?>

            <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'rocket-books');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_html($title); ?>" >
            </p>

            <p>
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php _e('Limit:', 'rocket-books');?></label>
            <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" value="<?php echo esc_html($limit); ?>" >
            </p>

            <?php

            $format_select_options = array(
                '' => __('All', 'rocket-books'),
                'hardcover' => __('Hardcover', 'rocket-books'),
                'audio' => __('Audio', 'rocket-books'),
                'pdf' => __('PDF', 'rocket-books'),
            );

            printf(
                '<p><label for="%s">%s</label>',
                $this->get_field_name('format'),
                __('Format', 'rocket-books')
            );

            printf(
                '<select id="%s" name="%s" class="widefat">',
                $this->get_field_id('format'),
                $this->get_field_name('format')
            );
// output option

            foreach ($format_select_options as $value => $label) {

                printf(
                    '<option value="%s" %s>%s</option>',
                    $value,
                    selected($value, $format),
                    $label
                );
            }

            echo "</select></p>";

        }

        /**
         * Processing widget options on save
         *
         * @param array $new_instance The new options
         * @param array $old_instance The previous options
         *
         * @return array
         */
        public function update($new_instance, $old_instance)
        {
            // processes widget options to be saved
            $sanitized_instance['title'] = sanitize_text_field($new_instance['title']);
            $sanitized_instance['limit'] = absint($new_instance['limit']);
            $sanitized_instance['format'] = sanitize_key($new_instance['format']);

            return $sanitized_instance;
        }
    }
}
