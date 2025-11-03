<?php

if (function_exists('yoast_breadcrumb')) {
    echo '<nav class="breadcrumbs">';
    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
} elseif (function_exists('rank_math_the_breadcrumbs')) {
    echo '<nav class="breadcrumbs">';
    rank_math_the_breadcrumbs();
    echo '</nav>';
} else {
    echo '<nav class="breadcrumbs">';
    echo '<a href="' . esc_url(home_url()) . '">Home</a>';

    if (is_category() || is_single()) {
        echo ' / ';
        the_category(' / ');
        if (is_single()) {
            echo ' / ';
            the_title();
        }
    } elseif (is_page()) {
        echo ' / ';
        the_title();
    }
    echo '</nav>';
}
?>