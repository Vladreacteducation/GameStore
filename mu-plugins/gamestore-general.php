<?php
/** Plugin Name: Gamestore General
* Description: Core Code for Gamestore
* Version: 1.0
* Author: Gamestore
* Author URI: http://gamestore.com
* License: GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: gamestore
*/

function game_store_remove_dashboard_widgets(){
    global $wp_meta_boxes;
    
    remove_action('welcome_panel', 'wp_welcome_panel');

    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['high']['rank_math_dashboard_widget']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
}
add_action('wp_dashboard_setup', 'game_store_remove_dashboard_widgets');


// Allow SVG uploads in WordPress
function game_store_allow_svg_upload($mimes) {
    // Add SVG mime type
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'game_store_allow_svg_upload');

// Sanitize SVG files for security
function game_store_sanitize_svg($file) {
    $filetype = wp_check_filetype($file['name']);
    if ($filetype['ext'] === 'svg') {
        $file['type'] = 'image/svg+xml';
    }
    return $file;
}
add_filter('wp_check_filetype_and_ext', 'game_store_sanitize_svg', 10, 4);

// Disable SVG rendering in the browser for security
function game_store_disable_svg_rendering() {
    echo '<style>img[src$=".svg"] { width: auto; height: auto; }</style>';
}
add_action('admin_head', 'game_store_disable_svg_rendering');



// Add custom post type News

// Register Custom Post Type: News
function gamestore_register_news_post_type() {
    $labels = array(
        'name'               => _x('News', 'Post Type General Name', 'gamestore'),
        'singular_name'      => _x('News', 'Post Type Singular Name', 'gamestore'),
        'menu_name'          => __('News', 'gamestore'),
        'name_admin_bar'     => __('News', 'gamestore'),
        'add_new'            => __('Add New', 'gamestore'),
        'add_new_item'       => __('Add New News', 'gamestore'),
        'edit_item'          => __('Edit News', 'gamestore'),
        'new_item'           => __('New News', 'gamestore'),
        'view_item'          => __('View News', 'gamestore'),
        'search_items'       => __('Search News', 'gamestore'),
        'not_found'          => __('No News Found', 'gamestore'),
        'not_found_in_trash' => __('No News Found in Trash', 'gamestore'),
    );

    $args = array(
        'label'               => __('News', 'gamestore'),
        'description'         => __('News and updates', 'gamestore'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'          => array('news_category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-media-document',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true, // Enable Gutenberg support
    );

    register_post_type('news', $args);
}
add_action('init', 'gamestore_register_news_post_type');

// Register Custom Taxonomy: News Category
function gamestore_register_news_category_taxonomy() {
    $labels = array(
        'name'              => _x('News Categories', 'Taxonomy General Name', 'gamestore'),
        'singular_name'     => _x('News Category', 'Taxonomy Singular Name', 'gamestore'),
        'menu_name'         => __('News Categories', 'gamestore'),
        'all_items'         => __('All Categories', 'gamestore'),
        'parent_item'       => __('Parent Category', 'gamestore'),
        'parent_item_colon' => __('Parent Category:', 'gamestore'),
        'new_item_name'     => __('New Category Name', 'gamestore'),
        'add_new_item'      => __('Add New Category', 'gamestore'),
        'edit_item'         => __('Edit Category', 'gamestore'),
        'update_item'       => __('Update Category', 'gamestore'),
        'view_item'         => __('View Category', 'gamestore'),
        'search_items'      => __('Search Categories', 'gamestore'),
        'not_found'         => __('No Categories Found', 'gamestore'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Enable Gutenberg support
    );

    register_taxonomy('news_category', array('news'), $args);
}
add_action('init', 'gamestore_register_news_category_taxonomy');
