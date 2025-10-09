<?php
$customsummary = get_sub_field('customsummary'); 

$border_repeater = get_sub_field('border');
$border = 'bottom';
if ($border_repeater && is_array($border_repeater) && isset($border_repeater[0]['bordersummary'])) {
    $border = $border_repeater[0]['bordersummary'];
}
?>

<?php if ($customsummary): ?>
<section id="pagina-summary" class="summary-block">
    <div class="container summary-container">
        <?php foreach ($customsummary as $row): 
            $link_summary = $row['linksummary'] ?? '';
            $discription_summary  = $row['discriptionsummary'] ?? '';
        ?>
            <div class="summary-item <?php echo esc_attr($border); ?>">
                <?php if ($link_summary): 
                    $url    = $link_summary['url'] ?? '#';
                    $target = $link_summary['target'] ?? '_self';
                    $linkTitle = $link_summary['title'] ?? 'Button';
                ?>
                    <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="summary-title">
                        <?php echo esc_html($linkTitle); ?>
                    </a>
                <?php endif; ?>

                <?php if ($discription_summary): ?>
                    <h3 class="summary-discription"><?php echo esc_html($discription_summary); ?></h3>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>


<style>
.summary-block {
    margin-top: 50px;
    width: 100%;
    background-color: #f8f6f2;
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
}

.summary-container {
    max-width: 800px;
    width: 55%;
}

.summary-item {
    display: grid;
    grid-template-rows: auto auto; 
    align-items: center;  
    transition: all 0.3s ease;
    padding: 0 20px;
    opacity: 1;
    filter: blur(0);
}


.summary-item.bottom { border-bottom: 1px solid #333; }
.summary-item.top { border-top: 1px solid #333; }
.summary-item.left { border-left: 1px solid #333; }
.summary-item.right { border-right: 1px solid #333; }
.summary-item.none { border: none; }
.summary-item.full { border: 1px solid #333; }



.summary-container:hover .summary-item {
    opacity: 0.3;
    filter: blur(1px);
}

.summary-container .summary-item:hover {
    opacity: 1;
    filter: blur(0);
    transform: scale(1.02);
}
.summary-title {
    grid-row: 1 / 2;
    font-size: 1.7rem;
    font-weight: 700;
    margin-top: 10px;
    text-decoration: none;
    color: #1a5427;
}

.summary-discription {
    grid-row: 2 / 3;
    font-size: 1.4rem;
    font-weight: 500;
    color: #7f7f7d;
}

@media screen and (max-width: 768px) {
    .summary-block {
    margin-top: 50px;
    width: 100%;
    background-color: #f8f6f2;
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
}

.summary-container {
    max-width: 800px;
    width: 70%;
}

.summary-item {
    display: grid;
    grid-template-rows: auto auto; 
    align-items: center;  
    transition: all 0.3s ease;
    padding: 0 20px;
    opacity: 1;
    filter: blur(0);
}


.summary-item.bottom { border-bottom: 1px solid #333; }
.summary-item.top { border-top: 1px solid #333; }
.summary-item.left { border-left: 1px solid #333; }
.summary-item.right { border-right: 1px solid #333; }
.summary-item.none { border: none; }
.summary-item.full { border: 1px solid #333; }



.summary-container:hover .summary-item {
    opacity: 0.3;
    filter: blur(1px);
}

.summary-container .summary-item:hover {
    opacity: 1;
    filter: blur(0);
    transform: scale(1.02);
}
.summary-title {
    grid-row: 1 / 2;
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 10px;
    text-decoration: none;
    color: #1a5427;
}

.summary-discription {
    grid-row: 2 / 3;
    font-size: 1.2rem;
    font-weight: 500;
    color: #7f7f7d;
}
}
</style>
