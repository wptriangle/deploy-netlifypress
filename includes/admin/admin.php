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
            <form method="post">
                <?php
                    if ( isset( $_POST[ 'webhook_url' ] ) ) {
                        update_option( 'webhook_url', $_POST[ 'webhook_url' ] );
                    }
                ?>
                <label for="webhook_url"><?php _e( 'Webhook URL', 'netlifypress' ); ?></label>
                <input type="text" name="webhook_url" id="webhook_url" placeholder="e.g. https://api.netlify.com/build_hooks/XXXXXXXXXXXX" class="form-control" value="<?php echo get_option( 'webhook_url' ); ?>" required>

                <label for=""><?php _e( 'Post Types', 'netlifypress' ); ?></label>
                <?php
                    foreach ( get_post_types( '', 'objects' ) as $post_type ) {
                        echo '<input type="checkbox" name="post_types" id="post_types" value="' . $post_type->name . '">' . $post_type->label;
                    }
                ?>

                <input type="hidden" name="action" value="update" />
                <?php wp_nonce_field( 'netlifypress_update_action' ); ?>
                <button type="submit" class="btn btn-primary"><?php _e( 'Save Changes', 'netlifypress' ); ?></button>
            </form>
        </div>
    <?php
}
