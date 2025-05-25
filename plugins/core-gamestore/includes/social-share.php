<?php



function gamestore_social_share($url, $title){
    $encoded_url = urlencode($url);
    $encoded_title = urlencode($title);

    $social_links = [
        'twitter' => "https://twitter.com/intent/tweet?url={$encoded_url}&text={$encoded_title}",
        'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$encoded_url}",
        'pinterest' => "https://pinterest.com/pin/create/button/?url={$encoded_url}&description={$encoded_title}"
    ];

    $output = '<div class="social-share-buttons">';
    foreach ($social_links as $platform => $link) {
        $output .= "<a href='{$link}' target='_blank' class='{$platform}-icon'>Share on " . ucfirst($platform) . "</a>";
    }
    $output .= '</div>';

    return $output;
}