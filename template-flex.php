<?php
/* Template Name: Flexibele Pagina */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="site-wrapper">

        <header class="site-header" style="max-width:1200px; width:100%; margin:0 auto;">
            <?php
            get_template_part('template-parts/header');
            ?>
        </header>

        <main class="site-main" style="max-width:1200px; width:100%; margin:0 auto;">
            <?php
            if (have_rows('rows')):
                while (have_rows('rows')): the_row();
                    get_template_part('template-parts/rows');
                endwhile;
            endif;
            ?>
        </main>

        <!-- ===== FOOTER ===== -->
        <footer class="site-footer" style="max-width:1200px; width:100%; margin:0 auto;">

            <?php
            get_template_part('template-parts/footer');
            ?>
        </footer>

        <style>
            .site-wrapper {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .site-main {
                flex: 1;
            }

            .header-grid {
                display: grid;
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                gap: 10px;
            }

            .header-column {
                display: flex;
                flex-direction: column;
                padding: 10px;
                border: 1px solid blue;
                border-radius: 4px;
            }

            .footer-grid {
                display: grid;
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                gap: 10px;
            }

            .footer-column {
                display: flex;
                flex-direction: column;
                padding: 10px;
                border: 1px solid green;
                border-radius: 4px;
            }

            @media screen and (max-width: 768px) {
                .header-grid {
                    grid-template-columns: 1fr !important;
                }

                .header-grid .header-item.is-empty {
                    display: none !important;
                }

                .footer-grid {
                    grid-template-columns: 1fr !important;
                }

                .footer-grid .header-item.is-empty {
                    display: none !important;
                }
            }
        </style>

        <?php wp_footer(); ?>
</body>

</html>