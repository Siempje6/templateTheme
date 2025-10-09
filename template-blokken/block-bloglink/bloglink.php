<?php
$image = get_sub_field('imageblog');
$blogdate = get_sub_field('dateblog');

$bloglink_field = get_sub_field('titleblog');
$bloglink_title = $bloglink_field['title'] ?? '';
$bloglink_url   = $bloglink_field['url'] ?? '#';
$bloglink_target = $bloglink_field['target'] ?? '_self';
?>

<section id="pagina-bloglink" class="bloglink-block">
    <div class="container bloglink-container">
        <?php if ($image): ?>
            <a href="<?php echo esc_url($bloglink_url); ?>">
                <div class="bloglink-image">
                    <img
                        src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>"
                        class="bloglink-img"
                        href="<?php echo esc_url($bloglink_url); ?>"
                        target="<?php echo esc_attr($bloglink_target); ?>" />
                </div>
            </a>
        <?php endif; ?>

        <div class="bloglink-content">
            <?php if ($bloglink_title): ?>
                <h2 class="bloglink-title">
                    <a href="<?php echo esc_url($bloglink_url); ?>" target="<?php echo esc_attr($bloglink_target); ?>">
                        <?php echo esc_html($bloglink_title); ?>
                    </a>
                </h2>
            <?php endif; ?>

            <?php if ($blogdate): ?>
                <h3 class="bloglink-date"><?php echo esc_html($blogdate); ?></h3>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .bloglink-block {
        width: 100%;
        padding-top: 40px;
        display: flex;
        justify-content: center;
        background-color: #f8f6f2;
    }

    .bloglink-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        max-width: 800px;
        width: 100%;
    }

    .bloglink-image {
        width: 100%;
        height: auto;
        max-width: 800px;
    }

    .bloglink-image img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 6px;
    }

    .bloglink-content {
        text-align: center;
    }

    .bloglink-date {
        font-size: 1rem;
        color: #7f7f7d;
        margin-bottom: 10px;
    }

    .bloglink-title a {
        color: #333333;
        text-decoration: none;
        font-size: 1.5rem;
        font-weight: 700;
        text-decoration: underline #333333 2px;
    }

    @media (max-width: 768px) {
        .bloglink-container {
            max-width: 90%;
        }

        .bloglink-title a {
            font-size: 1.25rem;
        }

        .bloglink-date {
            font-size: 0.9rem;
        }
    }
</style>