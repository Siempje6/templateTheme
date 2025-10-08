<?php

$shortcode = get_sub_field('shortcode_form');

if ($shortcode):
?>
<div class="contact-form">
    <?php echo do_shortcode($shortcode); ?>
</div>
<?php endif; ?>
