<?php 

// function view_block_games_line($attributes){

//     if (!function_exists('wc_get_product')) {
//         return '<p>WooCommerce is not active.</p>';
//     }
//     $args = array(
//         'post_type'      => 'product',
//         'posts_per_page' => $attributes['count'],
//         'post_status'    => 'publish',
//         'orderby'        => 'date',
//         'order'          => 'DESC',
//     );

//     $games_query = new WP_Query( $args );
//     ob_start();

//     echo '<div '.get_block_wrapper_attributes().'>';
//     if ( $games_query->have_posts() ) {
//         $games_query->the_post();
//         echo '<div class="games-line-container"><div class="swiper-wrapper">';

//         while ( $games_query->have_posts() ) {
    
    
//             $product = wc_get_product(get_the_ID());
//             echo '<div class="swiper-slide game-item">';
//             echo '<a href="' . get_permalink() . '">';
//             echo $product->get_image('full'); // Display product image
//             echo '</a>'; // Display link
//             echo '</div>';
//         }

//         echo '</div></div>';
//     }
//     echo '</div>';

//     wp_reset_postdata();

//     return ob_get_clean();
// }


function view_block_games_line($attributes){
    if (!function_exists('wc_get_product')) {
        return '<p>WooCommerce is not active.</p>';
    }

    $transient_key = 'games_line_block_' . md5(serialize($attributes));
    $cached_output = get_transient($transient_key);
    if ($cached_output) return $cached_output;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $attributes['count'],
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $games_query = new WP_Query($args);
    ob_start();

    echo '<div '.get_block_wrapper_attributes().'>';
    if ($games_query->have_posts()) {
        echo '<div class="games-line-container"><div class="swiper-wrapper">';
        while ($games_query->have_posts()) {
            $games_query->the_post();
            echo '<div class="swiper-slide game-item">';
            echo '<a href="' . get_permalink() . '">';
            echo get_the_post_thumbnail(get_the_ID(), 'full');
            echo '</a>';
            echo '</div>';
        }
        echo '</div></div>';
    }
    echo '</div>';

    wp_reset_postdata();

    $output = ob_get_clean();
    set_transient($transient_key, $output, MINUTE_IN_SECONDS);

    return $output;
}



// function view_block_recent_news($attributes) {
//     if (!function_exists('wc_get_product')) {
//         return '<p>WooCommerce is not active.</p>';
//     }
  
//     $args = array(
//         'post_type'      => 'news',
//         'posts_per_page' => 3,
//         'post_status'    => 'publish',
//         'orderby'        => 'date',
//         'order'          => 'DESC',
//     );

//     $news_query = new WP_Query($args);

//     $image_bg = ($attributes['image'] ? 'style="background-image: url(' . esc_url($attributes['image']) . ');"' : '');
//     ob_start();

//     echo '<div ' . get_block_wrapper_attributes() .$image_bg.'>';
//     if ($news_query->have_posts()) {
//         $news_query->the_post(); 
//         echo '<div class="recent-news-container">';
  

//         if ($attributes['title']) {
//             echo '<h2>' . esc_html($attributes['title']) . '</h2>';
//         }

//         if ($attributes['description']) {
//             echo '<p>' . esc_html($attributes['description']) . '</p>';
//         }
//         while ($news_query->have_posts()) {


//             echo '<div class="news-item">';
//             echo '<a href="' . get_permalink() . '">';
//             echo get_the_post_thumbnail(get_the_ID(), 'medium'); // Display the featured image
//             echo '<h3>' . get_the_title() . '</h3>'; // Display the title
//             echo '</a>';
//             echo '</div>';
//         }

//         echo '</div>';
//     } else {
//         echo '<p>No recent news found.</p>';
//     }
//     echo '</div>';

//     wp_reset_postdata();

//     return ob_get_clean();
// }

