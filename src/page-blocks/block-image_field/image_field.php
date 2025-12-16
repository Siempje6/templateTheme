<?php
$image = get_sub_field('image'); // of get_field('image') als het geen repeater/subfield is
$styling = get_sub_field('styling') ?: [];
$corners = $styling['corners'] ?? '12px';
?>

<?php if ($image): ?>
<section class="block-image-field">
    <div class="image-container">
        <img
            src="<?php echo esc_url($image['url']); ?>"
            alt="<?php echo esc_attr($image['alt']); ?>"
            class="image-content"
            style="border-radius: <?php echo esc_attr($corners); ?>;"
            loading="lazy"
        >
    </div>
</section>
<?php endif; ?>
