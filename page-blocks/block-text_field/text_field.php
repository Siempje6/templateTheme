<?php
$text = get_sub_field('text'); 
?>

<div class="text-block">
    <?php if ($text): ?>
        <?php echo $text; ?>
    <?php endif; ?>
</div>

<style>
.text-block {
    margin: 2rem 0;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 1rem;
    line-height: 1.6;
    margin-left: 2rem;
    margin-right: 2rem;
}
</style>
