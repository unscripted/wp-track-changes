# Track Changes

Track Changes is a developer tool for block themes that assists in surfacing customizations made in the WordPress site editor (Gutenberg). It enables theme developers to use a Git-based workflow to identify new or modified patterns, template parts, and templates. Additionally, it checks for global style (theme.json) edits made within the site editor.

The plugin registers a dashboard widget that runs a `get_posts` query targeting the post types used by the Site Editor when saving customizations. It then returns the results in a table, showing the file type, name, and last modified date.

### Key features

- Check if global style changes are saved in the database.
- Check if changes to tracked theme templates are saved in the database.
- Check if new, untracked templates are saved in the database.
- Check if changes to tracked template parts are saved in the database.
- Check if new, untracked template parts are saved in the database.
- Check if new, untracked patterns are saved in the database.

## Requirements

- WordPress 6.2+
- PHP 7.0+

## Recommended workflows

The Track Changes plugin works great for single-user sites, but it shines when a site using a block theme has multiple users with the `administrator` or `editor` role.

_The workflow outline below is recommended for production websites developed and maintained for a client by agencies or freelance developers._

### 1. Use separate development, staging and production environments

For best results, you should install the plugin in each environment to identify if any changes were made before you "save changes" to your theme.

### 2. Check for changes in production

Before making any code-level changes in your local environment, you should check the production and staging environments to see if any changes are present.

### 3. Save changes to your theme

The Track Changes plugin works best with the [Create Block Theme](https://wordpress.org/plugins/create-block-theme/) (CBT) plugin. If changes are present, use CBT's "Save Changes" button to export them from your database and create or update the associated files within your theme. Additionally, it removes the database entries when complete.

_If you do not use CBT, you must remove these entries manually after adding the changes to your theme._

### 4. Content (and theme) comes down

Pull the database and theme to your local environment using a tool like WP Migrate.

### 5. Commit the theme changes

Use your preferred Git tool to diff, commit and push revisions to your repository.

### 6. Code goes up

Once your committed code is tested and approved, deploy it to the production environment.

### 7. Rinse and repeat (optional)

Once we've deployed to production, we like to check for changes again. On heavily active sites, we often encounter changes that were made between the time we last saved changes and deployed them to production.

## Frequently Asked Questions

### Are you monitoring my site?

No. As much as we love to reverse engineer and learn by example, we respect your privacy more. This plugin is fully contained within your website and has no "call home" features with reporting data.

### How do I get support?

If you encounter an issue, you should first check the [Support forum](https://wordpress.org/support/plugin/track-changes/). This forum is a great place to get help.

### How do I report an issue?

If you have a bug to report, please submit it to the [GitHub repository](https://github.com/unscripted/wp-track-changes/issues) as an issue. Please search before creating a new bug to confirm it's not a duplicate.

### How do you know something isn't tracked?

We don't. However, Track Changes looks at the posts table to identify entries for the 'wp_block', 'wp_template', 'wp_template_part', and 'wp_global_styles' post types. If an entry exists, we know the change came from the site editor, not your theme.

### How do I clear these entries after I've updated my theme?

If you've updated your theme and still see entries in the Track Changes table, these entries still exist in the database. You have several options to keep this updated.

1. Use the Create Block Theme plugin (recommended).
2. If tracked, you can "reset" the template within the site editor.
3. If untracked, you can delete the template or pattern within the site editor.
4. You can manually delete the entries from the posts and post_meta tables (danger zone).
