<?php

$styling_h1    = get_sub_field('styling_h1');
$decoration_h1 = get_sub_field('decoration_h1');
$color_h1      = get_sub_field('colors_h1');
$responsive_h1 = get_sub_field('responsive_h1');

$font_size   = !empty($styling_h1['font_size_h1']) ? $styling_h1['font_size_h1'] : '32';
$font_weight = !empty($styling_h1['font_weight']) ? $styling_h1['font_weight'] : '400';
$font_family = !empty($styling_h1['font_family']) ? $styling_h1['font_family'] : 'Arial, sans-serif';

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

$color = !empty($color_h1['color']) ? $color_h1['color'] : '#1a5428';
$text_gradient = !empty($color_h1['text_gradient']) ? $color_h1['text_gradient'] : '';
$hover_color = !empty($color_h1['hover_color']) ? $color_h1['hover_color'] : '';
?>

<h1 style="
    margin-left: 2rem;
    margin-right: 2rem;
    margin-bottom: 0rem;
    font-size: calc(<?php echo esc_attr($font_size); ?>px + 1vw) !important;
    font-weight: <?php echo esc_attr($font_weight); ?>;
    font-family: <?php echo esc_attr($font_family); ?>;

    line-height: <?php echo esc_attr($line_height) ?>px;
    letter-spacing: <?php echo esc_attr($letter_spacing) ?>px;
    text-shadow: <?php echo esc_attr($text_shadow) ?>;
    word-spacing: <?php echo esc_attr($word_spacing) ?>px;
    font-variant: <?php echo esc_attr($font_variant) ?>;
    text-overflow: <?php echo esc_attr($text_overflow) ?>;
    word-wrap: <?php echo esc_attr($word_wrap) ?>;

    text-decoration: <?php echo esc_attr($decoration); ?>;
    font-style: <?php echo esc_attr($style); ?>;
    text-transform: <?php echo esc_attr($transform); ?>;

    color: <?php echo esc_attr($color); ?>;
    text-gradient: <?php echo esc_attr($text_gradient) ?>;

    ">
    Preview Font H1
</h1>

<style>
    h1:hover {
        color: <?php echo esc_attr($hover_color) ?>;
    }
</style>