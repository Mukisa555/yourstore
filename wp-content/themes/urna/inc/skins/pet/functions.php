<?php

if (!function_exists('urna_tbay_private_size_image_setup')) {
    function urna_tbay_private_size_image_setup()
    {
        // Post Thumbnails Size
        set_post_thumbnail_size(310, 180, true); // Unlimited height, soft crop

        if (!urna_tbay_get_global_config('config_media', false)) {
            update_option('thumbnail_size_w', 465);
            update_option('thumbnail_size_h', 270);

            update_option('medium_size_w', 570);
            update_option('medium_size_h', 330);

            update_option('large_size_w', 770);
            update_option('large_size_h', 440);
        }
    }
    add_action('after_setup_theme', 'urna_tbay_private_size_image_setup');
}

if (!function_exists('urna_tbay_private_menu_setup')) {
    function urna_tbay_private_menu_setup()
    {
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'urna'),
            'mobile-menu' => esc_html__('Mobile Menu', 'urna'),
            'nav-category-menu' => esc_html__('Nav Category Menu', 'urna'),
            'track-order' => esc_html__('Tracking Order Menu', 'urna'),
        ]);
    }
    add_action('after_setup_theme', 'urna_tbay_private_menu_setup');
}

/*
 *  Include Load Google Front
 */

if (!function_exists('urna_fonts_url')) {
    function urna_fonts_url()
    {
        /**
         * Load Google Front.
         */
        $fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Montserrat, translate this to 'off'. Do not translate
        * into your own language.
        */
        $Poppins = _x('on', 'Poppins font: on or off', 'urna');
        $Fredoka_One = _x('on', 'Fredoka One font: on or off', 'urna');
        if ('off' !== $Poppins || 'off' !== $Fredoka_One) {
            $font_families = [];

            if ('off' !== $Poppins) {
                $font_families[] = 'Poppins:400,500,600,700';
            }
            if ('off' !== $Fredoka_One) {
                $font_families[] = 'Fredoka One:400';
            }

            $query_args = [
                'family' => rawurlencode(implode('|', $font_families)),
                'subset' => urlencode('latin,latin-ext'),
                'display' => urlencode('swap'),
            ];

            $protocol = is_ssl() ? 'https:' : 'http:';
            $fonts_url = add_query_arg($query_args, $protocol.'//fonts.googleapis.com/css');
        }

        return esc_url_raw($fonts_url);
    }
}

if (!function_exists('urna_tbay_fonts_url')) {
    function urna_tbay_fonts_url()
    {
        $protocol = is_ssl() ? 'https:' : 'http:';
        $show_typography = urna_tbay_get_config('show_typography', false);
        $font_source = urna_tbay_get_config('font_source', '1');
        $font_google_code = urna_tbay_get_config('font_google_code');
        if (!$show_typography) {
            wp_enqueue_style('urna-theme-fonts', urna_fonts_url(), [], null);
        } elseif ($font_source == '2' && !empty($font_google_code)) {
            wp_enqueue_style('urna-theme-fonts', $font_google_code, [], null);
        }
    }
    add_action('wp_enqueue_scripts', 'urna_tbay_fonts_url');
}

if (!function_exists('urna_skin_tbay_add_text')) {
    function urna_skin_tbay_add_text()
    {
        $output = esc_html_e('Compare', 'urna');

        return trim($output);
    }
    add_filter('urna_get_text_compare', 'urna_skin_tbay_add_text', 2);
}
