<?php
$header_rows = get_field('header_builder', 'option');

if ($header_rows): ?>
    <div class="header-background">
        <header class="site-header" style="max-width:1500px; width:100%; margin:0 auto;">
            <?php
            foreach ($header_rows as $row):

                if ($row['acf_fc_layout'] === 'header_columns' && !empty($row['content'])):

                    $header_grid_template = [];
                    $header_columns_content = [];

                    foreach ($row['content'] as $col):

                        // Breedte behouden zoals jij had
                        $width = $col['layout_header']['width_in_fr'] ?? '1fr';
                        if (is_numeric($width)) $width .= 'fr';
                        $header_grid_template[] = $width;

                        $layout = $col['acf_fc_layout'] ?? '';
                        $block_file = get_template_directory() . '/src/options/header-builder/block-' . $layout . '/' . $layout . '.php';

                        $block = $col;

                        // **Exact dezelfde content inladen**
                        if (file_exists($block_file)):
                            ob_start();
                            include $block_file;
                            $column_content = ob_get_clean();
                        else:
                            $column_content = '<!-- Block bestand niet gevonden: ' . esc_html($block_file) . ' -->';
                        endif;

                        // Voeg toe aan array, met een lege-status flag zonder de content aan te passen
                        $header_columns_content[] = [
                            'content' => $column_content,
                            'empty'   => $column_content === '' // alleen check, geen verandering
                        ];

                    endforeach;
            ?>
                    <div class="header-grid" style="display:grid; grid-template-columns: <?php echo esc_attr(implode(' ', $header_grid_template)); ?>; gap:10px; padding:5px 0; box-sizing:border-box;">
                        <?php foreach ($header_columns_content as $col_item): ?>
                            <div class="header-column<?php echo $col_item['empty'] ? ' is-empty' : ''; ?>">
                                <?php echo $col_item['content']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
            <?php
                endif;

            endforeach; ?>
        </header>
    </div>
    <style>
        .header-background {
            background-color: #1d1b184c;
            color: #fff;
        }

        /* BASIS GRID */
        .header-grid {
            display: grid;
            gap: 10px;
            align-items: center;
        }

        .header-column {
            display: block;
            /* altijd zichtbaar */
        }

        /* LEGE KOLommen VERBERGEN PAS BIJ ≤900px */
        @media (max-width: 900px) {
            .header-column.is-empty {
                display: none;
            }
        }
    </style>
<?php endif; ?>