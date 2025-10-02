<?php

$textrepeater = get_sub_field('textrepeater');
?>

<section id="pagina-blogtext" class="blogtext-block">
    <div class="container blogtext-container">
        <?php foreach ($textrepeater as $row): ?>
            <?php if (!empty($row['blogtekst'])): ?>
                <p class="blog-text"><?php echo esc_html($row['blogtekst']); ?></p>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</section>

<style>
    .blogtext-block {
        width: 100%;
        background-color: #f8f6f2;
    }

    .blogtext-container {
        width: 55%;
        margin: 0 auto;
        max-width: 800px;
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .blog-text {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 10px;
    }
</style>