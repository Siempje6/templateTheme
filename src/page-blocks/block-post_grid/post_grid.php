<?php
if (!defined('ABSPATH')) exit;

// ================================
// CONFIGURATIE / ACF-VELDEN
// ================================
$post_type   = get_sub_field('post_type_select') ?: 'post'; // fallback
$post_count  = intval(get_sub_field('post_count') ?: 6);
$order       = get_sub_field('order') ?: 'DESC';
$order_by    = get_sub_field('order_by') ?: 'date';
$columns     = get_sub_field('columns') ?: '3';
$show_nav    = get_sub_field('page_navigation_bottom');

// fallback kleuren & fonts
$colors = get_sub_field('colors') ?: [];
$fonts  = get_sub_field('fonts') ?: [];

$hover_pagitation      = $colors['hover_pagitation'] ?? '#1a5428';
$pagitation_background = $colors['pagitation_background'] ?? '#f0f0f0';
$text_block_background = $colors['text_block_background'] ?? '#dadce070';
$font_color            = $colors['font_color'] ?? '#666';
$title_color           = $colors['title_color'] ?? '#111';

$font_family = $fonts['font_family'] ?? '';
$title_size  = $fonts['title_size'] ?? '18';
$text_font   = $fonts['text_font'] ?? '';

// ================================
// QUERY POSTS
// ================================
$paged = max(1, get_query_var('paged'));
$args = [
    'post_type' => $post_type,
    'posts_per_page' => -1, // haal alles, filter later
    'orderby' => in_array($order_by, ['date','title','rand','menu_order']) ? $order_by : 'date',
    'order' => strtoupper($order) === 'ASC' ? 'ASC' : 'DESC',
    'post_status' => 'publish',
];

$query = new WP_Query($args);
if (!$query->have_posts()) return;

// ================================
// FILTER / DEBUG
// ================================
$visible_posts = [];
$debug_posts   = [];
$today = new DateTime('today');

while ($query->have_posts()) {
    $query->the_post();
    $post_id    = get_the_ID();
    $post_date  = new DateTime(get_the_date('Y-m-d 00:00:00', $post_id));
    $interval   = $post_date->diff($today);
    $days_old   = (int)$interval->format('%a');
    $months_old = round($days_old / 30.4375, 2);

    $post_cats = wp_get_post_terms($post_id, 'category', ['fields'=>'names']);

    $debug_posts[] = [
        'title' => get_the_title(),
        'date'  => $post_date->format('Y-m-d'),
        'days_old' => $days_old,
        'months_old' => $months_old,
        'categories' => implode(', ', $post_cats),
    ];

    $visible_posts[] = get_post();
}

$total_posts = count($visible_posts);
$start_index = ($paged-1)*$post_count;
$visible_page_posts = array_slice($visible_posts, $start_index, $post_count);

// ================================
// CSS CLASSEN
// ================================
$columns = in_array($columns, ['auto','2','3','4']) ? $columns : '3';
$wrapper_class = 'acf-post-grid-wrapper columns-'.$columns;
$item_class    = 'acf-post-grid-item columns-'.$columns;
?>

<!-- DEBUG BLOCK -->
<div style="background:#fff3cd;border:1px solid #ffeeba;padding:8px;margin-bottom:12px;font-size:0.9rem;color:#856404;">
    <strong>DEBUG BLOCK:</strong>
    <ul style="margin:0; padding-left:16px;">
        <li>Post type: <strong><?php echo esc_html($post_type); ?></strong></li>
        <li>Aantal posts gevonden: <strong><?php echo esc_html($total_posts); ?></strong></li>
    </ul>
</div>

