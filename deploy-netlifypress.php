<?php
/**
 * Plugin Name: Deploy with NetlifyPress
 * Plugin URI: https://nahid.dev/project/deploy-netlifypress
 * Description: Seamlessly trigger deploys in Netlify from WordPress
 * Author: Nahid Ferdous Mohit
 * Version: 1.1.1
 * Author URI: https://nahid.dev
 * Text Domain: deploy-netlifypress
 *
 * @since      1.0
 * @package    Deploy with NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Call the plugin core file
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/core.php';
