<?php
/**
 * Track_Changes_Get_Customizations_Query class
 *
 * This file contains the Track_Changes_Get_Customizations_Query class, which is responsible
 * for querying the latest customizations made within the site editor.
 *
 * @package track-changes
 * @since 0.1.0
 */

namespace TrackChanges;

/**
 * Handles querying for site customizations.
 *
 * Utilizes WordPress core functions to fetch the latest customizations made within
 * the site editor, including changes to templates, template parts, and global styles.
 *
 * @since 0.1.0
 *
 * @see WP_Query For the underlying query mechanism used by get_posts().
 * @link https://developer.wordpress.org/reference/classes/wp_query/
 *       WP_Query documentation.
 */
class Track_Changes_Get_Customizations_Query {
	/**
	 * Fetches the latest customizations made to the site editor components.
	 *
	 * Retrieves an array of WP_Post objects representing the most recent customizations
	 * to wp_block, wp_template, wp_template_part, and wp_global_styles post types.
	 * These customizations are sorted by their modification date in descending order.
	 * Optimized for performance by avoiding pagination calculations.
	 *
	 * @since 0.1.0
	 *
	 * @see get_posts() Utilizes get_posts to fetch the data, see for more details on parameters.
	 * @link https://developer.wordpress.org/reference/functions/get_posts/
	 *       get_posts documentation.
	 *
	 * @see wp_add_dashboard_widget() Adds a new dashboard widget.
	 * @link https://developer.wordpress.org/reference/functions/wp_add_dashboard_widget/
	 *       For dashboard widget registration.
	 *
	 * @return WP_Post[] An array of WP_Post objects representing the latest customizations, or an empty array if none are found.
	 */
	public function get_latest_customizations() {
		$args = array(
			'post_type'      => array(     // Only fetch post types related to the site editor.
				'wp_block',                // Maps to Patters.
				'wp_template',             // Maps to Templates.
				'wp_template_part',        // Maps to Template Parts.
				'wp_global_styles',        // Maps to Global styles (theme.json).
			),
			'posts_per_page' => 42,        // Retrieve up to 42 matching posts.
			'post_status'    => 'publish', // Only fetch published posts.
			'orderby'        => 'date',    // Order by the date the post was last modified.
			'order'          => 'DESC',    // Sort in descending order to get the latest posts first.
			'no_found_rows'  => true,      // Skip pagination count for performance improvement.
		);

		return get_posts( $args );
	}
}
