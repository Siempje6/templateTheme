<?php
if (!defined('ABSPATH')) exit;

$post_type   = get_sub_field('post_type_select');
$post_count  = intval(get_sub_field('post_count') ?: 6);
$order       = get_sub_field('order') ?: 'DESC';
$order_by    = get_sub_field('order_by') ?: 'date';
$columns     = get_sub_field('columns') ?: '3';
$show_nav    = get_sub_field('page_navigation_bottom');

$block_months_visible_raw = get_sub_field('weergeven_tot');
$block_months_visible = (is_numeric($block_months_visible_raw) && intval($block_months_visible_raw) > 0)
    ? intval($block_months_visible_raw)
    : 0;

$selected_cats = get_sub_field('categorien_weergeven') ?: [];

if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('=== [POST GRID DEBUG] START BLOCK ===');
    error_log('[POST GRID DEBUG] weergeven_tot veldwaarde = ' . print_r($block_months_visible_raw, true));
    error_log('[POST GRID DEBUG] berekende maanden = ' . $block_months_visible);
    error_log('[POST GRID DEBUG] geselecteerde categorieën = ' . print_r($selected_cats, true));
}

if (empty($post_type)) return;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type'      => $post_type,
    'posts_per_page' => -1,
    'order'          => strtoupper($order) === 'ASC' ? 'ASC' : 'DESC',
    'orderby'        => in_array($order_by, ['date', 'title', 'menu_order', 'rand'], true) ? $order_by : 'date',
    'post_status'    => 'publish',
];

if (!empty($selected_cats)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'categorie', 
            'field'    => 'term_id',
            'terms'    => $selected_cats,
            'operator' => 'IN'
        ]
    ];
}

$query = new WP_Query($args);
if (!$query->have_posts()) {
    wp_reset_postdata();
    return;
}

$today = new DateTime('today');
$visible_posts = [];
$debug_posts = [];

while ($query->have_posts()) {
    $query->the_post();

    $post_id    = get_the_ID();
    $post_title = get_the_title();
    $post_date  = new DateTime(get_the_date('Y-m-d 00:00:00', $post_id));

    $limit_date = null;
    $too_old = false;

    $interval = $post_date->diff($today);
    $days_total = (int)$interval->format('%a');
    $months_exact = $days_total / 30.4375;

    if ($block_months_visible > 0) {
        $limit_date = clone $post_date;
        $limit_date->modify('+' . $block_months_visible . ' months');

        if ($today > $limit_date) {
            $too_old = true;
        }
    }

    $post_cats = wp_get_post_terms($post_id, 'categorie', ['fields' => 'names']);

    $debug_posts[] = [
        'title'        => $post_title,
        'date'         => $post_date->format('Y-m-d'),
        'months_old'   => round($months_exact, 2),
        'days_old'     => $days_total,
        'limit_date'   => $limit_date ? $limit_date->format('Y-m-d') : 'geen limiet',
        'too_old'      => $too_old ? 'JA' : 'NEE',
        'categories'   => implode(', ', $post_cats)
    ];

    if ($too_old) continue;

    $visible_posts[] = get_post();
}

$total_posts = count($visible_posts);
$start_index = ($paged - 1) * $post_count;
$visible_page_posts = array_slice($visible_posts, $start_index, $post_count);

$columns = in_array($columns, ['2', '3', '4'], true) ? $columns : '3';
$wrapper_class = 'acf-post-grid-wrapper columns-' . esc_attr($columns);
?>

<div style="background:#fff3cd;border:1px solid #ffeeba;padding:8px;margin-bottom:12px;font-size:0.9rem;color:#856404;">
    <strong>DEBUG BLOCK:</strong>
    <ul style="margin:0; padding-left:16px;">
        <li><code>weergeven_tot</code> veldwaarde: <strong><?php echo esc_html($block_months_visible_raw ?? 'null'); ?></strong></li>
        <li>Berekende maanden: <strong><?php echo esc_html($block_months_visible); ?></strong></li>
        <li>Vandaag: <strong><?php echo esc_html($today->format('Y-m-d')); ?></strong></li>
        <li>Geselecteerde categorieën: <strong><?php echo esc_html(implode(', ', $selected_cats)); ?></strong></li>
    </ul>
</div>

