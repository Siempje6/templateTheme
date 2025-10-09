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

<style>
    .image-block {
        width: 100%;
        padding: 20px 0;
        display: flex;
        justify-content: center;
        background-color: #f8f6f2;
    }

    .image-container {
        max-width: 1200px;
        display: flex;
        justify-content: center;
    }

    .image-container.small {
        width: 50%;
    }

    .image-container.normal {
        width: 60%;
    }

    .image-container.large {
        width: 70%;
    }

    .image-content {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .image-content.none {
        border-radius: 0;
    }

    .image-content.small {
        border-radius: 6px;
    }

    .image-content.medium {
        border-radius: 12px;
    }

    .image-content.large {
        border-radius: 24px;
    }

    
</style>