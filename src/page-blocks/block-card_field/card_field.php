<?php
$items = get_sub_field('items_in_card') ?: [];
$cards = get_sub_field('card');

$bg_settings = get_sub_field('settings_background') ?: [];
$bg_type = $bg_settings['achtergrond_option'] ?? '';
$bg_color = $bg_settings['background_color'] ?? '';
$bg_image = $bg_settings['background_image'] ?? '';
$bg_style = '';

if ($bg_type === 'background color' && $bg_color) {
    $bg_style = "background-color: {$bg_color};";
} elseif ($bg_type === 'background image' && $bg_image) {
    $bg_url = esc_url($bg_image['url']);
    $bg_style = "background-image: url('{$bg_url}'); background-size: cover; background-position: center;";
}
?>

<div class="card-field" style="<?php echo esc_attr($bg_style); ?>">
    <?php if ($cards): ?>
        <div class="cards-grid">
            <?php foreach ($cards as $card): ?>
                <div class="card-item">
                    <?php if (in_array('image', $items) && !empty($card['image_card'])): ?>
                        <div class="card-image">
                            <img src="<?php echo esc_url($card['image_card']['url']); ?>" alt="<?php echo esc_attr($card['image_card']['alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (in_array('title', $items) && !empty($card['title_card'])): ?>
                        <h3 class="card-title"><?php echo esc_html($card['title_card']); ?></h3>
                    <?php endif; ?>

                    <?php if (in_array('text', $items) && !empty($card['text_card'])): ?>
                        <div class="card-text"><?php echo wp_kses_post($card['text_card']); ?></div>
                    <?php endif; ?>

                    <?php if (in_array('button', $items) && !empty($card['button_card'])): ?>
                        <a href="<?php echo esc_url($card['button_card']['url']); ?>" class="card-button"><?php echo esc_html($card['button_card']['title']); ?></a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
