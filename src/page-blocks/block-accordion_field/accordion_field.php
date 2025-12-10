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

$bg_color       = $wrapper_item['background_color'] ?? 'transparent';
$border_value   = $wrapper_item['border'] ?? '0';
$border_unit    = $wrapper_item['border_size'] ?? 'px';
$border_color   = $wrapper_item['border_color'] ?? 'transparent';
$border_full    = $border_value . $border_unit . ' solid ' . $border_color;
$radius         = $wrapper_item['border_radius'] ?? 0;
$padding_unit   = $wrapper_item['padding_size'] ?? 'px';
$padding_value  = $wrapper_item['padding'] ?? '0';
$padding_full   = $padding_value . $padding_unit;
$margin_unit    = $wrapper_item['margin_size'] ?? 'px';
$margin_value   = $wrapper_item['margin'] ?? '0';
$margin_full    = $margin_value . $margin_unit;

$active_bg_raw       = $active['background_color'] ?? '';
$active_bg_content      = $active['background_content_color'] ?? '';
$active_title_color  = $active['title_color'] ?? '';
$active_icon_rotation_value = isset($active['icon_rotation']) ? $active['icon_rotation'] : 180;
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

        --acc-bg-color: <?= esc_attr($bg_color); ?>;
        --acc-border: <?= esc_attr($border_full); ?>;
        --acc-radius: <?= esc_attr($radius); ?>px;
        --acc-padding: <?= esc_attr($padding_full); ?>;
        --acc-margin: <?= esc_attr($margin_full); ?>;

        --acc-active-bg: <?= esc_attr($active_bg_raw); ?>;
        --acc-active-content-bg: <?= esc_attr($active_bg_content); ?>;
        --acc-active-title-color: <?= esc_attr($active_title_color); ?>;
        --acc-active-icon-rotation: <?= esc_attr($active_icon_rotation); ?>;

        --acc-hover-bg: <?= esc_attr($hover_bg_color); ?>;
        --acc-hover-title-color: <?= esc_attr($hover_title_color); ?>;

        --acc-anim-duration: <?= esc_attr($anim_duration); ?>s;
        --acc-anim-timing: <?= esc_attr($anim_timing); ?>;
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
