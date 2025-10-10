<?php
/**
 * Thema functies en scripts
 */

// ===============================
// 1. Scripts & Styles inladen
// ===============================
function thema_enqueue_assets() {
    // ---------- CSS ----------
    wp_enqueue_style(
        'theme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        null
    );

    // ---------- JS ----------
    // GSAP core
    wp_enqueue_script(
        'gsap-core',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js',
        array(),
        null,
        true
    );

    // ScrollTrigger plugin (optioneel, kan in de toekomst)
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
        array('gsap-core'),
        null,
        true
    );

    // Jouw eigen app.js
    wp_enqueue_script(
        'theme-app-js',
        get_template_directory_uri() . '/js/app.js',
        array('gsap-core', 'gsap-scrolltrigger'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'thema_enqueue_assets');

// ===============================
// 2. WP standaard CSS verwijderen
// ===============================
function thema_remove_wp_styling() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('classic-theme-styles');

    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('wp_enqueue_scripts', 'thema_remove_wp_styling', 100);

// ===============================
// 3. Thema setup
// ===============================
function thema_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'thema')
    ));
}
add_action('after_setup_theme', 'thema_setup');

// ===============================
// 4. ACF JSON instellingen
// ===============================
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// ===============================
// 5. Block Image CSS & JS
// ===============================
function image_block_assets() {
    // CSS
    wp_enqueue_style(
        'image-block-style',
        get_template_directory_uri() . '/template-blokken/block-image/style.css',
        array(),
        null
    );

    // JS
    wp_enqueue_script(
        'image-block-script',
        get_template_directory_uri() . '/template-blokken/block-image/script.js',
        array('gsap-core'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'image_block_assets');


// ===============================
// 6. Blossom Carousel inladen
// ===============================
function thema_enqueue_blossom_carousel() {
    $js_uri  = get_template_directory_uri() . '/assets/js/vendor/blossom-carousel.js';
    $css_uri = get_template_directory_uri() . '/assets/css/vendor/blossom-carousel.css';

    // JS
    wp_enqueue_script(
        'blossom-carousel',
        $js_uri,
        array(), // afhankelijkheden, voeg toe indien nodig
        null,
        true
    );

    // CSS
    wp_enqueue_style(
        'blossom-carousel-style',
        $css_uri,
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'thema_enqueue_blossom_carousel');
