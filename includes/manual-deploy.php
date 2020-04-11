<?php
/**
 * Manual Deployment
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
 * Top Admin Bar Button
 */

add_action( 'admin_bar_menu', 'netlifypress_manual_deploy_button', 999 );
function netlifypress_manual_deploy_button( $wp_admin_bar ) {
    $currentUserRole = wp_get_current_user()->roles;
    if ( ! empty( get_option( 'netlifypress_build_hook_url' ) ) && get_option( 'netlifypress_manual_deploy' ) == 'on' && ! empty ( array_intersect( $currentUserRole, get_option( 'netlifypress_auth_roles_manual_deploy' ) ) ) ) {
        $args = array(
            'id'    => 'netlifypress_manual_deploy_button',
            'title' => '<span class="ab-icon"></span>' . __( 'Trigger Netlify Deploy' ),
            'href'  => '#',
            'meta'  => array( 'class' => 'netlifypress_manual_deploy_button' )
        );
        $wp_admin_bar->add_node( $args );
    }
}

/*
* Netlify Deploy Trigger
*/

/* Initialize the trigger */

add_action( 'init', 'netlifypress_manual_deploy_initialize' );
function netlifypress_manual_deploy_initialize() {
    $currentUserRole = wp_get_current_user()->roles;
    if ( is_admin_bar_showing() && ! empty( get_option( 'netlifypress_build_hook_url' ) ) && get_option( 'netlifypress_manual_deploy' ) == 'on' && ! empty ( array_intersect( $currentUserRole, get_option( 'netlifypress_auth_roles_manual_deploy' ) ) ) ) {
        add_action( 'admin_enqueue_scripts', 'netlifypress_manual_trigger_script' );
        add_action( 'wp_enqueue_scripts', 'netlifypress_manual_trigger_script' );
    }
}

/* Manual deploy trigger script */

