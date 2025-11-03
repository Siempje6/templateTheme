<?php
$footer_rows = get_field('footer_builder', 'option');

if ($footer_rows): ?>
    <footer class="site-footer" style="max-width:1500px; width:100%; margin:0 auto;">
    <?php
    foreach ($footer_rows as $row):
        if ($row['acf_fc_layout'] === 'footer_columns' && !empty($row['content'])):

            $footer_grid_template = [];
            $footer_columns_content = [];

            foreach ($row['content'] as $col):

                $width = $col['layout_header']['width_in_fr'] ?? '1fr';
                if (is_numeric($width)) $width .= 'fr';
                $footer_grid_template[] = $width;

                $layout = $col['acf_fc_layout'] ?? '';
                $block_file = get_template_directory() . '/src/footer-builder/block-' . $layout . '/' . $layout . '.php';

                $block = $col;

                $block_code = file_exists($block_file) ? htmlspecialchars(file_get_contents($block_file)) : '';
                $debug_comment = '<!-- DEBUG BLOCK:
                                  Layout: ' . esc_html($layout) . '
                                  Bestand gezocht: ' . esc_html($block_file) . '
                                  ' . (file_exists($block_file) ? "Bestand gevonden, wordt geladen..." : "Bestand NIET gevonden!") . '
                                  Code uit bestand:
                                  ' . $block_code . '
                                  -->';

                $column_content = $debug_comment;

                if (file_exists($block_file)):
                    ob_start();
                    include $block_file;
                    $column_content .= ob_get_clean();
                endif;

                $footer_columns_content[] = $column_content;

            endforeach;
            ?>
            <div class="footer-grid" style="display:grid; grid-template-columns: <?php echo esc_attr(implode(' ', $footer_grid_template)); ?>; gap:10px; padding:10px 0; box-sizing:border-box;">
                <?php foreach ($footer_columns_content as $content): ?>
                    <div class="footer-column"><?php echo $content; ?></div>
                <?php endforeach; ?>
            </div>
            <?php

        endif;
    endforeach; ?>
    </footer>
<?php endif; ?>
