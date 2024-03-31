<?php
/**
 * Track_Changes class
 *
 * This file contains the Track_Changes class, which is responsible for initializing
 * the Track Changes plugin by setting up hooks for loading text domains, enqueuing
 * styles, and adding dashboard widgets.
 *
 * @package track-changes
 * @since 0.1.0
 */

namespace TrackChanges;

/**
 * The core class for the Track Changes plugin.
 *
 * Initializes the plugin by setting up hooks for loading text domains,
 * enqueuing styles, and adding dashboard widgets. Acts as the central point
 * for orchestrating the plugin's functionality.
 *
 * @since 0.1.0
 */
class Track_Changes {
	/**
	 * Singleton instance of the TrackChanges class.
	 *
	 * This static property holds the singleton instance of the TrackChanges class.
	 * The singleton pattern ensures that only one instance of the TrackChanges class
	 * is created and accessible throughout the execution of the program.
	 *
	 * This instance can be accessed globally, providing a centralized point of
	 * management for all functionality provided by the TrackChanges class.
	 *
	 * @since 0.1.0
	 *
	 * @access private
	 * @var Track_Changes|null Holds the singleton instance of the TrackChanges class if initialized, otherwise `null`.
	 */
	private static $instance = null;

	/**
	 * Initializes and retrieves the singleton instance of the TrackChanges class.
	 *
	 * This method implements the singleton pattern. It checks if the `$instance`
	 * static property is `null`, indicating that the TrackChanges class has not yet
	 * been instantiated. If not instantiated, it creates a new instance of the
	 * TrackChanges class, stores it in the `$instance` property, and calls the `run`
	 * method to initialize the plugin's core functionality. If the TrackChanges class
	 * has already been instantiated, it simply returns the existing instance.
	 *
	 * @since 0.1.0
	 * @return Track_Changes The singleton instance of the TrackChanges class.
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->run();
		}

		return self::$instance;
	}

	/**
	 * Constructs the TrackChanges object.
	 *
	 * Initializes the plugin by setting up the necessary actions for internationalization,
	 * CSS style enqueuing for the admin dashboard, and dashboard widget initialization.
	 * This method orchestrates the foundational setup of the plugin by delegating specific
	 * tasks to helper methods for clarity and maintainability.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->load_textdomain();
		$this->register_hooks();
	}

	/**
	 * Loads the plugin's required dependencies.
	 *
	 * This method is responsible for including the PHP files that define the main components
	 * of the plugin, such as dashboard widgets and query handlers.
	 *
	 * @since 0.1.0
	 */
	public function load_dependencies() {
		require_once TRACK_CHANGES_PLUGIN_DIR . '/includes/class-track-changes-dashboard-widget.php';
		require_once TRACK_CHANGES_PLUGIN_DIR . '/includes/class-track-changes-get-customizations-query.php';
	}

	/**
	 * Loads the plugin's text domain for internationalization.
	 *
	 * Utilizes the `load_plugin_textdomain()` function to make the plugin
	 * translation-ready by loading the appropriate .mo files based on the
	 * site's current language setting.
	 *
	 * @since 0.1.0
	 *
	 * @see load_plugin_textdomain() For the function used to load the text domain.
	 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
	 *       Documentation for load_plugin_textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'track-changes', false, TRACK_CHANGES_BASENAME . '/languages' );
	}

	/**
	 * Registers core hooks for the plugin.
	 *
	 * This method is responsible for setting up hooks directly related to the plugin's
	 * main functionality. It includes actions and filters that are essential for the
	 * plugin's operation.
	 *
	 * Note that hooks specific to certain features or components are registered within
	 * their respective classes or files to maintain modularity and separation of concerns.
	 *
	 * @since 0.1.0
	 *
	 * @see add_action() To register actions with WordPress's hook system for core plugin functionality.
	 * @link https://developer.wordpress.org/reference/functions/add_action/
	 *       Documentation for the add_action function.
	 *
	 * @see admin_enqueue_scripts() For enqueueing CSS styles in the admin pages.
	 * @link https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *       Documentation for admin_enqueue_scripts.
	 */
	private function register_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		$dashboard_widget = new Track_Changes_Dashboard_Widget();
		add_action( 'wp_dashboard_setup', array( $dashboard_widget, 'add_dashboard_widget' ) );
	}

	/**
	 * Enqueues the CSS styles required by the plugin.
	 *
	 * Registers and enqueues CSS files that are needed for styling the plugin's
	 * dashboard widget and any other admin-facing elements. Ensures that styles
	 * are only loaded within the admin dashboard to not affect the site's frontend.
	 *
	 * @since 0.1.0
	 *
	 * @param string $hook_suffix The current admin page.
	 *
	 * @see admin_enqueue_scripts() For the hook used to enqueue styles in the admin pages.
	 * @link https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *       Documentation for the admin_enqueue_scripts hook and $hook_suffix parameter.
	 *
	 * @see wp_enqueue_style() For the function used to enqueue styles.
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *       Documentation for the wp_enqueue_style function.
	 */
	public function enqueue_styles( $hook_suffix ) {
		// Check if the current page is the Dashboard.
		if ( 'index.php' === $hook_suffix ) {
			wp_enqueue_style( 'track-changes-css', TRACK_CHANGES_PLUGIN_URL . 'assets/track-changes.css', array(), TRACK_CHANGES_VERSION );
		}
	}

	/**
	 * Kicks off the plugin by registering hooks and loading components.
	 *
	 * This method is responsible for initializing the plugin's core functionality
	 * by hooking into WordPress to register dashboard widgets and set up other
	 * necessary components. It should be called immediately after the plugin class
	 * is instantiated.
	 *
	 * @since 0.1.0
	 *
	 * @see add_action() To register the dashboard widget setup action.
	 * @link https://developer.wordpress.org/reference/functions/add_action/
	 *       Documentation for the add_action function.
	 *
	 * @see wp_dashboard_setup For the action hook used to add dashboard widgets.
	 * @link https://developer.wordpress.org/reference/hooks/wp_dashboard_setup/
	 *       Documentation for the wp_dashboard_setup hook.
	 *
	 * @see add_dashboard_widgets() For the method that registers the dashboard widget.
	 */
	public function run() {
		$this->load_dependencies();
		$this->load_textdomain();
		$this->register_hooks();
	}
}
