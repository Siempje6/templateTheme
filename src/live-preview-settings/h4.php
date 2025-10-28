<?php

$styling_h4    = get_sub_field('styling_h4');
$decoration_h4 = get_sub_field('decoration_h4');
$color_h4      = get_sub_field('colors_h4'); 
$responsive_h4 = get_sub_field('responsive_h4');

$font_size   = !empty($styling_h4['font_size_h4']) ? $styling_h4['font_size_h4'] : '32';
$font_weight = !empty($styling_h4['font_weight']) ? $styling_h4['font_weight'] : '400';
$font_family = !empty($styling_h4['font_family']) ? $styling_h4['font_family'] : 'Arial, sans-serif';

$line_height = !empty($styling_h4['line_height']) ? $styling_h4['line_height'] : '';
$letter_spacing = !empty($styling_h4['letter_spacing']) ? $styling_h4['letter_spacing'] : '0';
$text_shadow = !empty($styling_h4['text_shadow_option']) ? $styling_h4['text_shadow_option'] : '1px 1px h4px rgba(0,0,0,0.h4)';
$word_spacing = !empty($styling_h4['word_spacing']) ? $styling_h4['word_spacing'] : '0';
$font_variant = !empty($styling_h4['font_variant']) ? $styling_h4['font_variant'] : 'normal';
$text_overflow = !empty($styling_h4['text_overflow']) ? $styling_h4['text_overflow'] : 'clip';
$word_wrap = !empty($styling_h4['word_wrap_break']) ? $styling_h4['word_wrap_break'] : 'normal';

$decoration = !empty($decoration_h4['decoration']) ? $decoration_h4['decoration'] : 'none';
$style      = !empty($decoration_h4['style']) ? $decoration_h4['style'] : 'normal';
$transform  = !empty($decoration_h4['transform']) ? $decoration_h4['transform'] : 'none';

$color = !empty($color_h4['color']) ? $color_h4['color'] : '#000';
$text_gradient = !empty($color_h4['text_gradient']) ? $color_h4['text_gradient'] : '';
$hover_color = !empty($color_h4['hover_color']) ? $color_h4['hover_color'] : '';
?>

<h4 style="
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
    Preview Font h4
</h4>

<style>
    h4:hover {
       color: <?php echo esc_attr($hover_color) ?>;
    }
</style>
