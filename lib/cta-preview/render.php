<?php

echo '<div class="wrap cta-preview-admin">';
echo '<h1 style="margin-bottom: 1.5rem;">CTA Preview</h1>';

$ctas = get_field('call_to_action', 'option');

if (!$ctas) {
    echo '<div class="notice notice-warning"><p>Geen CTA\'s gevonden in de instellingen.</p></div>';
    echo '</div>';
    return;
}

echo '<form method="get" class="cta-preview-form">';
echo '<input type="hidden" name="page" value="cta-preview">';
echo '<label for="cta_class">Selecteer een CTA:</label> ';
echo '<select name="cta_class" id="cta_class" class="regular-text">';
foreach ($ctas as $cta) {
    $class = $cta['class'] ?? '';
    if (!$class) continue;
    $selected = (isset($_GET['cta_class']) && $_GET['cta_class'] === $class) ? 'selected' : '';
    echo '<option value="' . esc_attr($class) . '" ' . $selected . '>' . esc_html($class) . '</option>';
}
echo '</select> ';
echo '<button class="button button-primary">Preview tonen</button>';
echo '</form>';

if (isset($_GET['cta_class'])) {
    $selected_class = sanitize_text_field($_GET['cta_class']);

    foreach ($ctas as $cta) {
        if (($cta['class'] ?? '') === $selected_class) {
            echo '<div class="cta-preview-area">';
            include __DIR__ . '/partials/cta.php';
            echo '</div>';
        }
    }
}

echo '</div>';
?>

<style>
.cta-preview-admin {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.cta-preview-form {
    background: #fff;
    border: 1px solid #dcdcde;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.cta-preview-area {
    background: #f6f7f7;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #dcdcde;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.04);
}

.wp-core-ui .button-primary {
    background-color: #1a5428;
}
.wp-core-ui .button-primary:hover {
    background-color: #247e3b;
}
</style>
