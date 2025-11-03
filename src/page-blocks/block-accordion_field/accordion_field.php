<?php
$accordion_items = get_sub_field('accordion_items');
$styling = get_sub_field('styling');
$title_weight = $styling['title_font_weight'] ?? '400';
$title_size = $styling['title_font_size'] ?? '18px';
$title_color = $styling['title_color'] ?? 'black';
$dropdown_icon = $styling['accordion_dropdown_icon'] ?? 'plus';

function get_icon_html($icon) {
    switch ($icon) {
        case 'arrow':
            return '<i class="icon-arrow"></i>';
        case 'plus':
            return '<i class="icon-plus"></i>';
        case 'minus':
            return '<i class="icon-minus"></i>';
        case 'chevron':
            return '<i class="icon-chevron"></i>';
        default:
            return '<i class="icon-plus"></i>';
    }
}
?>

<div class="accordion-wrapper">
    <?php if ($accordion_items): ?>
        <?php foreach ($accordion_items as $index => $item): ?>
            <div class="accordion-item">
                <button class="accordion-title title-<?= esc_attr($title_color); ?>" style="font-weight: <?= esc_attr($title_weight); ?>; font-size: <?= esc_attr($title_size); ?>;">
                    <?= esc_html($item['accordion_title']); ?>
                    <span class="accordion-icon"><?= get_icon_html($dropdown_icon); ?></span>
                </button>
                <div class="accordion-content">
                    <?= $item['accordion_text']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>

</style>

<script>
document.querySelectorAll('.accordion-title').forEach(title => {
    title.addEventListener('click', () => {
        const parent = title.parentElement;
        const wrapper = parent.closest('.accordion-wrapper');
        const allItems = wrapper.querySelectorAll('.accordion-item');

        allItems.forEach(item => {
            if (item !== parent) {
                item.classList.remove('active');
            }
        });

        parent.classList.toggle('active');
    });
});
</script>

