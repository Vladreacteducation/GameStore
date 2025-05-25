<?php
/**
 * Plugin Name: Core Gamestore
 * Description: A plugin to add a gamestore to your website
 * Version: 1.0 
 * Author: Core Games
 * Author URI: https://coregames.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: core-gamestore
 * Domain Path: /languages
 * 
 */

 define('GAMESTORE_PLUGIN_URL', plugin_dir_url(__FILE__));
 define('GAMESTORE_PLUGIN_PATH', plugin_dir_path(__FILE__));

require_once GAMESTORE_PLUGIN_PATH . 'includes/games-search.php';

require_once GAMESTORE_PLUGIN_PATH . 'includes/games-meta.php';

require_once GAMESTORE_PLUGIN_PATH . 'includes/social-share.php';

require_once GAMESTORE_PLUGIN_PATH . 'includes/news-term-meta.php';

 