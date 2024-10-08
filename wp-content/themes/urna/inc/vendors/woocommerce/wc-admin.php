<?php

if (!urna_is_Woocommerce_activated()) {
    return;
}

define('URNA_WOOCOMMERCE_ACTIVED', true);

// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
if (! function_exists('urna_add_custom_product_data_tab')) {
    add_filter('woocommerce_product_data_tabs', 'urna_add_custom_product_data_tab', 80);
    function urna_add_custom_product_data_tab($product_data_tabs)
    {
        $product_data_tabs['urna-options-tab'] = array(
          'label' => esc_html__('Urna Options', 'urna'),
          'target' => 'urna_product_data',
          'class'     => array(),
          'priority' => 100,
      );
        return $product_data_tabs;
    }
}


/*Add video to product detail*/
if ( !function_exists('urna_options_woocom_product_data_fields') ) {
    add_action( 'woocommerce_product_data_panels', 'urna_options_woocom_product_data_fields' );
  
    function urna_options_woocom_product_data_fields(){
  
      $args_video = apply_filters( 'urna_tbay_woocommerce_simple_url_video_args', array(
          'id' => '_video_url',
          'label' => esc_html__('Featured Video URL', 'urna'),
          'placeholder' => esc_html__('Video URL', 'urna'),
          'desc_tip' => true,
          'description' => esc_html__('Enter the video url at https://vimeo.com/ or https://www.youtube.com/', 'urna'))
      );
      $args_size_guide_type =  apply_filters( 'urna_tbay_woo_size_guide_type_args', array(
        'id'          => '_urna_size_guide_type',
        'label'       => esc_html__( 'Size Guide Type', 'urna' ),
        'options'     => array(
          'global'     => esc_html__( 'Global Setting', 'urna' ),
          'customize' => esc_html__( 'Customize', 'urna' ),
        ),
        'desc_tip'    => true,
        'description' => esc_html__( 'Global Setting is to choose Size Guide on the theme option', 'urna' ),
      ));

      $args_size_guide =  apply_filters( 'urna_tbay_woo_size_guide_args', array(
        'id'          => '_urna_size_guide', 
        'desc_tip'    => true,
        'label'       => esc_html__( 'Size Guide Customize', 'urna' ),
        'description' => esc_html__( 'Enter an optional shortcode or cusom text', 'urna' ),
        'wrapper_class'     => 'show_size_guide_customize',
      ));

      $args_delivery_type =  apply_filters( 'urna_tbay_woo_delivery_return_type_args', array(
        'id'          => '_urna_delivery_return_type',
        'label'       => esc_html__( 'Delivery Return Type', 'urna' ),
        'options'     => array(
          'global'     => esc_html__( 'Global Setting', 'urna' ),
          'customize' => esc_html__( 'Customize', 'urna' ),
        ),
        'desc_tip'    => true,
        'description' => esc_html__( 'Global Setting is to choose Delivery Return on the theme option', 'urna' ),
      ));

      $args_delivery =  apply_filters( 'urna_tbay_woo_delivery_return_args', array(
        'id'          => '_urna_delivery_return', 
        'desc_tip'    => true,
        'label'       => esc_html__( 'Delivery Return Customize', 'urna' ),
        'description' => esc_html__( 'Enter an optional shortcode or cusom text', 'urna' ),
        'wrapper_class'     => 'show_delivery_return_customize',
      ));
  
      echo '<div id="urna_product_data" class="panel woocommerce_options_panel"><div class="options_group">';
  
      ?>
      <div class="options_group">
      <?php
      woocommerce_wp_text_input( $args_video ) ;
      ?>
      </div><div class="options_group">
      <?php
        woocommerce_wp_select($args_size_guide_type); 

        woocommerce_wp_textarea_input( $args_size_guide );
      ?>
      </div><div class="options_group">
      <?php
        woocommerce_wp_select($args_delivery_type); 

        woocommerce_wp_textarea_input( $args_delivery ) ;
      ?>
      </div>
      <?php


      do_action( 'urna_woocommerce_options_product_data' );
      echo '</div></div>';
    }
  }
  
  if ( !function_exists('urna_options_woocom_save_proddata_custom_fields') ) {
    add_action( 'woocommerce_admin_process_product_object', 'urna_options_woocom_save_proddata_custom_fields', 10, 1 );
    function urna_options_woocom_save_proddata_custom_fields( $product ) {
        $video_url = isset($_POST['_video_url']) ? wp_unslash($_POST['_video_url']) : '';
        $old_value_url = $product->get_meta('_video_url');
 
        if ($video_url !== $old_value_url) {
          $product->update_meta_data('_video_url', $video_url);
        }

        $size_guide_type           = isset($_POST['_urna_size_guide_type']) ? wp_unslash($_POST['_urna_size_guide_type']) : '';
        $old_size_guide_type       = $product->get_meta('_urna_size_guide_type');

        $size_guide                = isset($_POST['_urna_size_guide']) ? wp_unslash($_POST['_urna_size_guide']) : '';
        $old_size_guide            = $product->get_meta('_urna_size_guide');

        $delivery_return_type                = isset($_POST['_urna_delivery_return_type']) ? wp_unslash($_POST['_urna_delivery_return_type']) : '';
        $old_delivery_return_type            = $product->get_meta('_urna_delivery_return_type');
        
        $delivery_return                = isset($_POST['_urna_delivery_return']) ? wp_unslash($_POST['_urna_delivery_return']) : '';
        $old_delivery_return            = $product->get_meta('_urna_delivery_return');

        if ($size_guide_type !== $old_size_guide_type) {
          $product->update_meta_data('_urna_size_guide_type', $size_guide_type);
        }

        if ($size_guide !== $old_size_guide) {
          $product->update_meta_data('_urna_size_guide', $size_guide);
        }

        if ($delivery_return_type !== $old_delivery_return_type) {
          $product->update_meta_data('_urna_delivery_return_type', $delivery_return_type);
        }
 
        if ($delivery_return !== $old_delivery_return) {
          $product->update_meta_data('_urna_delivery_return', $delivery_return);
        }

    }
  }

