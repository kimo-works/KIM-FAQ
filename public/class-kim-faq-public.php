<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/kimo-works/kim-faq/
 * @since      1.0.0
 *
 * @package    kim_faq
 * @subpackage kim_faq/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    kim_faq
 * @subpackage kim_faq/public
 * @author     Karim Siam <kimoforworks@gmail.com>
 */
class kim_faq_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $kim_faq    The ID of this plugin.
	 */
	private $kim_faq;

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
	 * @param      string    $kim_faq       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $kim_faq, $version ) {

		$this->kim_faq = $kim_faq;
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
		 * defined in kim_faq_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The kim_faq_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->kim_faq, plugin_dir_url( __FILE__ ) . 'css/kim-faq-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in kim_faq_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The kim_faq_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->kim_faq, plugin_dir_url( __FILE__ ) . 'js/kim-faq-public.js', array( 'jquery' ), $this->version, false );

	}

}
