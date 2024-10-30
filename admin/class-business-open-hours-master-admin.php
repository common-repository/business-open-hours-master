<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://icanwp.com/plugins/business-open-hours-master/
 * @since      1.0.0
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/admin
 * @author     iCanWP Team, Sean Roh, Chris Couweleers
 */
class Business_Open_Hours_Master_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Business_Open_Hours_Master    The ID of this plugin.
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
	 * @param      string    $Business_Open_Hours_Master       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}
	/**
     * Load the required dependencies for the Admin facing functionality.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
    }
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Business_Open_Hours_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Business_Open_Hours_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-bohm-admin-css', plugin_dir_url( __FILE__ ) . 'css/business-open-hours-master-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-bohm-timepicker-css', plugin_dir_url( __FILE__ ) . 'css/jquery.ui.timepicker.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Business_Open_Hours_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Business_Open_Hours_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( $this->plugin_name . '-bohm-admin-js', plugin_dir_url( __FILE__ ) . 'js/business-open-hours-master-admin.js', array( 'jquery','jquery-ui-sortable' ), $this->version, false );
		$bohm_variables = array(
			'plugin_admin_url' => plugin_dir_url( __FILE__ )
		);
		wp_localize_script( $this->plugin_name . '-bohm-admin-js', 'bohm_admin_localized', $bohm_variables );
		wp_enqueue_script( $this->plugin_name . '-bohm-timepicker-js', plugin_dir_url( __FILE__ ) . 'js/jquery.ui.timepicker.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-bohm-admin-js' );
	}
	
	public function add_admin_menu(){
		add_menu_page(
			'Business Open Hours Master', // The title to be displayed on this menu's corresponding page
			'Business Hours', // The text to be displayed for this actual menu item
			'manage_options', // Which type of users can see this menu
			'bohm_admin_menu', // The unique ID - that is, the slug - for this menu item
			array($this, 'display_bohm_regular_hours_menu'), // The name of the function to call when rendering this menu's page
			plugin_dir_url( __FILE__ ) . 'assets/admin-icon.png', // icon url
			118.811 // position
		);
		add_submenu_page(
			'bohm_admin_menu',
			'Business Open Hours Settings',
			'Settings',
			'manage_options',
			'bohm_settings_menu',
			array($this, 'display_bohm_admin_settings_menu') 
		);
		add_settings_section(
			'bohm_settings_section',
			'Settings',
			array($this, 'callback_bohm_settings_section'),
			'bohm_settings_menu'
		);
		add_settings_field( 
			'bohm_settings_field',
			'Allow shortcode from the "Text" widget',
			array($this, 'callback_allow_shortcode_in_text_widget'),
			'bohm_settings_menu',
			'bohm_settings_section',
			array(
				'Check to allow the use of shortcode in the text widget. <br /><span class="ch_warning"><strong>WARNING:</strong> This will allow the use of any shortcode from the text widget globally.</span>'
			)
		);
	}
	
	public function bohm_init_options(){
		add_option('bohm_regular_hours', array());
		register_setting(
			'bohm_settings_menu',
			'bohm_shortcode_text_widget'
		);
	}
	
	public function display_bohm_regular_hours_menu(){
		require_once('partials/menu-page-bohm-regular-hours.php');
	}
	
	public function display_bohm_admin_settings_menu(){
		require_once('partials/menu-page-bohm-settings.php');
	}
	
	public function callback_bohm_settings_section(){
		return;
	}
	
	public function callback_allow_shortcode_in_text_widget(){
		// Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
		$html = '<input type="checkbox" id="bohm_shortcode_text_widget" name="bohm_shortcode_text_widget" value="1" ' . checked(1, get_option('bohm_shortcode_text_widget'), false) . '/>'; 
		$html .= '<label for="bohm_shortcode_text_widget"> '  . $options[0] . '</label>'; 
		 
		echo $html;
	}
}
