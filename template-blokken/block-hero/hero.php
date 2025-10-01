<?php
$title   = get_sub_field('title');
$text    = get_sub_field('text'); 
$buttons = get_sub_field('buttonmenu'); 

$align_option = get_sub_field('align');
$alignment = 'left';
if ($align_option && isset($align_option[0]['alignment'])) {
    $alignment = $align_option[0]['alignment'];
}

?>

<section id="pagina-hero" class="hero-block">
    <div class="container hero-align-<?php echo esc_attr($alignment); ?>">
        <?php if ($title): ?>
            <h1 class="hero-title">
                <?php echo esc_html($title); ?>
            </h1>
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

@media (max-width: 1024px) {
    .hero-block {
        width: 80%;
    }
}

@media (max-width: 768px) {
    .hero-block {
        width: 90%;
    }

    .hero-title {
        font-size: 2.2rem;
    }

    .hero-text {
        font-size: 1rem;
    }

    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }

    .hero-btn {
        width: 100%;
        text-align: center;
    }
}
</style>
