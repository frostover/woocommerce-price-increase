<?php

namespace CodeableNathanCorbin;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
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
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/includes
 * @author     Nathan Corbin <contact@nathanonline.us>
 */
class Codeable_Nathan_Corbin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Codeable_Nathan_Corbin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

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
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		if ( !defined(CODEABLE_NC_TEXT_DOMAIN) ) {
			define( 'CODEABLE_NC_TEXT_DOMAIN', 'codeable-nc');
		}

		$this->plugin_name = 'codeable-nathan-corbin';

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
	 * - Codeable_Nathan_Corbin_Loader. Orchestrates the hooks of the plugin.
	 * - Codeable_Nathan_Corbin_i18n. Defines internationalization functionality.
	 * - Codeable_Nathan_Corbin_Admin. Defines all hooks for the admin area.
	 * - Codeable_NC_Settings. Loads custom WooCommerce settings.
	 * - Codeable_Nathan_Corbin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-codeable-nathan-corbin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-codeable-nathan-corbin-i18n.php';

		/**
		 * The class establishes the WooCommerce settings
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-codeable-nathan-corbin-wc-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-codeable-nathan-corbin-public.php';

		$this->loader = new Codeable_Nathan_Corbin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Codeable_Nathan_Corbin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Codeable_Nathan_Corbin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$wc_settings = new Admin\Codeable_NC_Settings($this->get_plugin_name());

		// WooCommerce Product Increase tab register
		$this->loader->add_filter('woocommerce_product_data_tabs', $wc_settings, 'product_increase_tab');

		// WooCommerce Product Increase display tab content
		$this->loader->add_filter('woocommerce_product_data_panels', $wc_settings, 'product_increase_content');

		// WooCommerce Product Increase save tab content
		$this->loader->add_filter('woocommerce_process_product_meta', $wc_settings, 'save_product_increase_fields');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pub\Codeable_Nathan_Corbin_Public($this->get_plugin_name());

		// WooCommerce cart total price increase
		$this->loader->add_filter('woocommerce_cart_calculate_fees', $plugin_public, 'calculate_price_increase');
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
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Codeable_Nathan_Corbin_Loader    Orchestrates the hooks of the plugin.
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
