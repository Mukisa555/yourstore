<?php

if (!urna_is_woo_variation_swatches_pro()) {
    return;
}

if (!function_exists('urna_is_quantity_field_archive')) {
    function urna_is_quantity_field_archive()
    {
        global $product;

        if ($product && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually()) {
            $max_value = $product->get_max_purchase_quantity();
            $min_value = $product->get_min_purchase_quantity();

            if ($max_value && $min_value === $max_value) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('urna_quantity_swatches_pro_field_archive')) {
    function urna_quantity_swatches_pro_field_archive()
    {
        global $product;
        if (urna_is_quantity_field_archive()) {
            woocommerce_quantity_input(['min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity()]);
        }
    }
}

if (!function_exists('urna_variation_swatches_pro_group_button')) {
    function urna_variation_swatches_pro_group_button()
    {
        $class_active = '';

        if (!apply_filters('urna_quantity_mode', 10, 2)) {
            $class_active .= 'woo-swatches-pro-btn';
        }

        if (!apply_filters('urna_quantity_mode', 10, 2)) {
            echo '<div class="'.esc_attr($class_active).'">';
        }

        if (apply_filters('urna_quantity_mode', 10, 2)) {
            urna_quantity_swatches_pro_field_archive();
        }

        woocommerce_template_loop_add_to_cart();
        if (!apply_filters('urna_quantity_mode', 10, 2)) {
            echo '</div>';
        }
    }
    add_action('woocommerce_after_shop_loop_item', 'urna_variation_swatches_pro_group_button', 10);
}

if (!function_exists('urna_variation_enable_swatches')) {
    add_action('woocommerce_init', 'urna_variation_enable_swatches', 5);
    function urna_variation_enable_swatches()
    {
        $enable = wc_string_to_bool(woo_variation_swatches()->get_option('show_on_archive', 'yes'));
        $position = sanitize_text_field(woo_variation_swatches()->get_option('archive_swatches_position', 'after'));

        if (!$enable) {
            return;
        }

        if ('after' === $position) {
            add_action('woocommerce_after_shop_loop_item_title', [Woo_Variation_Swatches_Pro_Archive_Page::instance(), 'after_shop_loop_item'], 30);
        } else {
            add_action('woocommerce_after_shop_loop_item_title', [Woo_Variation_Swatches_Pro_Archive_Page::instance(), 'after_shop_loop_item'], 7);
        }
    }
}

if (class_exists('Woo_Variation_Swatches_Pro_Archive_Page')) {
    remove_action('woocommerce_init', [Woo_Variation_Swatches_Pro_Archive_Page::instance(), 'enable_swatches'], 1);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}
