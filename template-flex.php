<?php
/* Template Name: Flexibele Pagina */
?>

<div class="site-wrapper">

    <header class="site-header">
        <?php get_template_part('template-parts/header'); ?>
    </header>

    <main class="site-main">
        <?php if( have_rows('flex_fields') ): ?>
            <?php while( have_rows('flex_fields') ): the_row(); ?>
                <?php
                $layout = get_row_layout();
                get_template_part('template-blokken/block-' . $layout . '/' . $layout);
                ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <?php get_template_part('template-parts/footer'); ?>
    </footer>

</div>
