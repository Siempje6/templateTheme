<?php
/* Template Name: Flexibele Pagina */
?>

<div class="site-wrapper">

    <header class="site-header">
        <?php get_template_part('template-parts/header'); ?>

    </header>


    </header>

    <main class="site-main">
        <?php if (have_rows('flex_fields')): ?>
            <?php while (have_rows('flex_fields')): the_row(); ?>
                <?php
                $layout = get_row_layout();
                get_template_part('template-blokken/block-' . $layout . '/' . $layout);
                ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (have_rows('contact_form_fields')): ?>
            <section class="contact-form">
                <?php get_template_part('contact-form/form-start'); ?>

                <?php while (have_rows('contact_form_fields')): the_row(); ?>
                    <?php
                    $layout = get_row_layout();
                    get_template_part('contact-form/' . $layout);
                    ?>
                <?php endwhile; ?>

                <?php get_template_part('contact-form/form-end'); ?>
            </section>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <?php get_template_part('template-parts/footer'); ?>
    </footer>

    <style>
        .site-wrapper {
            display: flex;
            flex-direction: column;
            max-width: 100vw;
        }

        .site-header {
            flex: 0 0 auto;
        }

        .site-main {
            flex: 1 0 auto;
        }

        .site-footer {
            flex: 0 0 auto;
        }
    </style>

</div>