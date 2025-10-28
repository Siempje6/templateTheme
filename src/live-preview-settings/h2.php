<?php
$h_group = get_sub_field('h2_font');

if ($h_group) {
    $preview_flex = $h_group['preview_font'] ?? null;
    $title = '';
    if ($preview_flex && isset($preview_flex[0]['preview_font_h2'])) {
        $title = $preview_flex[0]['preview_font_h2'];
    }

    $style_group = $h_group['style'] ?? [];
    $font_family = $style_group['font_family'] ?? "'Times New Roman', serif";
    $font_size   = $style_group['default_font_size'] ?: '1.5rem';
    $font_weight = $style_group['font_weight'] ?: '700';

    $decoration_group = $h_group['decoration'] ?? [];
    $decoration = $decoration_group['decoration'] ?? 'none';
    $style      = $decoration_group['style'] ?? 'normal';
    $transform  = $decoration_group['transform'] ?? 'none';

    $inline_style = sprintf(
        'font-family:%s;font-weight:%s;text-decoration:%s;font-style:%s;text-transform:%s;font-size:%s;',
        esc_attr($font_family),
        esc_attr($font_weight),
        esc_attr($decoration),
        esc_attr($style),
        esc_attr($transform),
        esc_attr($font_size)
    );
}
?>

<h2 class="title-preview-h2" style="<?php echo esc_attr($inline_style ?? ''); ?>">
    <?php echo esc_html($title ?? 'Preview Font H2'); ?>
</h2>
