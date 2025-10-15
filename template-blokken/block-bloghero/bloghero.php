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

<style>
.bloghero-block {
    width: 100%;
    background-color: #f8f6f2;
    padding: 40px 20px;
    box-sizing: border-box;
}

.bloghero-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
}

.bloghero-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.leftalignhero .bloghero-content {
    align-items: flex-start;
    text-align: left;
}

.centeralignhero .bloghero-content {
    align-items: center;
    text-align: center;
}

.rightalignhero .bloghero-content {
    align-items: flex-end;
    text-align: right;
}

.bloghero-author {
    font-size: 1.15rem;
    font-weight: 500;
    margin: 0 0 10px 0;
    color: #4e4e4e;
}

.bloghero-title {
    font-family: serif;
    font-weight: 700;
    margin: 0 0 8px 0;
    line-height: 1.05;
    word-break: break-word;
}

.bloghero-title-h1,
.bloghero-title-h1.bloghero-title { font-size: 3.8rem; }
.bloghero-title-h2,
.bloghero-title-h2.bloghero-title { font-size: 3.2rem; }
.bloghero-title-h3,
.bloghero-title-h3.bloghero-title { font-size: 2.6rem; }
.bloghero-title-h4,
.bloghero-title-h4.bloghero-title { font-size: 2.2rem; }
.bloghero-title-h5,
.bloghero-title-h5.bloghero-title { font-size: 1.8rem; }
.bloghero-title-h6,
.bloghero-title-h6.bloghero-title { font-size: 1.4rem; }
.bloghero-title-p,
.bloghero-title-div,
.bloghero-title-p.bloghero-title,
.bloghero-title-div.bloghero-title { font-size: 1.15rem; }

.bloghero-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin: 0 0 10px 0;
    color: #444;
}

.bloghero-date {
    font-size: 0.95rem;
    font-weight: 400;
    margin: 0;
    color: #111f15;
}

@media screen and (max-width: 1024px) {
    .bloghero-title-h1, .bloghero-title-h1.bloghero-title { font-size: 3.2rem; }
    .bloghero-title-h2, .bloghero-title-h2.bloghero-title { font-size: 2.8rem; }
    .bloghero-title-h3, .bloghero-title-h3.bloghero-title { font-size: 2.2rem; }
    .bloghero-title-h4, .bloghero-title-h4.bloghero-title { font-size: 1.9rem; }
}

@media screen and (max-width: 768px) {
    .bloghero-block { padding: 30px 15px; }
    .bloghero-container { max-width: 700px; }
    .bloghero-title-h1, .bloghero-title-h1.bloghero-title { font-size: 2.6rem; }
    .bloghero-title-h2, .bloghero-title-h2.bloghero-title { font-size: 2.2rem; }
    .bloghero-title-h3, .bloghero-title-h3.bloghero-title { font-size: 1.9rem; }
    .bloghero-title-h4, .bloghero-title-h4.bloghero-title { font-size: 1.6rem; }
    .bloghero-title-h5 { font-size: 1.4rem; }
    .bloghero-title-h6 { font-size: 1.15rem; }
}
</style>
