<?php
$header_rows = get_field('header_builder', 'option');

if ($header_rows): ?>
    <header class="site-header" style="max-width:1500px; width:100%; margin:0 auto;">
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
                    $block_file = get_template_directory() . '/src/header-builder/block-' . $layout . '/' . $layout . '.php';

                    $block = $col;

                    if (file_exists($block_file)):
                        ob_start();
                        include $block_file;
                        $column_content = ob_get_clean();
                    else:
                        $column_content = '<!-- Block bestand niet gevonden: ' . esc_html($block_file) . ' -->';
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
