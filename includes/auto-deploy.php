<?php
/**
 * Automatic Deploy Logic
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
 * Auto Deploy Triggers
 */

if ( get_option( 'netlifypress_build_hook_url' ) ) {

    /* Publish/Update Action */

    if ( in_array( 'publish', get_option( 'action_auto_deploy' ) ) || in_array( 'update', get_option( 'action_auto_deploy' ) ) ) {
        add_action( 'save_post', 'deploy_trigger_publish_update', 10, 2 );
    }

    function deploy_trigger_publish_update( $post_id, $post ) {

        /* Make sure trigger for post type is enabled */

        $post_type = get_post_type( $post_id );
        if ( in_array( $post_type, get_option( 'post_types' ) ) ) {

            /* Make sure post is not auto-draft */

            if ( 'auto-draft' == get_post_status( $post_id ) ) {
                return;
            }

            if ( in_array( 'publish', get_option( 'action_auto_deploy' ) ) && $post->post_date === $post->post_modified ) {

                wp_remote_post( get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=' . $post->post_title . ' was published' );

            } elseif ( in_array( 'update', get_option( 'action_auto_deploy' ) ) && $post->post_date != $post->post_modified ) {

                wp_remote_post( get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=' . $post->post_title . ' was updated' );

            }
        }
    }
}
