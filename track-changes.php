<?php
/**
 * Plugin Name:       Track Changes
 * Plugin URI:        https://github.com/unscripted/wp-track-changes
 * Description:       Effortlessly identify Site Editor customizations for Git-based workflows.
 * Requires at least: 6.2
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            Culen Whitmore
 * Author URI:        https://cullenwhitmore.com
 * License: GNU       General Public License v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       track-changes
 *
 * This file represents the entry point for the Track Changes plugin where it handles
 * the initial setup like defining constants and including the core plugin class. It's
 * responsible for initiating the plugin's functionality by setting up necessary hooks
 * and loading required files.
 *
 * @package track-changes
 * @since 0.1.0
 */

namespace TrackChanges;

/**
 * Prevents direct access to the PHP file.
 *
 * Checks if the WPINC constant is defined, which is a unique constant set by WordPress
 * during its loading process. If WPINC is not defined, it indicates that the file is being
 * accessed directly outside the WordPress environment, which should not be allowed for
 * security reasons. Therefore, the script execution is halted using `exit`.
 *
 * @since 0.1.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit; // Prevent direct access to the file.
}

/**
 * Current plugin version.
 *
 * Defines the version of the plugin that can be used to manage upgrades, enqueueing
 * scripts, styles, and other assets with cache-busting.
 *
 * @since 0.1.0
 */
define( 'TRACK_CHANGES_VERSION', '0.1.0' );

/**
 * Plugin directory path.
 *
 * Stores the absolute path to the plugin directory for use in including files.
 *
 * @since 0.1.0
 */
define( 'TRACK_CHANGES_PLUGIN_DIR', __DIR__ );

/**
 * Plugin URL.
 *
 * Stores the URL to the plugin directory for use in enqueueing scripts and styles.
 *
 * @since 0.1.0
 */
define( 'TRACK_CHANGES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Plugin base name.
 *
 * Defines the plugin's basename which can be used in WordPress to uniquely identify
 * the plugin, for example, in activation or deactivation hooks.
 *
 * @since 0.1.0
 */
define( 'TRACK_CHANGES_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Includes the core plugin class file.
 *
 * This inclusion is necessary to instantiate the main plugin class and kick off
 * the plugin's functionality.
 *
 * @since 0.1.0
 *
 * @see   class-track-changes.php For the primary functionality of the plugin.
 */
require TRACK_CHANGES_PLUGIN_DIR . '/includes/class-track-changes.php';

/**
 * Kicks off the execution of the plugin.
 *
 * Instantiates the main plugin class and calls its run method. This is the point
 * where the plugin's functionality gets started, hooking into the WordPress lifecycle.
 *
 * @since 0.1.0
 *
 * @uses  Track_Changes::run() Initializes the plugin's main functionality.
 */
Track_Changes::init();
