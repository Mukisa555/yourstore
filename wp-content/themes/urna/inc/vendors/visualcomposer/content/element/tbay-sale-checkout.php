<?php
/**
* ------------------------------------------------------------------------------------------------
* urna Product Recently Viewed map
* ------------------------------------------------------------------------------------------------
*/

if (!function_exists('urna_vc_map_tbay_safe_checkout')) {
    function urna_vc_map_tbay_safe_checkout()
    {

        $params = array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "value" => esc_html__( 'Guaranteed Safe Checkout', 'urna' ),
                "heading" => esc_html__('Title', 'urna'),
                "param_name" => "title",
            ),
            array(
                "type" => "attach_image",
                "param_name" => "image",
                "value" => '',
                'heading'	=> esc_html__('Image', 'urna' )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'list elements', 'urna' ),
                'param_name' => 'list_elements',
                'description' => '',
                'value' => rawurlencode( wp_json_encode( array(
                    array(
                        'title' => esc_html__( 'Free', 'urna' ),
                        'subtitle' => esc_html__( 'Worldwide Shopping', 'urna' ),
                    ),
                    array(
                        'title' => esc_html__( '100%', 'urna' ),
                        'subtitle' => esc_html__( 'Guaranteed Satisfaction', 'urna' ),
                    ),
                    array(
                        'title' => esc_html__( '30 Day', 'urna' ),
                        'subtitle' => esc_html__( 'Guaranteed Money Back', 'urna' ),
                    ),
                ) ) ),
                'params' => array(
                    array(
                        "type" => "textfield",
                        "param_name" => "title",
                        "holder" => "div",
                        "heading" => esc_html__('Title', 'urna'),
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "param_name" => "subtitle",
                        "heading" => esc_html__('Sub Title', 'urna'),
                    ),
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Safe checkout custom background color', 'urna' ),
                'param_name' => 'custombgcolor',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Safe checkout custom text color', 'urna' ),
                'param_name' => 'customtxtcolor',
            ),
        );

        $last_params = array(
            vc_map_add_css_animation(true),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS box', 'urna'),
                'param_name' => 'css',
                'group' => esc_html__('Design Options', 'urna'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'urna'),
                'param_name' => 'el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'urna')
            )
        );

        $params = array_merge($params, $last_params);

        vc_map(array(
            "name" => esc_html__('Urna Safe Checkout', 'urna'),
            "base" => "tbay_safe_checkout",
            "icon" => "vc-icon-urna",
            "category" => esc_html__('Tbay Widgets', 'urna'),
            "params" => $params
        ));
    }
    add_action('vc_before_init', 'urna_vc_map_tbay_safe_checkout');
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tbay_safe_checkout extends WPBakeryShortCode{}
}
