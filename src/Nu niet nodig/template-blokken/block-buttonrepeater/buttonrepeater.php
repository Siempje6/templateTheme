<?php
$buttons = get_sub_field('buttonsmenu'); 
$alignment = get_sub_field('alignment') ?? 'center'; // alleen als je echt een alignment field hebt
?>

<section id="pagina-buttonrepeater" class="buttonrepeater-block">

    <?php if ($buttons): ?>
        <div class="buttonrepeater-container buttonrepeater-container-<?php echo esc_attr($alignment); ?>">
            <?php foreach ($buttons as $btn): 
                $link = $btn['items']; 
                if ($link):
                    $url      = $link['url'] ?? '#';
                    $target   = $link['target'] ?? '_self';
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
    
</section>

