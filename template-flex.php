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
    <?php if (have_rows('footerbuilder', 'option')): ?>
        <div class="footer-grid">
            <?php while (have_rows('footerbuilder', 'option')): the_row(); ?>
                <?php
                $layout = get_row_layout();
                $footer_block_path = get_template_directory() . '/footer-builder/block-' . $layout . '/' . $layout . '.php';
                if ($layout && file_exists($footer_block_path)): ?>
                    <div class="footer-grid__item">
                        <?php include $footer_block_path; ?>
                    </div>
                <?php else: ?>
                    <div class="footer-grid__item">
                        <p>Footer block "<?php echo esc_html($layout); ?>" niet gevonden</p>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</footer>

<style>
.site-wrapper { display:flex; flex-direction:column; min-height:100vh; }
.site-main { flex:1; }

.header-grid { display: grid; max-width:1200px; width:100%; margin:0 auto; gap:10px; }
.header-column { display:flex; flex-direction:column; padding:10px; border:1px solid blue; border-radius:4px; }


.footer-grid { display:grid; gap:20px; grid-template-columns:repeat(auto-fit, minmax(150px,1fr)); max-width:1200px; margin:0 auto; padding:40px 20px; }
.footer-grid__item { padding:10px;  }
</style>

<?php wp_footer(); ?>
</body>
</html>
