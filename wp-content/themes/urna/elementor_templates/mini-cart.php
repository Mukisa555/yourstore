<?php
/**
 * Templates Name: Elementor
 * Widget: Mini Cart
 */

if (null === WC()->cart) {
    return;
}

$this->add_render_attribute('wrapper', 'class', ['top-cart', 'hidden-xs']);
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
    <?php $this->render_woocommerce_mini_cart(); ?>
</div>