<?php
/**
 * Manual Deployment
 *
 * @since      1.0
 * @package    NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

/*
 * If this file is called directly, abort.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Top Admin Bar Button
 */

add_action( 'admin_bar_menu', 'netlifypress_manual_deploy_button', 999 );
function netlifypress_manual_deploy_button( $wp_admin_bar ) {
	$args = array(
		'id'    => 'netlifypress_manual_deploy_button',
		'title' => '<span class="ab-icon"></span>' . __( 'Trigger Netlify Deploy' ),
		'href'  => '#',
		'meta'  => array( 'class' => 'netlifypress_manual_deploy_button' )
	);
	$wp_admin_bar->add_node( $args );
}
