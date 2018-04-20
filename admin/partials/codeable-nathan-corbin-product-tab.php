<?php

namespace CodeableNathanCorbin\Admin\Partials;

/**
 * HTML for the product tab content
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nathanonline.us
 * @since      1.0.0
 *
 * @package    Codeable_Nathan_Corbin
 * @subpackage Codeable_Nathan_Corbin/admin/partials
 */
?>

<div id='price_increase_options' class='panel woocommerce_options_panel'>
	<div class='options_group'><?php

		woocommerce_wp_checkbox( array(
			'id' 		=> 'price_increase',
			'label' 	=> __( 'Activate price increase?' ),
		) );

		$price_increase_amount = get_post_meta($post->ID, 'price_increase_amount', true);

		woocommerce_wp_text_input( array(
			'id'				=> 'price_increase_amount',
			'label'				=> __( 'Cart increase amount (%)', CODEABLE_NC_TEXT_DOMAIN ),
			'desc_tip'			=> 'true',
			'description'		=> __( 'The cart total will be increased by this amount.', CODEABLE_NC_TEXT_DOMAIN ),
			'style'				=> 'width: 60px; text-align: center;',
			'type' 				=> 'number',
			'value'				=> !empty($price_increase_amount) ? $price_increase_amount : '10',
			'custom_attributes'	=> array(
				'min'	=> '1',
				'step'	=> '0.1',
				'max'   => '100',
			),
		) );
	?></div>
</div>