<?php

$styling_h3    = get_sub_field('styling_h3');
$decoration_h3 = get_sub_field('decoration_h3');
$color_h3      = get_sub_field('colors_h3');
$responsive_h3 = get_sub_field('responsive_h3');

$font_size   = !empty($styling_h3['font_size_h3']) ? $styling_h3['font_size_h3'] : '32';
$font_weight = !empty($styling_h3['font_weight']) ? $styling_h3['font_weight'] : '400';
$font_family = !empty($styling_h3['font_family']) ? $styling_h3['font_family'] : 'Arial, sans-serif';

$line_height = !empty($styling_h3['line_height']) ? $styling_h3['line_height'] : '';
$letter_spacing = !empty($styling_h3['letter_spacing']) ? $styling_h3['letter_spacing'] : '0';
$text_shadow = !empty($styling_h3['text_shadow_option']) ? $styling_h3['text_shadow_option'] : '1px 1px h3px rgba(0,0,0,0.h3)';
$word_spacing = !empty($styling_h3['word_spacing']) ? $styling_h3['word_spacing'] : '0';
$font_variant = !empty($styling_h3['font_variant']) ? $styling_h3['font_variant'] : 'normal';
$text_overflow = !empty($styling_h3['text_overflow']) ? $styling_h3['text_overflow'] : 'clip';
$word_wrap = !empty($styling_h3['word_wrap_break']) ? $styling_h3['word_wrap_break'] : 'normal';

$decoration = !empty($decoration_h3['decoration']) ? $decoration_h3['decoration'] : 'none';
$style      = !empty($decoration_h3['style']) ? $decoration_h3['style'] : 'normal';
$transform  = !empty($decoration_h3['transform']) ? $decoration_h3['transform'] : 'none';

$color = !empty($color_h3['color']) ? $color_h3['color'] : '#000';
$text_gradient = !empty($color_h3['text_gradient']) ? $color_h3['text_gradient'] : '';
$hover_color = !empty($color_h3['hover_color']) ? $color_h3['hover_color'] : '';
?>

<h3 style="
    margin-left: 20px;
    font-size: <?php echo esc_attr($font_size); ?>px;
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
    Preview Font h3
</h3>

<style>
    h3:hover {
        color: <?php echo esc_attr($hover_color) ?>;
    }
</style>