<?php
if (!defined('ABSPATH')) exit;

$post_type   = get_sub_field('post_type_select');
$post_count  = intval(get_sub_field('post_count') ?: 6);
$order       = get_sub_field('order') ?: 'DESC';
$order_by    = get_sub_field('order_by') ?: 'date';
$columns     = get_sub_field('columns') ?: '3';

if (empty($post_type)) return;

$args = [
    'post_type'      => $post_type,
    'posts_per_page' => $post_count,
    'order'          => strtoupper($order) === 'ASC' ? 'ASC' : 'DESC',
    'orderby'        => in_array($order_by, ['date', 'title', 'menu_order', 'rand'], true) ? $order_by : 'date',
    'post_status'    => 'publish',
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
    <?php endwhile;
    wp_reset_postdata(); ?>
</div>

<style>
    .acf-post-grid-wrapper {
        display: grid;
        gap: 1.75rem;
        margin: 2.5rem auto;
        padding: 0 1rem;
        align-items: start;
    }

    .acf-post-grid-wrapper.columns-2 {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    }

    .acf-post-grid-wrapper.columns-3 {
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    }

    .acf-post-grid-wrapper.columns-4 {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .acf-post-grid-item {
        border-radius: 10px;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .acf-post-grid-item:hover {
        transform: translateY(-3px);
    }

    .acf-post-grid-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .acf-post-grid-image img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        border-radius: 10px;
    }

    .acf-post-grid-placeholder {
        width: 100%;
        height: 220px;
        background: #8c8c8c;
        border-radius: 10px;
    }

    .acf-post-grid-content {
        border-radius: 10px;
        padding: 1rem;
        background-color: #dadce070;
        margin-top: 0.6rem;
    }

    .acf-post-grid-title {
        margin: 0 0 .4rem 0;
        font-size: 1.05rem;
        font-weight: 600;
    }

    .acf-post-grid-text {
        margin: 0;
        color: #666;
        font-size: .95rem;
        line-height: 1.4;
    }

    @media (max-width: 768px) {
        .acf-post-grid-image img,
        .acf-post-grid-placeholder {
            height: 160px;
        }

        .acf-post-grid-content {
            padding: 0.8rem;
        }
    }
</style>
