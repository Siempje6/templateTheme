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
