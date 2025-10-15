<?php

$textrepeater = get_sub_field('textrepeater');
?>

<section id="pagina-blogtext" class="blogtext-block">
    <div class="container blogtext-container">
        <?php foreach ($textrepeater as $row): ?>
            <?php if (!empty($row['blogtekst'])): ?>
                <p class="blog-text"><strong><?php echo esc_html($row['blogtekst']); ?></strong></p>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</section>
