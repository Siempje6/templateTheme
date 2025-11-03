<?php
$title   = get_sub_field('title');
$text    = get_sub_field('text'); 
$buttons = get_sub_field('buttonmenu'); 
$image   = get_sub_field('image');

$align_option = get_sub_field('align');
$alignment = 'left';
if ($align_option && isset($align_option[0]['alignment'])) {
    $alignment = $align_option[0]['alignment'];
}
?>

<section id="pagina-hero" class="hero-block">
    <div class="container hero-align-<?php echo esc_attr($alignment); ?>">
        <?php if ($title): ?>
            <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="hero-text"><?php echo esc_html($text); ?></p>
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
                <?php 
                    endif;
                endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($image): ?>
            <div class="image-container">
                <img 
                    src="<?php echo esc_url($image['url']); ?>" 
                    alt="<?php echo esc_attr($image['alt']); ?>" 
                    class="image-content">
            </div>
        <?php endif; ?>
    </div>
</section>

