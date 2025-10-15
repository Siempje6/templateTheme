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
