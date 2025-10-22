<?php
$title = get_sub_field('title');
?>

<div class="title">
    <?php if ($title): ?>
        <h1 class="block-title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>
</div>


<style>
    .title {
        text-align: left;
        margin-left: 2rem;
        font-weight: bold;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>