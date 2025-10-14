<?php
$title   = get_sub_field('title');
$text    = get_sub_field('text'); 
$buttons = get_sub_field('buttonmenu'); 

$align_option = get_sub_field('align');
$alignment = 'left';

if ($align_option && isset($align_option[0]['alignment'])) {
    $alignment = $align_option[0]['alignment'];
}

$styling = get_sub_field('styling');

$title_styles = '';
$text_styles = '';
$section_styles = '';

if ($styling) {
    foreach ($styling as $layout) {

        if ($layout['acf_fc_layout'] === 'text_styling') {
            $title_font_size   = $layout['title_font_size'] ?? '';
            $title_font_weight = $layout['title_font_weight'] ?? '';
            $title_color       = $layout['title_color'] ?? '';
            $text_font_size    = $layout['text_font_size'] ?? '';
            $text_font_weight  = $layout['text_font_weight'] ?? '';
            $text_color        = $layout['text_color'] ?? '';
            $text_alignment    = $layout['text_alignment'] ?? '';

            if ($title_font_size)   $title_styles .= "font-size: {$title_font_size};";
            if ($title_font_weight) $title_styles .= "font-weight: {$title_font_weight};";
            if ($title_color)       $title_styles .= "color: {$title_color};";

            if ($text_font_size)    $text_styles .= "font-size: {$text_font_size};";
            if ($text_font_weight)  $text_styles .= "font-weight: {$text_font_weight};";
            if ($text_color)        $text_styles .= "color: {$text_color};";

            if ($text_alignment) {
                $alignment = $text_alignment;
            }
        }

        if ($layout['acf_fc_layout'] === 'layout_spacing') {

            if (!empty($layout['paddingoptions'])) {
                foreach ($layout['paddingoptions'] as $padding) {
                    if ($padding['acf_fc_layout'] === 'padding_sides') {
                        if (!empty($padding['padding_all_sides'])) {
                            $section_styles .= "padding: {$padding['padding_all_sides']};";
                        } else {
                            if (!empty($padding['padding_top']))    $section_styles .= "padding-top: {$padding['padding_top']};";
                            if (!empty($padding['padding_right']))  $section_styles .= "padding-right: {$padding['padding_right']};";
                            if (!empty($padding['padding_bottom'])) $section_styles .= "padding-bottom: {$padding['padding_bottom']};";
                            if (!empty($padding['padding_left']))   $section_styles .= "padding-left: {$padding['padding_left']};";
                        }
                    }
                }
            }

            if (!empty($layout['marginoptions'])) {
                foreach ($layout['marginoptions'] as $margin) {
                    if ($margin['acf_fc_layout'] === 'marginsides') {
                        if (!empty($margin['margin_all_sides'])) {
                            $section_styles .= "margin: {$margin['margin_all_sides']};";
                        } else {
                            if (!empty($margin['margin_top']))    $section_styles .= "margin-top: {$margin['margin_top']};";
                            if (!empty($margin['margin_right']))  $section_styles .= "margin-right: {$margin['margin_right']};";
                            if (!empty($margin['margin_bottom'])) $section_styles .= "margin-bottom: {$margin['margin_bottom']};";
                            if (!empty($margin['margin_left']))   $section_styles .= "margin-left: {$margin['margin_left']};";
                        }
                    }
                }
            }

            if (!empty($layout['width_content'])) {
                $section_styles .= "width: {$layout['width_content']};";
            }
            if (!empty($layout['height_content'])) {
                $section_styles .= "height: {$layout['height_content']};";
            }
        }
    }
}
?>

<section id="pagina-hero" class="hero-block hero-align-<?php echo esc_attr($alignment); ?>" style="<?php echo esc_attr($section_styles); ?>">
    <div class="container">
        <?php if ($title): ?>
            <h1 class="hero-title" style="<?php echo esc_attr($title_styles); ?>">
                <?php echo esc_html($title); ?>
            </h1>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="hero-text" style="<?php echo esc_attr($text_styles); ?>">
                <?php echo esc_html($text); ?>
            </p>
        <?php endif; ?>

        <?php if ($buttons): ?>
            <div class="hero-buttons hero-buttons-<?php echo esc_attr($alignment); ?>">
                <?php foreach ($buttons as $btn): 
                    $link = $btn['items']; 
                    if ($link):
                        $url    = $link['url'] ?? '#';
                        $target = $link['target'] ?? '_self';
                        $titleBtn = $link['title'] ?? 'Button';
                ?>
                    <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="hero-btn">
                        <?php echo esc_html($titleBtn); ?>
                    </a>
                <?php endif; endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.hero-block {
    width: 55%;
    margin: 0 auto; 
    padding: 40px 20px;
    background-color: #f8f6f2;
    display: grid;
    grid-template-rows: auto 1fr auto;
    place-items: center;
}

.hero-align-left {
    text-align: left;
    justify-items: start;
}

.hero-align-center {
    text-align: center;
    justify-items: center;
}

.hero-align-right {
    text-align: right;
    justify-items: end;
}

.hero-title {
    font-family: serif;
    font-size: 3rem;
    font-weight: 700;
    margin: 0 0 20px 0;
}

.hero-text {
    font-size: 1.25rem;
    color: #555;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 0 20px 0;
}

.hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.hero-buttons-left {
    justify-content: flex-start;
}

.hero-buttons-center {
    justify-content: center;
}

.hero-buttons-right {
    justify-content: flex-end;
}

.hero-btn {
    display: inline-block;
    padding: 12px 30px;
    font-size: 1rem;
    text-decoration: none;
    color: #fff;
    background-color: #1a5427;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.hero-btn:hover {
    background-color: #247937;
    transform: translateY(-1px);
}

@media screen and (max-width: 768px) {
    .hero-block {
        width: 80%;
        padding: 30px 15px;
        max-width: 700px;
    }

    .hero-title {
        font-size: 2.2rem;
    }

    .hero-text {
        font-size: 1.1rem;
    }

    .hero-btn {
        font-size: 0.9rem;
        padding: 10px 25px;
    }
}
</style>
