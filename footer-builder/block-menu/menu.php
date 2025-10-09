<?php
/**
 * Footer Menu Block
 */

if (have_rows('menurepeater')): ?>
    <div class="footer-menu">
        <ul class="footer-menu__list">
            <?php while (have_rows('menurepeater')): the_row();
                $title = get_sub_field('menutitle');
                $link = get_sub_field('menulink');
                if ($link):
                    $url = esc_url($link['url']);
                    $label = esc_html($link['title'] ?: $title);
                    $target = $link['target'] ? ' target="_blank"' : '';
                    ?>
                    <li class="footer-menu__item">
                        <a href="<?= $url; ?>"<?= $target; ?> class="footer-menu__link">
                            <?= $label; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>

<style>
    .footer-menu {
        margin: 0px 0;
        display: flex;
        justify-content: center;
    }

    .footer-menu__list {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .footer-menu__item {
        margin: 0;
    }

    .footer-menu__link {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .footer-menu__link:hover {
        color: #247937;
    }
</style>
