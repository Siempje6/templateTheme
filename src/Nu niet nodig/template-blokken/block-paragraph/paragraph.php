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
