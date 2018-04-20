<?php

namespace CodeableNathanCorbin;

/**
 * Fired during plugin activation
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
 * @author     Nathan Corbin <contact@nathanonline.us>
 */
class Codeable_Nathan_Corbin_Activator {

	/**
	 * Called when the plugin is first activated.
	 *
	 * Check if WooCommerce is installed and activated before allowing this plugin to be activated.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Require WooCommerce
	    if (!is_plugin_active('woocommerce/woocommerce.php')) {
	        // Stop activation and show error
	        wp_die('Sorry, but Codeable Nathan Corbin plugin requires WooCommerce to be installed and active. Please download and activate WooCommerce first.<br><a href="' . admin_url('plugins.php') . '">&laquo; Return to Plugins.</a>');
	    }
	}

}