<!-- DEBUG POSTS -->
<div style="background:#e8f4fd;border:1px solid #b3d7f7;padding:10px;margin-bottom:20px;font-size:0.9rem;color:#084298;">
    <strong>DEBUG POSTS:</strong>
    <table style="width:100%;border-collapse:collapse;margin-top:8px;">
        <thead>
            <tr style="background:#cfe2ff;">
                <th style="padding:4px;border:1px solid #b6d4fe;">Titel</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Datum</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Leeftijd (mnd)</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Leeftijd (dagen)</th>
                <th style="padding:4px;border:1px solid #b6d4fe;">Categorieën</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($debug_posts as $info) : ?>
                <tr style="background:#d1e7dd;">
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['title']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['date']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;text-align:center;"><?php echo esc_html($info['months_old']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;text-align:center;"><?php echo esc_html($info['days_old']); ?></td>
                    <td style="padding:4px;border:1px solid #b6d4fe;"><?php echo esc_html($info['categories']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- POST GRID -->
<div class="<?php echo esc_attr($wrapper_class); ?>">
    <?php foreach ($visible_page_posts as $post) : setup_postdata($post); ?>
        <?php
        $excerpt = get_the_excerpt() ?: wp_trim_words(strip_tags(get_the_content()), 20, '...');
        $post_cats = wp_get_post_terms(get_the_ID(), 'category', ['fields'=>'names']);
        ?>
        <article id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($item_class); ?>">
            <a href="<?php the_permalink(); ?>" class="acf-post-grid-link">
                <div class="acf-post-grid-image">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); else : ?>
                        <div class="acf-post-grid-placeholder" aria-hidden="true"></div>
                    <?php endif; ?>
                </div>
                <div class="acf-post-grid-content" style="background-color:<?php echo esc_attr($text_block_background); ?>;">
                    <h3 class="acf-post-grid-title" style="color:<?php echo esc_attr($title_color); ?>; font-family:<?php echo esc_attr($font_family); ?>; font-size:<?php echo esc_attr($title_size); ?>px;"><?php the_title(); ?></h3>
                    <?php if (!empty($post_cats)) : ?>
                        <p style="font-size:0.9rem;color:#444;margin-top:0.5rem;">Categorie: <?php echo esc_html(implode(', ', $post_cats)); ?></p>
                    <?php endif; ?>
                    <p class="acf-post-grid-text" style="color:<?php echo esc_attr($font_color); ?>; font-family:<?php echo esc_attr($text_font); ?>;"><?php echo esc_html($excerpt); ?></p>
                </div>
            </a>
        </article>
    <?php endforeach; wp_reset_postdata(); ?>
</div>

<!-- PAGINATIE -->
<?php
if ($show_nav && $total_posts > $post_count) :
    $total_pages = ceil($total_posts / $post_count);
    $big = 999999999;
    $pagination_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $total_pages,
        'type'      => 'array',
        'prev_text' => '<',
        'next_text' => '>',
    ]);

    if (!empty($pagination_links)) :
        echo '<nav class="acf-post-grid-pagination"><ul>';
        echo '<li class="first-page"><a href="' . esc_url(get_pagenum_link(1)) . '"><<</a></li>';
        foreach ($pagination_links as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '<li class="last-page"><a href="' . esc_url(get_pagenum_link($total_pages)) . '">>></a></li>';
        echo '</ul></nav>';
    endif;
endif;
?>

<!-- CSS STYLING -->
<style>
.acf-post-grid-wrapper { display:grid; gap:1.75rem; margin:2.5rem auto; padding:0 1rem; align-items:start; }
.acf-post-grid-item { border-radius:10px; overflow:hidden; transition:transform .25s ease, box-shadow .25s ease; flex:1 1 340px; }
.acf-post-grid-item:hover { transform:translateY(-1px); }
.acf-post-grid-link { display:block; text-decoration:none; color:inherit; }
.acf-post-grid-image img { width:100%; height:220px; object-fit:cover; display:block; border-radius:10px; }
.acf-post-grid-placeholder { width:100%; height:220px; background:#8c8c8c; border-radius:10px; }
.acf-post-grid-content { border-radius:10px; padding:1rem; margin-top:0.6rem; }
.acf-post-grid-title { margin:0 0 .4rem 0; font-weight:600; }
.acf-post-grid-text { margin:0; line-height:1.4; }
.acf-post-grid-pagination { text-align:center; margin:2rem 0; }
.acf-post-grid-pagination ul { display:inline-flex; list-style:none; padding:0; gap:0.5rem; }
.acf-post-grid-pagination li a { display:block; padding:0.5rem 0.75rem; border-radius:5px; color:#333; text-decoration:none; transition:background-color 0.3s ease; }
.acf-post-grid-pagination li a:hover, .acf-post-grid-pagination li .current { color:#fff; }
.acf-post-grid-wrapper.columns-2 { grid-template-columns:repeat(auto-fit, minmax(400px,1fr)); }
.acf-post-grid-wrapper.columns-3 { grid-template-columns:repeat(auto-fit, minmax(320px,1fr)); }
.acf-post-grid-wrapper.columns-4 { grid-template-columns:repeat(auto-fit, minmax(260px,1fr)); }
@media (max-width:1024px){
  .acf-post-grid-wrapper.columns-4{grid-template-columns:repeat(auto-fit,minmax(260px,1fr));}
  .acf-post-grid-wrapper.columns-3{grid-template-columns:repeat(auto-fit,minmax(280px,1fr));}
}
@media (max-width:768px){
  .acf-post-grid-wrapper{grid-template-columns:1fr !important;}
  .acf-post-grid-image img, .acf-post-grid-placeholder{height:160px;}
  .acf-post-grid-content{padding:0.8rem;}
}
</style>
