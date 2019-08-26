<?php
/**
 * Core plugin file
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
 * Enqueue CSS and JS assets
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/assets.php';

/*
 * Admin pages
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/admin.php';

/*
 * Automatic Deploy Logic
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/auto-deploy.php';

/*
 * Manual Deployment
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/manual-deploy.php';
