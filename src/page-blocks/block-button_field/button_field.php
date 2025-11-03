<?php
$button = get_sub_field('button'); 
$button_style = get_sub_field('button_style'); 

if ($button):
    $button_url    = $button['url'] ?? '#';
    $button_title  = $button['title'] ?? '';
    $button_target = $button['target'] ?? '_self';

    $font_size      = '14px';
    $font_weight    = '500';
    $font_family    = 'Arial, sans-serif';
    $line_height    = 'normal';
    $letter_spacing = '0';
    $word_spacing   = '0';
    $padding_v      = '10px';
    $padding_h      = '20px';
    $border         = '';
    $border_radius  = '50px';
    $cursor         = 'pointer';
    $font_variant   = 'normal';
    $text_transform = 'none';

    $text_color     = '#fff';
    $bg_color       = '#1a5427';
    $transition     = 'all 0.3s ease';
    $animation      = 'none';

    if ($button_style === 'button 1'):
        $styling_btn = get_sub_field('styling_btn') ?: [];
        $colors_btn  = get_sub_field('colors_btn') ?: [];
        $effects_btn = get_sub_field('effects_btn') ?: [];

        $font_size      = !empty($styling_btn['font_size']) ? $styling_btn['font_size'] . 'px' : $font_size;
        $font_weight    = !empty($styling_btn['font_weight']) ? $styling_btn['font_weight'] : $font_weight;
        $font_family    = !empty($styling_btn['font_family']) ? $styling_btn['font_family'] : $font_family;
        $line_height    = !empty($styling_btn['line_heigth']) ? $styling_btn['line_heigth'] . 'px' : $line_height;
        $letter_spacing = !empty($styling_btn['letter_spacing']) ? $styling_btn['letter_spacing'] . 'px' : $letter_spacing;
        $word_spacing   = !empty($styling_btn['word_spacing']) ? $styling_btn['word_spacing'] . 'px' : $word_spacing;
        $padding_v      = !empty($styling_btn['padding_vertical']) ? $styling_btn['padding_vertical'] . 'px' : $padding_v;
        $padding_h      = !empty($styling_btn['padding_horizontal']) ? $styling_btn['padding_horizontal'] . 'px' : $padding_h;
        $border         = !empty($styling_btn['border']) ? $styling_btn['border'] : $border;
        $border_radius  = !empty($styling_btn['border_radius']) ? $styling_btn['border_radius'] . 'px' : $border_radius;
        $cursor         = !empty($styling_btn['cursor']) ? $styling_btn['cursor'] : $cursor;
        $font_variant   = !empty($styling_btn['font_variant']) ? $styling_btn['font_variant'] : $font_variant;
        $text_transform = !empty($styling_btn['text_transform']) ? $styling_btn['text_transform'] : $text_transform;

        $text_color     = !empty($colors_btn['text_color']) ? $colors_btn['text_color'] : $text_color;
        $bg_color       = !empty($colors_btn['background_color']) ? $colors_btn['background_color'] : $bg_color;

        $transition     = !empty($effects_btn['transition']) ? $effects_btn['transition'] : $transition;
        $animation      = !empty($effects_btn['animation']) && $effects_btn['animation'] !== 'none' ? $effects_btn['animation'] . ' 0.5s' : 'none';
    endif;
?>
    <a href="<?php echo esc_url($button_url); ?>" 
       target="<?php echo esc_attr($button_target); ?>" 
       class="btn"
       style="
            display: inline-block;
            font-size: <?php echo esc_attr($font_size); ?>;
            font-weight: <?php echo esc_attr($font_weight); ?>;
            font-family: <?php echo esc_attr($font_family); ?>;
            line-height: <?php echo esc_attr($line_height); ?>;
            letter-spacing: <?php echo esc_attr($letter_spacing); ?>;
            word-spacing: <?php echo esc_attr($word_spacing); ?>;
            padding: <?php echo esc_attr($padding_v); ?> <?php echo esc_attr($padding_h); ?>;
            border: <?php echo esc_attr($border); ?>;
            border-radius: <?php echo esc_attr($border_radius); ?>;
            cursor: <?php echo esc_attr($cursor); ?>;
            font-variant: <?php echo esc_attr($font_variant); ?>;
            text-transform: <?php echo esc_attr($text_transform); ?>;
            color: <?php echo esc_attr($text_color); ?>;
            background: <?php echo esc_attr($bg_color); ?>;
            transition: <?php echo esc_attr($transition); ?>;
            <?php if($animation !== 'none') echo "animation: $animation;"; ?>
       ">
        <?php echo esc_html($button_title); ?>
    </a>
<?php endif; ?>
