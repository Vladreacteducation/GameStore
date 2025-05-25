<?php


function news_category_add_meta_field($taxonomy) {
    ?>
    <div class="form-field term-group">
        <label for="news_category_icon"><?php _e('Icon', 'gamestore'); ?></label>
        <input type="text" name="news_category_icon" id="news_category_icon" class="news-category-upload" />
        <button class="upload-icon-button button"><?php _e('Upload Icon', 'gamestore'); ?></button>
    </div>
    <?php
}
add_action('news_category_add_form_fields', 'news_category_add_meta_field', 10, 1);

function news_category_edit_meta_field($term, $taxonomy) {
    $icon = get_term_meta($term->term_id, 'news_category_icon', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="news_category_icon"><?php _e('Icon', 'gamestore'); ?></label></th>
        <td>
            <?php if($icon){
                echo'<img src="'.esc_url($icon).'" alt="'.__('Icon Preview', 'gamestore').'" />';
            }  ?>
            <input type="text" style="margin-bottom:14px;" name="news_category_icon" id="news_category_icon" value="<?php echo esc_attr($icon); ?>" class="news-category-upload" />
            <button class="button upload-icon-button"><?php _e('Upload Icon', 'gamestore'); ?></button>
        </td>
    </tr>
    <?php
}
add_action('news_category_edit_form_fields', 'news_category_edit_meta_field', 10, 2);



function save_news_category_meta($term_id, $tt_id) {
    if (isset($_POST['news_category_icon']) && !empty($_POST['news_category_icon'])) {
        update_term_meta($term_id, 'news_category_icon', sanitize_text_field($_POST['news_category_icon']));
    } else {
        delete_term_meta($term_id, 'news_category_icon');
    }
}

add_action('created_news_category', 'save_news_category_meta', 10, 2);

add_action('edited_news_category', 'save_news_category_meta', 10, 2);


// Enqueue media uploader and JS
function enqueue_media_uploader(){ 
  
     
    
    if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'news_category') {
        wp_enqueue_media(); 
        wp_enqueue_script('media-news-term-meta', GAMESTORE_PLUGIN_URL . 'assets/js/news-term-meta.js', array('jquery'), null, true);
  
    }
}   

add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

// створення колонки в админке
function news_category_add_icon_column($columns) {
    $columns['news_category_icon'] = __('Icon', 'gamestore');
    return $columns;
}
add_filter('manage_edit-news_category_columns', 'news_category_add_icon_column');

function news_category_icon_column_content($content, $column_name, $term_id) {
    if ($column_name == 'news_category_icon') {
        $icon = get_term_meta($term_id, 'news_category_icon', true);
        if ($icon) {
            $content = '<img src="' . esc_url($icon) . '" alt="' . __('Icon Preview', 'gamestore') . '" style="width: 50px; height: auto;" />';
        } else {
            $content = __('No Icon', 'gamestore');
        }
    }
    return $content;
}
add_filter('manage_news_category_custom_column', 'news_category_icon_column_content', 10, 3);