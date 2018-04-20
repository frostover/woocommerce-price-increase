<?php

namespace CodeableNathanCorbin;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
 * @author     Nathan Corbin <contact@nathanonline.us>
 */
class Codeable_Nathan_Corbin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			CODEABLE_NC_TEXT_DOMAIN,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);

	}



}
