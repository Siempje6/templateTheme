<?php
$ctas = get_field('call_to_action', 'option');

echo '<div class="cta-options-preview" style="margin-bottom:20px; padding:20px; background:#f6f7f7; border-radius:8px; max-width:1200px; margin-left:auto; margin-right:auto;">';
echo '<h2 style="margin-bottom:15px;">CTA Preview</h2>';

if (!$ctas) {
    echo '<p style="color:#a00;">Geen CTA\'s gevonden</p>';
} else {
    foreach ($ctas as $cta) {
        $cta_rows = [$cta];

        $file = get_template_directory() . '/lib/cta-preview/render.php';
        if (file_exists($file)) {
            include_once $file;
        } else {
            echo '<p style="color:red;">CTA render bestand niet gevonden!</p>';
        }
    }
}

echo '</div>';
