/**
 * NetlifyPress Main JS
 *
 */

/*
 * NetlifyPress Main Sass File
 */

import '../sass/main.scss';

/*
 * Custom JS
 */

( function( $ ) {
    $( document ).ready( function() {

        /* "Selct All" checkboxes for the auto-deploy selections */

        /* Auto Deploy Action Selection */

        $( '.auto-deploy-action-form-group #netlifypress_action_auto_deploy_all' ).on( 'click', function() {
            if( this.checked ) {
                $( '.auto-deploy-action-form-group input[type=checkbox]:not( #netlifypress_action_auto_deploy_all )' ).each( function() {
                    this.checked = true;
                } );
            } else {
                 $( '.auto-deploy-action-form-group input[type=checkbox]:not( #netlifypress_action_auto_deploy_all )' ).each( function() {
                    this.checked = false;
                } );
            }
        });
        
        $( '.auto-deploy-action-form-group input[type=checkbox]:not( #netlifypress_action_auto_deploy_all )' ).on( 'click', function() {
            if( $( '.auto-deploy-action-form-group input[type=checkbox]:not( #netlifypress_action_auto_deploy_all ):checked' ).length == $( '.auto-deploy-action-form-group input[type=checkbox]:not( #netlifypress_action_auto_deploy_all )' ).length ) {
                $( '.auto-deploy-action-form-group #netlifypress_action_auto_deploy_all' ).prop( 'checked', true );
            } else {
                $( '.auto-deploy-action-form-group #netlifypress_action_auto_deploy_all' ).prop( 'checked', false );
            }
        } );

        /* Post Types Selection */

        $( '.post-types-form-group #netlifypress_post_type_all' ).on( 'click', function() {
            if( this.checked ) {
                $( '.post-types-form-group input[type=checkbox]:not( #netlifypress_post_type_all )' ).each( function() {
                    this.checked = true;
                } );
            } else {
                 $( '.post-types-form-group input[type=checkbox]:not( #netlifypress_post_type_all )' ).each( function() {
                    this.checked = false;
                } );
            }
        });
        
        $( '.post-types-form-group input[type=checkbox]:not( #netlifypress_post_type_all )' ).on( 'click', function() {
            if( $( '.post-types-form-group input[type=checkbox]:not( #netlifypress_post_type_all ):checked' ).length == $( '.post-types-form-group input[type=checkbox]:not( #netlifypress_post_type_all )' ).length ) {
                $( '.post-types-form-group #netlifypress_post_type_all' ).prop( 'checked', true );
            } else {
                $( '.post-types-form-group #netlifypress_post_type_all' ).prop( 'checked', false );
            }
        } );

        /* Auto Deploy Actions - Display Conditions */

        $( '#automatic-deployment input#netlifypress_auto_deploy' ).click( function () {
            $( '.auto-deploy-actions-post-types' ).slideToggle();
        });
        
        /* "Selct All" checkboxes for the manual-deploy selections */

        /* Authorized roles Selection */

        $( '.authorized-roles-form-group #netlifypress_auth_role_all' ).on( 'click', function() {
            if( this.checked ) {
                $( '.authorized-roles-form-group input[type=checkbox]:not( #netlifypress_auth_role_all )' ).each( function() {
                    this.checked = true;
                } );
            } else {
                 $( '.authorized-roles-form-group input[type=checkbox]:not( #netlifypress_auth_role_all )' ).each( function() {
                    this.checked = false;
                } );
            }
        });
        
        $( '.authorized-roles-form-group input[type=checkbox]:not( #netlifypress_auth_role_all )' ).on( 'click', function() {
            if( $( '.authorized-roles-form-group input[type=checkbox]:not( #netlifypress_auth_role_all ):checked' ).length == $( '.authorized-roles-form-group input[type=checkbox]:not( #netlifypress_auth_role_all )' ).length ) {
                $( '.authorized-roles-form-group #netlifypress_auth_role_all' ).prop( 'checked', true );
            } else {
                $( '.authorized-roles-form-group #netlifypress_auth_role_all' ).prop( 'checked', false );
            }
        } );

        /* Manual Deploy Settings - Display Conditions */

        $( '#manual-deployment input#netlifypress_manual_deploy' ).click( function () {
            $( '.manual-deploy-authorized-roles' ).slideToggle();
        });

    } );
} )( jQuery );
