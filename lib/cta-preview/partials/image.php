<?php
$image = $block['image'] ?? null;
$text_under = $block['text_under_image'] ?? '';

if ($image) {
    echo '<div class="cta-image">';
    echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt'] ?? '') . '" style="max-width:100%;height:auto;">';
    if ($text_under) {
        echo '<div class="cta-image-text">' . wp_kses_post($text_under) . '</div>';
    }
    echo '</div>';
}
?>


<style>
 
</style>