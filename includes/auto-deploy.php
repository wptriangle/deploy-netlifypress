<?php
/**
 * Automatic Deploy Logic
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
 * Auto Deploy Triggers
 */

if ( ! empty( get_option( 'netlifypress_build_hook_url' ) ) && get_option( 'netlifypress_auto_deploy' ) == 'on' ) {

    /* Initialize the trigger */

    add_action( 'init', 'netlifypress_auto_deploy_initialize' );
    function netlifypress_auto_deploy_initialize() {
        if ( ( in_array( 'publish', get_option( 'netlifypress_action_auto_deploy' ) ) || in_array( 'update', get_option( 'netlifypress_action_auto_deploy' ) ) || in_array( 'trash', get_option( 'netlifypress_action_auto_deploy' ) ) ) ) {
            add_action( 'save_post', 'netlifypress_deploy_trigger', 10, 2 );
        }
    }

    /* Auto Deploy Trigger */

    function netlifypress_deploy_trigger( $post_id, $post ) {

        /* Make sure trigger for post type is enabled */

        $post_type = get_post_type( $post_id );
        if ( in_array( $post_type, get_option( 'netlifypress_post_types_auto_deploy' ) ) ) {

            /* Publish/Update Action */

            if ( ( in_array( 'publish', get_option( 'netlifypress_action_auto_deploy' ) ) || in_array( 'update', get_option( 'netlifypress_action_auto_deploy' ) ) ) && 'trash' != get_post_status( $post_id ) ) {

                /* Make sure post is not auto-draft, draft or a revision */

                if ( 'auto-draft' == get_post_status( $post_id ) || 'draft' == get_post_status( $post_id ) || wp_is_post_revision( $post_id ) ) {
                    return;
                }

                /* Publish Action */

                if ( in_array( 'publish', get_option( 'netlifypress_action_auto_deploy' ) ) && $post->post_date === $post->post_modified ) {

                    wp_remote_post( get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=' . $post->post_title . ' was published' );

                /* Update Action */    

                } elseif ( in_array( 'update', get_option( 'netlifypress_action_auto_deploy' ) ) && $post->post_date != $post->post_modified ) {

                    wp_remote_post( get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=' . $post->post_title . ' was updated' );

                }
            }

            /* Trash Action */

            elseif ( in_array( 'trash', get_option( 'netlifypress_action_auto_deploy' ) ) && 'trash' == get_post_status( $post_id ) ) {
                wp_remote_post( get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=' . $post->post_title . ' was trashed' );
            }
        }
    }
}
