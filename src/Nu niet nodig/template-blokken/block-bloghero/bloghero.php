<?php
$blogauthor  = get_sub_field('blogauthor');
$blogtitle   = get_sub_field('blogtitle');
$blogtext    = get_sub_field('blogtext');
$blogdate    = get_sub_field('blogdate');
$textstyling = get_sub_field('textstyling');
$alignment   = get_sub_field('alignment');

$title_tag       = 'h2';
$title_style     = '';
$author_style    = '';
$date_style      = '';
$alignment_class = 'leftalignhero';

if ($textstyling && !empty($textstyling['title_size']) && $textstyling['title_size'] !== 'select') {
    $title_tag = preg_replace('/[^a-z0-9]/i', '', $textstyling['title_size']);
}

if ($textstyling && isset($textstyling['blog_title_color'])) {
    switch ($textstyling['blog_title_color']) {
        case 'wit':   $title_style = 'color:#fff;'; break;
        case 'zwart': $title_style = 'color:#000;'; break;
        case 'groen': $title_style = 'color:#1a5427;'; break;
    }
}

if ($textstyling && isset($textstyling['blog_author_color'])) {
    switch ($textstyling['blog_author_color']) {
        case 'wit':   $author_style = 'color:#fff;'; break;
        case 'zwart': $author_style = 'color:#000;'; break;
        case 'groen': $author_style = 'color:#1a5427;'; break;
    }
}

if ($textstyling && isset($textstyling['blog_date_color'])) {
    switch ($textstyling['blog_date_color']) {
        case 'wit':   $date_style = 'color:#fff;'; break;
        case 'zwart': $date_style = 'color:#000;'; break;
        case 'groen': $date_style = 'color:#1a5427;'; break;
    }
}

if ($alignment && isset($alignment['alignment_hero_kopie'])) {
    $alignment_class = $alignment['alignment_hero_kopie'];
}

if (!$alignment_class) {
    $alignment_class = 'leftalignhero';
}
?>
<section id="pagina-bloghero" class="bloghero-block <?php echo esc_attr($alignment_class); ?>">
    <div class="container bloghero-container">
        <div class="bloghero-content">
            <?php if ($blogauthor): ?>
                <h3 class="bloghero-author" style="<?php echo esc_attr($author_style); ?>">
                    <?php echo esc_html($blogauthor); ?>
                </h3>
            <?php endif; ?>

            <?php if ($blogtitle): ?>
                <<?php echo esc_attr($title_tag); ?> class="bloghero-title bloghero-title-<?php echo esc_attr($title_tag); ?>" style="<?php echo esc_attr($title_style); ?>">
                    <?php echo esc_html($blogtitle); ?>
                </<?php echo esc_attr($title_tag); ?>>
            <?php endif; ?>

            <?php if ($blogtext): ?>
                <p class="bloghero-text"><?php echo esc_html($blogtext); ?></p>
            <?php endif; ?>

            <?php if ($blogdate): ?>
                <p class="bloghero-date" style="<?php echo esc_attr($date_style); ?>">
                    <?php echo esc_html($blogdate); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
