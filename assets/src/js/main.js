/**
 * NetlifyPress Main JS
 *
 */

/*
 * NetlifyPress Main Sass File
 */

import '../sass/main.scss';

/*
 * Bootstrap JS
 */

import 'bootstrap';

/*
 * Custom JS
 */

/* "Selct All" checkboxes for the auto-deploy selections */

( function( $ ) {
    $( document ).ready( function() {

        /* Auto Deploy Action Selection */

        $( '.auto-deploy-action-form-group #action_auto_deploy_all' ).on( 'click', function() {
            if( this.checked ) {
                $( '.auto-deploy-action-form-group input[type=checkbox]:not( #action_auto_deploy_all )' ).each( function() {
                    this.checked = true;
                } );
            } else {
                 $( '.auto-deploy-action-form-group input[type=checkbox]:not( #action_auto_deploy_all )' ).each( function() {
                    this.checked = false;
                } );
            }
        });
        
        $( '.auto-deploy-action-form-group input[type=checkbox]:not( #action_auto_deploy_all )' ).on( 'click', function() {
            if( $( '.auto-deploy-action-form-group input[type=checkbox]:not( #action_auto_deploy_all ):checked' ).length == $( '.auto-deploy-action-form-group input[type=checkbox]:not( #action_auto_deploy_all )' ).length ) {
                $( '.auto-deploy-action-form-group #action_auto_deploy_all' ).prop( 'checked', true );
            } else {
                $( '.auto-deploy-action-form-group #action_auto_deploy_all' ).prop( 'checked', false );
            }
        } );
    } );
} )( jQuery );