if (! function_exists('urna_options_woocom_save_proddata_custom_fields')) {
    /** Hook callback function to save custom fields information */
    function urna_options_woocom_save_proddata_custom_fields($product)
    {
        // Save Text Field
        $video_url = isset($_POST['_video_url']) ? $_POST['_video_url'] : '';
        $old_value_url = $product->get_meta('_video_url');
 
        if ($video_url !== $old_value_url) {
            $product->update_meta_data('_video_url', $video_url);
        }
    }

    add_action('woocommerce_admin_process_product_object', 'urna_options_woocom_save_proddata_custom_fields');
}

if (! function_exists('urna_size_guide_metabox_output')) {
    function urna_size_guide_metabox_output($post)
    {
        ?>
    <div id="product_size_guide_images_container">
      <ul class="product_size_guide_images">
        <?php
          $product_image = array();

        if (metadata_exists('post', $post->ID, '_product_size_guide_image')) {
            $product_image = get_post_meta($post->ID, '_product_size_guide_image', true);
        } else {
            // Backwards compat
            $attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_size_guide_image&meta_value=1');
            $attachment_ids = array_diff($attachment_ids, array( get_post_thumbnail_id() ));
            $product_image = implode(',', $attachment_ids);
        }

        $attachments         = array_reverse(array_filter(explode(',', $product_image)));
        $update_meta         = false;
        $updated_gallery_ids = array();

        if (! empty($attachments)) {
            foreach ($attachments as $key => $attachment_id) {
                if ($key != 0) {
                    unset($attachment_id);
                } else {
                    $attachment = wp_get_attachment_image($attachment_id, 'thumbnail');

                    // if attachment is empty skip
                    if (empty($attachment)) {
                        $update_meta = true;
                        continue;
                    }

                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
                  ' . $attachment . '
                  <ul class="actions">               
                    <li><a href="#" class="delete tips" data-tip="' . esc_attr__('Remove product image', 'urna') . '">' . esc_html__('Remove product image', 'urna') . '</a></li>
                  </ul>
                </li>';

                    // rebuild ids to be saved
                    $updated_gallery_ids[] = $attachment_id;
                }
            }

            // need to update product meta to set new gallery ids
            if ($update_meta) {
                update_post_meta($post->ID, '_product_size_guide_image', implode(',', $updated_gallery_ids));
            }
        } ?>
      </ul>

      <input type="hidden" id="product_size_guide_image" name="product_size_guide_image" value="<?php echo esc_attr($product_image); ?>" />

    </div>
    <p class="add_product_size_guide_images hide-if-no-js">
      <a href="#" data-choose="<?php esc_attr_e('Add Images to Product Size Guide', 'urna'); ?>" data-update="<?php esc_attr_e('Add to image', 'urna'); ?>" data-delete="<?php esc_attr_e('Delete image', 'urna'); ?>" data-text="<?php esc_attr_e('Remove product image', 'urna'); ?>"><?php esc_html_e('Add product Size Guide view images', 'urna'); ?></a>
    </p>
    <?php
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Save metaboxes
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('urna_proccess_size_guide_view_metabox')) {
    add_action('woocommerce_process_product_meta', 'urna_proccess_size_guide_view_metabox', 50, 2);
    function urna_proccess_size_guide_view_metabox($post_id, $post)
    {
        $attachment_ids = isset($_POST['product_size_guide_image']) ? array_filter(explode(',', wc_clean($_POST['product_size_guide_image']))) : array();

        update_post_meta($post_id, '_product_size_guide_image', implode(',', $attachment_ids));
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Returns the size guide image attachment ids.
 * ------------------------------------------------------------------------------------------------
 */
if (! function_exists('urna_get_size_guide_attachment_ids')) {
    function urna_get_size_guide_attachment_ids()
    {
        global $post;

        if (! $post) {
            return;
        }

        $product_image = get_post_meta($post->ID, '_product_size_guide_image', true);

        return apply_filters('woocommerce_product_size_guide_attachment_ids', array_filter(array_filter((array) explode(',', $product_image)), 'wp_attachment_is_image'));
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown template
if (! function_exists('urna_swatch_attribute_template')) {
    function urna_swatch_attribute_template($post)
    {
        global $post;


        $attribute_post_id = get_post_meta($post->ID, '_urna_attribute_select');
        $attribute_post_id = isset($attribute_post_id[0]) ? $attribute_post_id[0] : ''; ?>

          <select name="urna_attribute_select" class="urna_attribute_taxonomy">
            <option value="" selected="selected"><?php esc_html_e('Global Setting', 'urna'); ?></option>

              <?php

                global $wc_product_attributes;

        // Array of defined attribute taxonomies.
        $attribute_taxonomies = wc_get_attribute_taxonomies();

        if (! empty($attribute_taxonomies)) {
            foreach ($attribute_taxonomies as $tax) {
                $attribute_taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
                $label                   = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;

                echo '<option value="' . esc_attr($attribute_taxonomy_name) . '" '. selected($attribute_post_id, $attribute_taxonomy_name) .' >' . esc_html($label) . '</option>';
            }
        } ?>

          </select>

        <?php
    }
}


//Dropdown Save
if (! function_exists('urna_attribute_dropdown_save')) {
    add_action('woocommerce_process_product_meta', 'urna_attribute_dropdown_save', 30, 2);

    function urna_attribute_dropdown_save($post_id)
    {
        if (isset($_POST['urna_attribute_select'])) {
            update_post_meta($post_id, '_urna_attribute_select', $_POST['urna_attribute_select']);
        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown Single layout template
if (! function_exists('urna_single_select_single_layout_template')) {
    function urna_single_select_single_layout_template($post)
    {
        global $post;


        $layout_post_id = get_post_meta($post->ID, '_urna_single_layout_select');
        $layout_post_id = isset($layout_post_id[0]) ? $layout_post_id[0] : ''; ?>

          <select name="urna_layout_select" class="urna_single_layout_taxonomy">
            <option value="" selected="selected"><?php esc_html_e('Global Setting', 'urna'); ?></option>

              <?php

                global $wc_product_attributes;



        // Array of defined attribute taxonomies.
        $attribute_taxonomies = wc_get_attribute_taxonomies();



        $layout_selects = apply_filters('urna_layout_select_filters', array(
                    'full-width-vertical'   => esc_html__('Image Vertical', 'urna'),
                    'full-width-horizontal' => esc_html__('Image Horizontal', 'urna'),
                    'full-width-stick'      => esc_html__('Image Stick', 'urna'),
                    'full-width-gallery'    => esc_html__('Image Gallery', 'urna'),
                    'full-width-carousel'   => esc_html__('Image Carousel', 'urna'),
                    'full-width-full'       => esc_html__('Image Full', 'urna'),
                    'full-width-centered'   => esc_html__('Image Centered', 'urna'),
                    'left-main'             => esc_html__('Left - Main Sidebar', 'urna'),
                    'main-right'            => esc_html__('Main - Right Sidebar', 'urna')
                  ));

        foreach ($layout_selects as $key => $select) {
            echo '<option value="' . esc_attr($key) . '" '. selected($layout_post_id, $key) .' >' . esc_html($select) . '</option>';
        } ?>

          </select>

        <?php
    }
}


//Dropdown Save
if (! function_exists('urna_single_select_dropdown_save')) {
    add_action('woocommerce_process_product_meta', 'urna_single_select_dropdown_save', 30, 2);

    function urna_single_select_dropdown_save($post_id)
    {
        if (isset($_POST['urna_layout_select'])) {
            update_post_meta($post_id, '_urna_single_layout_select', $_POST['urna_layout_select']);
        }
    }
}
