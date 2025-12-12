<?php
$title = get_sub_field('title');
$icon  = get_sub_field('icon');
$wrapper_item = get_sub_field('wrapper_item');
$active = get_sub_field('active_state');
$hover = get_sub_field('hover_state');
$animation = get_sub_field('animation_transition');

$title_weight    = $title['title_font_weight'] ?? '400';
$title_unit      = $title['font_size_options'] ?? 'px';
$title_value     = $title['title_font_size'] ?? '18';
$title_color     = $title['title_color'] ?? '#000';
$title_transform = $title['title_transform'] ?? 'none';
$font_family     = $title['font_family'] ?? "'Times New Roman', Times, serif";
$title_full      = $title_value . $title_unit;

$dropdown_icon = $icon['dropdown_icon'] ?? 'plus';
$icon_color    = $icon['icon_color'] ?? '#000000';
$icon_size     = $icon['icon_size'] ?? '16';
$icon_bg_color = $icon['icon_background_color'] ?? 'transparent';
$icon_padding  = $icon['icon_background_padding'] ?? 0;
$icon_padding_full = $icon_padding . 'px';
$icon_radius   = $icon['icon_background_radius'] ?? 0;

$irtl = $icon['irtl'] ?? null;
$irtr = $icon['irtr'] ?? null;
$irbl = $icon['irbl'] ?? null;
$irbr = $icon['irbr'] ?? null;

$icon_css_vars = [
    '--acc-icon-bg-color' => $icon_bg_color,
    '--acc-icon-bg-padding' => $icon_padding_full,
    '--acc-icon-radius' => $icon_radius . 'px',
];

if ($irtl) $icon_css_vars['--acc-icon-radius-top-left'] = $irtl . 'px';
if ($irtr) $icon_css_vars['--acc-icon-radius-top-right'] = $irtr . 'px';
if ($irbl) $icon_css_vars['--acc-icon-radius-bottom-left'] = $irbl . 'px';
if ($irbr) $icon_css_vars['--acc-icon-radius-bottom-right'] = $irbr . 'px';

$icon_style = '';
foreach ($icon_css_vars as $var => $val) {
    $icon_style .= "$var: $val; ";
}

$bg_color       = $wrapper_item['background_color'] ?? 'transparent';
$border_value   = $wrapper_item['border'] ?? '0';
$border_unit    = $wrapper_item['border_size'] ?? 'px';
$border_color   = $wrapper_item['border_color'] ?? 'transparent';

$border_top_left     = $wrapper_item['border_top_left_radius'] ?? null;
$border_top_right    = $wrapper_item['border_top_right_radius'] ?? null;
$border_bottom_left  = $wrapper_item['border_bottom_left_radius'] ?? null;
$border_bottom_right = $wrapper_item['border_bottom_right_radius'] ?? null;

$radius = $wrapper_item['border_radius'] ?? 0;

$radius_top_left     = $border_top_left !== null ? $border_top_left . 'px' : $radius . 'px';
$radius_top_right    = $border_top_right !== null ? $border_top_right . 'px' : $radius . 'px';
$radius_bottom_left  = $border_bottom_left !== null ? $border_bottom_left . 'px' : $radius . 'px';
$radius_bottom_right = $border_bottom_right !== null ? $border_bottom_right . 'px' : $radius . 'px';

$border_full    = $border_value . $border_unit . ' solid ' . $border_color;
$padding_unit   = $wrapper_item['padding_size'] ?? 'px';
$padding_value  = $wrapper_item['padding'] ?? '0';
$padding_full   = $padding_value . $padding_unit;
$margin_unit    = $wrapper_item['margin_size'] ?? 'px';
$margin_value   = $wrapper_item['margin'] ?? '0';
$margin_full    = $margin_value . $margin_unit;

$active_bg_raw       = $active['background_color'] ?? '';
$active_bg_content   = $active['background_content_color'] ?? '';
$active_title_color  = $active['title_color'] ?? '';
$active_icon_rotation_value = $active['icon_rotation'] ?? 180;
$active_icon_rotation = $active_icon_rotation_value . 'deg';

