<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.whoi.edu
 * @since             1.0.0
 * @package           Whoi_Directory_Search
 *
 * @wordpress-plugin
 * Plugin Name:       WHOI Directory Search
 * Plugin URI:        https://www.whoi.edu
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ethan Andrews
 * Author URI:        https://www.whoi.edu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whoi-directory-search
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WHOI_DIRECTORY_SEARCH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-whoi-directory-search-activator.php
 */
function activate_whoi_directory_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whoi-directory-search-activator.php';
	Whoi_Directory_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-whoi-directory-search-deactivator.php
 */
function deactivate_whoi_directory_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whoi-directory-search-deactivator.php';
	Whoi_Directory_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_whoi_directory_search' );
register_deactivation_hook( __FILE__, 'deactivate_whoi_directory_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-whoi-directory-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_whoi_directory_search() {

	$plugin = new Whoi_Directory_Search();
	$plugin->run();

}
run_whoi_directory_search();