function view_block_recent_news($attributes) {
    $transient_key = 'recent_news_block_' . md5(serialize($attributes));
    $cached_output = get_transient($transient_key);
    if ($cached_output) return $cached_output;

    $args = array(
        'post_type'      => 'news',
        'posts_per_page' => $attributes['count'],
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $news_query = new WP_Query($args);
    $image_bg = (!empty($attributes['image']) ? 'style="background-image: url(' . esc_url($attributes['image']) . ');"' : '');

    ob_start();
    echo '<div ' . get_block_wrapper_attributes() . ' ' . $image_bg . '>';

    if ($news_query->have_posts()) {

        if (!empty($attributes['title'])) {
            echo '<h2>' . esc_html($attributes['title']) . '</h2>';
        }

        if (!empty($attributes['description'])) {
            echo '<p>' . esc_html($attributes['description']) . '</p>';
        }

        echo '<div class="recent-news wrapper">';
        while ($news_query->have_posts()) {
            $news_query->the_post();
            echo '<div class="news-item">';
            if (has_post_thumbnail()) {
                echo '<h3>' . get_the_title() . '</h3>';
                echo '<div class="news-thumbnail">';
                echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" class="blur-image" alt="' . get_the_title() . '"/>';
                echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" class="original-image" alt="' . get_the_title() . '"/>';
                echo '</div>';
            }
            echo '<div class="news-excerpt">'.get_the_excerpt().'</div>';
            echo '<a href="' . get_permalink() . '" class="read-more">Open the post</a>';

            echo '</div>';
        
        }
        echo '</div>';
    } else {
        echo '<p>No recent news found.</p>';
    }
    echo '</div>';

    wp_reset_postdata();

    $output = ob_get_clean();
    // set_transient($transient_key, $output, 5 * MINUTE_IN_SECONDS);

    return $output;
}

function view_block_subscribe($attributes) {
    // $transient_key = 'subscribe_block_' . md5(serialize($attributes));
    // $cached_output = get_transient($transient_key);
    // if ($cached_output) return $cached_output;

    $image_bg = (!empty($attributes['image']) ? 'style="background-image: url(' . esc_url($attributes['image']) . ');"' : '');

    ob_start();
    echo '<div ' . get_block_wrapper_attributes(array('class'=> 'alignfull')). $image_bg . '>';
   echo '<div class="subscribe-inner wrapper">';
   echo '<h2 class="subscribe-title">' . ($attributes['title']) . '</h2>';
   echo '<p class="subscribe-description">' . ($attributes['description']) . '</p>';
   echo '<div class="subscribe-shortcode">' . do_shortcode(($attributes['shortcode'])) . '</div>';

    echo '</div>';
    echo '</div>';
    $output = ob_get_clean();
    // set_transient($transient_key, $output, 5 * MINUTE_IN_SECONDS);

    return $output;
}  







function view_block_featured_products($attributes){

    $featured_games = wc_get_products(array(
        'status' => 'publish',
        'limit' => $attributes['count'],
        'featured' => true,
    )); 

    ob_start();
    echo '<div ' . get_block_wrapper_attributes(array('class' => 'wrapper')) . '>';

    if (!empty($attributes['title'])) {
        echo '<h2>' . esc_html($attributes['title']) . '</h2>';
    }

    if (!empty($attributes['description'])) {
        echo '<p>' . esc_html($attributes['description']) . '</p>';
    }



    $platforms = array('Xbox' ,'PC', 'PlayStation');



  


    if (!empty($featured_games)) {
        echo '<div class="games-list">';
        foreach ($featured_games as $game) {
            $platforms_html = '';
            echo '<div class="game-result">';
            echo '<a href="' . esc_url($game->get_permalink()) . '">';
            echo '<div class="game-featured-image">' . $game->get_image() . '</div>';
            echo '<div class="game-meta">';
            echo '<div class="game-price">' . $game->get_price_html() . '</div>';
            echo '<h3>' . esc_html($game->get_name()) . '</h3>';

            echo '<div class="game-platforms">';

            foreach($platforms as $platform){
                $platforms_html.= (get_post_meta($game->get_id(), '_platform_'. strtolower($platform), true)=='yes')?'<div class="platform_'. strtolower($platform).'"></div>':'';


             }
             echo $platforms_html;

            echo '</div>';
            echo '</div>';

            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No games found.</p>';
    }

    echo '</div>';

    return ob_get_clean();
}
