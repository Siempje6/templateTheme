<?php
$text = get_sub_field('button_text') ?: 'Verstuur';
?>
<button type="submit"><?php echo esc_html($text); ?></button>
