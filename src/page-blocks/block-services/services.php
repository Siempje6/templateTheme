<?php
if (get_row_layout() == 'services') :

    $button = get_sub_field('button');
    $keuze_soort = get_sub_field('keuze_soort');

    if ($keuze_soort === 'normaal') :

        $button_url    = $button['url'] ?? '#';
        $button_title  = $button['title'] ?? '';
        $button_target = $button['target'] ?? '_self';

        $standaard_service = get_sub_field('standaard_service');

        $standard_styling = get_sub_field('standard_styling');
        $max_width = !empty($standard_styling['max-width']) ? $standard_styling['max-width'] : '340px';

        if ($standaard_service) : ?>
            <div class="services" style="grid-column: 2/3; grid-row: 2/3;">
                <div class="services-grid"
                    style="height: auto;
                     display: grid;
                     grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
                     grid-template-rows: 1fr;
                     gap: 10px;">
                     <!-- 
                        hier komen de volgende stylign opties 
                        1. voor de columns de 340px moet aan te passen zijn via wordpress 
                        2. de gap tussen de columns en rows moet je kunnen aanpassen  
                     -->

                    <?php foreach ($standaard_service as $service) :
                        $head = $service['head'];
                        $content = $service['content'];

                        $head_title    = $head['title'] ?? '';
                        $head_currency = $head['currency'] ?? '';
                        $head_amount   = $head['amount'] ?? '';
                        $head_per      = $head['per'] ?? '';
                        $head_button   = $head['button'] ?? '';

                        $content_title = $content['title'] ?? '';
                        $list_items    = $content['list_items'] ?? [];
                    ?>

                        <div class="services-column-startup">
                            <div class="startupservices"
                                style="width: 100%; height: 100%;
                             background-color: #ebebea89; border-radius: 10px;
                             display: grid; grid-template-rows: 2.8fr 2.5fr;
                             min-height: 550px;">
                                <!-- 
                                    hier komen de volgende stylign opties 
                                        1. de background color moet je kunnen aanpassen 
                                        2. de min height moet aan te passen zijn 
                                        3. border radius 
                                -->
                                <div class="head"
                                    style="display: grid;
                                 grid-template-columns: 1fr; grid-template-rows: 2fr 2fr 2fr ;">

                                    <h2 class="title"
                                        style="grid-row: 1/2;
                                     padding: 0; margin: 0;
                                     display: flex; justify-content: center; align-items: center;
                                     color: #333; font-size: 40px;
                                     font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                    <!-- 
                                        hier komen de volgende stylign opties 
                                            1. color 
                                            2. font family
                                            3. padding
                                            4. margin
                                            5. font size
                                    -->
                                        <?php echo esc_html($head_title); ?>
                                    </h2>

                                    <h3 class="price"
                                        style="display: flex;
                                     justify-content: center; align-items: center;
                                     margin: 0;">

                                        <span style="font-size: 25px; color: #333;
                                           justify-content: center;
                                           font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                                           margin-top: -15px;">
                                            <?php echo esc_html($head_currency); ?>
                                        </span>

                                        <span style="font-size: 50px; color: #333;
                                           font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                            <?php echo esc_html($head_amount); ?>
                                        </span>

                                        <span style="color: #666666;
                                           font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                                           font-size: 30px; margin-left: 5px;">
                                            /<?php echo esc_html(strtolower(str_replace('Per ', '', $head_per))); ?>
                                        </span>
                                    </h3>

                                    <div class="button"
                                        style="display: flex;
                                      justify-content: center; align-items: center;">
                                        <?php if ($head['button']) : ?>
                                            <a href="<?php echo esc_url($head['button']['url']); ?>"
                                               target="<?php echo esc_attr($head['button']['target']); ?>"
                                               class="button"
                                               style="color: white; background-color: #1a5428;
                                                      padding: 12px 30px; border-radius: 50px; text-decoration: none;
                                                      font-size: 16px;
                                                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                                <?php echo esc_html($head['button']['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="content"
                                    style="display: grid;
                                 grid-template-rows: 50px 1fr; grid-template-columns: 1fr 2fr 1fr ;">

                                    <div class="title-content"
                                        style="display: flex; justify-content: center; align-items: center;
                                      grid-column: 2/3;">
                                        <h3 style="font-size: 18px; color: #333;
                                           font-family: 'Times New Roman', Times, serif;
                                           font-weight: 200;">
                                            <?php echo esc_html($content_title); ?>
                                        </h3>
                                    </div>

                                    <div class="list-included"
                                        style="grid-column: 2/3; grid-row: 2/3;">

                                        <?php if ($list_items) : ?>
                                            <?php foreach ($list_items as $item) :
                                                $svg  = $item['svg'] ?? 'check';
                                                $text = $item['list_item_text'] ?? '';
                                            ?>
                                                <p style="color: #333; display: flex; align-items: center; gap: 20px;
                                                  font-family: 'Times New Roman', Times, serif;
                                                  font-weight: 200; font-size: 16px;">
                                                    <?php 
                                                    $svg_path = get_template_directory() . '/assets/icons/' . $svg . '.svg';
                                                    if (file_exists($svg_path)) {
                                                        $svg_content = file_get_contents($svg_path);

                                                        $svg_content = str_replace('<svg', '<svg style="width: 20px; height: 20px; fill: currentColor;"', $svg_content);
                                                        echo $svg_content;
                                                    }
                                                    ?>
                                                    <?php echo esc_html($text); ?>
                                                </p>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
<?php endif;
    endif;
endif;
?>