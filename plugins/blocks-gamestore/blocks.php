<?php 


function view_block_games_line($attributes){
    if (!function_exists('wc_get_product')) {
        return '<p>WooCommerce is not active.</p>';
    }


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
 
    return $output;
}


function view_block_recent_news($attributes) {
   
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

    return $output;
}

function view_block_subscribe($attributes) {

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



function view_block_single_news(){
    ob_start();

    $bg_img= get_the_post_thumbnail_url(get_the_ID(), 'full')?'style="background-image: url(' . get_the_post_thumbnail_url(get_the_ID(), 'full') . ');"':'';

    echo '<article ' . get_block_wrapper_attributes(array('class' => implode(' ', get_post_class('alignfull')))) . '>';

    echo '<div class="featured-image-section" ' . $bg_img . '>';
    echo '<div class="wrapper">';
    echo '<h1>'.esc_html(get_the_title()).'</h1>';
    echo '<div class="news-meta">';
    
    echo '<div class="news-date"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M8 2.5V5.5" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M16 2.5V5.5" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M3.5 9.59009H20.5" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M21 9V17.5C21 20.5 19.5 22.5 16 22.5H8C4.5 22.5 3 20.5 3 17.5V9C3 6 4.5 4 8 4H16C19.5 4 21 6 21 9Z" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M15.6947 14.2H15.7037" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M15.6947 17.2H15.7037" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M11.9955 14.2H12.0045" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M11.9955 17.2H12.0045" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M8.29431 14.2H8.30329" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M8.29431 17.2H8.30329" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
</svg>'.esc_html(get_the_date()).'</div>';
    echo '<div class="news-author"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M18.427 22.12C17.547 22.38 16.507 22.5 15.287 22.5H9.28697C8.06697 22.5 7.02697 22.38 6.14697 22.12C6.36697 19.52 9.03697 17.47 12.287 17.47C15.537 17.47 18.207 19.52 18.427 22.12Z" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M15.2871 2.5H9.28711C4.28711 2.5 2.28711 4.5 2.28711 9.5V15.5C2.28711 19.28 3.42711 21.35 6.14711 22.12C6.36711 19.52 9.03711 17.47 12.2871 17.47C15.5371 17.47 18.2071 19.52 18.4271 22.12C21.1471 21.35 22.2871 19.28 22.2871 15.5V9.5C22.2871 4.5 20.2871 2.5 15.2871 2.5ZM12.2871 14.67C10.3071 14.67 8.70711 13.06 8.70711 11.08C8.70711 9.10002 10.3071 7.5 12.2871 7.5C14.2671 7.5 15.8671 9.10002 15.8671 11.08C15.8671 13.06 14.2671 14.67 12.2871 14.67Z" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M15.867 11.08C15.867 13.06 14.267 14.67 12.287 14.67C10.307 14.67 8.70703 13.06 8.70703 11.08C8.70703 9.10002 10.307 7.5 12.287 7.5C14.267 7.5 15.867 9.10002 15.867 11.08Z" stroke="var(--text-secondary)" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>'. esc_html(get_the_author_meta('display_name')).'</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="wrapper news-container">';
    echo '<div class="news-social-share">Share'.gamestore_social_share(get_the_permalink(), get_the_title()).'</div>';

    echo '<div class="news-content">' . get_the_content() . '</div>';

    
   

    echo '</div>';

    echo '</article>';
    return ob_get_clean();
}


function view_block_news_header($attributes){
 
    $image_bg = (!empty($attributes['image']) ? 'style="background-image: url(' . esc_url($attributes['image']) . ');"' : '');

    ob_start();
    echo '<div ' . get_block_wrapper_attributes() . ' ' . $image_bg . '>';
    echo '<div class="wrapper">';


        if (!empty($attributes['title'])) {
            echo '<h1 class="news-header-title">' . esc_html($attributes['title']) . '</h1>';
        }

        if (!empty($attributes['description'])) {
            echo '<p class="news-header-description">' . esc_html($attributes['description']) . '</p>';
        }

        

  $terms_news = get_terms(array(
    'taxonomy' => 'news_category',
    'hide_empty' => false,
    ));

    if (!empty($terms_news) && !is_wp_error($terms_news)) {
        echo '<div class="news-categories">';
        foreach ($terms_news as $term) {
            $icon_url = (get_term_meta($term->term_id, 'news_category_icon', true)) ? '<img src="' . esc_url(get_term_meta($term->term_id, 'news_category_icon', true)) . '" alt="' . esc_attr($term->name) . '" />' : '';
            $term_link = get_term_link($term);
            echo '<div class="news-cat-item">
            <a href="' . esc_url($term_link) . '">' . esc_html($term->name) . $icon_url . '</a>
            </div>';
        }
        echo '</div>';

    }

        echo '</div>';
   
    echo '</div>';
    $output = ob_get_clean();
    
    return $output;

}

function view_block_news_box(){

    ob_start();
    echo '<div ' . get_block_wrapper_attributes(). '>';

    if(has_post_thumbnail()) {
                    echo '<h3>' . get_the_title() . '</h3>';
                  echo '<div class="news-thumbnail">';
                echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" class="blur-image" alt="' . get_the_title() . '"/>';
                echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" class="original-image" alt="' . get_the_title() . '"/>';
                echo '</div>';
      
      
      
            echo '<div class="news-excerpt">'.get_the_excerpt().'</div>';
            echo '<a href="' . get_permalink() . '" class="read-more">Open the post</a>';
            echo '</div>';
        
    }

    return ob_get_clean();
}  