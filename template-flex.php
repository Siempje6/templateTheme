<?php
/* Template Name: Flexibele Pagina */
?>

<div class="site-wrapper">

    <header class="site-header">
        <?php get_template_part('template-parts/header'); ?>
    </header>

    <main class="site-main">

        <!-- FLEX FIELDS BOUWER -->
        <?php if (have_rows('flex_fields')): ?>
            <?php while (have_rows('flex_fields')): the_row(); ?>
                <?php
                $layout = get_row_layout();
                get_template_part('template-blokken/block-' . $layout . '/' . $layout);
                ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <!-- KOLUMNEN BOUWER -->
        <?php if (have_rows('kolommen')): ?>
            <?php while (have_rows('kolommen')): the_row(); ?>
                <?php $layout = get_row_layout(); ?>

                <?php if ($layout === 'row_1_col'): ?>
                    <div class="row row-1-col centered-columns">
                        <?php if (have_rows('column')): ?>
                            <?php while (have_rows('column')): the_row(); ?>
                                <?php
                                if (have_rows('flex_fields')):
                                    while (have_rows('flex_fields')): the_row();
                                        $sub_layout = get_row_layout();
                                        get_template_part('template-blokken/block-' . $sub_layout . '/' . $sub_layout);
                                    endwhile;
                                endif;
                                ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                <?php elseif ($layout === 'row_2_col'): ?>
                    <div class="row row-2-col centered-columns">
                        <div class="column linker">
                            <?php if (have_rows('linker_kolom')): ?>
                                <?php while (have_rows('linker_kolom')): the_row(); ?>
                                    <?php
                                    if (have_rows('flex_fields')):
                                        while (have_rows('flex_fields')): the_row();
                                            $sub_layout = get_row_layout();
                                            get_template_part('template-blokken/block-' . $sub_layout . '/' . $sub_layout);
                                        endwhile;
                                    endif;
                                    ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="column rechter">
                            <?php if (have_rows('rechter_kolom')): ?>
                                <?php while (have_rows('rechter_kolom')): the_row(); ?>
                                    <?php
                                    if (have_rows('flex_fields')):
                                        while (have_rows('flex_fields')): the_row();
                                            $sub_layout = get_row_layout();
                                            get_template_part('template-blokken/block-' . $sub_layout . '/' . $sub_layout);
                                        endwhile;
                                    endif;
                                    ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endwhile; ?>
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
            padding: 20px;
        }

        /* Footer grid */
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
        }

        @media (max-width: 600px) {
            .footer-grid__item {
                flex: 1 1 100%;
            }
        }

        /* KOLUMNEN */
        .centered-columns {
            max-width: 60%;
            margin: 0 auto;
        }

        .row-2-col.centered-columns {
            display: flex;
            gap: 20px;
        }

        .row-2-col.centered-columns .column {
            flex: 1;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .row-1-col.centered-columns .column {
            width: 100%;
            padding: 0 10px;
            box-sizing: border-box;
        }
    </style>

</div>