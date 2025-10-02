<?php
$textrepeater = get_sub_field('textrepeater');
?>

<section id="pagina-blogtext" class="blogtext-block">
    <div class="container blogtext-container">
        <?php if ($textrepeater): ?>
            <ul class="blog-list">
                <?php foreach ($textrepeater as $row): ?>
                    <?php if (!empty($row['listitems'])): ?>
                        <li class="blog-text"><?php echo esc_html($row['listitems']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>

<style>
    .blogtext-block {
        margin-top: 10px;
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

    .blog-list {
        list-style-type: decimal;
        padding-left: 20px;   
        margin: 0;
    }

    .blog-text {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 8px;
    }
</style>
