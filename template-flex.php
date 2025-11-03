<?php
/* 
Template Name: Flexibele Pagina 
*/
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

        <!-- ===== HEADER ===== -->
        <header class="site-header" style="max-width:1900px; width:100%; margin:0 auto;">
            <?php get_template_part('template-parts/header'); ?>
        </header>

        <!-- ===== MAIN ===== -->
        <main class="site-main" style="max-width:1900px; width:100%; margin:0 auto;">
            <?php
            if (have_rows('rows')):
                while (have_rows('rows')): the_row();
                    get_template_part('template-parts/rows');
                endwhile;
            else:
                if (have_posts()):
                    while (have_posts()): the_post();
                        echo '<div class="default-page-content">';
                        echo '</div>';
                    endwhile;
                endif;
            endif;
            ?>
        </main>

        <!-- ===== FOOTER ===== -->
        <footer class="site-footer" style="max-width:1900px; width:100%; margin:0 auto;">
            <?php get_template_part('template-parts/footer'); ?>
        </footer>

    </div><!-- .site-wrapper -->

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
            max-width: 1600px;
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
            max-width: 1600px;
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

        /* Responsive fix */
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

        .default-page-content {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }
    </style>

    <?php wp_footer(); ?>
</body>
</html>
