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

