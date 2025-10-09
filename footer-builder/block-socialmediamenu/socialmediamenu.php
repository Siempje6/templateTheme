<?php
/**
 * Footer Social Media Menu Block
 */

if (have_rows('socialrepeater')): ?>
    <div class="footer-socials">
        <ul class="footer-socials__list">
            <?php while (have_rows('socialrepeater')): the_row();
                $title = get_sub_field('socialtitle');
                $link = get_sub_field('sociallink');
                if ($link):
                    $url = esc_url($link['url']);
                    $label = esc_html($link['title'] ?: $title);
                    $target = $link['target'] ? ' target="_blank"' : '';
                    ?>
                    <li class="footer-socials__item">
                        <a href="<?= $url; ?>"<?= $target; ?> class="footer-socials__link">
                            <?= $label; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>

<style>
    .footer-socials {
        margin: 0px 0;
        display: flex;
        justify-content: center;
    }

    .footer-socials__list {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 15px;
    }

    .footer-socials__item {
        margin: 0;
    }

    .footer-socials__link {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .footer-socials__link:hover {
        color: #247937; 
    }
</style>