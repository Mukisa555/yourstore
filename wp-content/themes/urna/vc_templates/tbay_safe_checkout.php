<?php
$bgcolor = $title = $image = $list_elements = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

$class_to_filter = 'widget widget-text-safe-checkout safe_custom';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

echo '<style type="text/css" data-type="vc_custom-css">';
?>
    <?php if( !empty($custombgcolor) ) : ?>
        .safe-checkout__title,
        .safe-checkout__lists {
            background: <?php echo trim($custombgcolor); ?>;
        }
    <?php endif; ?>

    <?php if( !empty($customtxtcolor) ) : ?>
        .safe-checkout__title,
        .safe-checkout__item-title, 
        .safe-checkout__item-description {
            color: <?php echo trim($customtxtcolor); ?>;
        }
    <?php endif; ?>

<?php
echo '</style>';

?>
<div class="<?php echo esc_attr($css_class);?>">

    <div class="safe-checkout__content">
        <div class="safe-checkout__widget-title-wrapper">
            <?php if( (isset($subtitle) && $subtitle) || (isset($title) && $title)  ): ?>
                <h3 class="safe-checkout__title">
                    <?php if ( isset($title) && $title ): ?>
                        <span><?php echo esc_html( $title ); ?></span>
                    <?php endif; ?>
                </h3>
            <?php endif; ?>

            <?php if( !empty($image) ) : ?>
                <div class="safe-checkout__img-wrapper">
                    <?php 
                        echo wp_get_attachment_image( $image, 'full', false, array( "class" => "safe-checkout__img" ) );
                    ?> 
                </div>
            <?php endif; ?>
        </div>

        <div class="safe-checkout__lists">
            <?php 
                $list_elements = (array) vc_param_group_parse_atts( $list_elements );
            ?>
            <?php foreach ($list_elements as $element) : ?>
                <div class="safe-checkout__item">
                    <?php if( !empty( $element['title'] ) ) : ?> 
                        <h4 class="safe-checkout__item-title"><?php echo trim($element['title']); ?></h4>
                    <?php endif; ?> 

                    <?php if( !empty( $element['subtitle'] ) ) : ?>
                        <p class="safe-checkout__item-description"><?php echo trim($element['subtitle']); ?></p>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>