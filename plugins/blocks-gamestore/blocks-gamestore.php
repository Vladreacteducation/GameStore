<?php
/**
 * Plugin Name:       Blocks Gamestore
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blocks-gamestore
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define ('BLOCKS_GAMESTORE_PATH', plugin_dir_path( __FILE__ ) ); # шлях до плагіна

require_once (BLOCKS_GAMESTORE_PATH . 'blocks.php'); # підключення файлу з функцією view_block_games_line

// add category for blocks
add_filter( 'block_categories_all', function( $categories ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'gamestore',
                'title' => 'Gamestore',
            ),
        )
    );
});


function create_block_blocks_gamestore_block_init() {
	register_block_type( __DIR__ . '/build/block-hero' ); # реєстрація першого блоку
	// register_block_type( __DIR__ . '/build/block-contact' ); # реєстрація другого блоку
	register_block_type( __DIR__ . '/build/block-header' ); # реєстрація header блоку
    register_block_type( __DIR__ . '/build/block-games-line',array(
        'render_callback' => 'view_block_games_line'
    )); # реєстрація games-line блоку   

    register_block_type( __DIR__ . '/build/block-recent-news',array(
        'render_callback' => 'view_block_recent_news'
    ));  # реєстрація recent-news блоку

    register_block_type( __DIR__ . '/build/block-subscribe',array(
        'render_callback' => 'view_block_subscribe'
    ));  # реєстрація subscribe блоку


    register_block_type( __DIR__ . '/build/block-featured-products',array(
        'render_callback' => 'view_block_featured_products'
    ));  # реєстрація featured products блоку

    register_block_type( __DIR__ . '/build/block-cta' ); # реєстрація block-cta блоку

    register_block_type( __DIR__ . '/build/block-faq' ); # реєстрація faq блоку

    register_block_type( __DIR__ . '/build/block-footer' ); # реєстрація footer блоку

    register_block_type( __DIR__ . '/build/block-single-news',array(
        'render_callback' => 'view_block_single_news'
    ));  # page single-news блоку


        register_block_type( __DIR__ . '/build/block-news-header',array(
        'render_callback' => 'view_block_news_header'
    ));  # news_header блоку

        register_block_type( __DIR__ . '/build/block-news-box',array(
        'render_callback' => 'view_block_news_box'
    ));  # page block-news-box блоку

        register_block_type( __DIR__ . '/build/block-single-game',array(
        'render_callback' => 'view_block_single_game'
    ));  # single game

    register_block_type( __DIR__ . '/build/block-slider' ); # block slider

           register_block_type( __DIR__ . '/build/block-similar-products',array(
        'render_callback' => 'view_block_similar_products'
    ));

            register_block_type( __DIR__ . '/build/block-product-header',array(
        'render_callback' => 'view_block_product_header'
    ));  # product_header блоку

             register_block_type( __DIR__ . '/build/block-bestseller-products',array(
        'render_callback' => 'view_block_bestseller_products'
    )); # bestsellers блок
}  

add_action( 'init', 'create_block_blocks_gamestore_block_init' );
