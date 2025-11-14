<?php
$text = $block['text'] ?? '';
if ($text) {
    echo '<div class="cta-text">' . wp_kses_post($text) . '</div>';
}
?>

<style>

</style>