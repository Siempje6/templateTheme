<?php

$blogauthor = get_sub_field('blogauthor');
$blogtitle = get_sub_field('blogtitle');
$blogtext = get_sub_field('blogtext');
$blogdate = get_sub_field('blogdate');

?>

<section id="pagina-bloghero" class="bloghero-block">
    <div class="container bloghero-container">
        <?php if ($blogauthor): ?>
            <h3 class="bloghero-author"><?php echo esc_html($blogauthor); ?></h3>
        <?php endif; ?>

        <?php if ($blogtitle): ?>
            <h2 class="bloghero-title"><?php echo esc_html($blogtitle); ?></h2>
        <?php endif; ?>

        <?php if ($blogtext): ?>
            <p class="bloghero-text"><?php echo esc_html($blogtext); ?></p>
        <?php endif; ?>

        <?php if ($blogdate): ?>
            <p class="bloghero-date"><?php echo esc_html($blogdate); ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
.bloghero-block {
    width: 100%;
    background-color: #f8f6f2;
}   
.bloghero-container {
    width: 55%;              
    margin: 0 auto;         
    max-width: 800px;
    display: flex;
    flex-direction: column;
    text-align: left;      
}
.bloghero-author {
    font-size: 1.2rem;
    font-weight: normal;
    margin-bottom: 0px;
    color: #4e4e4e;
}
.bloghero-title {
    font-family: serif;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0px;
}
.bloghero-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 0px;
}
.bloghero-date {
    font-size: 0.9rem;
    color: #111f15;
}
</style>    