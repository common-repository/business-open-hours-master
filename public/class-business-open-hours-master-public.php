<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://icanwp.com/plugins/business-open-hours-master/
 * @since      1.0.0
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/public
 * @author     iCanWP Team, Sean Roh, Chris Couweleers
 */
class Business_Open_Hours_Master_Public {

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
	 * @param      string    $Business_Open_Hours_Master       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name . '-bohm-public-css', plugin_dir_url( __FILE__ ) . 'css/business-open-hours-master-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name . '-bohm-public-js', plugin_dir_url( __FILE__ ) . 'js/business-open-hours-master-public.js', array( 'jquery' ), $this->version, false );

	}
	public function bohm_register_shortcode(){
		add_shortcode( 'show-business-hours', array( $this, 'bohm_public_display'));
	}
	
	public function bohm_public_display(){
		ob_start();
		require_once('partials/display-bohm-public.php');
		$output = ob_get_contents();
		ob_get_clean();
		return $output;	
	}
	
}
