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
 * Fontawesome
 */

import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'

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

        /* Post Types Selection */

        $( '.post-types-form-group #post_type_all' ).on( 'click', function() {
            if( this.checked ) {
                $( '.post-types-form-group input[type=checkbox]:not( #post_type_all )' ).each( function() {
                    this.checked = true;
                } );
            } else {
                 $( '.post-types-form-group input[type=checkbox]:not( #post_type_all )' ).each( function() {
                    this.checked = false;
                } );
            }
        });
        
        $( '.post-types-form-group input[type=checkbox]:not( #post_type_all )' ).on( 'click', function() {
            if( $( '.post-types-form-group input[type=checkbox]:not( #post_type_all ):checked' ).length == $( '.post-types-form-group input[type=checkbox]:not( #post_type_all )' ).length ) {
                $( '.post-types-form-group #post_type_all' ).prop( 'checked', true );
            } else {
                $( '.post-types-form-group #post_type_all' ).prop( 'checked', false );
            }
        } );
    } );
} )( jQuery );