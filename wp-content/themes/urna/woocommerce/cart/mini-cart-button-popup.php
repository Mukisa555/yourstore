<?php
    if ( class_exists('WOOCS') && WC()->cart->is_empty() ) wp_enqueue_script( 'wc-cart-fragments' );
    $_id = urna_tbay_random_key();

    extract($args);

	$data_dropdown = ( is_checkout() || is_cart() ) ? '' : 'data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0"';
?>
<div class="tbay-topcart">
 <div id="cart-<?php echo esc_attr($_id); ?>" class="cart-dropdown cart-popup <?php echo ( !is_checkout() && !is_cart() ) ? 'dropdown' : '';  ?>">
        <a class="<?php echo ( !is_checkout() && !is_cart() ) ? 'dropdown-toggle' : '';  ?> mini-cart" <?php echo $data_dropdown; ?> href="<?php echo ( is_checkout() ) ? wc_get_cart_url() : 'javascript:void(0);'; ?>" title="<?php esc_attr_e('View your shopping cart', 'urna'); ?>">
	        <?php  urna_tbay_minicart_button($icon_array, $show_title_mini_cart, $title_mini_cart, $price_mini_cart, $active_elementor_minicart); ?>
        </a>      

        <?php if( !is_checkout() && !is_cart() ) : ?>      
        <div class="dropdown-menu">
        	<div class="widget-header-cart">
				<h3 class="widget-title heading-title"><?php esc_html_e('Shopping cart', 'urna'); ?></h3>
				<a href="javascript:;" class="offcanvas-close"><i class="linear-icon-cross"></i></a>
			</div>
			
			<div class="widget_shopping_cart_content">
				<?php woocommerce_mini_cart(); ?>
			</div>
    	</div>
    	<?php endif; ?>
    </div>
</div>    