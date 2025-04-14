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