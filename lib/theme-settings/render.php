<?php

echo '<div class="wrap">';
echo '<h1>Theme Settings Preview</h1>';
echo '<p>Hier zie je de live previews van H1 t/m H6.</p>';
echo '</div>';

$fields = [
    'H1' => ['name' => 'preview_h1', 'template' => 'h1.php'],
    'H2' => ['name' => 'preview_h2', 'template' => 'h2.php'],
    'H3' => ['name' => 'preview_h3', 'template' => 'h3.php'],
    'H4' => ['name' => 'preview_h4', 'template' => 'h4.php'],
    'H5' => ['name' => 'preview_h5', 'template' => 'h5.php'],
    'H6' => ['name' => 'preview_h6', 'template' => 'h6.php'],
];

foreach ($fields as $label => $info) {

    $fieldname = $info['name'];
    $templatename = $info['template'];

    echo '<div style="margin-top:40px; padding:20px; background:#fff; border-radius:10px;">';
    echo '<h2 style="margin-bottom:20px;">Preview ' . $label . '</h2>';

    $rows = get_field($fieldname, 'option');

    if (!$rows) {
        echo '<p>Geen previews gevonden.</p>';
        echo '</div>';
        continue;
    }

    $field_object = get_field_object($fieldname, 'option');

    foreach ($rows as $row) {

        echo '<div style="padding:20px; border:1px solid #ddd; margin-bottom:20px; border-radius:6px;">';

        $template = get_template_directory() . "/src/live-preview-settings/" . $templatename;

        if (file_exists($template)) {

            $layout     = $row;
            $field      = $field_object;
            $is_preview = true;

            include $template;

            echo '<pre style="background:#111;color:#0f0;padding:20px;margin-top:20px;">';
            print_r($layout);
            echo '</pre>';
        } else {
            echo "<p style='color:red;'>Template niet gevonden: $template</p>";
        }

        echo '</div>';
    }

    echo '</div>';
}
