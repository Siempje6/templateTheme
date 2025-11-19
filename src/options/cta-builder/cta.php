<?php
// Haal de CTA flexible content op
$cta_rows = get_sub_field('call_to_action'); // of get_field('call_to_action') als het op options page staat

if( $cta_rows ):
    foreach( $cta_rows as $row ):

        // Alleen 'cta' layout renderen
        if( $row['acf_fc_layout'] === 'cta' ):

            $cta_class   = isset($row['class']) ? $row['class'] : '';
            $cta_bg      = isset($row['background_color']) ? $row['background_color'] : '';
            $cta_width   = isset($row['width']) ? intval($row['width']) : '';

            // CTA container met styling
            $style = '';
            if($cta_bg) $style .= "background: $cta_bg; ";
            if($cta_width) $style .= "max-width: {$cta_width}px; ";
            $style .= "padding: 2rem; margin: 1rem auto; border-radius: 10px;";

            echo '<div class="'.esc_attr($cta_class).'" style="'.esc_attr($style).'">';

            // Nested Columns
            if( isset($row['columns']) && is_array($row['columns']) ):
                foreach($row['columns'] as $column):
                    
                    if( isset($column['cta_options']) && is_array($column['cta_options']) ):
                        foreach($column['cta_options'] as $option):

                            switch($option['acf_fc_layout']):
                                case 'title':
                                    $title = isset($option['title']) ? $option['title'] : '';
                                    if($title):
                                        echo '<h3 style="font-size:1.5rem; font-family:Times, serif; color:#1a5428; margin-bottom:0.5rem;">'.esc_html($title).'</h3>';
                                    endif;
                                    break;

                                case 'text':
                                    $text = isset($option['text']) ? $option['text'] : '';
                                    if($text):
                                        echo '<div class="text-cta" style="font-size:1rem; font-family:Gill Sans, Calibri, sans-serif; margin-bottom:1rem;">'. $text .'</div>';
                                    endif;
                                    break;

                                case 'button':
                                    $button = isset($option['button']) ? $option['button'] : '';
                                    if($button):
                                        $url   = isset($button['url']) ? $button['url'] : '#';
                                        $label = isset($button['title']) ? $button['title'] : '';
                                        echo '<a href="'.esc_url($url).'" class="btn" style="display:inline-block; padding:0.6rem 1rem; border-radius:50px; background:#1a5428; color:white; text-decoration:none; font-family:Gill Sans, Calibri, sans-serif; margin-right:1rem;">'.esc_html($label).'</a>';
                                    endif;
                                    break;

                                case 'image':
                                    $image = isset($option['image']) ? $option['image'] : '';
                                    $text_under_image = isset($option['text_under_image']) ? $option['text_under_image'] : '';
                                    if($image):
                                        echo '<div class="image-container" style="margin-bottom:1rem;">';
                                        echo '<img src="'.esc_url($image['url']).'" alt="'.esc_attr($image['alt']).'" style="max-width:100%; height:auto; display:block; margin-bottom:0.5rem;" />';
                                        if($text_under_image) echo '<div class="text-under-image" style="font-size:0.9rem; font-family:Gill Sans, Calibri, sans-serif;">'. $text_under_image .'</div>';
                                        echo '</div>';
                                    endif;
                                    break;

                            endswitch;

                        endforeach;
                    endif;

                endforeach;
            endif;

            echo '</div>'; // einde CTA container

        endif;

    endforeach;
endif;
?>
