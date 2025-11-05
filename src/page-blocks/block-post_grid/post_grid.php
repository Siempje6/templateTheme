<?php
if (!defined('ABSPATH')) exit;

$post_type   = get_sub_field('post_type_select');
$post_count  = intval(get_sub_field('post_count') ?: 6);
$order       = get_sub_field('order') ?: 'DESC';
$order_by    = get_sub_field('order_by') ?: 'date';
$columns     = get_sub_field('columns') ?: '3';
$show_nav    = get_sub_field('page_navigation_bottom');

if (empty($post_type)) return;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type'      => $post_type,
    'posts_per_page' => $post_count,
    'order'          => strtoupper($order) === 'ASC' ? 'ASC' : 'DESC',
    'orderby'        => in_array($order_by, ['date', 'title', 'menu_order', 'rand'], true) ? $order_by : 'date',
    'post_status'    => 'publish',
    'paged'          => $paged,
];

$query = new WP_Query($args);
if (!$query->have_posts()) {
    wp_reset_postdata();
    return;
}

$columns = in_array($columns, ['2', '3', '4'], true) ? $columns : '3';
$wrapper_class = 'acf-post-grid-wrapper columns-' . esc_attr($columns);
?>

<div class="<?php echo esc_attr($wrapper_class); ?>">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php
        $excerpt = get_the_excerpt();
        if (!$excerpt) {
            $excerpt = wp_trim_words(strip_tags(get_the_content()), 20, '...');
        }
        ?>
        <article id="post-<?php the_ID(); ?>" class="acf-post-grid-item">
            <a class="acf-post-grid-link" href="<?php the_permalink(); ?>">
                <div class="acf-post-grid-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php else : ?>
                        <div class="acf-post-grid-placeholder" aria-hidden="true"></div>
                    <?php endif; ?>
                </div>

                <div class="acf-post-grid-content">
                    <h3 class="acf-post-grid-title"><?php the_title(); ?></h3>
                    <p class="acf-post-grid-text"><?php echo esc_html($excerpt); ?></p>
                </div>
            </a>
        </article>
    <?php endwhile; ?>
</div>

<?php


if ($show_nav) {
    $big = 999999999; 
    $pagination_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, $paged),
        'total'     => $query->max_num_pages,
        'type'      => 'array',
        'prev_text' => '<',
        'next_text' => '>',
    ]);

    if (!empty($pagination_links)) :
        echo '<nav class="acf-post-grid-pagination">';
        echo '<ul>';
        echo '<li class="first-page"><a href="' . esc_url(get_pagenum_link(1)) . '"><<</a></li>';
        foreach ($pagination_links as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '<li class="last-page"><a href="' . esc_url(get_pagenum_link($query->max_num_pages)) . '">>></a></li>';
        echo '</ul>';
        echo '</nav>';
    endif;
}

wp_reset_postdata();
?>



<?php
// styling 
$colors = get_sub_field('colors');
$fonts  = get_sub_field('fonts');
$posts  = get_sub_field('posts');


$hover_pagitation      = !empty($colors['hover_pagitation']) ? $colors['hover_pagitation'] : '#1a5428';
$pagitation_background = !empty($colors['pagitation_background']) ? $colors['pagitation_background'] : '#f0f0f0';
$text_block_background = !empty($colors['text_block_background']) ? $colors['text_block_background'] : '#dadce070';

$font_family = !empty($fonts['font_family']) ? $fonts['font_family'] : '';
$title_size = !empty($fonts['title_size']) ? $fonts['title_size'] : '';
$text_font = !empty($fonts['text_font']) ? $fonts['text_font'] : '';

$post_2 = !empty($posts['width_post_2']) ? $posts['width_post_2'] : '400';
$post_3 = !empty($posts['width_post_3']) ? $posts['width_post_3'] : '320';
$post_4 = !empty($posts['width_post_4']) ? $posts['width_post_4'] : '260';
$post_3responsive = !empty($posts['width_post_3responsive']) ? $posts['width_post_3responsive'] : '280';
$post_4responsive = !empty($posts['width_post_4responsive']) ? $posts['width_post_4responsive'] : '260';

?>

    <?php echo '<!-- Font family: ' . esc_html($font_family) . ' -->'; ?>
<style>
.acf-post-grid-wrapper { display: grid; gap: 1.75rem; margin: 2.5rem auto; padding: 0 1rem; align-items: start; }
.acf-post-grid-item { border-radius: 10px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease; }
.acf-post-grid-item:hover { transform: translateY(-1px); }
.acf-post-grid-link { display: block; text-decoration: none; color: inherit; }
.acf-post-grid-image img { width: 100%; height: 220px; object-fit: cover; display: block; border-radius: 10px; }
.acf-post-grid-placeholder { width: 100%; height: 220px; background: #8c8c8c; border-radius: 10px; }
.acf-post-grid-content { border-radius: 10px; padding: 1rem; margin-top: 0.6rem; }
.acf-post-grid-title { margin: 0 0 .4rem 0; font-size: 1.05rem; font-weight: 600; }
.acf-post-grid-text { margin: 0; color: #666; font-size: .95rem; line-height: 1.4; }
.acf-post-grid-pagination { text-align: center; margin: 2rem 0; }
.acf-post-grid-pagination ul { display: inline-flex; list-style: none; padding: 0; gap: 0.5rem; }
.acf-post-grid-pagination li a { display: block; padding: 0.5rem 0.75rem; border-radius: 5px; color: #333; 
                                 text-decoration: none; transition: background-color 0.3s ease; }
.acf-post-grid-pagination li a:hover,
.acf-post-grid-pagination li .current { display: block; padding: 0.5rem 0.75rem; border-radius: 5px; color: #fff;
                                        text-decoration: none; }
.acf-post-grid-pagination .first-page a,
.acf-post-grid-pagination .last-page a { font-weight: bold; }

@media (max-width: 1024px) {
    .acf-post-grid-wrapper.columns-4 { grid-template-columns: repeat(auto-fit, minmax( <?php echo esc_attr($post_4responsive) ?>px, 1fr)); }
    .acf-post-grid-wrapper.columns-3 { grid-template-columns: repeat(auto-fit, minmax( <?php echo esc_attr($post_3responsive) ?>px, 1fr)); }
}
@media (max-width: 768px) {
    .acf-post-grid-wrapper { grid-template-columns: 1fr !important; }
    .acf-post-grid-image img,
    .acf-post-grid-placeholder { height: 160px; }
    .acf-post-grid-content { padding: 0.8rem; }
}

.acf-post-grid-content { background-color: <?php echo esc_attr($text_block_background) ?>; }
.acf-post-grid-title { font-family: <?php echo ($font_family); ?>; font-size: <?php echo ($title_size); ?>px; }
.acf-post-grid-text { font-family: <?php echo ($text_font) ?>; }
.acf-post-grid-pagination li a { background-color: <?php echo esc_attr($pagitation_background) ?>; }
.acf-post-grid-pagination li a:hover,
.acf-post-grid-pagination li .current { background-color: <?php echo esc_attr($hover_pagitation) ?>; }
.acf-post-grid-wrapper.columns-2 { grid-template-columns: repeat(auto-fit, minmax( <?php echo esc_attr($post_2) ?>px, 1fr)); }
.acf-post-grid-wrapper.columns-3 { grid-template-columns: repeat(auto-fit, minmax( <?php echo esc_attr($post_3) ?>px, 1fr)); }
.acf-post-grid-wrapper.columns-4 { grid-template-columns: repeat(auto-fit, minmax( <?php echo esc_attr($post_4) ?>px, 1fr)); }


</style>
