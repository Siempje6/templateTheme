<?php

$selected_class = get_sub_field('block');

if (!$selected_class) {
    echo '<p style="color:#a00;">Geen CTA geselecteerd.</p>';
    return;
}

$ctas = get_field('call_to_action', 'option');

if (!$ctas) {
    echo '<p style="color:#a00;">Geen CTA\'s gevonden in de instellingen.</p>';
    return;
}

$selected_cta = false;

foreach ($ctas as $cta) {
    if (($cta['class'] ?? '') === $selected_class) {
        $selected_cta = $cta;
        break;
    }
}

if (!$selected_cta) {
    echo '<p style="color:#a00;">CTA niet gevonden: ' . esc_html($selected_class) . '</p>';
    return;
}

$cta = $selected_cta;

$partial = get_stylesheet_directory() . '/lib/cta-preview/partials/cta.php';

if (file_exists($partial)) {
    include $partial;
} else {
    echo '<p style="color:#a00;">CTA template niet gevonden.</p>';
}
