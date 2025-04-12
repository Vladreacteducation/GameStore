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
}
add_action( 'init', 'create_block_blocks_gamestore_block_init' );
