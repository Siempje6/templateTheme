<?php
$label = function_exists('get_sub_field') ? get_sub_field('input_label') : 'Conditions';
$name = function_exists('get_sub_field') ? get_sub_field('input_name') : 'conditions';
$options = function_exists('get_sub_field') ? get_sub_field('options') : 'Ik ga akkoord met de voorwaarden';
?>
<label for="<?php echo esc_attr($name); ?>">
    <input
        type="checkbox"
        id="<?php echo esc_attr($name); ?>"
        name="<?php echo esc_attr($name); ?>"
        value="1"
        required
    >
    <?php echo wp_kses_post($options); ?>
</label>

<style>
    input[type="checkbox"] {
        margin-left: 20px;
    }
</style>