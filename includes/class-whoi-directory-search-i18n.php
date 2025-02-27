<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.whoi.edu
 * @since      1.0.0
 *
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/includes
 * @author     Ethan Andrews <eandrews@whoi.edu>
 */
class Whoi_Directory_Search_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'whoi-directory-search',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
