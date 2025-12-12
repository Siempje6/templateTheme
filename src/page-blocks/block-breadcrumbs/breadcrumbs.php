<?php

$algemeen = get_sub_field('algemeen');

$title_weight    = $algemeen['font_weight'] ?? '400';
$title_color     = $algemeen['font_color'] ?? '#000';
$background_color     = $algemeen['background_color'] ?? '#000';
$padding    = $algemeen['padding'] ?? 'px';
$padding_sides    = $algemeen['padding_sides'] ?? 'px';

$margin_left    = $algemeen['margin_left'] ?? 'px';
$margin_right    = $algemeen['margin_right'] ?? 'px';
$margin_top    = $algemeen['margin_top'] ?? 'px';
$margin_bottom    = $algemeen['margin_bottom'] ?? 'px';

$border_width    = $algemeen['border_width'] ?? 'px';
$border_color     = $algemeen['border_color'] ?? '#000';

$collapsed_overflow = $algemeen['collapsed_styling'] ?? false; 
$collapsed_overflow = $collapsed_overflow ? 'hidden' : 'visible';   

?>
<div id="<?= esc_attr($accordion_id); ?>"
     class="breadcrumbs-wrapper <?= esc_attr($collapsed_class);?>"
     style="
        --acc-title-weight: <?= esc_attr($title_weight); ?>;
        --acc-title-color: <?= esc_attr($title_color); ?>;
        --acc-background-color: <?= esc_attr($background_color); ?>;
        --acc-padding: <?= esc_attr($padding); ?>px;
        --acc-padding-sides: <?= esc_attr($padding_sides); ?>px;

        --acc-margin-left: <?= esc_attr($margin_left); ?>px;
        --acc-margin-right: <?= esc_attr($margin_right); ?>px;
        --acc-margin-top: <?= esc_attr($margin_top); ?>px;
        --acc-margin-bottom: <?= esc_attr($margin_bottom); ?>px;

        --acc-border-width: <?= esc_attr($border_width); ?>px;
        --acc-border-color: <?= esc_attr($border_color); ?>;

        --acc-collapsed-overflow: <?= esc_attr($collapsed_overflow); ?>;
        
     ">
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

    echo '<li class="collapsed"><a href="' . esc_url(home_url()) . '">Home</a></li>';

    if (is_category() || is_single()) {

        if (is_single()) {
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0];
                $ancestors = get_ancestors($category->term_id, 'category');
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor_id) {
                    $ancestor = get_category($ancestor_id);
                    echo ' / <li class="collapsed"><a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
                }

                echo ' / <li class="collapsed"><a href="' . esc_url(get_category_link($category)) . '">' . esc_html($category->name) . '</a></li>';
            }

            echo ' / ' . get_the_title();

        } else { 
            $category = get_queried_object();
            $ancestors = get_ancestors($category->term_id, 'category');
            $ancestors = array_reverse($ancestors);

            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_category($ancestor_id);
                echo ' / <li class="collapsed"><a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
            }

            echo ' / ' . esc_html($category->name);
        }

    } elseif (is_page()) {
        global $post;

        if ($post->post_parent) {
            $parent_ids = get_post_ancestors($post);
            $parent_ids = array_reverse($parent_ids);

            foreach ($parent_ids as $parent_id) {
                echo ' / <li class="collapsed"><a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a></li>';
            }
        }

        echo ' / ' . get_the_title();
    }

    echo '</nav>';
}

?>
</div>

