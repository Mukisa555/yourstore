<?php
if ( !urna_is_woocommerce_activated() ) return;

/**
 * ------------------------------------------------------------------------------------------------
 * Size Guide button
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('urna_the_aska_question')) {
    function urna_the_aska_question( $product_id )
    {
        $aska_question          = maybe_unserialize(urna_tbay_get_config('single_aska_question'));

        if( empty(trim($aska_question)) ) return;
        
        wp_enqueue_script('jquery-magnific-popup');
        wp_enqueue_style('magnific-popup');

        $product    = wc_get_product( $product_id );
        $image_id   = $product->get_image_id();
        $image      = wp_get_attachment_image( $image_id, 'woocommerce_thumbnail' );

        $heading    = apply_filters('urna_woo_product_ask_a_question_heading', esc_html__('Ask a Question', 'urna'));
        $icon       = apply_filters('urna_woo_product_ask_a_question_icon_class', 'tb-icon tb-icon-z-question');

        ?>
        <li class="item tbay-aska-question">
            <a href="#tbay-content-aska-question" class="popup-button-open">
                <i class="<?php echo esc_attr($icon); ?>"></i>
                <span><?php echo esc_html($heading); ?></span>
            </a>
            <div id="tbay-content-aska-question" class="tbay-popup-content popup-aska-question zoom-anim-dialog mfp-hide">
                <div class="content">
                    <h3 class="tbay-headling-popup"><?php echo esc_html($heading); ?></h3>
                    <div class="tbay-product media">
                        <div class="image media-left">
                            <?php echo trim($image); ?>  
                        </div>
                        <div class="product-info media-body">
                            <h4 class="name"><?php echo trim($product->get_name()); ?></h4>
                            <span class="price"><?php echo trim($product->get_price_html()); ?></span>
                        </div>
                    </div>
                    <div class="tbay-wrap">
                        <?php echo do_shortcode($aska_question); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
}