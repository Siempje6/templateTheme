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

<style>
.buttonrepeater-block {
    width: 55%;
    margin: 0 auto; 
    margin-top: 10px;
    margin-bottom: 10px;
    background-color: #f8f6f2;
    display: grid;
    place-items: center;
}   

.buttonrepeater-container {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.hero-btn {
    background-color: #1a5427;
    color: #ffffff;
    text-align: center;
    width: auto;
    padding: 10px 30px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2rem;
    transition: background-color 0.3s ease;
}

.hero-btn:hover {
    background-color: #2b6e3b;
}
</style>
