<?php
if ( !urna_is_customize_checkout_payment() ) {
    remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    add_action('woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20);
}