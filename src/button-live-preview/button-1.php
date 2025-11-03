<?php
$styling_btn = get_sub_field('styling_btn');
$colors_btn  = get_sub_field('colors_btn');
$effects_btn = get_sub_field('effects_btn');

if (!$styling_btn) $styling_btn = [];
if (!$colors_btn)  $colors_btn  = [];
if (!$effects_btn) $effects_btn = [];

$font_size       = !empty($styling_btn['font_size']) ? $styling_btn['font_size'] . 'px' : '16px';
$font_weight     = !empty($styling_btn['font_weight']) ? $styling_btn['font_weight'] : '400';
$font_family     = !empty($styling_btn['font_family']) ? $styling_btn['font_family'] : 'Arial, sans-serif';
$line_height     = !empty($styling_btn['line_heigth']) ? $styling_btn['line_heigth'] . 'px' : 'normal';
$letter_spacing  = !empty($styling_btn['letter_spacing']) ? $styling_btn['letter_spacing'] . 'px' : '0';
$word_spacing    = !empty($styling_btn['word_spacing']) ? $styling_btn['word_spacing'] . 'px' : '0';
$padding_v       = !empty($styling_btn['padding_vertical']) ? $styling_btn['padding_vertical'] . 'px' : '10px';
$padding_h       = !empty($styling_btn['padding_horizontal']) ? $styling_btn['padding_horizontal'] . 'px' : '20px';
$border          = !empty($styling_btn['border']) ? $styling_btn['border'] : '';
$border_radius   = !empty($styling_btn['border_radius']) ? $styling_btn['border_radius'] . 'px' : '4px';
$cursor          = !empty($styling_btn['cursor']) ? $styling_btn['cursor'] : 'pointer';
$font_variant    = !empty($styling_btn['font_variant']) ? $styling_btn['font_variant'] : 'normal';
$text_transform  = !empty($styling_btn['text_transform']) ? $styling_btn['text_transform'] : 'none';

$text_color      = !empty($colors_btn['text_color']) ? $colors_btn['text_color'] : '#fff';
$bg_color        = !empty($colors_btn['background_color']) ? $colors_btn['background_color'] : '#1a73e8';
$text_gradient   = !empty($colors_btn['text_gradient']) ? $colors_btn['text_gradient'] : '';
$bg_gradient     = !empty($colors_btn['background_gradient']) ? $colors_btn['background_gradient'] : '';
$border_color    = !empty($colors_btn['border_color']) ? $colors_btn['border_color'] : '';
$hover_text      = !empty($colors_btn['hover_text_color']) ? $colors_btn['hover_text_color'] : '';
$hover_bg        = !empty($colors_btn['hover_background_color']) ? $colors_btn['hover_background_color'] : '';
$hover_border    = !empty($colors_btn['hover_border_color']) ? $colors_btn['hover_border_color'] : '';

$hover_shadow    = !empty($effects_btn['hover_shadow']) ? $effects_btn['hover_shadow'] : '';
$transition      = !empty($effects_btn['transition']) ? $effects_btn['transition'] : 'all 0.3s ease';
$animation       = !empty($effects_btn['animation']) ? $effects_btn['animation'] : 'none';

$btn_id = 'btn-' . uniqid();
?>

<button id="<?php echo esc_attr($btn_id); ?>" style="
    margin: 2rem;
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
    background: <?php echo !empty($bg_gradient) ? $bg_gradient : $bg_color; ?>;
    <?php if(!empty($text_gradient)) echo "background: $text_gradient; -webkit-background-clip: text; -webkit-text-fill-color: transparent;"; ?>
    transition: <?php echo esc_attr($transition); ?>;
    <?php if(!empty($animation) && $animation !== 'none') echo "animation: $animation 0.5s;"; ?>
">
    Preview Btn
</button>

<?php if ($hover_text || $hover_bg || $hover_border || $hover_shadow): ?>
<style>
    #<?php echo esc_attr($btn_id); ?>:hover {
        <?php if($hover_text) echo "color: $hover_text;"; ?>
        <?php if($hover_bg) echo "background: $hover_bg;"; ?>
        <?php if($hover_border) echo "border-color: $hover_border;"; ?>
        <?php if($hover_shadow) echo "box-shadow: $hover_shadow;"; ?>
    }
</style>
<?php endif; ?>
