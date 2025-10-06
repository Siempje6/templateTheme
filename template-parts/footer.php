<?php
$nieuwsletter = get_field('nieuwsletter', 'option');
$menusocial   = get_field('menusocial', 'option');
$menupolicy   = get_field('menupolicy', 'option');
?>

<footer id="footer" class="footer">
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

<style>
/* ================= BASIS STYLING ================= */
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
}

.footer {
    width: 100%;
    background-color: #f8f6f2;
    padding: 20px 0;
    font-family: Arial, sans-serif;
    margin: 0; /* geen extra witruimte */
}

.footer .footer-inner {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr; 
    align-items: center;
    gap: 20px; 
    max-width: 1200px; 
    margin: 0 auto;
    padding: 20px 0;
}

/* ===== Nieuwsbrief ===== */
.footer-nieuwsletter {
    justify-self: start; 
    max-width: 400px;
    position: relative;
}

.footer-nieuwsletter .newsletter-text {
    display: block;
    margin-bottom: 12px;
    margin-left: 12px;
    font-weight: 500;
    font-size: 0.95rem;
}

.footer-nieuwsletter .newsletter-form {
    position: relative;
    display: block;
}

.footer-nieuwsletter .newsletter-form input[type="email"] {
    width: 100%;
    padding: 12px 50px 12px 40px; 
    border-radius: 24px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
    background: #fff;
    background-size: 20px 20px;
}

.footer-nieuwsletter .newsletter-form button {
    position: absolute;
    right: 2px;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: #1a5427;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.footer-nieuwsletter .newsletter-form button::after {
    content: '→';
    display: block;
}

.footer-nieuwsletter .newsletter-form button:hover {
    background-color: #247937;
}

/* ===== Social & Policy ===== */
.footer-social {
    justify-self: center;
}

.footer-policy {
    justify-self: end;
}

.footer-social ul,
.footer-policy ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
    justify-content: center;
}

.footer-social a,
.footer-policy a {
    text-decoration: none;
    color: #333;
    transition: opacity 0.3s ease;
}

.footer-social ul:hover li a,
.footer-policy ul:hover li a {
    opacity: 0.2;
    filter: blur(1px);
}

.footer-social ul li:hover a,
.footer-policy ul li:hover a {
    opacity: 1;
    filter: blur(0);
}

/* ===== RESPONSIVE ===== */
@media screen and (max-width: 1300px) {
    /* Alles horizontaal blijft hetzelfde */
    .footer .footer-inner {
        grid-template-columns: 1fr 1fr 1fr; 
        gap: 15px;
        max-width: 800px;
    }
}

/* Vanaf kleiner scherm alles gecentreerd */
@media screen and (max-width: 1178px) {

    .footer .footer-inner {
        display: grid;
        grid-template-columns: 1fr;
        justify-items: center;
        gap: 20px;
        max-width: 400px;
        text-align: center;
    }

    .footer-nieuwsletter,
    .footer-social,
    .footer-policy {
        justify-self: center;
    }

    .footer-nieuwsletter .newsletter-text {
        margin-left: 0;
    }
}

</style>
</html>
