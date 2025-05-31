<?php 

// Register Custom Taxonomy for Languages
function gamestore_register_languages_taxonomy() {
    $labels = array(
        'name'                       => _x('Languages', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Language', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Languages', 'text_domain'),
        'all_items'                  => __('All Languages', 'text_domain'),
        'parent_item'                => __('Parent Language', 'text_domain'),
        'parent_item_colon'          => __('Parent Language:', 'text_domain'),
        'new_item_name'              => __('New Language Name', 'text_domain'),
        'add_new_item'               => __('Add New Language', 'text_domain'),
        'edit_item'                  => __('Edit Language', 'text_domain'),
        'update_item'                => __('Update Language', 'text_domain'),
        'view_item'                  => __('View Language', 'text_domain'),
        'separate_items_with_commas' => __('Separate languages with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove languages', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Languages', 'text_domain'),
        'search_items'               => __('Search Languages', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No languages', 'text_domain'),
        'items_list'                 => __('Languages list', 'text_domain'),
        'items_list_navigation'      => __('Languages list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy('languages', array('product'), $args);
}
add_action('init', 'gamestore_register_languages_taxonomy', 0);

// Register Custom Taxonomy for Genres
function gamestore_register_genres_taxonomy() {
    $labels = array(
        'name'                       => _x('Genres', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Genre', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Genres', 'text_domain'),
        'all_items'                  => __('All Genres', 'text_domain'),
        'parent_item'                => __('Parent Genre', 'text_domain'),
        'parent_item_colon'          => __('Parent Genre:', 'text_domain'),
        'new_item_name'              => __('New Genre Name', 'text_domain'),
        'add_new_item'               => __('Add New Genre', 'text_domain'),
        'edit_item'                  => __('Edit Genre', 'text_domain'),
        'update_item'                => __('Update Genre', 'text_domain'),
        'view_item'                  => __('View Genre', 'text_domain'),
        'separate_items_with_commas' => __('Separate genres with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove genres', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Genres', 'text_domain'),
        'search_items'               => __('Search Genres', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No genres', 'text_domain'),
        'items_list'                 => __('Genres list', 'text_domain'),
        'items_list_navigation'      => __('Genres list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy('genres', array('product'), $args);
}
add_action('init', 'gamestore_register_genres_taxonomy', 0);

// Register Custom Taxonomy for Platform
function gamestore_register_platform_taxonomy() {
    $labels = array(
        'name'                       => _x('Platforms', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Platform', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Platforms', 'text_domain'),
        'all_items'                  => __('All Platforms', 'text_domain'),
        'parent_item'                => __('Parent Platform', 'text_domain'),
        'parent_item_colon'          => __('Parent Platform:', 'text_domain'),
        'new_item_name'              => __('New Platform Name', 'text_domain'),
        'add_new_item'               => __('Add New Platform', 'text_domain'),
        'edit_item'                  => __('Edit Platform', 'text_domain'),
        'update_item'                => __('Update Platform', 'text_domain'),
        'view_item'                  => __('View Platform', 'text_domain'),
        'separate_items_with_commas' => __('Separate platforms with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove platforms', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Platforms', 'text_domain'),
        'search_items'               => __('Search Platforms', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No platforms', 'text_domain'),
        'items_list'                 => __('Platforms list', 'text_domain'),
        'items_list_navigation'      => __('Platforms list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy('platforms', array('product'), $args);
}
add_action('init', 'gamestore_register_platform_taxonomy', 0);
?>