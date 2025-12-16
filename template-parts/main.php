<main class="site-main">

<?php if (is_search()) : ?>
    <div class="search-results-wrapper">
        <h1>Zoekresultaten voor: <em><?php echo esc_html(get_search_query()); ?></em></h1>
        <?php if (have_posts()) : ?>
            <ul class="search-results-list">
                <?php while (have_posts()) : the_post(); ?>
                    <li class="search-result-item">
                        <a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Geen resultaten gevonden.</p>
        <?php endif; ?>
    </div>

<?php else: ?>

    <?php
    $custom_width  = get_field('row_width') ?? '1200px';

    if (have_rows('rows')):
        while (have_rows('rows')): the_row();
            $layout_field = get_sub_field('layout') ?: get_field('layout');
            $width_option  = $layout_field['width_options'] ?? 'fixed';

            if (have_rows('columns')):
                $grid_template = [];
                $columns_data  = [];
                while (have_rows('columns')): the_row();
                    $settings = get_sub_field('settings') ?: [];
                    $breedte  = $settings['breedte'] ?? '1fr';
                    ob_start();
                    if (have_rows('column_content')):
                        while (have_rows('column_content')): the_row();
                            $layout = get_row_layout();
                            $file   = get_template_directory() . '/page-blocks/block-' . $layout . '/' . $layout . '.php';
                            if (file_exists($file)) include $file;
                        endwhile;
                    endif;
                    $content = trim(ob_get_clean());
                    $grid_template[] = $breedte;
                    $columns_data[]  = ['content'=>$content,'empty'=>$content===''];
                endwhile;

                $grid_classes = ['columns-grid'];
                $style_attrs  = [];
                if ($width_option==='full width') $grid_classes[]='layout-full';
                else { $grid_classes[]='layout-fixed'; $style_attrs[]='--grid-max-width:'.$custom_width.';'; }
                $style_attrs[] = 'grid-template-columns:'.implode(' ', $grid_template).';';
                ?>
                <div class="<?php echo esc_attr(implode(' ',$grid_classes)); ?>" style="<?php echo implode(' ',$style_attrs); ?>">
                    <?php foreach($columns_data as $col): ?>
                        <div class="column-item<?php echo $col['empty']?' is-empty':''; ?>">
                            <?php echo $col['content']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;
        endwhile;
    endif;
    ?>

<?php endif; ?>
</main>
