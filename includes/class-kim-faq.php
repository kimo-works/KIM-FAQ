<?php

/**
 * The file that defines the core plugin class
 *
 * @link       https://github.com/kimo-works/kim-faq/
 * @since      1.0.0
 *
 * @package    kim_faq
 * @subpackage kim_faq/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    kim_faq
 * @subpackage kim_faq/includes
 * @author     Karim Siam <kimoforworks@gmail.com>
 */
class kim_faq {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      kim_faq_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $kim_faq    The string used to uniquely identify this plugin.
	 */
	protected $kim_faq;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'KIM_FAQ_VERSION' ) ) {
			$this->version = KIM_FAQ_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->kim_faq = 'kim-faq';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - kim_faq_Loader. Orchestrates the hooks of the plugin.
	 * - kim_faq_i18n. Defines internationalization functionality.
	 * - kim_faq_Admin. Defines all hooks for the admin area.
	 * - kim_faq_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		// /**
		//  * The class responsible for orchestrating the actions and filters of the
		//  * core plugin.
		//  */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kim-faq-loader.php';

		// /**
		//  * The class responsible for defining internationalization functionality
		//  * of the plugin.
		//  */
		 //require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kim-faq-i18n.php';

		// /**
		//  * The class responsible for defining all actions that occur in the admin area.
		//  */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-kim-faq-admin.php';

		// /**
		//  * The class responsible for defining all actions that occur in the public-facing
		//  * side of the site.
		//  */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-kim-faq-public.php';
		// CT 
		//
		// CMB2
		require_once KIM_FAQ_DIR . 'libraries/cmb2/init.php';
		require_once KIM_FAQ_DIR . 'includes/custom-tables.php';

		

	    $this->loader = new kim_faq_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the kim_faq_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		// $plugin_i18n = new kim_faq_i18n();

		// $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		
		$this->loader->add_shortcode( 'kim_faq', 'kim_faq_shortcode' );
		add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
		// add_menu_page('KIM FAQ', 'KIM FAQ', 'manage_options', 'kim-faq', 'kim-faq_admin_page', 'dashicons-location', 10);
	
		// $plugin_admin = new kim_faq_Admin( $this->get_kim_faq(), $this->get_version() );
		// $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		// $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new kim_faq_Public( $this->get_kim_faq(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_kim_faq() {
		return $this->kim_faq;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    kim_faq_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
