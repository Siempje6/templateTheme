<?php
if (!defined('ABSPATH')) exit;

$post_type   = get_sub_field('post_type_select') ?: 'post';
$post_count  = intval(get_sub_field('post_count') ?: 6);
$order       = get_sub_field('order') ?: 'DESC';
$order_by    = get_sub_field('order_by') ?: 'date';
$columns     = get_sub_field('columns') ?: '3';
$show_nav    = get_sub_field('page_navigation_bottom') ?: false;

$paged = max(1, get_query_var('paged'));
$args = [
    'post_type' => $post_type,
    'posts_per_page' => $post_count,
    'orderby' => in_array($order_by, ['date', 'title', 'rand', 'menu_order']) ? $order_by : 'date',
    'order' => strtoupper($order) === 'ASC' ? 'ASC' : 'DESC',
    'post_status' => 'publish',
    'paged' => $paged
];

$query = new WP_Query($args);

$columns = in_array($columns, ['auto', '2', '3', '4']) ? $columns : '3';
$wrapper_class = 'acf-post-grid-wrapper columns-' . $columns;
$item_class    = 'acf-post-grid-item columns-' . $columns;
?>

<?php if ($query->have_posts()): ?>
    <div class="<?php echo esc_attr($wrapper_class); ?>">
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <?php
            $excerpt = get_the_excerpt() ?: wp_trim_words(strip_tags(get_the_content()), 20, '...');
            $author_id = get_the_author_meta('ID');
            $avatar = get_avatar($author_id, 28);
            $post_date = get_the_date('j M Y');
            ?>
            <article class="<?php echo esc_attr($item_class); ?>">
                <a href="<?php the_permalink(); ?>" class="acf-post-grid-link">
                    <div class="acf-post-grid-image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else: ?>
                            <div class="acf-post-grid-placeholder">
                                <span class="placeholder-text">Geen afbeelding</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="acf-post-grid-content">
                        <h3 class="acf-post-grid-title"><?php the_title(); ?></h3>
                        <i class="fa-solid fa-arrow-up-right-from-square" style="height: 20px;"></i>
                        <p class="acf-post-grid-text"><?php echo esc_html($excerpt); ?></p>
                        <div class="acf-post-grid-meta">
                            <?php echo $avatar; ?>
                            <span class="acf-post-grid-author"><?php the_author(); ?></span>
                            <span>-</span>
                            <span class="acf-post-grid-date"><?php echo esc_html($post_date); ?></span>
                        </div>
                    </div>
                </a>
            </article>
        <?php endwhile; ?>
    </div>

    <?php if ($show_nav): ?>
        <div class="acf-post-grid-pagination">
            <?php
            echo paginate_links([
                'total'   => $query->max_num_pages,
                'current' => $paged,
                'mid_size'=> 2,
                'prev_text' => __('<', 'textdomain'),
                'next_text' => __('>', 'textdomain'),
                'type' => 'list'
            ]);
            ?>
        </div>
    <?php endif; ?>

<?php else: ?>
    <p>Er zijn geen posts beschikbaar.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
