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

if ($font_size === 'h1') :

    $has_preview = have_rows('preview_h1');
    $styling_h1 = $decoration_h1 = $color_h1 = $responsive_h1 = [];

    if ($has_preview) {
        while (have_rows('preview_h1')) : the_row();
            $styling_h1    = get_sub_field('styling_h1');
            $decoration_h1 = get_sub_field('decoration_h1');
            $color_h1      = get_sub_field('colors_h1');
            $responsive_h1 = get_sub_field('responsive_h1');
        endwhile;
    }

    $font_size_px = !empty($styling_h1['font_size_h1']) ? $styling_h1['font_size_h1'] : '42';
    $font_weight  = !empty($styling_h1['font_weight']) ? $styling_h1['font_weight'] : '400';
    $font_family  = !empty($styling_h1['font_family']) ? $styling_h1['font_family'] : 'Arial, sans-serif';

    $line_height = !empty($styling_h1['line_height']) ? $styling_h1['line_height'] : '';
    $letter_spacing = !empty($styling_h1['letter_spacing']) ? $styling_h1['letter_spacing'] : '0';
    $text_shadow = !empty($styling_h1['text_shadow_option']) ? $styling_h1['text_shadow_option'] : '1px 1px 2px rgba(0,0,0,0.2)';
    $word_spacing = !empty($styling_h1['word_spacing']) ? $styling_h1['word_spacing'] : '0';
    $font_variant = !empty($styling_h1['font_variant']) ? $styling_h1['font_variant'] : 'normal';
    $text_overflow = !empty($styling_h1['text_overflow']) ? $styling_h1['text_overflow'] : 'clip';
    $word_wrap = !empty($styling_h1['word_wrap_break']) ? $styling_h1['word_wrap_break'] : 'normal';

    $decoration = !empty($decoration_h1['decoration']) ? $decoration_h1['decoration'] : 'none';
    $style      = !empty($decoration_h1['style']) ? $decoration_h1['style'] : 'normal';
    $transform  = !empty($decoration_h1['transform']) ? $decoration_h1['transform'] : 'none';

    $color        = !empty($color_h1['color']) ? $color_h1['color'] : '#000';
    $text_gradient = !empty($color_h1['text_gradient']) ? $color_h1['text_gradient'] : '';
    $hover_color  = !empty($color_h1['hover_color']) ? $color_h1['hover_color'] : '';

    $desktop_size = !empty($responsive_h1['desktop']['font_size_desktop']) ? $responsive_h1['desktop']['font_size_desktop'] : '';
    $laptop_size  = !empty($responsive_h1['laptop']['font_size_laptop']) ? $responsive_h1['laptop']['font_size_laptop'] : '';
    $tablet_size  = !empty($responsive_h1['tablet']['font_size_tablet']) ? $responsive_h1['tablet']['font_size_tablet'] : '';
    $phone_size   = !empty($responsive_h1['phone']['font_size_phone']) ? $responsive_h1['phone']['font_size_phone'] : '';
    ?>

    <h1 class="acf-h1-dynamic" style="
        margin-left: 2rem;
        margin-right: 2rem;
        margin-bottom: 0rem;
        font-size: <?php echo esc_attr($font_size_px); ?>px;
        font-weight: <?php echo esc_attr($font_weight); ?>;
        font-family: <?php echo esc_attr($font_family); ?>;
        <?php if ($line_height): ?>line-height: <?php echo esc_attr($line_height); ?>px;<?php endif; ?>
        letter-spacing: <?php echo esc_attr($letter_spacing); ?>px;
        text-shadow: <?php echo esc_attr($text_shadow); ?>;
        word-spacing: <?php echo esc_attr($word_spacing); ?>px;
        font-variant: <?php echo esc_attr($font_variant); ?>;
        text-overflow: <?php echo esc_attr($text_overflow); ?>;
        word-wrap: <?php echo esc_attr($word_wrap); ?>;
        text-decoration: <?php echo esc_attr($decoration); ?>;
        font-style: <?php echo esc_attr($style); ?>;
        text-transform: <?php echo esc_attr($transform); ?>;
        color: <?php echo esc_attr($color); ?>;
        <?php if ($text_gradient): ?>
            background: <?php echo esc_attr($text_gradient); ?>;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        <?php endif; ?>
    ">
        <?php echo esc_html($title); ?>
    </h1>

    <style>
        .acf-h1-dynamic:hover {
            color: <?php echo esc_attr($hover_color ?: $color); ?>;
        }
    </style>

<?php
else :
    // fallback: alle andere heading types
    ?>
    <<?php echo esc_html($font_size); ?> class="<?php echo esc_attr($classes_str); ?>">
        <?php echo esc_html($title); ?>
    </<?php echo esc_html($font_size); ?>>
<?php endif; ?>
