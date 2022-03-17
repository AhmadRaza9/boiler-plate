<?php

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

}
