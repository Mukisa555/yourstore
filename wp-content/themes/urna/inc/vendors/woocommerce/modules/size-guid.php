<?php
if ( !urna_is_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * Size Guide button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('urna_the_size_guide')) {
    function urna_the_size_guide($product_id)
    {
        $size_guide_type     = maybe_unserialize(get_post_meta($product_id, '_urna_size_guide_type', true));

        if( !empty($size_guide_type) && $size_guide_type !== 'global' ) {
            $size_guide          = maybe_unserialize(get_post_meta($product_id, '_urna_size_guide', true));
        } else {
            $size_guide          = maybe_unserialize(urna_tbay_get_config('single_size_guide'));
        } 

        if( empty(trim($size_guide)) ) return;

        $heading    = apply_filters('urna_woo_product_size_guide_heading', esc_html__('Size Guide', 'urna'));
        $icon       = apply_filters('urna_woo_product_size_guide_icon_class', 'tb-icon tb-icon-z-size-guide');
        
        wp_enqueue_script('jquery-magnific-popup');
        wp_enqueue_style('magnific-popup');
        ?>
        <li class="item tbay-size-guide">
            <a href="#tbay-content-size-guide" class="popup-button-open">
                <i class="<?php echo esc_attr($icon); ?>"></i>
                <span><?php echo esc_html($heading); ?></span>
            </a>
            <div id="tbay-content-size-guide" class="tbay-popup-content tbay-popup-size-guid zoom-anim-dialog mfp-hide">
                <div class="content">
                    <h3 class="tbay-headling-popup"><?php echo esc_html($heading); ?></h3>
                    <?php echo do_shortcode($size_guide); ?>
                </div>
            </div>
        </li>
        <?php
    }
}