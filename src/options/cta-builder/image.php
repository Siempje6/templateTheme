image
text_under_image

<?php 

$image = get_sub_field('image');
?>


<?php if ($image): ?>
<section class="block-image-field">
    <div class="image-container">
        <img
            src="<?php echo esc_url($image['url']); ?>"
            alt="<?php echo esc_attr($image['alt']); ?>"
            class="image-cta"
            style=""
        >
    </div>
</section>
<?php endif; ?>