<?php
function set_global_typography_styles() {
    $styling_h1    = get_field('styling_h1', 'option');
    $decoration_h1 = get_field('decoration_h1', 'option');
    $color_h1      = get_field('colors_h1', 'option');
    $responsive_h1 = get_field('responsive_h1', 'option');

    $styles = '<style>
        :root {
            --h1-font-size: ' . (!empty($styling_h1['font_size_h1']) ? $styling_h1['font_size_h1'] . 'px' : '32px') . ';
            --h1-font-weight: ' . (!empty($styling_h1['font_weight']) ? $styling_h1['font_weight'] : '400') . ';
            --h1-font-family: ' . (!empty($styling_h1['font_family']) ? $styling_h1['font_family'] : 'Arial, sans-serif') . ';
            --h1-line-height: ' . (!empty($styling_h1['line_height']) ? $styling_h1['line_height'] : 'normal') . ';
            --h1-letter-spacing: ' . (!empty($styling_h1['letter_spacing']) ? $styling_h1['letter_spacing'] . 'px' : '0') . ';
            --h1-text-shadow: ' . (!empty($styling_h1['text_shadow_option']) ? $styling_h1['text_shadow_option'] : '1px 1px 2px rgba(0,0,0,0.2)') . ';
            --h1-word-spacing: ' . (!empty($styling_h1['word_spacing']) ? $styling_h1['word_spacing'] . 'px' : '0') . ';
            --h1-font-variant: ' . (!empty($styling_h1['font_variant']) ? $styling_h1['font_variant'] : 'normal') . ';
            --h1-text-overflow: ' . (!empty($styling_h1['text_overflow']) ? $styling_h1['text_overflow'] : 'clip') . ';
            --h1-word-wrap: ' . (!empty($styling_h1['word_wrap_break']) ? $styling_h1['word_wrap_break'] : 'normal') . ';
            --h1-decoration: ' . (!empty($decoration_h1['decoration']) ? $decoration_h1['decoration'] : 'none') . ';
        }
    </style>';
    
    echo $styles;
}
add_action('wp_head', 'set_global_typography_styles');