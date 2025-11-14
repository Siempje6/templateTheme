<?php
$btn = $block['button'] ?? null;
if ($btn && isset($btn['url'])) {
    echo '<a href="' . esc_url($btn['url']) . '" class="button" target="' . esc_attr($btn['target'] ?? '_self') . '">' . esc_html($btn['title'] ?? 'Button') . '</a>';
}
?>

<style>
    
</style>