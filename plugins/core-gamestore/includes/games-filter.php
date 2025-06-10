<?php

function filter_games_ajax_handler(){

  $posts_per_page = isset($_POST['post_per_page']) ? intval($_POST['post_per_page']) : 8;
  $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
  $platforms = isset($_POST['platforms']) ? sanitize_text_field($_POST['platforms']) : '';
  $publisher = isset($_POST['publisher']) ? sanitize_text_field($_POST['publisher']) : '';
  $singleplayer = isset($_POST['singleplayer']) ? sanitize_text_field($_POST['singleplayer']) : '';
  $released = isset($_POST['released']) ? sanitize_text_field($_POST['released']) : '';
  $languages = isset($_POST['languages']) ? sanitize_text_field($_POST['languages']) : '';
  $genres = isset($_POST['genres']) ? sanitize_text_field($_POST['genres']) : '';
  $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';

  $args = array(
    'post_type' => 'product',
    'posts_per_page' => $posts_per_page,
    'post_status' => 'publish',
    'paged' => $paged
  );

  if($platforms) {
    $args['tax_query'][] = array(
      'taxonomy' => 'platforms',
      'field' => 'term_id',
      'terms' => $platforms
    );
  }

  if($languages) {
    $languages = explode(',',$languages);
    $args['tax_query'][] = array(
      'taxonomy' => 'languages',
      'field' => 'term_id',
      'terms' => $languages
    );
  }

  if($genres) {
    $genres = explode(',',$genres);
    $args['tax_query'][] = array(
      'taxonomy' => 'genres',
      'field' => 'term_id',
      'terms' => $genres
    );
  }

  if($publisher){
    $args['meta_query'][] = array(
      'key' => '_gamestore_publisher',
      'value' => $publisher,
      'compare' => '='
    );
  }

  if($singleplayer){
    $args['meta_query'][] = array(
      'key' => '_gamestore_single_player',
      'value' => $singleplayer,
      'compare' => '='
    );
  }

  if($released){
    $args['meta_query'][] = array(
      'key' => '_gamestore_release_date',
      'value' => array("{$released}-01-01","{$released}-12-31"),
      'compare' => 'BETWEEN',
      'type' => 'DATE',
    );
  }

  switch($sort) {
    case 'latest':
      $args['orderby'] = 'date';
      $args['order'] = 'DESC';
      break;
    case 'price_low_high':
      $args['meta_key'] = '_price';
      $args['orderby']  = 'meta_value_num';
      $args['order']    = 'ASC';
      break;
    case 'price_high_low':
      $args['meta_key'] = '_price';
      $args['orderby']  = 'meta_value_num';
      $args['order']    = 'DESC';
      break;
    case 'popularity':
      $args['meta_key'] = 'total_sales';
      $args['orderby']  = 'meta_value_num';
      $args['order']    = 'DESC';
      break;
    default:
      $args['orderby']  = 'date';
      $args['order']    = 'DESC';
  }

  $filtered_games = get_posts($args);

  $html = '';
  if(!empty($filtered_games)){
    foreach($filtered_games as $post){
      $game = wc_get_product($post->ID);
      $platforms_html = '';
      $html .= '<div class="game-result">';
        $html .= '<a href="'.esc_url($game->get_permalink()).'">';
            $html .= '<div class="game-featured-image">'.$game->get_image('full').'</div>';
            $html .= '<div class="game-meta">';
              $html .= '<div class="game-price">'.$game->get_price_html().'</div>';
              $html .= '<h3>'.$game->get_name().'</h3>';
              $html .= '<div class="game-platforms">';
                $platforms = array('Xbox', 'PC', 'PlayStation');
                foreach($platforms as $platform){
                  $platforms_html .= (get_post_meta($game->get_ID(), '_platform_'.strtolower($platform), true ) == 'yes') ? '<div class="platform_'.strtolower($platform).'"></div>' : null;
                }
                $html .= $platforms_html;
              $html .= '</div>';
            $html .= '</div>';
        $html .= '</a>';
      $html .= '</div>';
    }
  }

  echo $html;
  wp_die();
}
add_action('wp_ajax_filter_games', 'filter_games_ajax_handler');
add_action('wp_ajax_nopriv_filter_games', 'filter_games_ajax_handler');