<?php
$footer_form_title     = get_sub_field('input_title');       
$footer_form_shortcode = get_sub_field('inputshortcode');    
?>

<?php if ($footer_form_shortcode): ?>
<div class="custom-footer-form">
    <?php if ($footer_form_title): ?>
        <h4 class="custom-footer-form__title"><?php echo esc_html($footer_form_title); ?></h4>
    <?php endif; ?>

    <div class="custom-footer-form__fields">
        <?php echo do_shortcode($footer_form_shortcode); ?>
    </div>
</div>
<?php endif; ?>

<style>
.custom-footer-form {
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 100%;
    max-width: 900px;
    margin: 20px auto;
    border-radius: 10px;
    box-sizing: border-box;
}

.custom-footer-form__title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.custom-footer-form__fields {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-start;
}

.custom-footer-form__fields p {
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1 1 200px; 
    min-width: 200px;
}

.custom-footer-form__fields label {
    font-weight: 600;
    font-size: 0.95rem;
    color: #333;
}

.custom-footer-form__fields input[type="text"],
.custom-footer-form__fields input[type="email"],
.custom-footer-form__fields input[type="tel"],
.custom-footer-form__fields input[type="date"],
.custom-footer-form__fields textarea {
    font-family: Arial, sans-serif;
    width: 100%;
    padding: 12px 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 0.9rem;
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.custom-footer-form__fields input:focus,
.custom-footer-form__fields textarea:focus {
    border-color: #1a5427;
}

.custom-footer-form__fields textarea {
    resize: vertical;
    min-height: 100px;
}

.custom-footer-form__fields p input[type="submit"] {
    padding: 12px 30px;
    font-size: 1rem;
    background-color: #1a5427;
    border-radius: 6px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    color: white;
    margin-top: 10px;
}

.custom-footer-form__fields p input[type="submit"]:hover {
    background-color: #247937;
    transform: translateY(-1px);
}
</style>
