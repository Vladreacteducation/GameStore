<?php


// Add a new tab to the product data metabox in WooCommerce

// Add a new tab to the product data metabox in WooCommerce
add_filter('woocommerce_product_data_tabs','add_gamestore_tab');
function add_gamestore_tab($tabs){
  $tabs['gamestore'] = array(
    'label' => 'GameStore',
    'target' => 'gamestore_product_data',
    'class' => array('show_if_simple','show_if_variable'),
    'priority' => 21,
  );
  return $tabs;
}

add_action('woocommerce_product_data_panels', 'add_gamestore_tab_content');

// Add content to the new tab (metabox)
function add_gamestore_tab_content(){

  global $post;
  
  echo '<div id="gamestore_product_data" class="panel woocommerce_options_panel">';
    echo '<div class="options_group">';

      // Simple Text field
      woocommerce_wp_text_input(
        array(
          'id' => '_gamestore_publisher',
          'label' => __('Publisher','core-gamestore'),
          'description' => __('Enter the Publisher of the game.','core-gamestore'),
          'desc_tip' => true,
          'placehoder' => 'e.g. Ubisoft'
        )
      );

      woocommerce_wp_text_input(
        array(
          'id' => '_gamestore_single_player',
          'label' => __('Single Player','core-gamestore'),
          'description' => __('Enter the Single Player value.','core-gamestore'),
          'desc_tip' => true,
          'placehoder' => 'e.g. Yes'
        )
      );

      woocommerce_wp_text_input(
        array(
          'id' => '_gamestore_release_date',
          'label' => __('Release Date', 'core-gamestore'),
          'description' => __('Enter the release date of the game.', 'core-gamestore'),
          'desc_tip' => false,
          'type' => 'date',
        )
      );

      // Multicheckbox field
      echo '<p class="form-field"><label><strong>'. __('Select Platforms','core-gamestore') .'</strong></label>';
        $platforms = array('Xbox', 'PC', 'PlayStation');
        foreach($platforms as $platform){
          woocommerce_wp_checkbox(
            array(
              'id' => '_platform_'.strtolower($platform),
              'label' => $platform,
              'description' => sprintf(__('Available on %s', 'core-gamestore'),$platform),
            )
          );
        }
      echo '</p>';

      // Image Upload field
      $image = get_post_meta($post->ID, '_gamestore_image', true);
      ?>
      <p class="form-field">
        <label for="_gamestore_image"><?php _e('Game Image', 'core-gamestore'); ?></label>
        <input type="text" class="short" name="_gamestore_image" id="_gamestore_image" value="<?php echo esc_attr($image); ?>" />
        <button type="button" class="upload_image_button button"><?php _e('Upload/Add image', 'core-gamestore'); ?></button>
      </p>
      <script type="text/javascript">
        jQuery(document).ready(function($){
          $('.upload_image_button').click(function(e) {
            e.preventDefault();
            var button = $(this);
            var custom_uploader = wp.media({
              title: 'Insert image',
              library : {
                type : 'image'
              },
              button: {
                text: 'Use this image'
              },
              multiple: false
            }).on('select', function() {
              var attachment = custom_uploader.state().get('selection').first().toJSON();
              button.prev().val(attachment.url);
            }).open();
          });
        });
      </script>
      <?php

    echo '</div>';
  echo '</div>';
}

add_action('woocommerce_process_product_meta', 'save_gamestore_tab_fields');
function save_gamestore_tab_fields($post_id){

  if(isset($_POST['_gamestore_publisher'])){
    update_post_meta($post_id, '_gamestore_publisher', sanitize_text_field($_POST['_gamestore_publisher']));
  }

  if(isset($_POST['_gamestore_single_player'])){
    update_post_meta($post_id, '_gamestore_single_player', sanitize_text_field($_POST['_gamestore_single_player']));
  }

  if(isset($_POST['_gamestore_release_date'])){
    $release_date = isset($_POST['_gamestore_release_date']) ? sanitize_text_field($_POST['_gamestore_release_date']) : '';
    update_post_meta($post_id, '_gamestore_release_date', $release_date);
  }


  $platforms = array('Xbox', 'PC', 'PlayStation');
  foreach($platforms as $platform){
    $checkbox_value = isset($_POST['_platform_'.strtolower($platform)]) ? 'yes' : 'no';
    update_post_meta($post_id, '_platform_'.strtolower($platform), $checkbox_value);
  }

  $image = isset($_POST['_gamestore_image']) ? sanitize_text_field($_POST['_gamestore_image']) : '';
  update_post_meta($post_id, '_gamestore_image', $image);

}

function woo_custom_description_metabox(){
  add_meta_box(
    'woo_custom_description_metabox',
    __('Game Description', 'core-gamestore'),
    'woo_custom_description_metabox_content',
    'product',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'woo_custom_description_metabox');

function woo_custom_description_metabox_content($post){
  $content = get_post_meta($post->ID, '_gamestore_full_description', true);
  wp_editor($content, 'gamestore_full_description', array('textarea_name' => 'gamestore_full_description'));
}

function save_custom_description($post_id){
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if(!isset($_POST['gamestore_full_description'])) return;
  if(!current_user_can('edit_post', $post_id)) return;

  if(isset($_POST['gamestore_full_description'])){
    update_post_meta($post_id, '_gamestore_full_description', wp_kses_post($_POST['gamestore_full_description']));
  }
}
add_action('save_post', 'save_custom_description');