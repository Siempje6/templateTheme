<?php
// Haal velden op
$image       = get_sub_field('image');
$styling     = get_sub_field('styling') ?: [];

// Basis styling
$corners     = $styling['corners'] ?? '12px';
$customType  = $styling['custom_height_or_width'] ?? 'custom width';

// Afmetingen ophalen
$widthSingle = $styling['image_width'] ?? '100%';
$heightSingle= $styling['image_height'] ?? 'auto';
$widthBoth   = $styling['custom_width_and_heigth'] ?? '100%';
$heightBoth  = $styling['custom_height_and_width'] ?? 'auto';

// Bepaal afmetingen op basis van type
switch ($customType) {
    case 'custom width':
        $width  = $widthSingle;
        $height = 'auto';
        break;

    case 'custom height':
        $width  = 'auto';
        $height = $heightSingle;
        break;

    case 'custom':
        $width  = $widthBoth;
        $height = $heightBoth;
        break;

    default:
        $width  = '100%';
        $height = 'auto';
        break;
}

// Voeg px toe als waarde numeriek is
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
                max-width: 1200px;
                height: <?php echo esc_attr($height); ?>;
            "
        >
    </div>
</section>
<?php endif; ?>