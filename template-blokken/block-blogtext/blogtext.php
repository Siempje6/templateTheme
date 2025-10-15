<?php
$blogtekst = get_sub_field('blogtekst');
?>

<section id="pagina-blogtext" class="blogtext-block">
    <div class="container blogtext-container">
        <?php if (!empty($blogtekst)): ?>
            <div class="blog-text">
                <?php echo $blogtekst; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

