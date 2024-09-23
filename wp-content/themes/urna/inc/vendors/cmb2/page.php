<?php

if (!function_exists('urna_tbay_page_metaboxes')) {
    function urna_tbay_page_metaboxes(array $metaboxes)
    {
        global $wp_registered_sidebars;
        $sidebars = [];

        if (!empty($wp_registered_sidebars)) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }

        $footers = array_merge(['global' => esc_html__('Global Setting', 'urna')], urna_tbay_get_footer_layouts());

        $prefix = 'tbay_page_';
        $fields = [
            [
                'name' => esc_html__('Select Layout', 'urna'),
                'id' => $prefix.'layout',
                'type' => 'select',
                'options' => [
                    'main' => esc_html__('Main Content Only', 'urna'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'urna'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'urna'),
                    'left-main-right' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'urna'),
                ],
            ],
            [
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'urna'),
                'options' => $sidebars,
            ],
            [
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'urna'),
                'options' => $sidebars,
            ],
            [
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'urna'),
                'options' => [
                    'no' => esc_html__('No', 'urna'),
                    'yes' => esc_html__('Yes', 'urna'),
                ],
                'default' => 'yes',
            ],
            [
                'id' => $prefix.'show_page_title',
                'type' => 'select',
                'name' => esc_html__('Show Page Title?', 'urna'),
                'desc'      => esc_html__('The page title is automatically displayed if Breadcrumb is not shown', 'urna'),
                'options' => [
                    'no' => esc_html__('No', 'urna'),
                    'yes' => esc_html__('Yes', 'urna'),
                ],
                'default' => 'yes',
            ],
            [
                'name' => esc_html__('Select Breadcrumbs Layout', 'urna'),
                'id' => $prefix.'breadcrumbs_layout',
                'type' => 'select',
                'options' => [
                    'image' => esc_html__('Background Image', 'urna'),
                    'color' => esc_html__('Background color', 'urna'),
                    'text' => esc_html__('Just text', 'urna'),
                ],
                'default' => 'color',
            ],
            [
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'urna'),
            ],
            [
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'urna'),
            ],
        ];

        $after_array = [
            [
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'urna'),
                'description' => esc_html__('Choose a footer for your website.', 'urna'),
                'options' => $footers,
                'default' => 'global',
            ],
            [
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'urna'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'urna'),
            ],
        ];
        $fields = array_merge($fields, $after_array);

        $metaboxes[$prefix.'display_setting'] = [
            'id' => $prefix.'display_setting',
            'title' => esc_html__('Display Settings', 'urna'),
            'object_types' => ['page'],
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'fields' => $fields,
        ];

        return $metaboxes;
    }
}
add_filter('cmb2_meta_boxes', 'urna_tbay_page_metaboxes');

if (!function_exists('urna_tbay_cmb2_style')) {
    function urna_tbay_cmb2_style()
    {
        wp_enqueue_style('urna-cmb2-style', URNA_THEME_DIR.'/inc/vendors/cmb2/assets/style.css', [], '1.0');
    }
}
add_action('admin_enqueue_scripts', 'urna_tbay_cmb2_style');
