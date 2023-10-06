<?php
add_action('woocommerce_single_product_summary', 'add_product_reviews_shortcode_after_price', 15);

function add_product_reviews_shortcode_after_price() {
    // Check if we are on a single product page
    if (is_product()) {
        echo '<div class="wcpr-overall-rating-main">';
        echo '<div class="wcpr-overall-rating-right-star">';
        
        $product = wc_get_product(get_the_ID());
        $average_rating = $product->get_average_rating();
        $review_count = $product->get_review_count(); // Get the total number of reviews
        
        // Generate the star rating HTML based on the average rating
        $stars_html = ($review_count > 0) ? wc_get_rating_html($average_rating, 5) : wc_get_rating_html(0, 5);
        echo $stars_html;
        
        echo '</div>';
        
        echo '<div class="wcpr-overall-rating-right-total">';
        if ($review_count === 0) {
            echo ' No reviews';
        } else {
            echo '(' . $review_count . ' review' . ($review_count === 1 ? ')' : 's)');
        }
        echo '</div>';
        
        echo '</div>';
    }
}
