<?php
$separator_size = get_sub_field('separator') ?: 'm';
$options = get_sub_field('options') ?: [];

$show_line = !empty($options['lijn']);
$line_thickness = $options['line_thickness'] ?? '1px';
$line_width = $options['width'] ?? '100%';
$line_color = $options['line_color'] ?? 'black';
$alignment_line = $options['alignment_line'] ?? 'left';

$classes = [
    'separator',
    "separator-{$separator_size}",
];

if ($show_line) {
    $classes[] = 'has-line';
    $classes[] = "line-color-{$line_color}";
    $classes[] = "line-align-{$alignment_line}";
}

$classes_str = implode(' ', $classes);
?>

<?php if ($separator_size): ?>
    <div 
        class="<?php echo esc_attr($classes_str); ?>"
        <?php if ($show_line): ?>
            style="--line-width: <?php echo esc_attr($line_width); ?>;
                   --line-thickness: <?php echo esc_attr($line_thickness); ?>;"
        <?php endif; ?>
    >
        <?php if ($show_line): ?>
            <div class="separator-line"></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
