<?php
if (! defined('ABSPATH')) exit;

$card_icon = get_sub_field('card_icon');
$card_title = get_sub_field('card_title');
$card_paragraph = get_sub_field('card_paragraph');
$card_link = get_sub_field('card_link');
?>

<style>

</style>

<div class="card-item-field">
    <?php if ($card_icon) : ?>
        <div class="card-icon">
            <img src="<?php echo esc_url($card_icon['url']); ?>" alt="<?php echo esc_attr($card_icon['alt'] ?: $card_title); ?>">
        </div>
    <?php endif; ?>

    <div class="card-content">
        <?php if ($card_title) : ?>
            <h3 class="card-title"><?php echo esc_html($card_title); ?></h3>
        <?php endif; ?>

        <?php if ($card_paragraph) : ?>
            <div class="card-paragraph"><?php echo wp_kses_post($card_paragraph); ?></div>
        <?php endif; ?>

        <?php if ($card_link && isset($card_link['url'])) : ?>
            <div class="card-link">
                <a href="<?php echo esc_url($card_link['url']); ?>" target="<?php echo esc_attr($card_link['target'] ?: '_self'); ?>">
                    <?php echo esc_html($card_link['title'] ?: 'Lees meer'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
