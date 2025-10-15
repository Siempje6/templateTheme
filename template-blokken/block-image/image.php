<?php

$image = get_sub_field('image');

$corners = get_sub_field('corners');
$border_class = 'small';
if ($corners && is_array($corners) && isset($corners[0]['imagecorners'])) {
    $border_class = $corners[0]['imagecorners'];
}

$size_repeater = get_sub_field('size');
$size_class = 'normal';
if ($size_repeater && is_array($size_repeater) && isset($size_repeater[0]['imagesize'])) {
    $size_class = $size_repeater[0]['imagesize'];
}
?>

<section id="pagina-image" class="image-block">
    <div class="container image-container <?php echo esc_attr($size_class); ?>">
        <?php if ($image): ?>
            <img
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt']); ?>"
                class="image-content <?php echo esc_attr($border_class); ?>">
        <?php endif; ?>
    </div>
</section>
