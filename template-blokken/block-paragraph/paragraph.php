<?php
$paragraphtitle = get_sub_field('paragraphtitle');
$textrepeater = get_sub_field('textrepeater');
?>

<section id="pagina-paragraph" class="paragraph-block">
    <div class="container paragraph-container">
        <?php if ($paragraphtitle): ?>
            <h2 class="paragraph-title"><?php echo esc_html($paragraphtitle); ?></h2>
        <?php endif; ?>

        <?php if ($textrepeater): ?>
            <?php foreach ($textrepeater as $row): ?>
                <?php if (!empty($row['paragraphtext'])): ?>
                    <p class="paragraph-text"><?php echo esc_html($row['paragraphtext']); ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<style>
.paragraph-block {
    width: 100%;
    background-color: #f8f6f2;
}

.paragraph-container {
    width: 100%;            
    max-width: 800px;
    display: flex;
    margin: 0 auto;
    flex-direction: column;
    text-align: left;      
}

.paragraph-title {
    font-family: serif;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0px;
}

.paragraph-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 10px;
}

@media screen and (max-width: 768px) {
    .paragraph-container {
        width: 100%;          
        padding: 20px;
        max-width: 600px;      
    }

    .paragraph-title {
        font-size: 2.3rem;
    }

    .paragraph-text {
        font-size: 1rem;
    }
}
</style>