function netlifypress_manual_trigger_script() {
    if ( ! is_admin() && ! wp_script_is( 'jquery', 'done' ) ) {
        wp_enqueue_script( 'jquery' );
    }
    wp_add_inline_script( 'jquery', '
        jQuery( document ).ready( function() {
            jQuery( ".netlifypress_manual_deploy_button a" ).on( "click", function( e ) {
                event.preventDefault();
                if ( confirm( "Are you sure that you want to trigger a deployment?" ) ) {
                    jQuery.ajax( {
                        type: "POST",
                        url: "' . get_option( 'netlifypress_build_hook_url' ) . '?trigger_title=Manually triggered deployment",
                        success: function( d ) {
                            window.alert( "Successfully triggered deploy in Netlify!" )
                        }
                    } )
                }
            } )
        } )
    ' );
}

/* Top Admin Bar link icon */

add_action( 'init', 'netlifypress_frontend_button_icon' );
function netlifypress_frontend_button_icon() {
    $currentUserRole = wp_get_current_user()->roles;
    if ( is_admin_bar_showing() && ! empty( get_option( 'netlifypress_build_hook_url' ) ) && get_option( 'netlifypress_manual_deploy' ) == 'on' && ! empty ( array_intersect( $currentUserRole, get_option( 'netlifypress_auth_roles_manual_deploy' ) ) ) ) {
        add_action( 'wp_footer', 'netlifypress_topbar_button_icon_styles' );
        add_action( 'admin_footer', 'netlifypress_topbar_button_icon_styles' );
    }
}

function netlifypress_topbar_button_icon_styles() {
    ?>
        <style type="text/css">
            .netlifypress_manual_deploy_button a.ab-item .ab-icon {
                display: block;
            }

            .netlifypress_manual_deploy_button a.ab-item .ab-icon:before {
                content: "";
                display:block;
                height: 20px;
                width: 20px;
                background-size: 20px 20px;
                background-repeat: no-repeat;
                background-image: url( 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+IDxkZWZzPiA8cmFkaWFsR3JhZGllbnQgaWQ9ImEiIGN5PSIwJSIgcj0iMTAwLjExJSIgZng9IjUwJSIgZnk9IjAlIiBncmFkaWVudFRyYW5zZm9ybT0ibWF0cml4KDAgLjk5ODkgLTEuMTUyIDAgLjUgLS41KSI+IDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMyMEM2QjciLz4gPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjNEQ5QUJGIi8+IDwvcmFkaWFsR3JhZGllbnQ+IDwvZGVmcz4gPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTI4LjU4OSAxNC4xMzVsLS4wMTQtLjAwNmMtLjAwOC0uMDAzLS4wMTYtLjAwNi0uMDIzLS4wMTNhLjExLjExIDAgMCAxLS4wMjgtLjA5M2wuNzczLTQuNzI2IDMuNjI1IDMuNjI2LTMuNzcgMS42MDRhLjA4My4wODMgMCAwIDEtLjAzMy4wMDZoLS4wMTVjLS4wMDUtLjAwMy0uMDEtLjAwNy0uMDItLjAxN2ExLjcxNiAxLjcxNiAwIDAgMC0uNDk1LS4zODF6bTUuMjU4LS4yODhsMy44NzYgMy44NzZjLjgwNS44MDYgMS4yMDggMS4yMDggMS4zNTUgMS42NzQuMDIyLjA2OS4wNC4xMzguMDU0LjIwOWwtOS4yNjMtMy45MjNhLjcyOC43MjggMCAwIDAtLjAxNS0uMDA2Yy0uMDM3LS4wMTUtLjA4LS4wMzItLjA4LS4wNyAwLS4wMzguMDQ0LS4wNTYuMDgxLS4wNzFsLjAxMi0uMDA1IDMuOTgtMS42ODR6bTUuMTI3IDcuMDAzYy0uMi4zNzYtLjU5Ljc2Ni0xLjI1IDEuNDI3bC00LjM3IDQuMzY5LTUuNjUyLTEuMTc3LS4wMy0uMDA2Yy0uMDUtLjAwOC0uMTAzLS4wMTctLjEwMy0uMDYyYTEuNzA2IDEuNzA2IDAgMCAwLS42NTUtMS4xOTNjLS4wMjMtLjAyMy0uMDE3LS4wNTktLjAxLS4wOTIgMC0uMDA1IDAtLjAxLjAwMi0uMDE0bDEuMDYzLTYuNTI2LjAwNC0uMDIyYy4wMDYtLjA1LjAxNS0uMTA4LjA2LS4xMDhhMS43MyAxLjczIDAgMCAwIDEuMTYtLjY2NWMuMDA5LS4wMS4wMTUtLjAyMS4wMjctLjAyNy4wMzItLjAxNS4wNyAwIC4xMDMuMDE0bDkuNjUgNC4wODJ6bS02LjYyNSA2LjgwMWwtNy4xODYgNy4xODYgMS4yMy03LjU2LjAwMi0uMDFjLjAwMS0uMDEuMDAzLS4wMi4wMDYtLjAyOS4wMS0uMDI0LjAzNi0uMDM0LjA2MS0uMDQ0bC4wMTItLjAwNWExLjg1IDEuODUgMCAwIDAgLjY5NS0uNTE3Yy4wMjQtLjAyOC4wNTMtLjA1NS4wOS0uMDZhLjA5LjA5IDAgMCAxIC4wMjkgMGw1LjA2IDEuMDR6bS04LjcwNyA4LjcwN2wtLjgxLjgxLTguOTU1LTEyLjk0MmEuNDI0LjQyNCAwIDAgMC0uMDEtLjAxNGMtLjAxNC0uMDE5LS4wMjktLjAzOC0uMDI2LS4wNi4wMDEtLjAxNi4wMTEtLjAzLjAyMi0uMDQybC4wMS0uMDEzYy4wMjctLjA0LjA1LS4wOC4wNzUtLjEyM2wuMDItLjAzNS4wMDMtLjAwM2MuMDE0LS4wMjQuMDI3LS4wNDcuMDUxLS4wNi4wMjEtLjAxLjA1LS4wMDYuMDczLS4wMDFsOS45MjEgMi4wNDZhLjE2NC4xNjQgMCAwIDEgLjA3Ni4wMzNjLjAxMy4wMTMuMDE2LjAyNy4wMTkuMDQzYTEuNzU3IDEuNzU3IDAgMCAwIDEuMDI4IDEuMTc1Yy4wMjguMDE0LjAxNi4wNDUuMDAzLjA3OGEuMjM4LjIzOCAwIDAgMC0uMDE1LjA0NWMtLjEyNS43Ni0xLjE5NyA3LjI5OC0xLjQ4NSA5LjA2M3ptLTEuNjkyIDEuNjkxYy0uNTk3LjU5MS0uOTQ5LjkwNC0xLjM0NyAxLjAzYTIgMiAwIDAgMS0xLjIwNiAwYy0uNDY2LS4xNDgtLjg2OS0uNTUtMS42NzQtMS4zNTZMOC43MyAyOC43M2wyLjM0OS0zLjY0M2MuMDExLS4wMTguMDIyLS4wMzQuMDQtLjA0Ny4wMjUtLjAxOC4wNjEtLjAxLjA5MSAwYTIuNDM0IDIuNDM0IDAgMCAwIDEuNjM4LS4wODNjLjAyNy0uMDEuMDU0LS4wMTcuMDc1LjAwMmEuMTkuMTkgMCAwIDEgLjAyOC4wMzJMMjEuOTUgMzguMDV6TTcuODYzIDI3Ljg2M0w1LjggMjUuOGw0LjA3NC0xLjczOGEuMDg0LjA4NCAwIDAgMSAuMDMzLS4wMDdjLjAzNCAwIC4wNTQuMDM0LjA3Mi4wNjVhMi45MSAyLjkxIDAgMCAwIC4xMy4xODRsLjAxMy4wMTZjLjAxMi4wMTcuMDA0LjAzNC0uMDA4LjA1bC0yLjI1IDMuNDkzem0tMi45NzYtMi45NzZsLTIuNjEtMi42MWMtLjQ0NC0uNDQ0LS43NjYtLjc2Ni0uOTktMS4wNDNsNy45MzYgMS42NDZhLjg0Ljg0IDAgMCAwIC4wMy4wMDVjLjA0OS4wMDguMTAzLjAxNy4xMDMuMDYzIDAgLjA1LS4wNTkuMDczLS4xMDkuMDkybC0uMDIzLjAxLTQuMzM3IDEuODM3ek0uODMxIDE5Ljg5MmEyIDIgMCAwIDEgLjA5LS40OTVjLjE0OC0uNDY2LjU1LS44NjggMS4zNTYtMS42NzRsMy4zNC0zLjM0YTIxNzUuNTI1IDIxNzUuNTI1IDAgMCAwIDQuNjI2IDYuNjg3Yy4wMjcuMDM2LjA1Ny4wNzYuMDI2LjEwNi0uMTQ2LjE2MS0uMjkyLjMzNy0uMzk1LjUyOGEuMTYuMTYgMCAwIDEtLjA1LjA2MmMtLjAxMy4wMDgtLjAyNy4wMDUtLjA0Mi4wMDJIOS43OEwuODMxIDE5Ljg5MXptNS42OC02LjQwM2w0LjQ5MS00LjQ5MWMuNDIyLjE4NSAxLjk1OC44MzQgMy4zMzIgMS40MTQgMS4wNC40NCAxLjk4OC44NCAyLjI4Ni45Ny4wMy4wMTIuMDU3LjAyNC4wNy4wNTQuMDA4LjAxOC4wMDQuMDQxIDAgLjA2YTIuMDAzIDIuMDAzIDAgMCAwIC41MjMgMS44MjhjLjAzLjAzIDAgLjA3My0uMDI2LjExbC0uMDE0LjAyMS00LjU2IDcuMDYzYy0uMDEyLjAyLS4wMjMuMDM3LS4wNDMuMDUtLjAyNC4wMTUtLjA1OC4wMDgtLjA4Ni4wMDFhMi4yNzQgMi4yNzQgMCAwIDAtLjU0My0uMDc0Yy0uMTY0IDAtLjM0Mi4wMy0uNTIyLjA2M2gtLjAwMWMtLjAyLjAwMy0uMDM4LjAwNy0uMDU0LS4wMDVhLjIxLjIxIDAgMCAxLS4wNDUtLjA1MWwtNC44MDgtNy4wMTN6bTUuMzk4LTUuMzk4bDUuODE0LTUuODE0Yy44MDUtLjgwNSAxLjIwOC0xLjIwOCAxLjY3NC0xLjM1NWEyIDIgMCAwIDEgMS4yMDYgMGMuNDY2LjE0Ny44NjkuNTUgMS42NzQgMS4zNTVsMS4yNiAxLjI2LTQuMTM1IDYuNDA0YS4xNTUuMTU1IDAgMCAxLS4wNDEuMDQ4Yy0uMDI1LjAxNy0uMDYuMDEtLjA5IDBhMi4wOTcgMi4wOTcgMCAwIDAtMS45Mi4zN2MtLjAyNy4wMjgtLjA2Ny4wMTItLjEwMS0uMDAzLS41NC0uMjM1LTQuNzQtMi4wMS01LjM0MS0yLjI2NXptMTIuNTA2LTMuNjc2bDMuODE4IDMuODE4LS45MiA1LjY5OHYuMDE1YS4xMzUuMTM1IDAgMCAxLS4wMDguMDM4Yy0uMDEuMDItLjAzLjAyNC0uMDUuMDNhMS44MyAxLjgzIDAgMCAwLS41NDguMjczLjE1NC4xNTQgMCAwIDAtLjAyLjAxN2MtLjAxMS4wMTItLjAyMi4wMjMtLjA0LjAyNWEuMTE0LjExNCAwIDAgMS0uMDQzLS4wMDdsLTUuODE4LTIuNDcyLS4wMTEtLjAwNWMtLjAzNy0uMDE1LS4wODEtLjAzMy0uMDgxLS4wNzFhMi4xOTggMi4xOTggMCAwIDAtLjMxLS45MTVjLS4wMjgtLjA0Ni0uMDU5LS4wOTQtLjAzNS0uMTQxbDQuMDY2LTYuMzAzem0tMy45MzIgOC42MDZsNS40NTQgMi4zMWMuMDMuMDE0LjA2My4wMjcuMDc2LjA1OGEuMTA2LjEwNiAwIDAgMSAwIC4wNTdjLS4wMTYuMDgtLjAzLjE3MS0uMDMuMjYzdi4xNTNjMCAuMDM4LS4wMzkuMDU0LS4wNzUuMDY5bC0uMDExLjAwNGMtLjg2NC4zNjktMTIuMTMgNS4xNzMtMTIuMTQ3IDUuMTczLS4wMTcgMC0uMDM1IDAtLjA1Mi0uMDE3LS4wMy0uMDMgMC0uMDcyLjAyNy0uMTFhLjc2Ljc2IDAgMCAwIC4wMTQtLjAybDQuNDgyLTYuOTQuMDA4LS4wMTJjLjAyNi0uMDQyLjA1Ni0uMDg5LjEwNC0uMDg5bC4wNDUuMDA3Yy4xMDIuMDE0LjE5Mi4wMjcuMjgzLjAyNy42OCAwIDEuMzEtLjMzMSAxLjY5LS44OTdhLjE2LjE2IDAgMCAxIC4wMzQtLjA0Yy4wMjctLjAyLjA2Ny0uMDEuMDk4LjAwNHptLTYuMjQ2IDkuMTg1bDEyLjI4LTUuMjM3cy4wMTggMCAuMDM1LjAxN2MuMDY3LjA2Ny4xMjQuMTEyLjE3OS4xNTRsLjAyNy4wMTdjLjAyNS4wMTQuMDUuMDMuMDUyLjA1NiAwIC4wMSAwIC4wMTYtLjAwMi4wMjVMMjUuNzU2IDIzLjdsLS4wMDQuMDI2Yy0uMDA3LjA1LS4wMTQuMTA3LS4wNjEuMTA3YTEuNzI5IDEuNzI5IDAgMCAwLTEuMzczLjg0N2wtLjAwNS4wMDhjLS4wMTQuMDIzLS4wMjcuMDQ1LS4wNS4wNTctLjAyMS4wMS0uMDQ4LjAwNi0uMDcuMDAxbC05Ljc5My0yLjAyYy0uMDEtLjAwMi0uMTUyLS41MTktLjE2My0uNTJ6Ii8+IDwvc3ZnPg==' );
            }
        </style>
    <?php
}
