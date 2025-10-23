<main class="site-main">

<?php
if ( have_rows('rows') ):
    while ( have_rows('rows') ): the_row();

        // Probeer eerst per-row layout-instellingen (als het in de row staat),
        // fallback naar get_field (site/page-level).
        $layout_field = get_sub_field('layout');
        if ( empty($layout_field) ) {
            $layout_field = get_field('layout');
        }

        $width_option = $layout_field['width_options'] ?? 'fixed';
        $custom_width = $layout_field['width'] ?? '1200px';

        if ( have_rows('columns') ):
            $grid_template = [];
            // build grid template
            while ( have_rows('columns') ): the_row();
                $settings = get_sub_field('settings') ?: [];
                $breedte = $settings['breedte'] ?? '1fr';
                $grid_template[] = $breedte;
            endwhile;

            // classes en style bepalen op basis van keuze
            $grid_classes = ['columns-grid'];
            $style_attrs = [];

            if ( $width_option === 'full width' ) {
                $grid_classes[] = 'layout-full';
                // geen max-width; grid vult viewport
                // maar we wél de template kolommen inline zetten
            } else {
                $grid_classes[] = 'layout-fixed';
                // geef de gewenste max-width mee als css-var (schoner)
                $style_attrs[] = '--grid-max-width:' . esc_attr($custom_width) . ';';
            }

            // grid-template-columns altijd als inline style (kan ook als class)
            $style_attrs[] = 'grid-template-columns:' . esc_attr( implode(' ', $grid_template) ) . ';';

            ?>
            <div class="<?php echo esc_attr( implode(' ', $grid_classes) ); ?>"
                 style="<?php echo implode(' ', $style_attrs); ?>">
                <?php
                // Nu écht de columns loop (reset/loop opnieuw)
                // Belangrijk: we moeten opnieuw door columns itereren
                if ( have_rows('columns') ):
                    while ( have_rows('columns') ): the_row();
                        ?>
                        <div class="column-item">
                            <?php
                            if ( have_rows('column_content') ):
                                while ( have_rows('column_content') ): the_row();
                                    $layout = get_row_layout();
                                    $file = get_template_directory() . '/page-blocks/block-' . $layout . '/' . $layout . '.php';

                                    if ( file_exists($file) ){
                                        include $file;
                                    } else {
                                        echo '<p>Block file not found: ' . esc_html($layout) . '</p>';
                                    }
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
            <?php
        endif;

    endwhile;
endif;
?>


</main>