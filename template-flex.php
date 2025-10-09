<?php
/* Template Name: Flexibele Pagina */
?>

<div class="site-wrapper">

    <header class="site-header">
        <?php get_template_part('template-parts/header'); ?>
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
        <?php if (have_rows('footerbuilder', 'option')): ?>
            <div class="footer-grid">
                <?php while (have_rows('footerbuilder', 'option')): the_row(); ?>
                    <?php
                    $layout = get_row_layout();
                    if ($layout && locate_template('footer-builder/block-' . $layout . '/' . $layout . '.php')): ?>
                        <div class="footer-grid__item">
                            <?php get_template_part('footer-builder/block-' . $layout . '/' . $layout); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
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
            background-color: #f5f5f5;
            padding: 20px 20px;
        }

        .footer-grid {
            display: flex;
            flex-wrap: wrap; 
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            box-sizing: border-box;
        }

        .footer-grid__item {
            flex: 1 1 calc(33.333% - 26.66px); 
            min-width: 250px;
            box-sizing: border-box;
        }

        @media (max-width: 900px) {
            .footer-grid__item {
                flex: 1 1 calc(50% - 20px);
            }

            .footer-grid {
                gap: 0px;
            }
        }

        @media (max-width: 600px) {
            .footer-grid__item {
                flex: 1 1 100%;
            }
        }

        .footer-grid__item h4 {
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .footer-grid__item p,
        .footer-grid__item a {
            font-size: 1rem;
            line-height: 1.6;
        }
    </style>

</div>
