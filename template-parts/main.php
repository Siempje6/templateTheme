<main class="site-main">

<?php
if( have_rows('rows') ):
    while( have_rows('rows') ): the_row();

        if( have_rows('columns') ):
            $grid_template = [];
            while( have_rows('columns') ): the_row();
                $breedte = get_sub_field('settings')['breedte'] ?? '1fr';
                $grid_template[] = $breedte;
            endwhile;

            ?>
            <div class="columns-grid" style="display:grid; grid-template-columns:<?php echo esc_attr(implode(' ', $grid_template)); ?>; max-width:1200px; margin:0 auto; gap:10px;">
            <?php

            while( have_rows('columns') ): the_row();
                ?>
                <div class="column-item" style="border:1px solid red; padding:10px;">
                    <?php
                    if( have_rows('column_content') ):
                        while( have_rows('column_content') ): the_row();
                            $layout = get_row_layout();
                            $file = get_template_directory() . '/page-blocks/block-' . $layout . '/' . $layout . '.php';

                            if( file_exists($file) ){
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

            echo '</div>';
        endif;

    endwhile;
endif;
?>

</main>