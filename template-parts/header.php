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

<?php
wp_body_open();

// Haal ACF velden op
$title = get_field('title', 'option');
$logo  = get_field('logo', 'option');
$menu  = get_field('menu', 'option');
?>

<header id="site-header" class="site-header">
    <div class="container header-inner">
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
