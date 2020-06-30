<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       tornmarketing.com.au
 * @since      1.0.0
 *
 * @package    Tm_Newsletter
 * @subpackage Tm_Newsletter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tm_Newsletter
 * @subpackage Tm_Newsletter/includes
 * @author     Torn Marketing <info@tornmarketing.com.au>
 */
class Tm_Newsletter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tm-newsletter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
