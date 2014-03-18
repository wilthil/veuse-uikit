<?php
/**
 * GitHub Updater
 *
 * @package   GitHub_Updater
 * @author    Andy Fragen
 * @license   GPL-2.0+
 * @link      https://github.com/afragen/github-updater
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

// Load base classes and Launch
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
	if ( ! class_exists( 'GitHub_Updater' ) ) {
		require_once 'includes/class-github-updater.php';
		require_once 'includes/class-github-api.php';
		require_once 'includes/class-bitbucket-api.php';
	}
	if ( ! class_exists( 'GitHub_Plugin_Updater' ) ) {
		require_once 'includes/class-plugin-updater.php';
		new GitHub_Plugin_Updater;
	}
	if ( ! class_exists( 'GitHub_Theme_Updater' ) ) {
		require_once 'includes/class-theme-updater.php';
		new GitHub_Theme_Updater;
	}
}
