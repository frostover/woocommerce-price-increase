<?php

namespace CodeableNathanCorbin\Admin;

/**
 * The WooCommerce admin-specific functionality of the plugin.
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/admin
 * @author     Nathan Corbin <contact@nathanonline.us>
 */

class Codeable_NC_Settings {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name ) {

		$this->plugin_name = $plugin_name;
		
	}

	/**
	 * Initialize the custom product setting tab
	 *
	 * @since      1.0.0
	 * @param      array     $tabs The array of product tabs.
	 * @return     array     $tabs The modified array of product tabs.
	 */
	function product_increase_tab($tabs) {
		$tabs['price_increase'] = array(
			'label'		=> __('Price Increase', CODEABLE_NC_TEXT_DOMAIN),
			'target'	=> 'price_increase_options',
			'class'		=> array('show_if_simple', 'show_if_variable', 'show_if_downloadable', 'show_if_grouped', 'show_if_external'),
		);

		return $tabs;
	}

	/**
	 * The HTML content for the product increase tab
	 *
	 * @since      1.0.0
	 */
	function product_increase_content() {
		global $post;	

		include plugin_dir_path(dirname( __FILE__ )) . 'admin/partials/codeable-nathan-corbin-product-tab.php';
	}

	/**
	 * Called when the product increase content is saved
	 *
	 * @since      1.0.0
	 * @param      int     $post_id The post id (product id).
	 */
	function save_product_increase_fields( $post_id ) {
		
		// Save the price increase activate checkbox
		$price_increase = isset($_POST['price_increase']) ? 'yes' : 'no';
		update_post_meta($post_id, 'price_increase', $price_increase);
		
		// Save the price increase amount
		if (isset($_POST['price_increase_amount'])) {
			$amount = abs($_POST['price_increase_amount']);

			// Check if greater than 100 or less than 0
			$amount = ($amount > 100) ? 100 : $amount;
			$amount = ($amount < 0)  ? 10  : $amount;

			update_post_meta($post_id, 'price_increase_amount', $amount);
		} else {
			update_post_meta($post_id, 'price_increase_amount', 10);
		}
	}
}