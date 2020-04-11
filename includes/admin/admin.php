<?php
/**
 * Admin Pages
 *
 * @since      1.0
 * @package    Deploy with NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

/*
 * Add the admin menu
 */

add_action( 'admin_menu', 'netlifypress_setup_options_page' );
function netlifypress_setup_options_page() {
    $page_title = __( 'NetlifyPress', 'deploy-netlifypress' );
    $menu_title = __( 'NetlifyPress', 'deploy-netlifypress' );
    $capability = 'manage_options';
    $menu_slug = 'netlifypress_options';
    $function = 'netlifypress_options_page_display';
    $icon_url = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"> <defs> <radialGradient id="a" cy="0%" r="100.11%" fx="50%" fy="0%" gradientTransform="matrix(0 .9989 -1.152 0 .5 -.5)"> <stop offset="0%" stop-color="#20C6B7"/> <stop offset="100%" stop-color="#4D9ABF"/> </radialGradient> </defs> <path fill="url(#a)" d="M28.589 14.135l-.014-.006c-.008-.003-.016-.006-.023-.013a.11.11 0 0 1-.028-.093l.773-4.726 3.625 3.626-3.77 1.604a.083.083 0 0 1-.033.006h-.015c-.005-.003-.01-.007-.02-.017a1.716 1.716 0 0 0-.495-.381zm5.258-.288l3.876 3.876c.805.806 1.208 1.208 1.355 1.674.022.069.04.138.054.209l-9.263-3.923a.728.728 0 0 0-.015-.006c-.037-.015-.08-.032-.08-.07 0-.038.044-.056.081-.071l.012-.005 3.98-1.684zm5.127 7.003c-.2.376-.59.766-1.25 1.427l-4.37 4.369-5.652-1.177-.03-.006c-.05-.008-.103-.017-.103-.062a1.706 1.706 0 0 0-.655-1.193c-.023-.023-.017-.059-.01-.092 0-.005 0-.01.002-.014l1.063-6.526.004-.022c.006-.05.015-.108.06-.108a1.73 1.73 0 0 0 1.16-.665c.009-.01.015-.021.027-.027.032-.015.07 0 .103.014l9.65 4.082zm-6.625 6.801l-7.186 7.186 1.23-7.56.002-.01c.001-.01.003-.02.006-.029.01-.024.036-.034.061-.044l.012-.005a1.85 1.85 0 0 0 .695-.517c.024-.028.053-.055.09-.06a.09.09 0 0 1 .029 0l5.06 1.04zm-8.707 8.707l-.81.81-8.955-12.942a.424.424 0 0 0-.01-.014c-.014-.019-.029-.038-.026-.06.001-.016.011-.03.022-.042l.01-.013c.027-.04.05-.08.075-.123l.02-.035.003-.003c.014-.024.027-.047.051-.06.021-.01.05-.006.073-.001l9.921 2.046a.164.164 0 0 1 .076.033c.013.013.016.027.019.043a1.757 1.757 0 0 0 1.028 1.175c.028.014.016.045.003.078a.238.238 0 0 0-.015.045c-.125.76-1.197 7.298-1.485 9.063zm-1.692 1.691c-.597.591-.949.904-1.347 1.03a2 2 0 0 1-1.206 0c-.466-.148-.869-.55-1.674-1.356L8.73 28.73l2.349-3.643c.011-.018.022-.034.04-.047.025-.018.061-.01.091 0a2.434 2.434 0 0 0 1.638-.083c.027-.01.054-.017.075.002a.19.19 0 0 1 .028.032L21.95 38.05zM7.863 27.863L5.8 25.8l4.074-1.738a.084.084 0 0 1 .033-.007c.034 0 .054.034.072.065a2.91 2.91 0 0 0 .13.184l.013.016c.012.017.004.034-.008.05l-2.25 3.493zm-2.976-2.976l-2.61-2.61c-.444-.444-.766-.766-.99-1.043l7.936 1.646a.84.84 0 0 0 .03.005c.049.008.103.017.103.063 0 .05-.059.073-.109.092l-.023.01-4.337 1.837zM.831 19.892a2 2 0 0 1 .09-.495c.148-.466.55-.868 1.356-1.674l3.34-3.34a2175.525 2175.525 0 0 0 4.626 6.687c.027.036.057.076.026.106-.146.161-.292.337-.395.528a.16.16 0 0 1-.05.062c-.013.008-.027.005-.042.002H9.78L.831 19.891zm5.68-6.403l4.491-4.491c.422.185 1.958.834 3.332 1.414 1.04.44 1.988.84 2.286.97.03.012.057.024.07.054.008.018.004.041 0 .06a2.003 2.003 0 0 0 .523 1.828c.03.03 0 .073-.026.11l-.014.021-4.56 7.063c-.012.02-.023.037-.043.05-.024.015-.058.008-.086.001a2.274 2.274 0 0 0-.543-.074c-.164 0-.342.03-.522.063h-.001c-.02.003-.038.007-.054-.005a.21.21 0 0 1-.045-.051l-4.808-7.013zm5.398-5.398l5.814-5.814c.805-.805 1.208-1.208 1.674-1.355a2 2 0 0 1 1.206 0c.466.147.869.55 1.674 1.355l1.26 1.26-4.135 6.404a.155.155 0 0 1-.041.048c-.025.017-.06.01-.09 0a2.097 2.097 0 0 0-1.92.37c-.027.028-.067.012-.101-.003-.54-.235-4.74-2.01-5.341-2.265zm12.506-3.676l3.818 3.818-.92 5.698v.015a.135.135 0 0 1-.008.038c-.01.02-.03.024-.05.03a1.83 1.83 0 0 0-.548.273.154.154 0 0 0-.02.017c-.011.012-.022.023-.04.025a.114.114 0 0 1-.043-.007l-5.818-2.472-.011-.005c-.037-.015-.081-.033-.081-.071a2.198 2.198 0 0 0-.31-.915c-.028-.046-.059-.094-.035-.141l4.066-6.303zm-3.932 8.606l5.454 2.31c.03.014.063.027.076.058a.106.106 0 0 1 0 .057c-.016.08-.03.171-.03.263v.153c0 .038-.039.054-.075.069l-.011.004c-.864.369-12.13 5.173-12.147 5.173-.017 0-.035 0-.052-.017-.03-.03 0-.072.027-.11a.76.76 0 0 0 .014-.02l4.482-6.94.008-.012c.026-.042.056-.089.104-.089l.045.007c.102.014.192.027.283.027.68 0 1.31-.331 1.69-.897a.16.16 0 0 1 .034-.04c.027-.02.067-.01.098.004zm-6.246 9.185l12.28-5.237s.018 0 .035.017c.067.067.124.112.179.154l.027.017c.025.014.05.03.052.056 0 .01 0 .016-.002.025L25.756 23.7l-.004.026c-.007.05-.014.107-.061.107a1.729 1.729 0 0 0-1.373.847l-.005.008c-.014.023-.027.045-.05.057-.021.01-.048.006-.07.001l-9.793-2.02c-.01-.002-.152-.519-.163-.52z"/> </svg>');
    $position = 24;

    global $netlifypress_options_page;
    $netlifypress_options_page = add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

/*
 * Admin Page Display
 */

function netlifypress_options_page_display() {

    /*
    * Save default settings
    */

    if ( ! empty( get_option( 'netlifypress_build_hook_url' ) ) ) {

        /* Auto Deploy Status */

        if ( ! get_option( 'netlifypress_auto_deploy' ) ) {
            add_option( 'netlifypress_auto_deploy', 'on' );
        }

        /* Make sure auto deploy is on before other settings are processed */

        if ( get_option( 'netlifypress_auto_deploy' ) == 'on' ) {

            /* Auto Deploy Actions */

            if ( ! get_option( 'netlifypress_action_auto_deploy' ) ) {
                add_option( 'netlifypress_action_auto_deploy', array(
                    'publish',
                    'update',
                    'trash'
                ) );
            }

            /* Auto Deploy Post Types */

            if ( ! get_option( 'netlifypress_post_types_auto_deploy' ) ) {
                add_option( 'netlifypress_post_types_auto_deploy', [ 'post', 'page' ] );
            }
        }

        /* Manual Deploy Status */

        if ( ! get_option( 'netlifypress_manual_deploy' ) ) {
            add_option( 'netlifypress_manual_deploy', 'on' );
        }

        /* Make sure manual deploy is on before other settings are processed */

        if ( get_option( 'netlifypress_manual_deploy' ) == 'on' ) {

            /* Auto Deploy Post Types */

            if ( ! get_option( 'netlifypress_auth_roles_manual_deploy' ) ) {
                add_option( 'netlifypress_auth_roles_manual_deploy', [ 'administrator' ] );
            }
        }
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized user' );
    }

    ?>
        <div class="netlifypress-admin-wrapper">
            <div class="container">
                <header class="netlifypress-admin-header">
                    <h1><?php echo __( 'NetlifyPress', 'deploy-netlifypress' ); ?></h1>
                    <?php
                        $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/deploy-netlifypress/deploy-netlifypress.php' );
                    ?>
                    <span class="plugin-version"><?php echo __( 'v', 'deploy-netlifypress' ) . $plugin_data[ 'Version' ]; ?></span>
                    <p><?php echo __( 'Seamlessly trigger deploys in Netlify from WordPress', 'deploy-netlifypress' ); ?></p>
                </header>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

                    <div class="row">
                        <ul class="netlifypress-admin-tabs nav col-md-4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="connect-netlify-tab" data-toggle="tab" href="#connect-netlify" role="tab" aria-controls="connect-netlify" aria-selected="true">
                                    <div class="row">
                                        <div class="tab-icon col-3"><i class="fas fa-link"></i></div>
                                        <div class="tab-label col-9"><?php _e( 'Connect with Netlify', 'deploy-netlifypress' ); ?></div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo empty( get_option( 'netlifypress_build_hook_url' ) ) ? 'disabled' : NULL ?>" id="deploy-configuration-tab" data-toggle="tab" href="#automatic-deployment" role="tab" aria-controls="automatic-deployment" aria-selected="false">
                                    <div class="row">
                                        <div class="tab-icon col-3"><i class="fas fa-robot"></i></div>
                                        <div class="tab-label col-9"><?php _e( 'Automatic Deployment', 'deploy-netlifypress' ); ?></div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo empty( get_option( 'netlifypress_build_hook_url' ) ) ? 'disabled' : NULL ?>" id="manual-configuration-tab" data-toggle="tab" href="#manual-deployment" role="tab" aria-controls="manual-deployment" aria-selected="false">
                                    <div class="row">
                                        <div class="tab-icon col-3"><i class="fas fa-mouse-pointer"></i></div>
                                        <div class="tab-label col-9"><?php _e( 'Manual Deployment', 'deploy-netlifypress' ); ?></div>
                                    </div>
                                </a>
                            </li>

                            <div class="netlifypress-save-settings">
                                <input type="hidden" name="action" value="netlifypress_options" />
                                <?php
                                    $netlifypress_admin_nonce = wp_create_nonce( 'netlifypress_admin_nonce' );
                                ?>
                                <input type="hidden" name="netlifypress_admin_nonce" value="<?php echo $netlifypress_admin_nonce; ?>" />
                                <button type="submit" class="btn btn-primary"><?php _e( 'Save Changes', 'deploy-netlifypress' ); ?></button>
                            </div>
                        </ul>

                        <div class="tab-content col-md-8">
                            <div class="tab-pane fade show active" id="connect-netlify" role="tabpanel" aria-labelledby="connect-netlify">
                                <fieldset>
                                    <div class="form-group">
                                        <h2><?php _e( 'Connect with Netlify', 'deploy-netlifypress' ); ?></h3>
                                        <p><?php _e( 'Enter your Netlify webhook URL to tell WordPress where to trigger deploys', 'deploy-netlifypress' ); ?></p>
                                        <label for="netlifypress_build_hook_url"><?php _e( 'Build Hook URL', 'deploy-netlifypress' ); ?></label>
                                        <input type="url" name="netlifypress_build_hook_url" id="netlifypress_build_hook_url" placeholder="e.g. https://api.netlify.com/build_hooks/XXXXXXXXXXXX" class="form-control" value="<?php echo esc_url( get_option( 'netlifypress_build_hook_url' ) ); ?>" required>
                                    </div>
                                </fieldset>
                            </div>

                            <?php if ( ! empty( get_option( 'netlifypress_build_hook_url' ) ) ) { ?>
                                <div class="tab-pane fade" id="automatic-deployment" role="tabpanel" aria-labelledby="automatic-deployment">
                                    <fieldset>
                                        <div class="form-group">
                                            <h2><?php _e( 'Automatic Deployment', 'deploy-netlifypress' ); ?></h3>
                                            <p><?php _e( 'Turn on if you want to trigger automated deploys on post actions', 'deploy-netlifypress' ); ?></p>

                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="netlifypress_auto_deploy" value="off">
                                                <input type="checkbox" class="custom-control-input" id="netlifypress_auto_deploy" name="netlifypress_auto_deploy" value="on" <?php echo checked( 'on', get_option( 'netlifypress_auto_deploy' ), true  ); ?>>
                                                <label class="custom-control-label" for="netlifypress_auto_deploy"> <?php _e( 'On', 'deploy-netlifypress' ); ?></label>
                                            </div>
                                        </div>

                                        <style>
                                            .auto-deploy-actions-post-types {
                                                <?php
                                                    if ( get_option( 'netlifypress_auto_deploy' ) == 'on' ) {
                                                        ?>
                                                            display: block;
                                                        <?php
                                                    } else {
                                                        ?>
                                                            display: none;
                                                        <?php
                                                    }
                                                ?>
                                            }
                                        </style>

                                        <div class="auto-deploy-actions-post-types">
                                            <div class="form-group auto-deploy-action-form-group">
                                                <h3><?php _e( 'Actions', 'deploy-netlifypress' ); ?></h3>
                                                <p><?php _e( 'Specify actions when automatic deployment should trigger', 'deploy-netlifypress' ); ?></p>

                                                <?php
                                                    $valid_auto_deploy_actions = array(
                                                        'publish',
                                                        'update',
                                                        'trash'
                                                    );
                                                ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_action_auto_deploy_all" <?php echo ( $valid_auto_deploy_actions == get_option( 'netlifypress_action_auto_deploy' ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_action_auto_deploy_all"> <?php _e( 'All', 'deploy-netlifypress' ); ?></label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_action_auto_deploy_publish" name="netlifypress_action_auto_deploy[]" value="publish" <?php echo in_array( 'publish', get_option( 'netlifypress_action_auto_deploy' ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_action_auto_deploy_publish"> <?php _e( 'On post publish', 'deploy-netlifypress' ); ?></label>
                                                </div>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_action_auto_deploy_update" name="netlifypress_action_auto_deploy[]" value="update" <?php echo in_array( 'update', get_option( 'netlifypress_action_auto_deploy' ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_action_auto_deploy_update"> <?php _e( 'On post update', 'deploy-netlifypress' ); ?></label>
                                                </div>
                                            
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_action_auto_deploy_trash" name="netlifypress_action_auto_deploy[]" value="trash" <?php echo in_array( 'trash', get_option( 'netlifypress_action_auto_deploy' ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_action_auto_deploy_trash"> <?php _e( 'On post trash', 'deploy-netlifypress' ); ?></label>
                                                </div>
                                            </div>

                                            <div class="form-group post-types-form-group">
                                                <h3><?php _e( 'Post Types', 'deploy-netlifypress' ); ?></h3>
                                                <p><?php _e( 'Specify post types where the above actions should apply', 'deploy-netlifypress' ); ?></p>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_post_type_all" <?php echo ( array_diff( get_post_types(), get_option( 'netlifypress_post_types_auto_deploy' ) ) === array_diff( get_option( 'netlifypress_post_types_auto_deploy' ), get_post_types() ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_post_type_all"> <?php _e( 'All', 'deploy-netlifypress' ); ?></label>
                                                </div>
                                                <?php
                                                    foreach ( get_post_types( '', 'objects' ) as $post_type ) {
                                                        ?>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="netlifypress_post_type_<?php echo $post_type->name; ?>" name="netlifypress_post_types_auto_deploy[]" value="<?php echo $post_type->name; ?>" <?php echo in_array( $post_type->name, get_option( 'netlifypress_post_types_auto_deploy' ) ) ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="netlifypress_post_type_<?php echo $post_type->name; ?>"> <?php echo $post_type->label; ?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </fieldset>    
                                </div>

                                <div class="tab-pane fade show" id="manual-deployment" role="tabpanel" aria-labelledby="manual-deployment">
                                    <fieldset>
                                        <div class="form-group">
                                            <h2><?php _e( 'Manual Deployment', 'deploy-netlifypress' ); ?></h3>
                                            <p><?php _e( 'Turn on if you want to have a manual deployment button on your top bar', 'deploy-netlifypress' ); ?></p>

                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="netlifypress_manual_deploy" value="off">
                                                <input type="checkbox" class="custom-control-input" id="netlifypress_manual_deploy" name="netlifypress_manual_deploy" value="on" <?php echo checked( 'on', get_option( 'netlifypress_manual_deploy' ), true  ); ?>>
                                                <label class="custom-control-label" for="netlifypress_manual_deploy"> <?php _e( 'On', 'deploy-netlifypress' ); ?></label>
                                            </div>
                                        </div>

                                        <style>
                                            .manual-deploy-authorized-roles {
                                                <?php
                                                    if ( get_option( 'netlifypress_manual_deploy' ) == 'on' ) {
                                                        ?>
                                                            display: block;
                                                        <?php
                                                    } else {
                                                        ?>
                                                            display: none;
                                                        <?php
                                                    }
                                                ?>
                                            }
                                        </style>

                                        <div class="manual-deploy-authorized-roles">
                                            <div class="form-group authorized-roles-form-group">
                                                <h3><?php _e( 'Authorized Roles', 'deploy-netlifypress' ); ?></h3>
                                                <p><?php _e( 'Specify user roles which can trigger manual deployments', 'deploy-netlifypress' ); ?></p>

                                                <?php
                                                    global $wp_roles;
                                                    $valid_user_roles = $wp_roles->get_names();
                                                ?>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="netlifypress_auth_role_all" <?php echo ( array_diff( array_keys( $valid_user_roles ), get_option( 'netlifypress_auth_roles_manual_deploy' ) ) === array_diff( get_option( 'netlifypress_auth_roles_manual_deploy' ), array_keys( $valid_user_roles ) ) ) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="netlifypress_auth_role_all"> <?php _e( 'All', 'deploy-netlifypress' ); ?></label>
                                                </div>
                                                <?php
                                                    foreach ( $valid_user_roles as $key => $user_role ) {
                                                        ?>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="netlifypress_auth_role_<?php echo $key; ?>" name="netlifypress_auth_roles_manual_deploy[]" value="<?php echo $key; ?>" <?php echo in_array( $key, get_option( 'netlifypress_auth_roles_manual_deploy' ) ) ? 'checked' : ''; ?>>
                                                            <label class="custom-control-label" for="netlifypress_auth_role_<?php echo $key; ?>"> <?php echo $user_role; ?></label>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </fieldset>    
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
}

/* 
 * After form submit
*/

add_action( 'admin_post_netlifypress_options', 'netlifypress_options_response' );
function netlifypress_options_response() {

    if( isset( $_POST['netlifypress_admin_nonce'] ) && wp_verify_nonce( $_POST['netlifypress_admin_nonce'], 'netlifypress_admin_nonce') ) {

        /* 
        * Form Sanitization and Processing
        */

        /* Webhook URL */

        if ( isset( $_POST[ 'netlifypress_build_hook_url' ] ) && ! empty( $_POST[ 'netlifypress_build_hook_url' ] ) ) {
            update_option( 'netlifypress_build_hook_url', esc_url_raw( $_POST[ 'netlifypress_build_hook_url' ] ) );
        }

        /* Make sure webhook URL is set before other settings are processed */

        if ( ! empty( get_option( 'netlifypress_build_hook_url' ) ) ) {

            /* Auto Deploy Status */

            $valid_auto_deploy_statuses = array(
                'off',
                'on'
            );

            if ( isset( $_POST[ 'netlifypress_auto_deploy' ] ) && ! empty( $_POST[ 'netlifypress_auto_deploy' ] )  ) {
                $auto_deploy_status = sanitize_text_field( $_POST[ 'netlifypress_auto_deploy' ] );

                if ( in_array( $auto_deploy_status, $valid_auto_deploy_statuses ) ) {
                    update_option( 'netlifypress_auto_deploy', $auto_deploy_status );
                }
            }

            /* Make sure auto deploy is on before other settings are processed */
    
            if ( get_option( 'netlifypress_auto_deploy' ) == 'on' ) {

                /* Auto Deploy Actions */

                $valid_auto_deploy_actions = array(
                    'publish',
                    'update',
                    'trash'
                );

                if ( isset( $_POST[ 'netlifypress_action_auto_deploy' ] ) && ! empty( $_POST[ 'netlifypress_action_auto_deploy' ] ) ) {
                    $action_auto_deploy = array_map( 'sanitize_text_field', $_POST[ 'netlifypress_action_auto_deploy' ] );

                    if ( ! empty( array_intersect( $action_auto_deploy, $valid_auto_deploy_actions ) ) ) {
                        update_option( 'netlifypress_action_auto_deploy', $action_auto_deploy );
                    }
                }

                /* Auto Deploy Post Types */

                $valid_post_types = get_post_types();

                if ( isset( $_POST[ 'netlifypress_post_types_auto_deploy' ] ) && ! empty( $_POST[ 'netlifypress_post_types_auto_deploy' ] ) ) {
                    $set_post_type = array_map( 'sanitize_text_field', $_POST[ 'netlifypress_post_types_auto_deploy' ] );

                    if ( ! empty( array_intersect( $set_post_type, $valid_post_types ) ) ) {
                        update_option( 'netlifypress_post_types_auto_deploy', $set_post_type );
                    }
                }
            }

            /* Manual Deploy Status */

            $valid_manual_deploy_statuses = array(
                'off',
                'on'
            );

            if ( isset( $_POST[ 'netlifypress_manual_deploy' ] ) && ! empty( $_POST[ 'netlifypress_manual_deploy' ] ) ) {
                $manual_deploy_status = sanitize_text_field( $_POST[ 'netlifypress_manual_deploy' ] );

                if ( in_array( $manual_deploy_status, $valid_manual_deploy_statuses ) ) {
                    update_option( 'netlifypress_manual_deploy', $manual_deploy_status );
                }
            }

            /* Make sure manual deploy is on before other settings are processed */
    
            if ( get_option( 'netlifypress_manual_deploy' ) == 'on' ) {

                /* Manual Deploy Authorized Roles */

                global $wp_roles;
                $valid_user_roles = array_keys( $wp_roles->get_names() );

                if ( isset( $_POST[ 'netlifypress_auth_roles_manual_deploy' ] ) && ! empty( $_POST[ 'netlifypress_auth_roles_manual_deploy' ] ) ) {
                    $set_auth_role = array_map( 'sanitize_text_field', $_POST[ 'netlifypress_auth_roles_manual_deploy' ] );

                    if ( ! empty( array_intersect( $set_auth_role, $valid_user_roles ) ) ) {
                        update_option( 'netlifypress_auth_roles_manual_deploy', $set_auth_role );
                    }
                }
            }
        }

        /* Redirect back to admin page with query strings for admin notices */

        wp_redirect(
            esc_url_raw(
                add_query_arg( array(
                    'netlifypress_admin_notice' => 'success',
                ),
                admin_url( 'admin.php?page=netlifypress_options' ) 
                )
            )
        );
        exit;
    }
}

/* 
 * Admin Notice(s)
*/

add_action( 'admin_notices', 'netlifypress_admin_notices' );
function netlifypress_admin_notices() {
    if ( isset( $_REQUEST[ 'netlifypress_admin_notice' ] ) ) {
        if( $_REQUEST[ 'netlifypress_admin_notice' ] === 'success' ) {
            echo '<div class="updated notice notice-success is-dismissible"> 
                    <p>Settings updated.</p>
                </div>';
        }
    }
}
