<?php
/**
 * Contact Form 7 Template
 * Laadt een Contact Form 7 formulier via ACF flexible content
 */

// Haal de shortcode op uit ACF
$form_shortcode = get_sub_field('form_shortcode'); // het ACF tekstveld waarin je de CF7 shortcode plakt

if ($form_shortcode):
?>
<div class="contact-form-wrapper">
    <?php
    // Voer de shortcode uit om het formulier te renderen
    echo do_shortcode($form_shortcode);
    ?>
</div>

<style>
.contact-form-wrapper form {
    max-width: 600px;
    margin: 2rem auto;
}

.contact-form-wrapper input,
.contact-form-wrapper textarea,
.contact-form-wrapper select {
    width: 100%;
    padding: 10px;
    margin-bottom: 1rem;
    box-sizing: border-box;
}

.contact-form-wrapper button.wpcf7-submit:hover {
    background-color: #155ab6;
}

.wpcf7-list-item label{
    display: grid;
    grid-template-columns: 50px 1fr;
}

.contact-form-wrapper input, .contact-form-wrapper textarea, .contact-form-wrapper select {
    border-radius: 10px;
    border: 1px solid #1a5427;
}



.wpcf7 .wpcf7-submit:disabled {
    background-color: #143a1cff;
    border: none;
    border-radius: 50px;
    color: white;
}
.wpcf7 .wpcf7-submit {
    background-color: #1a5427;
    border-radius: 50px;
    border: none;
    color: white;
    cursor: pointer;
}
</style>

<?php endif; ?>
