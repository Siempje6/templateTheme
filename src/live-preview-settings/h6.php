<?php

$styling_h6    = get_sub_field('styling_h6');
$decoration_h6 = get_sub_field('decoration_h6');
$color_h6      = get_sub_field('colors_h6'); 
$responsive_h6 = get_sub_field('responsive_h6');

$font_size   = !empty($styling_h6['font_size_h6']) ? $styling_h6['font_size_h6'] : '32';
$font_weight = !empty($styling_h6['font_weight']) ? $styling_h6['font_weight'] : '400';
$font_family = !empty($styling_h6['font_family']) ? $styling_h6['font_family'] : 'Arial, sans-serif';

$line_height = !empty($styling_h6['line_height']) ? $styling_h6['line_height'] : '';
$letter_spacing = !empty($styling_h6['letter_spacing']) ? $styling_h6['letter_spacing'] : '0';
$text_shadow = !empty($styling_h6['text_shadow_option']) ? $styling_h6['text_shadow_option'] : '1px 1px h6px rgba(0,0,0,0.h6)';
$word_spacing = !empty($styling_h6['word_spacing']) ? $styling_h6['word_spacing'] : '0';
$font_variant = !empty($styling_h6['font_variant']) ? $styling_h6['font_variant'] : 'normal';
$text_overflow = !empty($styling_h6['text_overflow']) ? $styling_h6['text_overflow'] : 'clip';
$word_wrap = !empty($styling_h6['word_wrap_break']) ? $styling_h6['word_wrap_break'] : 'normal';

$decoration = !empty($decoration_h6['decoration']) ? $decoration_h6['decoration'] : 'none';
$style      = !empty($decoration_h6['style']) ? $decoration_h6['style'] : 'normal';
$transform  = !empty($decoration_h6['transform']) ? $decoration_h6['transform'] : 'none';

$color = !empty($color_h6['color']) ? $color_h6['color'] : '#000';
$text_gradient = !empty($color_h6['text_gradient']) ? $color_h6['text_gradient'] : '';
$hover_color = !empty($color_h6['hover_color']) ? $color_h6['hover_color'] : '';
?>

<h6 style="
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
    Preview Font h6
</h6>

<style>
    h6:hover {
       color: <?php echo esc_attr($hover_color) ?>;
    }
</style>
