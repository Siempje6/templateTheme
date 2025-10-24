<?php
$header_rows = get_field('header_builder', 'option');

if ($header_rows): ?>
    <header class="site-header" style="max-width:1200px; width:100%; margin:0 auto;">
    <?php
    foreach ($header_rows as $row):
        if ($row['acf_fc_layout'] === 'header_columns' && !empty($row['content'])):

            $header_grid_template = [];
            $header_columns_content = [];

            foreach ($row['content'] as $col):

                $width = $col['layout_header']['width_in_fr'] ?? '1fr';
                if (is_numeric($width)) $width .= 'fr';
                $header_grid_template[] = $width;

                $layout = $col['acf_fc_layout'] ?? '';
                $block_file = get_template_directory() . '/header-builder/block-' . $layout . '/' . $layout . '.php';

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

                $header_columns_content[] = $column_content;

            endforeach;
            ?>
            <div class="header-grid" style="display:grid; grid-template-columns: <?php echo esc_attr(implode(' ', $header_grid_template)); ?>; gap:10px; padding:10px 0; box-sizing:border-box;">
                <?php foreach ($header_columns_content as $content): ?>
                    <div class="header-column"><?php echo $content; ?></div>
                <?php endforeach; ?>
            </div>
            <?php

        endif;
    endforeach; ?>
    </header>
<?php endif; ?>
