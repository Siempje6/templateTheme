<?php
// Styles en scripts laden
function thema_enqueue_assets() {
    // Laad alleen jouw main.css
    wp_enqueue_style(
        'theme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        null
    );

    // Optioneel: block specifieke CSS
    if (file_exists(get_template_directory() . '/template-blokken/block-header/style.css')) {
        wp_enqueue_style(
            'header-block-style',
            get_template_directory_uri() . '/template-blokken/block-header/style.css',
            array(),
            null
        );
    }

    // JS script
    if (file_exists(get_template_directory() . '/assets/js/script.js')) {
        wp_enqueue_script(
            'theme-script',
            get_template_directory_uri() . '/assets/js/script.js',
            array(),
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'thema_enqueue_assets');

// Verwijder standaard WordPress CSS/emoji/etc.
function thema_remove_wp_styling() {
    // Gutenberg block library
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // WooCommerce (indien actief)

    // Classic theme styles
    wp_dequeue_style('classic-theme-styles');

    // Emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('wp_enqueue_scripts', 'thema_remove_wp_styling', 100);

// Theme support
function thema_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'thema')
    ));
}
add_action('after_setup_theme', 'thema_setup');

// ACF JSON opslaan/laden in /acf-json map
add_filter('acf/settings/save_json', function($path) {
    return get_stylesheet_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});


