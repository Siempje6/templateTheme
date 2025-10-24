<?php
// Vervang get_sub_field door $block array
$logo = $block['logo'] ?? null;
if ($logo):
    $url = $logo['url'] ?? 'https://via.placeholder.com/100x50?text=Logo';
    $alt = $logo['alt'] ?? 'Logo Test';
?>
    <img class="imageheader" src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
<?php endif; ?>


<style>
    .header-column {
        display: flex;
        justify-content: center;
    }

    .header-column img {
        width: 50%;
        height: auto;
    }
</style>