<?php
namespace CodeableNathanCorbin;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://nathanonline.us
 * @since             1.0.0
 * @package           Codeable_Nathan_Corbin
 *
 * @wordpress-plugin
 * Plugin Name:       Codeable Nathan Corbin
 * Plugin URI:        http://nathanonline.us
 * Description:       This WordPress plugin integrates with WooCommerce and allows specific products to trigger a price increase to the cart total.
 * Version:           1.0.0
 * Author:            Nathan Corbin
 * Author URI:        http://nathanonline.us
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       codeable-nc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'CODEABLE_NC_VERSION', '1.0.0' );

/**
 * Plugin text domain
 */
define( 'CODEABLE_NC_TEXT_DOMAIN', 'codeable-nc');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-codeable-nathan-corbin.php';

/**
 * The loader plugin class.
 *
 * This is the loader class for the plugin
 *
 * @since      1.0.0
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin
 * @author     Nathan Corbin <contact@nathanonline.us>
 */
class Codeable_Nathan_Corbin_Plugin {

	private $plugin;

	/**
	 * Construct the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array($this, 'activate_codeable_nathan_corbin'));
		register_deactivation_hook( __FILE__, array($this, 'deactivate_codeable_nathan_corbin' ));

		// Assign the private plugin and begin execution of the plugin.
		$this->plugin = new Codeable_Nathan_Corbin();
		$this->plugin->run();
	}

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-codeable-nathan-corbin-activator.php
	 */
	public function activate_codeable_nathan_corbin() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-codeable-nathan-corbin-activator.php';
		Codeable_Nathan_Corbin_Activator::activate();
	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-codeable-nathan-corbin-deactivator.php
	 */
	public function deactivate_codeable_nathan_corbin() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-codeable-nathan-corbin-deactivator.php';
		Codeable_Nathan_Corbin_Deactivator::deactivate();
	}

}

// Start the plugin
$nathan_corbin_plugin = new Codeable_Nathan_Corbin_Plugin();