<?php
if (function_exists('yoast_breadcrumb')) {
    echo '<nav class="breadcrumbs">';
    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    echo '</nav>';
} elseif (function_exists('rank_math_the_breadcrumbs')) {
    echo '<nav class="breadcrumbs">';
    rank_math_the_breadcrumbs();
    echo '</nav>';
} else {
    echo '<nav class="breadcrumbs">';
    echo '<a href="' . esc_url(home_url()) . '">Home</a>';

    if (is_category() || is_single()) {
        if (is_single()) {
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0]; 
                $ancestors = get_ancestors($category->term_id, 'category');
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor_id) {
                    $ancestor = get_category($ancestor_id);
                    echo ' / <a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
                }
                echo ' / <a href="' . esc_url(get_category_link($category)) . '">' . esc_html($category->name) . '</a>';
            }
            echo ' / ' . get_the_title();
        } else { 
            $category = get_queried_object();
            $ancestors = get_ancestors($category->term_id, 'category');
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_category($ancestor_id);
                echo ' / <a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
            }
            echo ' / ' . esc_html($category->name);
        }
    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $parent_ids = get_post_ancestors($post);
            $parent_ids = array_reverse($parent_ids);
            foreach ($parent_ids as $parent_id) {
                echo ' / <a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a>';
            }
        }
        echo ' / ' . get_the_title();
    }

    echo '</nav>';
}
?>
