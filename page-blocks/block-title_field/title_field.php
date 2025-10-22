<?php
$title = get_sub_field('title');
$title_styling = get_sub_field('title_styling');

// Default values
$font_size = $title_styling['font_size'] ?? 'h2';
$font_color = $title_styling['font_color'] ?? 'black';
$font_weight = $title_styling['font_weight'] ?? '400';
$font_family = $title_styling['font_family'] ?? 'times new roman';
$decoration = $title_styling['decoration'] ?? 'none';
$style = $title_styling['style'] ?? 'normal';
$transform = $title_styling['transform'] ?? 'normal';

// Build classes
$classes = [
    "title",
    "title-{$font_size}",
    "color-{$font_color}",
    "weight-{$font_weight}",
    "font-" . str_replace(' ', '-', strtolower($font_family)),
    "decoration-" . str_replace(' ', '-', strtolower($decoration)),
    "style-" . strtolower($style),
    "transform-" . strtolower($transform),
];
$classes_str = implode(' ', $classes);
?>

<?php if ($title): ?>
    <<?php echo esc_html($font_size); ?> class="<?php echo esc_attr($classes_str); ?>">
        <?php echo esc_html($title); ?>
    </<?php echo esc_html($font_size); ?>>
<?php endif; ?>

