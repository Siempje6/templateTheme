<?php
$block_id = $block['block'] ?? null;

if ($block_id) {
    // WordPress reusable block renderen
    echo apply_filters('the_content', '<!-- wp:block {"ref":' . intval($block_id) . '} /-->');
} else {
    echo '<p style="color:#888;">Geen block geselecteerd.</p>';
}
?>