<div style="background:#e8f4fd;border:1px solid #b3d7f7;padding:10px;margin-bottom:20px;font-size:0.9rem;color:#084298;">
    <strong>DEBUG POSTS:</strong>
    <table style="width:100%;border-collapse:collapse;margin-top:8px;">
        <thead>
            <tr style="background:#cfe2ff;">
                <th style="padding:4px;border:1px solid #b6d4fe;">Titel</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Datum</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Leeftijd (mnd)</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Leeftijd (dagen)</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Limietdatum</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Te oud?</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Categorieën</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($debug_posts as $info) : ?>
                <tr style="background:<?php echo $info['too_old'] === 'JA' ? '#f8d7da' : '#d1e7dd'; ?>;">
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['title']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['date']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;text-align:center;"><?php echo esc_html($info['months_old']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;text-align:center;"><?php echo esc_html($info['days_old']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['limit_date']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;text-align:center;"><strong><?php echo esc_html($info['too_old']); ?></strong></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['categories']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="<?php echo esc_attr($wrapper_class); ?>">
    <?php foreach ($visible_page_posts as $post) : setup_postdata($post); ?>
        <?php
        $excerpt = get_the_excerpt();
        if (!$excerpt) {
            $excerpt = wp_trim_words(strip_tags(get_the_content()), 20, '...');
        }
        $post_cats = wp_get_post_terms(get_the_ID(), 'categorie', ['fields' => 'names']);
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
                    <?php if (!empty($post_cats)) : ?>
                        <p style="font-size:0.9rem;color:#444;margin-top:0.5rem; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" >Categorie: <?php echo esc_html(implode(', ', $post_cats)); ?></p>
                    <?php endif; ?>
                    <p class="acf-post-grid-text"><?php echo esc_html($excerpt); ?></p>
                </div>
            </a>
        </article>
    <?php endforeach; wp_reset_postdata(); ?>
</div>

<?php
if ($show_nav && $total_posts > $post_count) {
    $total_pages = ceil($total_posts / $post_count);
    $big = 999999999;
    $pagination_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, $paged),
        'total'     => $total_pages,
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
        echo '<li class="last-page"><a href="' . esc_url(get_pagenum_link($total_pages)) . '">>></a></li>';
        echo '</ul>';
        echo '</nav>';
    endif;
}

$colors = get_sub_field('colors');
$fonts  = get_sub_field('fonts');
$posts  = get_sub_field('posts');

$hover_pagitation      = !empty($colors['hover_pagitation']) ? $colors['hover_pagitation'] : '#1a5428';
$pagitation_background = !empty($colors['pagitation_background']) ? $colors['pagitation_background'] : '#f0f0f0';
$text_block_background = !empty($colors['text_block_background']) ? $colors['text_block_background'] : '#dadce070';
$font_color = !empty($colors['font_color']) ? $colors['font_color'] : '#666';
$title_color = !empty($colors['title_color']) ? $colors['title_color'] : '#111';

$font_family = !empty($fonts['font_family']) ? $fonts['font_family'] : '';
$title_size  = !empty($fonts['title_size']) ? $fonts['title_size'] : '';
$text_font   = !empty($fonts['text_font']) ? $fonts['text_font'] : '';

$post_2 = !empty($posts['width_post_2']) ? $posts['width_post_2'] : '400';
$post_3 = !empty($posts['width_post_3']) ? $posts['width_post_3'] : '320';
$post_4 = !empty($posts['width_post_4']) ? $posts['width_post_4'] : '260';
$post_3responsive = !empty($posts['width_post_3responsive']) ? $posts['width_post_3responsive'] : '280';
$post_4responsive = !empty($posts['width_post_4responsive']) ? $posts['width_post_4responsive'] : '260';
?>
<style>
.acf-post-grid-wrapper { display: grid; gap: 1.75rem; margin: 2.5rem auto; padding: 0 1rem; align-items: start; }
.acf-post-grid-item { border-radius: 10px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease; }
.acf-post-grid-item:hover { transform: translateY(-1px); }
.acf-post-grid-link { display: block; text-decoration: none; color: inherit; }
.acf-post-grid-image img { width: 100%; height: 220px; object-fit: cover; display: block; border-radius: 10px; }
.acf-post-grid-placeholder { width: 100%; height: 220px; background: #8c8c8c; border-radius: 10px; }
.acf-post-grid-content { border-radius: 10px; padding: 1rem; margin-top: 0.6rem; }
.acf-post-grid-title { margin: 0 0 .4rem 0; color: <?php echo ($title_color) ?>; font-size: 1.05rem; font-weight: 600; }
.acf-post-grid-text { margin: 0; color: <?php echo ($font_color) ?>; font-size: .95rem; line-height: 1.4; }
.acf-post-grid-pagination { text-align: center; margin: 2rem 0; }
.acf-post-grid-pagination ul { display: inline-flex; list-style: none; padding: 0; gap: 0.5rem; }
.acf-post-grid-pagination li a { display: block; padding: 0.5rem 0.75rem; border-radius: 5px; color: #333; text-decoration: none; transition: background-color 0.3s ease; }
.acf-post-grid-pagination li a:hover,
.acf-post-grid-pagination li .current { display: block; padding: 0.5rem 0.75rem; border-radius: 5px; color: #fff; text-decoration: none; }
.acf-post-grid-pagination .first-page a,
.acf-post-grid-pagination .last-page a { font-weight: bold; }

@media (max-width: 1024px) {
    .acf-post-grid-wrapper.columns-4 { grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr($post_4responsive) ?>px, 1fr)); }
    .acf-post-grid-wrapper.columns-3 { grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr($post_3responsive) ?>px, 1fr)); }
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
.acf-post-grid-wrapper.columns-2 { grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr($post_2) ?>px, 1fr)); }
.acf-post-grid-wrapper.columns-3 { grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr($post_3) ?>px, 1fr)); }
.acf-post-grid-wrapper.columns-4 { grid-template-columns: repeat(auto-fit, minmax(<?php echo esc_attr($post_4) ?>px, 1fr)); }
</style>
