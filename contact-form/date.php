<?php
$label = function_exists('get_sub_field') ? get_sub_field('input_label') : 'Date';
$name = function_exists('get_sub_field') ? get_sub_field('input_name') : 'date';
$placeholder = $label;
$value = '';

$required = function_exists('get_sub_field') ? (bool) get_sub_field('required') : false;

$id = esc_attr($name) . '-' . uniqid();
?>

<label id="<?php echo esc_attr($id); ?>-label" for="<?php echo $id; ?>">
    <?php echo esc_html($label); ?>
    <?php if ($required): ?>
        <span class="required-star" aria-hidden="true">*</span>
    <?php endif; ?>
</label>
<input
    type="text"
    id="<?php echo $id; ?>"
    name="<?php echo esc_attr($name); ?>"
    placeholder="<?php echo esc_attr($placeholder); ?>"
    value="<?php echo esc_attr($value); ?>"
    <?php if ($required): ?> required aria-required="true"<?php endif; ?>
    class="date-picker"
/>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof flatpickr !== 'undefined') {
        flatpickr('#<?php echo $id; ?>', {
            dateFormat: 'Y-m-d', 
            allowInput: true   
        });
    } else {
        var el = document.getElementById('<?php echo $id; ?>');
        try { el.type = 'date'; } catch (e) {  }
    }
});
</script>
<style>
.contact-form input[type="date"] {
    font-family: Arial, sans-serif;
    width: 100%;
    padding: 14px 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 0.9rem;
    outline: none;
    background-color: #f9f9f9;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}
</style>