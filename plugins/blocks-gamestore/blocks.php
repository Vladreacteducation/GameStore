<?php 

function view_block_games_line($attributes){

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $attributes['count'],
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $games_query = new WP_Query( $args );
    ob_start();

    echo '<div '.get_block_wrapper_attributes().'>';
    if ( $games_query->have_posts() ) {
        echo '<div class="games-line-container"><div class="swiper-wrapper">';

        while ( $games_query->have_posts() ) {
            $games_query->the_post();
    
            $product = wc_get_product(get_the_ID());
            echo '<div class="swiper-slide game-item">';
            echo '<a href="' . get_permalink() . '">';
            echo $product->get_image('full'); // Display product image
            echo '</a>'; // Display link
            echo '</div>';
        }

        echo '</div></div>';
    }
    echo '</div>';

    wp_reset_postdata();

    return ob_get_clean();
}



function view_block_recent_news(){
    return 'recent news';
}