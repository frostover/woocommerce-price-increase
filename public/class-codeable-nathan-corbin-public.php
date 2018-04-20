<?php

namespace CodeableNathanCorbin\Pub;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/public
 * @author     Nathan Corbin <contact@nathanonline.us>
 */
class Codeable_Nathan_Corbin_Public {

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
	 * Calculates the price increase for the cart if there are 
	 * any items that have been set to activate.
	 *
	 * @since    1.0.0
	 * @param      string    $cart       The WooCommerce cart object.
	 */
	function calculate_price_increase( $cart ) {

		// Check if we need to apply the price increase
		$increase = 0;
		foreach ($cart->cart_contents as $key => $item) {
			$meta = get_post_meta($item['product_id'], 'price_increase', true);
			if(isset($meta) && ($meta == 'yes' || $meta == '1')) {

				//Normalize the amount
				$amount = get_post_meta($item['product_id'], 'price_increase_amount', true);
				$amount = (!isset($amount)) ? 10 : abs($amount);
				$amount = ($amount > 100) ? 100 : $amount;
				$amount = ($amount < 0)   ? 10  : $amount;

				//Apply the highest amount increase only
				if($amount > $increase) {
					$increase = $amount;
				}
			}
		}

		//Apply the price increase
		if($increase > 0) {
			$amount = $cart->subtotal * ($increase / 100);
			$cart->add_fee( __( 'Upcharge ( '.$increase.'% )', CODEABLE_NC_TEXT_DOMAIN ) , $amount );
		}

	}
}