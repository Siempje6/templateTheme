<?php
$label = function_exists('get_sub_field') ? get_sub_field('input_label') : 'Subject';
$name = function_exists('get_sub_field') ? get_sub_field('input_name') : 'subject';
$placeholder = function_exists('get_sub_field') ? get_sub_field('input_placeholder') : 'Fill in your subject';
?>

<label for="<?php echo esc_attr($name); ?>">
    <?php echo esc_html($label); ?> <span style="color:red">*</span>
</label>
<input 
    type="text" 
    id="<?php echo esc_attr($name); ?>" 
    name="<?php echo esc_attr($name); ?>" 
    placeholder="<?php echo esc_attr($placeholder); ?>" 
    required
>
