<?php
$image = get_sub_field('image');
$styling = get_sub_field('styling') ?: [];

$corners = $styling['corners'] ?? '12px';
$custom_type = $styling['custom_height_or_width'] ?? 'custom width';
$custom_width = $styling['image_width'] ?? '100%';
$custom_height = $styling['image_height'] ?? 'auto';
$custom_both_w = $styling['custom_width_and_heigth'] ?? '100%';
$custom_both_h = $styling['custom_height_and_width'] ?? 'auto';

switch ($custom_type) {
    case 'custom width':
        $width = $custom_width;
        $height = 'auto';
        break;
    case 'custom height':
        $width = 'auto';
        $height = $custom_height;
        break;
    case 'custom':
        $width = $custom_both_w;
        $height = $custom_both_h;
        break;
    default:
        $width = '100%';
        $height = 'auto';
        break;
}

if (is_numeric($width))  $width  .= 'px';
if (is_numeric($height)) $height .= 'px';
?>

<?php if ($image): ?>
<section class="block-image-field">
    <div class="image-container">
        <img
            src="<?php echo esc_url($image['url']); ?>"
            alt="<?php echo esc_attr($image['alt']); ?>"
            class="image-content"
            style="
                border-radius: <?php echo esc_attr($corners); ?>;
                width: <?php echo esc_attr($width); ?>;
                height: <?php echo esc_attr($height); ?>;
            "
        >
    </div>
</section>
<?php endif; ?>
