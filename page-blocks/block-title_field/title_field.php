<?php
if (!defined('ABSPATH')) exit;

$title = get_sub_field('title');
if (!$title) return;

$title_styling = get_sub_field('title_styling');
if (!is_array($title_styling)) $title_styling = [];

$font_size   = !empty($title_styling['font_size']) ? strtolower($title_styling['font_size']) : 'h2';
$font_color  = !empty($title_styling['font_color']) ? $title_styling['font_color'] : 'black';
$font_weight = !empty($title_styling['font_weight']) ? $title_styling['font_weight'] : '400';
$font_family = !empty($title_styling['font_family']) ? $title_styling['font_family'] : 'Times New Roman, Times, serif';
$decoration  = !empty($title_styling['decoration']) ? $title_styling['decoration'] : 'none';
$style       = !empty($title_styling['style']) ? $title_styling['style'] : 'normal';
$transform   = !empty($title_styling['transform']) ? $title_styling['transform'] : 'none';

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


function render_heading($level, $preview_field, $title) {
    $styling = [];
    $colors = [];
    $decoration = [];

    if ($preview_field && is_array($preview_field) && isset($preview_field[0])) {
        $layout = $preview_field[0];
        if (isset($layout['styling_' . $level]))    $styling    = $layout['styling_' . $level];
        if (isset($layout['colors_' . $level]))     $colors     = $layout['colors_' . $level];
        if (isset($layout['decoration_' . $level])) $decoration = $layout['decoration_' . $level];
    }

    $font_size_px   = !empty($styling['font_size_' . $level]) ? $styling['font_size_' . $level] : '20';
    $font_weight    = !empty($styling['font_weight']) ? $styling['font_weight'] : '400';
    $font_family    = !empty($styling['font_family']) ? $styling['font_family'] : 'Arial, sans-serif';
    $line_height    = !empty($styling['line_height']) ? $styling['line_height'] : '';
    $letter_spacing = !empty($styling['letter_spacing']) ? $styling['letter_spacing'] : '0';
    $text_shadow    = !empty($styling['text_shadow_option']) ? $styling['text_shadow_option'] : '';
    $word_spacing   = !empty($styling['word_spacing']) ? $styling['word_spacing'] : '0';
    $font_variant   = !empty($styling['font_variant']) ? $styling['font_variant'] : 'normal';
    $text_overflow  = !empty($styling['text_overflow']) ? $styling['text_overflow'] : 'clip';
    $word_wrap      = !empty($styling['word_wrap_break']) ? $styling['word_wrap_break'] : 'normal';

    $decoration_val = !empty($decoration['decoration']) ? $decoration['decoration'] : 'none';
    $style_val      = !empty($decoration['style']) ? $decoration['style'] : 'normal';
    $transform_val  = !empty($decoration['transform']) ? $decoration['transform'] : 'none';

    $color = !empty($colors['color']) ? $colors['color'] : '#000';
    $hover_color = !empty($colors['hover_color']) ? $colors['hover_color'] : '';
    $text_gradient = !empty($colors['text_gradient']) ? $colors['text_gradient'] : '';

    ?>
    <<?php echo esc_html($level); ?> style="
        margin-left: 2rem;
        margin-right: 2rem;
        margin-bottom: 0rem;

        font-size: <?php echo esc_attr($font_size_px); ?>px;
        font-weight: <?php echo esc_attr($font_weight); ?>;
        font-family: <?php echo esc_attr($font_family); ?>;

        line-height: <?php echo esc_attr($line_height); ?>px;
        letter-spacing: <?php echo esc_attr($letter_spacing); ?>px;
        text-shadow: <?php echo esc_attr($text_shadow); ?>;
        word-spacing: <?php echo esc_attr($word_spacing); ?>px;
        font-variant: <?php echo esc_attr($font_variant); ?>;
        text-overflow: <?php echo esc_attr($text_overflow); ?>;
        word-wrap: <?php echo esc_attr($word_wrap); ?>;

        text-decoration: <?php echo esc_attr($decoration_val); ?>;
        font-style: <?php echo esc_attr($style_val); ?>;
        text-transform: <?php echo esc_attr($transform_val); ?>;

        color: <?php echo esc_attr($color); ?>;
        <?php if(!empty($text_gradient)) echo "background: $text_gradient; -webkit-background-clip: text; -webkit-text-fill-color: transparent;"; ?>
    ">
        <?php echo esc_html($title); ?>
    </<?php echo esc_html($level); ?>>

    <?php if (!empty($hover_color)) : ?>
        <style>
            <?php echo esc_html($level); ?>:hover {
                color: <?php echo esc_attr($hover_color); ?>;
            }
        </style>
    <?php endif; ?>
<?php
}


switch($font_size) {
    case 'h1':
        $preview = get_field('preview_h1', 'option');
        render_heading('h1', $preview, $title);
        break;
    case 'h2':
        $preview = get_field('preview_h2', 'option');
        render_heading('h2', $preview, $title);
        break;
    case 'h3':
        $preview = get_field('preview_h3', 'option');
        render_heading('h3', $preview, $title);
        break;
    case 'h4':
        $preview = get_field('preview_h4', 'option');
        render_heading('h4', $preview, $title);
        break;
    case 'h5':
        $preview = get_field('preview_h5', 'option');
        render_heading('h5', $preview, $title);
        break;
    case 'h6':
        $preview = get_field('preview_h6', 'option');
        render_heading('h6', $preview, $title);
        break;
    default:
        // fallback
        ?>
        <<?php echo esc_html($font_size); ?> class="<?php echo esc_attr($classes_str); ?>">
            <?php echo esc_html($title); ?>
        </<?php echo esc_html($font_size); ?>>
        <?php
}
