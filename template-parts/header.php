<?php

/**
 * Standaard site header
 * Haalt content uit ACF Options Page "Header"
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    $title = get_field('title', 'option');
    $logo  = get_field('logo', 'option');
    $menu  = get_field('menu', 'option');
    ?>

    <header id="site-header" class="site-header">
        <div class="header-inner">
            <div class="header-logo">
                <?php if ($logo): ?>
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                <?php endif; ?>
            </div>

            <?php if ($title): ?>
                <h1 class="header-title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>

            <?php if ($menu): ?>
                <nav class="header-nav">
                    <ul>
                        <?php foreach ($menu as $menuItem): ?>
                            <li>
                                <a href="<?php echo esc_url($menuItem['items'][0]['link']['url']); ?>">
                                    <?php echo esc_html($menuItem['titel']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <style>
        /* ===== BASIS STYLING ===== */
        body, html {
            margin: 0;
            padding: 0;
        }

        .site-header {
            width: 100%;
            background-color: #f8f6f2;
            font-family: Arial, sans-serif;
        }

        .header-inner {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            padding: 20px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-logo {
            justify-self: start;
        }

        .header-logo img {
            max-height: 60px;
        }

        .header-title {
            justify-self: center;
            text-align: center;
            font-size: 1.8rem;
        }

        .header-nav {
            
            justify-self: center;
        }

        .header-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .header-nav a {
            text-decoration: none;
            color: #333;
            transition: opacity 0.3s ease;
        }

        .header-nav ul:hover li a {
            opacity: 0.2;
            filter: blur(1px);
        }

        .header-nav ul li:hover a {
            opacity: 1;
            filter: blur(0);
        }

        /* ===== RESPONSIVE @MAX 1300px ===== */
        @media screen and (max-width: 1300px) {
            .header-inner {
                grid-template-columns: 1fr 2fr 1fr;
                max-width: 1000px;
                padding: 20px 20px;
            }

            .header-logo img {
                max-height: 50px;
            }

            .header-title {
                font-size: 1.5rem;
            }
        }

        /* ===== RESPONSIVE @MAX 1178px ===== */
        @media screen and (max-width: 1178px) {
            .header-inner {
                grid-template-rows: 1fr 1fr 1fr ;
                text-align: center;
                justify-items: center;
                max-width: 550px;
            }

            .header-logo {
                grid-row: 1 / 2;
                grid-column: 2 / 3;
            }

            .header-logo img {
                max-height: 40px;
            }

            .header-title {
                font-size: 1.3rem;
                margin: 0;
                grid-row: 2 / 3;
                grid-column: 2 / 3;
            }

            .header-nav ul {
                flex-direction: row;
            }

            .header-nav {
                grid-row: 3 / 4;
                grid-column: 2 / 3;
            }
        }
    </style>
