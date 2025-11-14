<?php 

$title = get_sub_field('title');
if (!$title) return;

?>
<h3 style="font-size: 1.5rem;
           font-family: 'Times New Roman', Times, serif;
           margin-left: 1rem;
           color: #1a5428;">
    <?php echo esc_html($title); ?>
</h3>

