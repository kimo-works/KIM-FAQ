<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://github.com/kimo-works
 * @since             1.0.0
 * @package           kim_faq
 *
 * @wordpress-plugin
 * Plugin Name:       KIM FAQ 
 * Plugin URI:        https://github.com/kimo-works/kim-faq/
 * Description:       Accordion And Collapse is the most easiest drag & drop accordion builder for WordPress. You can add multiple accordion and collapse with this.
 * Version:           1.0.0
 * Author:            Karim Siam
 * Author URI:        https://github.com/kimo-works/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kim-faq
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'KIM_FAQ_DIR', plugin_dir_path( __FILE__ ) );
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KIM_FAQ_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kim-faq-activator.php
 */
function activate_kim_faq() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kim-faq-activator.php';
	kim_faq_Activator::activate();
}
	// Custom Tables
	
    //

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kim-faq-deactivator.php
 */
function deactivate_kim_faq() {
	//require_once plugin_dir_path( __FILE__ ) . 'includes/class-kim-faq-deactivator.php';
	//kim_faq_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kim_faq' );
//register_deactivation_hook( __FILE__, 'deactivate_kim_faq' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kim-faq.php';
require_once KIM_FAQ_DIR . 'libraries/ct/init.php';
require_once KIM_FAQ_DIR . 'includes/functions.php';
/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page() {
	// $hook =  add_menu_page('KIM FAQ', 'KIM FAQ', 'manage_options', 'kim-faq', '__return_true', 'dashicons-clipboard', 10);
   add_menu_page('KIM FAQ Settings', 'KIM FAQ', 'manage_options', 'kim-faq', 'kim_faq_admin_page', 'dashicons-clipboard', 10);
	// if ($hook) {
	// 	add_action( "load-$hook", 'kim_faq_admin_page' );
	// }
}
/**
 * Register page admin  kim-faq_admin_page
 * of the plugin.
 *
 * @since    1.0.0
 * @access   private
 */
function kim_faq_admin_page() { ?>
<div id="welcome-panel" class="welcome-panel">
		<input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce" value="73a4eaf20e">
			<div class="welcome-panel-content">
	<div class="welcome-panel-header">
		<h2>Welcome to KIM FAQ!</h2>
		<p>
			<a href="https://github.com/kimo-works/KIM-FAQ">
			Learn more about the 0.1 version.
			</a>
		</p>
	</div>
	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-pages"></div>
			<div class="welcome-panel-column-content">
				<h3>Adding a FAQ Manager in WordPress</h3>
				<p>You will need to visit KIM FAQ » Add New FAQs to add your first frequently asked question. The FAQ editor looks very much like post editor.</p>
		
			</div>
		</div>
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-layout"></div>
			<div class="welcome-panel-column-content">
				<h3>Changing The Appearance of FAQs</h3>
				<p>This plugin uses a built-in stylesheet to control the appearance of FAQs in toggle style. It also provides an easy user interface to change colors of your FAQs.</p>
				
			</div>
		</div>
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-styles"></div>
			<div class="welcome-panel-column-content">
				<h3>Display FAQs in Toggle or Accordian</h3>
				<p>You can easily display FAQs using the shortcode in a new page titled frequently asked questions, or you can add it to any WordPress post or page. KIM FAQ plugin comes with multiple display options.</p>
			</div>
		</div>
	</div>
	</div>
		</div>
<style>
	.welcome-panel::before {
		background: unset;
	}
</style>
<?php }
function create_kim_question_answer() {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	// Question & Answer
	//* Create the kim_question_answer table
	$table_name = $wpdb->prefix . 'kim_question_answer';
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id INTEGER(20) NOT NULL auto_increment,
		shortcode_id INTEGER(20) NOT NULL,
		question varchar(7000) NOT NULL, 
		answer text NOT NULL, 
		PRIMARY KEY (id)
	) $charset_collate;";

	dbDelta( $sql );
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kim_faq() {
	$plugin = new kim_faq();
	$plugin->run();
	

}
run_kim_faq();
