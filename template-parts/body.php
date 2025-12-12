<?php
$background_color = get_field('page_background_color') ?: '#000';
?>

<body class="body" style="background-color: <?php echo esc_attr($background_color); ?>;">

    <div class="site-wrapper">

        <header class="site-header">
            <?php get_template_part('template-parts/header'); ?>
        </header>

        <main class="site-main">
            <?php
            if (have_rows('rows')):
                while (have_rows('rows')): the_row();
                    get_template_part('template-parts/rows');
                endwhile;
            else:
                if (have_posts()):
                    while (have_posts()): the_post(); ?>
                        <div class="default-page-content">
                            <?php the_content(); ?>
                        </div>
            <?php endwhile;

                    wp_reset_postdata();

                    if (comments_open() || get_comments_number()):
                        comments_template();
                    endif;
                endif;


            endif;
            ?>
        </main>

        <footer class="site-footer">
            <?php get_template_part('template-parts/footer'); ?>
        </footer>

    </div>
</body>