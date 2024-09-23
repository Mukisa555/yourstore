<?php
    if ( class_exists('WOOCS') && WC()->cart->is_empty() ) wp_enqueue_script( 'wc-cart-fragments' );
    $_id = urna_tbay_random_key();
    
    extract($args);

    $data_dropdown = ( is_checkout() || is_cart() ) ? '' : 'data-offcanvas="offcanvas-left" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0"';
?>
<div class="tbay-topcart">
 <div id="cart-<?php echo esc_attr($_id); ?>" class="cart-dropdown <?php echo ( !is_checkout() && !is_cart() ) ? 'dropdown' : '';  ?>">
        <a class="<?php echo ( !is_checkout() && !is_cart() ) ? 'dropdown-toggle v2' : '';  ?> mini-cart" <?php echo $data_dropdown; ?> href="<?php echo ( is_checkout() ) ? wc_get_cart_url() : 'javascript:void(0);'; ?>" title="<?php esc_attr_e('View your shopping cart', 'urna'); ?>">
			<?php  urna_tbay_minicart_button($icon_array, $show_title_mini_cart, $title_mini_cart, $price_mini_cart, $active_elementor_minicart); ?>
        </a>            
    </div>
</div>    

<?php 
    if( !is_checkout() && !is_cart() ) {
        urna_tbay_get_page_templates_parts('offcanvas-cart', 'left'); 
    }
?>