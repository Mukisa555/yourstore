<?php

if (!urna_is_Woocommerce_activated()) {
    return;
}

/**
 * Urna Template Hooks
 *
 * Action/filter hooks used for Urna functions/templates.
 *
 */

defined('ABSPATH') || exit;
/**
 * Product Add to cart.
 *
 * @see woocommerce_template_single_add_to_cart()
 * @see woocommerce_simple_add_to_cart()
 * @see woocommerce_grouped_add_to_cart()
 * @see woocommerce_variable_add_to_cart()
 * @see woocommerce_external_add_to_cart()
 * @see woocommerce_single_variation()
 * @see woocommerce_single_variation_add_to_cart_button()
 */
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30);
add_action('woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30);
add_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
add_action('woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30);
add_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
add_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);


/**
 * Product Quick View
 *
 * @see woocommerce_show_product_sale_flash()
 */
add_action('urna_before_image_quickview', 'woocommerce_show_product_sale_flash', 10);


/**
 *
 * @see woocommerce_template_single_excerpt()
 */
add_action('urna_shop_list_sort_description','woocommerce_template_single_excerpt', 5);



/**Fix duppitor image on elementor pro **/
if ( ! function_exists( 'urna_remove_shop_loop_item_title' ) ) {
    add_action( 'urna_content_product_item_before', 'urna_remove_shop_loop_item_title', 10 ); 
    function urna_remove_shop_loop_item_title() {
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); 
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    }
}