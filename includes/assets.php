<?php
/**
 * Enqueue and handle assets
 *
 * @since      1.0
 * @package    Deploy with NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

/*
 * Admin assets
 */

function netlifypress_enqueue_admin_assets( $hook ) {
    global $netlifypress_options_page;
	if( $hook != $netlifypress_options_page ) {
		return;
	}
    wp_enqueue_script( 'netlifypress-admin-popper',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/js/popper.min.js', array( 'jquery' ), '', true  );
    wp_enqueue_script( 'netlifypress-admin-bootstrap',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/js/bootstrap.min.js', array( 'jquery' ), '', true  );
    wp_enqueue_script( 'netlifypress-admin-script',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/js/main.min.js', array( 'jquery' ), '', true  );
    wp_enqueue_style( 'netlifypress-admin-style',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/css/main.min.css' );
}
add_action( 'admin_enqueue_scripts', 'netlifypress_enqueue_admin_assets' );
