# Contributing Guidelines

Welcome to Track Changes! All are welcome here.

## Ways to contribute

We welcome contributions in all forms, including code, design, documentation, translation, and triage.

### Development Setup

The basic setup for development is:

- Node/NPM Development Tools
- WordPress Development Site
- Code Editor

#### Prerequisites

- [Node.js](https://nodejs.org/en/) (v16.9.1)
- [Composer](https://getcomposer.org/) (used for linting PHP)
- WordPress Development Site, such as [wp-env](https://github.com/WordPress/gutenberg/blob/trunk/packages/env/README.md) or [Local](https://localwp.com/)
- We recommend using [Node Version Manager](https://github.com/nvm-sh/nvm) (nvm) to manage your Node.js versions

We recommend following the [Gutenberg code contribution guide](https://github.com/WordPress/gutenberg/blob/trunk/docs/contributors/code/getting-started-with-code-contribution.md) for more details on setting up a development environment.

#### Code Setup

[Fork](https://docs.github.com/en/get-started/quickstart/fork-a-repo) the Track Changes repository, [clone it to your computer](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository) and add the WordPress repository as [upstream](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/working-with-forks/configuring-a-remote-repository-for-a-fork)

```bash
git clone https://github.com/YOUR_GITHUB_USERNAME/wp-track-changes.git
cd wp-track-changes
git remote add upstream https://github.com/unscripted/wp-track-changes.git
```

Run the following commands to install the plugin dependencies:

```bash
npm install
composer install
```

Run `npm run build` to build the plugin.

There are several linter commands available to help ensure the plugin follows the WordPress coding standards:

- CSS: `npm run lint:css` & `npm run lint:css:fix`
- JS: `npm run lint:js` & `npm run lint:js:fix`
- PHP: `npm run lint:php` & `npm run lint:php:fix`

To test a WordPress plugin, you need to have WordPress itself installed. If you already have a WordPress environment setup, use the above Create Block Theme build as a standard WordPress plugin by putting the `create-block-theme` directory in your wp-content/plugins/ directory.

## Guidelines

This project's goal is to adhear to the WordPress standards.

- We want to ensure a welcoming environment for everyone. With that in mind, all contributors are expected to follow our [Code of Conduct](https://make.wordpress.org/handbook/community-code-of-conduct/).
- Contributors should follow WordPress' [coding standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) and [accessibility coding standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/accessibility/).
- You maintain copyright over any contribution you make. By submitting a pull request you agree to release that code under the [plugin's License](/LICENSE.md).
