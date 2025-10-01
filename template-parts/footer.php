<?php
/**
 * Standaard site footer
 * Haalt content uit ACF Options Page "Footer"
 */

// Haal ACF velden op
$nieuwsletter = get_field('nieuwsletter', 'option');
$menusocial   = get_field('menusocial', 'option');
$menupolicy   = get_field('menupolicy', 'option');
?>

<footer id="site-footer" class="site-footer">
    <div class="container footer-inner">

        <?php if ($nieuwsletter): ?>
            <div class="footer-nieuwsletter">
                <p><?php echo esc_html($nieuwsletter); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($menusocial): ?>
            <nav class="footer-social">
                <ul>
                    <?php foreach ($menusocial as $item): ?>
                        <li>
                            <a href="<?php echo esc_url($item['link']['url']); ?>" target="<?php echo esc_attr($item['link']['target']); ?>">
                                <?php echo esc_html($item['titel']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if ($menupolicy): ?>
            <nav class="footer-policy">
                <ul>
                    <?php foreach ($menupolicy as $item): ?>
                        <li>
                            <a href="<?php echo esc_url($item['link']['url']); ?>" target="<?php echo esc_attr($item['link']['target']); ?>">
                                <?php echo esc_html($item['titel']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
