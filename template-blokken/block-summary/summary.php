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
                $title_summary = $row['titlesummary'] ?? '';
                $year_summary  = $row['yearsummary'] ?? '';
            ?>
                <div class="summary-item <?php echo esc_attr($border); ?>">
                    <?php if ($title_summary): ?>
                        <h2 class="summary-title"><?php echo esc_html($title_summary); ?></h2>
                    <?php endif; ?>

                    <?php if ($year_summary): ?>
                        <h3 class="summary-year"><?php echo esc_html($year_summary); ?></h3>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