$hover_title_color = $hover['title_color'] ?? '';
$hover_bg_color    = $hover['background_color'] ?? '';

$anim_duration = $animation['animation_duration'] ?? 0.3;
$anim_timing   = $animation['timing_function'] ?? 'ease';

$accordion_id = 'acc-' . uniqid();

if (!function_exists('get_icon_html')) {
    function get_icon_html($icon) {
        switch ($icon) {
            case 'arrow': return '<i class="icon-arrow" aria-hidden="true"></i>';
            case 'plus': return '<i class="icon-plus" aria-hidden="true"></i>';
            case 'minus': return '<i class="icon-minus" aria-hidden="true"></i>';
            case 'chevron': return '<i class="icon-chevron" aria-hidden="true"></i>';
            default: return '<i class="icon-plus" aria-hidden="true"></i>';
        }
    }
}
?>

<div id="<?= esc_attr($accordion_id); ?>"
     class="accordion-wrapper"
     style="
        --acc-title-weight: <?= esc_attr($title_weight); ?>;
        --acc-title-size: <?= esc_attr($title_full); ?>;
        --acc-title-color: <?= esc_attr($title_color); ?>;
        --acc-title-transform: <?= esc_attr($title_transform); ?>;
        --acc-title-font-family: <?= esc_attr($font_family); ?>;

        --acc-icon-color: <?= esc_attr($icon_color); ?>;
        --acc-icon-size: <?= esc_attr($icon_size); ?>px;
        <?= esc_attr($icon_style); ?>

        --acc-bg-color: <?= esc_attr($bg_color); ?>;
        --acc-border: <?= esc_attr($border_full); ?>;

        --acc-radius-top-left: <?= esc_attr($radius_top_left); ?>;
        --acc-radius-top-right: <?= esc_attr($radius_top_right); ?>;
        --acc-radius-bottom-left: <?= esc_attr($radius_bottom_left); ?>;
        --acc-radius-bottom-right: <?= esc_attr($radius_bottom_right); ?>;
        --acc-radius: <?= esc_attr($radius); ?>px;
        --acc-padding: <?= esc_attr($padding_full); ?>;
        --acc-margin: <?= esc_attr($margin_full); ?>;

        --acc-active-bg: <?= esc_attr($active_bg_raw); ?>;
        --acc-active-content-bg: <?= esc_attr($active_bg_content); ?>;
        --acc-active-title-color: <?= esc_attr($active_title_color); ?>;
        --acc-active-icon-rotation: <?= esc_attr($active_icon_rotation); ?>;

        --acc-hover-bg: <?= esc_attr($hover_bg_color); ?>;
        --acc-hover-title-color: <?= esc_attr($hover_title_color); ?>;

        --acc-anim-duration: <?=  esc_attr($anim_duration); ?>s;
        --acc-anim-timing: <?=  esc_attr($anim_timing); ?>
     ">

<?php
$items = get_sub_field('accordion_items');
if ($items):
    foreach ($items as $item):
?>
    <div class="accordion-item">
        <button class="accordion-title" type="button" aria-expanded="false">
            <?= esc_html($item['accordion_title']); ?>
            <span class="accordion-icon" aria-hidden="true">
                <?= get_icon_html($dropdown_icon); ?>
            </span>
        </button>

        <div class="accordion-content">
            <?= wp_kses_post($item['accordion_text']); ?>
        </div>
    </div>
<?php
    endforeach;
endif;
?>
</div>

<script>
(function(){
    const wrap = document.getElementById('<?= esc_js($accordion_id); ?>');
    if (!wrap) return;

    const items = wrap.querySelectorAll('.accordion-item');

    items.forEach(item => {
        const title = item.querySelector('.accordion-title');
        const content = item.querySelector('.accordion-content');

        title.addEventListener("click", () => {
            const wasOpen = item.classList.contains("active");

            items.forEach(i => {
                i.classList.remove("active");
                const btn = i.querySelector('.accordion-title');
                const cnt = i.querySelector('.accordion-content');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (cnt) cnt.style.maxHeight = null;
            });

            if (!wasOpen) {
                item.classList.add("active");
                title.setAttribute('aria-expanded', 'true');
                if (content) content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });
})();
</script>
