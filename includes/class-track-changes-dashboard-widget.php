<?php
/**
 * Track_Changes_Dashboard_Widget class
 *
 * This file contains the Track_Changes_Dashboard_Widget class, which is responsible
 * for managing the dashboard widget functionality in the Track Changes plugin.
 *
 * @package track-changes
 * @since 0.1.0
 */

namespace TrackChanges;

/**
 * The dashboard widget for displaying site editor customizations.
 *
 * Manages the dashboard widget functionality, providing an interface for site
 * administrators to view and interact with plugin features.
 *
 * @since 0.1.0
 */
class Track_Changes_Dashboard_Widget {
	/**
	 * Register the dashboard widget.
	 *
	 * This method adds a widget to the WordPress dashboard that displays the latest
	 * updates made to templates, template parts, and theme.json files within the Site
	 * Editor, helping users quickly identify recent customizations.
	 *
	 * @since 0.1.0
	 *
	 * @see 'wp_add_dashboard_widget()' For the function used to register the dashboard widget.
	 * @link https://developer.wordpress.org/reference/functions/wp_add_dashboard_widget/
	 *       Documentation for wp_add_dashboard_widget.
	 */
	public function add_dashboard_widget() {
		wp_add_dashboard_widget(
			'tc_widget',                  // Widget slug.
			'Site Editor Customizations', // Title.
			array( $this, 'display_widget' )   // Display function.
		);
	}

	/**
	 * Displays the content of the dashboard widget.
	 *
	 * This function queries the posts and displays the results in a table format
	 * within the dashboard widget. It showcases the latest updates made to templates,
	 * template parts, and theme.json files within the Site Editor, allowing users to
	 * quickly see recent changes.
	 *
	 * @since 0.1.0
	 *
	 * @see 'Track_Changes_Get_Customizations_Query::get_latest_customizations()' For retrieving the latest customizations.
	 */
	public function display_widget() {
		if ( class_exists( 'TrackChanges\Track_Changes_Get_Customizations_Query' ) ) {
			$query          = new Track_Changes_Get_Customizations_Query();
			$customizations = $query->get_latest_customizations();

			if ( empty( $customizations ) ) {
				echo '<p>' . esc_html__( 'Your theme is up to date.', 'track-changes' ) . '</p>';
				return;
			}

			echo '<table class="dataviews-view-table">';
			echo '<thead><tr>';
			echo '<th scope="col">' . esc_html__( 'Type', 'track-changes' ) . '</th>';
			echo '<th scope="col">' . esc_html__( 'Name', 'track-changes' ) . '</th>';
			echo '<th scope="col">' . esc_html__( 'Last modified', 'track-changes' ) . '</th>';
			echo '</tr></thead><tbody>';

			foreach ( $customizations as $customization ) {
				echo '<tr>';
				echo '<td>' . esc_html( $customization->post_type ) . '</td>';
				echo '<td>' . esc_html( $customization->post_title ) . '</td>';
				echo '<td>' . esc_html( $customization->post_modified ) . '</td>';
				echo '</tr>';
			}

			echo '</tbody></table>';
		}
	}

	/**
	 * Constructs the Track_Changes_Dashboard_Widget instance.
	 *
	 * Initializes the dashboard widget by conditionally registering its hooks
	 * if the current request is for an admin page. This ensures that the widget
	 * setup logic is only executed within the WordPress admin dashboard, optimizing
	 * performance and resource usage on the frontend.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		if ( is_admin() ) {
			$this->register_dashboard_hooks();
		}
	}

	/**
	 * Registers the hooks necessary for adding the dashboard widget.
	 *
	 * This method encapsulates the hook registration process, specifically targeting
	 * the 'wp_dashboard_setup' action to add the dashboard widget. By isolating hook
	 * registration to this method, it maintains a clear separation of concerns and
	 * enhances the readability and maintainability of the widget setup process.
	 *
	 * @since 0.1.0
	 *
	 * @access private
	 * @see 'Track_Changes_Dashboard_Widget::add_dashboard_widgets()' For the method that adds the dashboard widget.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_action/
	 *       Documentation for the add_action() function.
	 * @link https://developer.wordpress.org/reference/hooks/wp_dashboard_setup/
	 *       Documentation for the wp_dashboard_setup() hook.
	 */
	private function register_dashboard_hooks() {
		add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
	}
}
