<?php

$styling_h5    = get_sub_field('styling_h5');
$decoration_h5 = get_sub_field('decoration_h5');
$color_h5      = get_sub_field('colors_h5'); 
$responsive_h5 = get_sub_field('responsive_h5');

$font_size   = !empty($styling_h5['font_size_h5']) ? $styling_h5['font_size_h5'] : '32';
$font_weight = !empty($styling_h5['font_weight']) ? $styling_h5['font_weight'] : '400';
$font_family = !empty($styling_h5['font_family']) ? $styling_h5['font_family'] : 'Arial, sans-serif';

$line_height = !empty($styling_h5['line_height']) ? $styling_h5['line_height'] : '';
$letter_spacing = !empty($styling_h5['letter_spacing']) ? $styling_h5['letter_spacing'] : '0';
$text_shadow = !empty($styling_h5['text_shadow_option']) ? $styling_h5['text_shadow_option'] : '1px 1px h5px rgba(0,0,0,0.h5)';
$word_spacing = !empty($styling_h5['word_spacing']) ? $styling_h5['word_spacing'] : '0';
$font_variant = !empty($styling_h5['font_variant']) ? $styling_h5['font_variant'] : 'normal';
$text_overflow = !empty($styling_h5['text_overflow']) ? $styling_h5['text_overflow'] : 'clip';
$word_wrap = !empty($styling_h5['word_wrap_break']) ? $styling_h5['word_wrap_break'] : 'normal';

$decoration = !empty($decoration_h5['decoration']) ? $decoration_h5['decoration'] : 'none';
$style      = !empty($decoration_h5['style']) ? $decoration_h5['style'] : 'normal';
$transform  = !empty($decoration_h5['transform']) ? $decoration_h5['transform'] : 'none';

$color = !empty($color_h5['color']) ? $color_h5['color'] : '#000';
$text_gradient = !empty($color_h5['text_gradient']) ? $color_h5['text_gradient'] : '';
$hover_color = !empty($color_h5['hover_color']) ? $color_h5['hover_color'] : '';
?>

<h5 style="
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
    Preview Font h5
</h5>

<style>
    h5:hover {
       color: <?php echo esc_attr($hover_color) ?>;
    }
</style>
