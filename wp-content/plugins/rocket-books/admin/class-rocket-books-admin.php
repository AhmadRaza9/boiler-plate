<?php

// If this file is call directyl, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link        https://ahmadraza.ga
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/admin
 * @author     Ahmad <raza.ataki@gmail.com>
 */
if (!class_exists('Rocket_Books_Admin')) {
    class Rocket_Books_Admin
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
         * @param      string    $plugin_name       The name of this plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct($plugin_name, $version)
        {

            $this->plugin_name = $plugin_name;
            $this->version = $version;

        }

        /**
         * Register the stylesheets for the admin area.
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

            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rocket-books-admin.css', array(), $this->version, 'all');

        }

        /**
         * Register the JavaScript for the admin area.
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

            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rocket-books-admin.js', array('jquery'), $this->version, false);

        }

        /**
         * Add admin menu for our plugin
         */

        public function add_admin_menu()
        {

            // Top Level Menu

            // add_menu_page(
            //     'Rocket Books Settings', // page_title
            //     'Rocket Books', // menu_title
            //     'manage_options', // capability
            //     'rocket-books', // menu_slug
            //     array($this, 'admin_page_display'), // function
            //     'dashicons-book-alt', // icon_url
            //     60, // position
            // );

            // Sub Menu
            // add_plugins_page(
            //     'Rocket Books Settings', // page_title
            //     'Rocket Books', // menu_title
            //     'manage_options', // capability
            //     'rocket-books', // menu_slug
            //     array($this, 'admin_page_display'), // function
            // );

            add_submenu_page(
                'edit.php?post_type=book', // parent_slug
                'Rocket Books Settings Page', // page_title
                'Rocket Books', // menu_title
                'manage_options', // capability
                'rocket-books', // menu_slug
                array($this, 'admin_page_display'), // function
            );

        }

        /**
         * Admin Page Display
         */

        public function admin_page_display()
        {
            // Old method of saving options
            // include "partials/rocket-books-admin-display-form-method.php";

            include "partials/rocket-books-admin-display.php";

        }
        /**
         * All the hooks for admin_init
         */

        public function admin_init()
        {
            // 1.) Add Settings Section
            $this->add_settings_section();

            // 2.) Add Settings Fields
            $this->add_settings_fields();

            // 3.) Save Settings
            $this->save_fields();
        }

        /**
         * Add Settings Sections for plugin options
         */

        public function add_settings_section()
        {
            // General Section
            add_settings_section(
                'rbr-general-section', // id
                'General Settings', // title
                function () {echo "<p>These are general settings for rocket books</p>";}, // cb-fun
                'rbr-settings-page' // page
            );

            // Advanced Section
            add_settings_section(
                'rbr-advanced-section', // id
                'Advanced Settings', // title
                function () {echo "<p>These are advanced settings for rocket books</p>";}, // cb-fun
                'rbr-settings-page' // page
            );

        }

        /**
         * Add Settings fields for setting section
         */
        public function add_settings_fields()
        {
            add_settings_field(
                'rbr_test_field', // id
                'Test Field', // title
                array($this, 'markup_text_fields_cb'), // args array()
                'rbr-settings-page', // page
                'rbr-general-section', // section
                array(
                    'name' => 'rbr_test_field',
                    'value' => get_option('rbr_test_field'),
                )
            );

            add_settings_field(
                'rbr_checkbox_field', // id
                'CheckBox', // title
                array($this, 'markup_check_box_cb'), // args array()
                'rbr-settings-page', // page
                'rbr-general-section', // section
                array(
                    'name' => 'rbr_checkbox_field',
                    'value' => get_option('rbr_checkbox_field'),
                )
            );

            add_settings_field(
                'rbr_archive_column', // id
                'Archive Column', // title
                array($this, 'markup_select_fields_cb'), // args array()
                'rbr-settings-page', // page
                'rbr-general-section', // section
                array(
                    'name' => 'rbr_archive_column',
                    'value' => get_option('rbr_archive_column'),
                    'options' => array(
                        'column-two' => __('Two Columns', 'rocket-books'),
                        'column-three' => __('Three Columns', 'rocket-books'),
                        'column-four' => __('Four Columns', 'rocket-books'),
                        'column-five' => __('Five Columns', 'rocket-books'),
                    ),
                )
            );

            add_settings_field(
                'rbr_advanced_field1', // id
                'Advance Field 1', // title
                array($this, 'markup_text_fields_cb'), // cb-fun
                'rbr-settings-page', // page
                'rbr-advanced-section', // section
                array(
                    'name' => 'rbr_advanced_field1',
                    'value' => get_option('rbr_advanced_field1'),
                ) // args array()
            );

            add_settings_field(
                'rbr_advanced_field2', // id
                'Advance Field 2', // title
                array($this, 'markup_text_fields_cb'), // cb-fun
                'rbr-settings-page', // page
                'rbr-advanced-section', // section
                array(
                    'name' => 'rbr_advanced_field2',
                    'value' => get_option('rbr_advanced_field2'),
                ) // args array()
            );

            add_settings_field(
                'rbr_text_area', // id
                'Some Message', // title
                array($this, 'markup_text_area_cb'), // cb-fun
                'rbr-settings-page', // page
                'rbr-advanced-section', // section
                array(
                    'name' => 'rbr_text_area',
                    'value' => get_option('rbr_text_area'),
                ) // args array()
            );

        }

        /**
         * Save Settings fields
         */
        public function save_fields()
        {
            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_test_field', // option_name required
                array('sanitize_callback' => 'sanitize_text_field')
            );
            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_advanced_field1', // option_name required
                array('sanitize_callback' => 'sanitize_text_field')
            );
            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_advanced_field2', // option_name required
                array('sanitize_callback' => 'sanitize_text_field')
            );
            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_archive_column' // option_name required
            );

            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_checkbox_field' // option_name required
            );

            register_setting(
                'rbr-settings-page-options-group', // option_group required
                'rbr_text_area', // option_name required
                array('sanitize_callback' => 'sanitize_textarea_field')
            );

        }

        /**
         * Markup for Text fields
         */

        public function markup_text_fields_cb($args)
        {
            if (!is_array($args)) {
                return null;
            }

            $name = (isset($args['name'])) ? esc_html($args['name']) : '';
            $value = (isset($args['value'])) ? esc_html($args['value']) : '';

            ?>

    <input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="field-<?php echo $name; ?>">

        <?php

        }

        /**
         * Markup for Select field
         **/

        public function markup_select_fields_cb($args)
        {
            if (!is_array($args)) {
                return null;
            }

            $name = (isset($args['name'])) ? esc_html($args['name']) : '';
            $value = (isset($args['value'])) ? esc_html($args['value']) : '';
            $options = (isset($args['options']) && is_array($args['options'])) ? $args['options'] : array();

            ?>

        <select name="<?php echo $name; ?>" class="field-<?php echo $name; ?>">
            <?php
foreach ($options as $option_key => $option_label):
                echo "<option value='{$option_key}'" . selected($option_key, $value) . ">$option_label</option>";
            endforeach;
            ?>
        </select>
        <small>Default Layout is Three column.</small>

        <?php

        }

        /**
         * Markup for check box
         */

        public function markup_check_box_cb($args)
        {
            if (!is_array($args)) {
                return null;
            }

            $name = (isset($args['name'])) ? esc_html($args['name']) : '';

            ?>

    <input type="checkbox" name="<?php echo $name; ?>" value="yes" class="field-<?php echo $name; ?>" <?php checked(get_option('rbr_checkbox_field'), 'yes');?>>

        <?php

        }

        /**
         * Markup for Textarea
         */
        public function markup_text_area_cb($args)
        {
            if (!is_array($args)) {
                return null;
            }

            $name = (isset($args['name'])) ? esc_html($args['name']) : '';
            $value = (isset($args['value'])) ? esc_html($args['value']) : '';
            ?>
    <textarea name="<?php echo $name; ?>" id="textarea-<?php echo $name; ?>" cols="50" rows="5"><?php echo $value; ?></textarea>
        <?php
}

        /**
         * Add plugin action links
         */

        public function add_plugin_action_links($links)
        {
            $mylinks = array(
                "<a href='" . admin_url('edit.php?post_type=book&page=rocket-books') . "'>Settings</a>",
            );
            return array_merge($links, $mylinks);
        }

        /**
         * To add Plugin Menu and Settings Page
         */

        public function plugin_menu_settings_using_helper()
        {

            require_once ROCKET_BOOKS_BASE_DIR . 'vendor/boo-settings-helper/class-boo-settings-helper.php';

            $rocket_books_settings = array(
                'tabs' => true,
                'prefix' => 'rbr_',
                'menu' => array(

                    'slug' => 'rocket-books',
                    'page_title' => __('Rocket Books Settings', 'rocket-books'),
                    'menu_title' => __('Rocket Books', 'rocket-books'),
                    'parent' => 'edit.php?post_type=book',
                    'submenu' => true,
                ),
                'sections' => array(
                    // General Seciton
                    array(
                        'id' => 'rbr_general_section',
                        'title' => __('General Section', 'rocket-books'),
                        'desc' => __('These are general settings', 'rocket-books'),
                    ),

                    // Advance Seciton
                    array(
                        'id' => 'rbr_advance_section',
                        'title' => __('Advance Section', 'rocket-books'),
                        'desc' => __('These are advnace settings', 'rocket-books'),
                    ),
                ),
                'fields' => array(
                    // fields for General Section
                    'rbr_general_section' => array(
                        array(
                            'id' => 'test_field',
                            'label' => __('Test Field', 'rocket-books'),
                        ),
                        array(
                            'id' => 'archive_column',
                            'label' => __('Archive Column', 'rocket-books'),
                            'type' => 'select',
                            'options' => array(
                                'column-two' => __('Two Columns', 'rocket-books'),
                                'column-three' => __('Three Columns', 'rocket-books'),
                                'column-four' => __('Four Columns', 'rocket-books'),
                                'column-five' => __('Five Columns', 'rocket-books'),
                            ),
                        ),
                        array(
                            'id' => 'abs_int',
                            'label' => __('Abs Int', 'rocket-books'),
                            'type' => 'text',
                            'placeholder' => 'admin',
                        ),
                        array(
                            'id' => 'tested_field1',
                            'label' => __('Test Field 1', 'rocket-books'),
                            'type' => 'color',
                        ),
                        array(
                            'id' => 'number_input',
                            'label' => __('Number Input', 'rocket-books'),
                            'type' => 'number',
                            'placeholder' => '1.99',
                        ),
                        array(
                            'id' => 'textarea_input',
                            'label' => __('Textarea Input', 'rocket-books'),
                            'type' => 'textarea',
                            'placeholder' => 'Textarea placeholder',
                        ),
                        array(
                            'id' => 'checkbox_input',
                            'label' => __('CheckBox', 'rocket-books'),
                            'type' => 'checkbox',
                        ),
                        array(
                            'id' => 'multicheck_button_input',
                            'label' => __('Radio Button', 'rocket-books'),
                            'type' => 'multicheck',
                            'options' => array(
                                'multi_1' => 'Multi 1',
                                'multi_2' => 'Multi 2',
                                'multi_3' => 'Multi 3',
                            ),
                            'default' => array(
                                'multi_1' => 'multi_1',
                                'multi_3' => 'multi_3',
                            ),
                        ),
                        array(
                            'id' => 'radio_button_input',
                            'label' => __('Radio Button', 'rocket-books'),
                            'type' => 'radio',
                            'options' => array(
                                'Radio 1' => 'Radio 1',
                                'Radio 2' => 'Radio 2',
                                'Radio 3' => 'Radio 3',
                            ),
                            'desc' => 'A radio Button',
                        ),
                        array(
                            'id' => 'drop_down',
                            'label' => __('A Dropdown', 'rocket-books'),
                            'type' => 'select',
                            'options' => array(
                                'option 1' => __('option 1', 'rocket-books'),
                                'option 2' => __('option 2', 'rocket-books'),
                                'option 3' => __('option 3', 'rocket-books'),
                                'option 4' => __('option 4', 'rocket-books'),
                            ),
                        ),
                        array(
                            'id' => 'password',
                            'label' => __('Password', 'rocket-books'),
                            'type' => 'password',

                        ),
                        array(
                            'id' => 'pages_field_id',
                            'label' => __('Pages Field Type', 'rocket-books'),
                            'desc' => __('List of Pages', 'rocket-books'),
                            'type' => 'pages',
                            'options' => array(
                                'post_type' => 'post',
                            ),
                        ),
                        array(
                            'id' => 'posts_field_id',
                            'label' => __('Posts Field Type', 'rocket-books'),
//                        'desc'    => __( 'List of Posts', 'plugin-name' ),
                            'type' => 'posts',
                            'options' => array(
                                'post_type' => 'post',
                            ),
                        ),
                        array(
                            'id' => 'file_field_id',
                            'label' => __('File', 'rocket-books'),
                            'desc' => __('File description', 'rocket-books'),
                            'type' => 'file',
                            'default' => '',
                            'placeholder' => __('Textarea placeholder', 'rocket-books'),
                            'options' => array( //                    'btn' => 'Get it'
                            ),
                        ),
                        array(
                            'id' => 'media_field_id',
                            'label' => __('Media', 'rocket-books'),
                            'type' => 'media',
                            'options' => array(
                                'btn' => __('Get the image', 'rocket-books'),
                                'width' => 150,
                                'max_width' => 150,
                            ),
                        ),
                    ),

                    // fields for Advance Section
                    'rbr_advance_section' => array(
                        array(
                            'id' => 'advance',
                            'label' => __('Advanced', 'rocket-books'),
                        ),
                    ),
                ),

                'links' => array(
                    'plugin_basename' => plugin_basename(ROCKET_BOOKS_BASE_FILE),
                    'action_links' => true,
                ),
            );

            new Boo_Settings_Helper($rocket_books_settings);

        }

    }
}