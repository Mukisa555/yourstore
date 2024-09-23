<?php
    if (!(defined('URNA_WOOCOMMERCE_ACTIVED') && URNA_WOOCOMMERCE_ACTIVED) || is_user_logged_in() || is_account_page() || urna_page_disable_login_popup() ) {
        return;
    }

    if( urna_tbay_get_config('select-header-page', 'default') === 'default' ) {
        $show_login         = urna_tbay_get_config('show_login', true);
        $show_login_popup   = urna_tbay_get_config('show_login_popup', true);

        if( !$show_login || !$show_login_popup ) return;
    }

    if ( class_exists('WeDevs_Dokan') && !is_user_logged_in() ) {
        dokan()->scripts->load_form_validate_script();
        wp_enqueue_script( 'dokan-vendor-registration' );
    }

    do_action('urna_woocommerce_before_customer_login_form');
?>

<div id="custom-login-wrapper" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><i class="linear-icon-cross"></i></button>
            <div class="modal-body">
                <?php echo do_shortcode('[woocommerce_my_account]'); ?>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'urna_woocommerce_after_customer_login_form' ); ?>