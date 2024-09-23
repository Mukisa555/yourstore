<?php
if ( !urna_is_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * Size Guide button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('urna_the_delivery_return')) {
    function urna_the_delivery_return($product_id)
    {
        $delivery_return_type     = maybe_unserialize(get_post_meta($product_id, '_urna_delivery_return_type', true));

        if( !empty($delivery_return_type) && $delivery_return_type !== 'global' ) {
            $delivery_return          = maybe_unserialize(get_post_meta($product_id, '_urna_delivery_return', true));
            
        } else {
            $delivery_return          = maybe_unserialize(urna_tbay_get_config('single_delivery_return'));
        }

        if( empty(trim($delivery_return)) ) return;

        $heading    = apply_filters('urna_woo_product_delivery_return_heading', esc_html__('Delivery Return', 'urna'));
        $icon       = apply_filters('urna_woo_product_delivery_return_icon_class', 'tb-icon tb-icon-z-question');
        
        wp_enqueue_script('jquery-magnific-popup');
        wp_enqueue_style('magnific-popup');
        ?>
        <li class="item tbay-delivery-return">
            <a href="#tbay-content-delivery-return" class="popup-button-open">
                <i class="<?php echo esc_attr($icon); ?>"></i>
                <span><?php echo esc_html($heading); ?></span>
            </a>
            <div id="tbay-content-delivery-return" class="tbay-popup-content zoom-anim-dialog mfp-hide">
                <div class="content">
                    <?php echo do_shortcode($delivery_return); ?>
                </div>
            </div>
        </li>
        <?php
    }
}