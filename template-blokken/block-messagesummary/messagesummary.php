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
