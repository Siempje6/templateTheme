<?php

$shortcode = get_sub_field('form_shortcode');

if ($shortcode):
?>
<div class="contact-form">
    <?php echo do_shortcode($shortcode); ?>
</div>
<?php endif; ?>
