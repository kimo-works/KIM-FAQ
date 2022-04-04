<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/kimo-works/kim-faq/
 * @since      1.0.0
 *
 * @package    kim_faq
 * @subpackage kim_faq/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    kim_faq
 * @subpackage kim_faq/includes
 * @author     Karim Siam <kimoforworks@gmail.com>
 */
class kim_faq_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		create_kim_question_answer();
	 
	}

}
