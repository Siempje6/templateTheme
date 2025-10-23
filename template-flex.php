<?php
/* Template Name: Flexibele Pagina */
?>

<div class="site-wrapper">

<header class="site-header">
    <?php get_template_part('template-parts/header'); ?>
</header>


<main class="site-main">
<?php
if (have_rows('rows')):
    while (have_rows('rows')): the_row();
        get_template_part('template-parts/rows'); // Verwijst naar rows.php
    endwhile;
endif;
?>
</main>



<footer class="site-footer">
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
.flex-row { display:grid; gap:20px; max-width:1200px; margin:0 auto 40px; }
.flex-column { border:1px solid black; padding:10px; display:flex; flex-direction:column; gap:20px; }
.flex-column img { width:100%; height:auto; object-fit:cover; display:block; }
</style>
