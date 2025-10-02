<?php
$nieuwsletter = get_field('nieuwsletter', 'option');
$menusocial   = get_field('menusocial', 'option');
$menupolicy   = get_field('menupolicy', 'option');
?>

<footer id="site-footer" class="site-footer">

    <div class="footer-inner">

        <!-- Nieuwsbrief -->
        <?php if ($nieuwsletter): ?>
            <div class="footer-nieuwsletter">
                <?php foreach ($nieuwsletter as $row): 
                    $text  = $row['uptodatetext'] ?? '';
                    $email = $row['inputnewsletter'] ?? '';
                ?>
                    <?php if ($text): ?>
                        <p class="newsletter-text"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>

                    <form class="newsletter-form" method="post" action="#">
                        
                        <input type="email" name="newsletter_email" placeholder="Vul je e-mail in" value="<?php echo esc_attr($email); ?>" required>
                        <button type="submit"></button>
                    </form>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Social Menu -->
        <?php if ($menusocial): ?>
            <nav class="footer-social">
                <ul>
                    <?php foreach ($menusocial as $item): 
                        $link_url = $item['link']['url'] ?? '#';
                        $link_target = $item['link']['target'] ?? '_self';
                        $titel = $item['titel'] ?? '';
                    ?>
                        <li>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($titel); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <!-- Policy Menu -->
        <?php if ($menupolicy): ?>
            <nav class="footer-policy">
                <ul>
                    <?php foreach ($menupolicy as $item): 
                        $link_url = $item['link']['url'] ?? '#';
                        $link_target = $item['link']['target'] ?? '_self';
                        $titel = $item['titel'] ?? '';
                    ?>
                        <li>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($titel); ?>
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

<style>
.footer-nieuwsletter {
    max-width: 400px;
    position: relative;
}

.newsletter-text {
    display: block;
    margin-bottom: 12px;
    margin-left: 12px;
    font-weight: 500;
    font-size: 0.95rem;
}

.newsletter-form input[type="email"] {
    width: 100%;
    padding: 12px 50px 12px 40px; 
    border-radius: 24px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
    background: #fff;
    background-size: 20px 20px;
}

.newsletter-form button {
    position: absolute;
    right: 2px;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: #e7e3db;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.newsletter-form button::after {
    content: '→';
    display: block;
}

.newsletter-form input[type="email"]:not(:placeholder-shown) + button {
    opacity: 1;
}

.newsletter-form {
    position: relative;
    display: block;
}


</style>