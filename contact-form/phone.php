<?php
$label = get_sub_field('input_label');
$name = get_sub_field('input_name');
$placeholder = get_sub_field('placeholder');
?>
<label for="<?php echo esc_attr($name); ?>">
    <?php echo esc_html($label); ?> 
</label>
<input 
    type="tel" 
    id="<?php echo esc_attr($name); ?>" 
    name="<?php echo esc_attr($name); ?>" 
    placeholder="<?php echo esc_attr($placeholder); ?>" 
>
