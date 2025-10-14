<?php

$title         = get_sub_field('title');
$text          = get_sub_field('text');
$buttons       = get_sub_field('buttonmenu');
$textstyling   = get_sub_field('textstyling');
$heroalignment = get_sub_field('heroalignment');
$buttoncolor   = get_sub_field('buttoncolor');

$title_tag        = 'h2';
$title_styles     = '';
$alignment_hero   = 'leftalignhero';
$btn_color_class  = 'hero-btn-zwart';

if ($textstyling) {
    $title_font_size  = $textstyling['title_font_size'] ?? 'select';
    $title_font_color = $textstyling['title_font_color'] ?? 'select';

    if ($title_font_size && $title_font_size !== 'select') {
        $title_tag = esc_attr($title_font_size);
    }

    if ($title_font_color && $title_font_color !== 'select') {
        switch ($title_font_color) {
            case 'wit':
                $title_styles .= "color:#fff;";
                break;
            case 'zwart':
                $title_styles .= "color:#000;";
                break;
            case 'groen':
                $title_styles .= "color:#1a5427;";
                break;
        }
    }
}

if ($heroalignment && isset($heroalignment['alignment_hero'])) {
    $alignment_hero = $heroalignment['alignment_hero'];
}

if ($buttoncolor && isset($buttoncolor['alignment_hero'])) {
    switch ($buttoncolor['alignment_hero']) {
        case 'wit':
            $btn_color_class = 'hero-btn-wit';
            break;
        case 'groen':
            $btn_color_class = 'hero-btn-groen';
            break;
        case 'zwart':
            $btn_color_class = 'hero-btn-zwart';
            break;
    }
}

if (!$alignment_hero) $alignment_hero = 'leftalignhero';
?>

<section id="pagina-hero" class="hero-block <?php echo esc_attr($alignment_hero); ?>">
    <div class="container">

        <?php if ($title): ?>
            <<?php echo esc_attr($title_tag); ?>
                class="hero-title hero-title-<?php echo esc_attr($title_tag); ?>"
                style="<?php echo esc_attr($title_styles); ?>">
                <?php echo esc_html($title); ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="hero-text">
                <?php echo esc_html($text); ?>
            </p>
        <?php endif; ?>

        <?php if ($buttons): ?>
            <div class="hero-buttons">
                <?php foreach ($buttons as $btn):
                    $link = $btn['items'] ?? null;
                    if ($link):
                        $url      = $link['url'] ?? '#';
                        $target   = $link['target'] ?? '_self';
                        $titleBtn = $link['title'] ?? 'Button';
                ?>
                    <a href="<?php echo esc_url($url); ?>"
                       target="<?php echo esc_attr($target); ?>"
                       class="hero-btn <?php echo esc_attr($btn_color_class); ?>">
                        <?php echo esc_html($titleBtn); ?>
                    </a>
                <?php endif; endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
.hero-block {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
    background-color: #f8f6f2;
    display: grid;
    grid-template-rows: auto 1fr auto;
}

.leftalignhero {
    text-align: left;
    justify-items: start;
}

.centeralignhero {
    text-align: center;
    justify-items: center;
}

.rightalignhero {
    text-align: right;
    justify-items: end;
}

.hero-title {
    font-family: serif;
    font-weight: 700;
    margin: 0 0 20px 0;
}

/* Dynamische font-groottes */
.hero-title-h1 { font-size: 3rem; }
.hero-title-h2 { font-size: 2.5rem; }
.hero-title-h3 { font-size: 2rem; }
.hero-title-h4 { font-size: 1.75rem; }
.hero-title-h5 { font-size: 1.5rem; }
.hero-title-h6 { font-size: 1.25rem; }
.hero-title-p,
.hero-title-div { font-size: 1.1rem; }

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

.leftalignhero .hero-buttons {
    justify-content: flex-start;
}

.centeralignhero .hero-buttons {
    justify-content: center;
}

.rightalignhero .hero-buttons {
    justify-content: flex-end;
}

/* Knoppen */
.hero-btn {
    display: inline-block;
    padding: 12px 30px;
    font-size: 1rem;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.hero-btn-wit {
    background-color: #fff;
    color: #000;
    border: 1px solid #000;
}

.hero-btn-groen {
    background-color: #1a5427;
    color: #fff;
}

.hero-btn-zwart {
    background-color: #000;
    color: #fff;
}

.hero-btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

@media screen and (max-width: 768px) {
    .hero-block {
        width: 100%;
        padding: 30px 15px;
        max-width: 700px;
    }

    .hero-title-h1 { font-size: 2.4rem; }
    .hero-title-h2 { font-size: 2rem; }
    .hero-title-h3 { font-size: 1.75rem; }
    .hero-title-h4 { font-size: 1.5rem; }

    .hero-text { font-size: 1.1rem; }

    .hero-btn {
        font-size: 0.9rem;
        padding: 10px 25px;
    }
}
</style>
