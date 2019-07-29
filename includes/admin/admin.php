<?php
/**
 * Admin Pages
 *
 * @since      1.0
 * @package    NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

add_action( 'admin_menu', 'netlifypress_setup_options_page' );
function netlifypress_setup_options_page() {
    $page_title = __( 'NetlifyPress', 'netlifypress' );
    $menu_title = __( 'NetlifyPress', 'netlifypress' );
    $capability = 'manage_options';
    $menu_slug = 'netlifypress_options';
    $function = 'netlifypress_options_page_display';
    $icon_url = '';
    $position = 24;

    global $netlifypress_options_page;
    $netlifypress_options_page = add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

function netlifypress_options_page_display() {
    if ( !current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized user' );
    }
    ?>
        <div class="netlifypress-admin-wrapper">
            <div class="container">
                <form method="post">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="connect-netlify-tab" data-toggle="tab" href="#connect-netlify" role="tab" aria-controls="connect-netlify" aria-selected="true"><?php _e( 'Connect with Netlify', 'netlifypress' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="deploy-configuration-tab" data-toggle="tab" href="#deploy-configuration" role="tab" aria-controls="deploy-configuration" aria-selected="false"><?php _e( 'Deploy Configuration', 'netlifypress' ); ?></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="connect-netlify" role="tabpanel" aria-labelledby="connect-netlify">
                            <?php
                                if ( isset( $_POST[ 'netlifypress_webhook_url' ] ) ) {
                                    update_option( 'netlifypress_webhook_url', $_POST[ 'netlifypress_webhook_url' ] );
                                }
                            ?>
                            <label for="netlifypress_webhook_url"><?php _e( 'Webhook URL', 'netlifypress' ); ?></label>
                            <input type="text" name="webhook_url" id="webhook_url" placeholder="e.g. https://api.netlify.com/build_hooks/XXXXXXXXXXXX" class="form-control" value="<?php echo get_option( 'netlifypress_webhook_url' ); ?>" required>
                        </div>

                        <div class="tab-pane fade" id="deploy-configuration" role="tabpanel" aria-labelledby="deploy-configuration">
                            <label for="auto_deploy"><?php _e( 'Automatic Deployments', 'netlifypress' ); ?></label>
                            <input type="radio" name="auto_deploy" id="auto_deploy" value="No"> No
                            <input type="radio" name="auto_deploy" id="auto_deploy" value="Yes"> Yes

                            <label for="post_types"><?php _e( 'Post Types', 'netlifypress' ); ?></label>
                            <?php
                                foreach ( get_post_types( '', 'objects' ) as $post_type ) {
                                    echo '<input type="checkbox" name="post_types" id="post_types" value="' . $post_type->name . '">' . $post_type->label;
                                }
                            ?>
                        </div>
                    </div>

                    <input type="hidden" name="action" value="update" />
                    <?php wp_nonce_field( 'netlifypress_update_action' ); ?>
                    <button type="submit" class="btn btn-primary"><?php _e( 'Save Changes', 'netlifypress' ); ?></button>
                </form>
            </div>
        </div>
    <?php
}
