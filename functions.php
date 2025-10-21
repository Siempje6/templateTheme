<?php
/**
 * Thema functies en scripts
 */

// ===============================
// 1. Scripts & Styles inladen
// ===============================
function thema_enqueue_assets() {
    // ---------- CSS ----------
    // In plaats van losse block CSS-bestanden, gebruiken we één gecompileerde SCSS-output (main.css)
    wp_enqueue_style(
        'theme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
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

    // ScrollTrigger plugin
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
        array('gsap-core'),
        null,
        true
    );

    // Jouw eigen JS
    wp_enqueue_script(
        'theme-app-js',
        get_template_directory_uri() . '/assets/js/script.js',
        array('gsap-core', 'gsap-scrolltrigger'),
        filemtime(get_template_directory() . '/assets/js/script.js'),
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
// 5. Block CSS automatisch inladen (UITGESCHAKELD - nu via SCSS)
// ===============================

/*
function enqueue_all_block_assets() {
    $blocks_dir = get_template_directory() . '/template-blokken';
    $blocks_uri = get_template_directory_uri() . '/template-blokken';

    $folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);

    foreach ($folders as $folder) {
        $folder_name = basename($folder);
        $css_file = $folder . '/style.css';
        $js_file  = $folder . '/script.js';

        if (file_exists($css_file)) {
            wp_enqueue_style(
                $folder_name . '-block-style',
                $blocks_uri . '/' . $folder_name . '/style.css',
                array(),
                filemtime($css_file)
            );
        }

        if (file_exists($js_file)) {
            wp_enqueue_script(
                $folder_name . '-block-script',
                $blocks_uri . '/' . $folder_name . '/script.js',
                array('jquery'),
                filemtime($js_file),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_all_block_assets');
*/

// ===============================
// 6. Blossom Carousel inladen
// ===============================
function thema_enqueue_blossom_carousel() {
    $js_uri  = get_template_directory_uri() . '/assets/js/vendor/blossom-carousel.js';
    $css_uri = get_template_directory_uri() . '/assets/css/vendor/blossom-carousel.css';

    wp_enqueue_script(
        'blossom-carousel',
        $js_uri,
        array(),
        filemtime(get_template_directory() . '/assets/js/vendor/blossom-carousel.js'),
        true
    );

    wp_enqueue_style(
        'blossom-carousel-style',
        $css_uri,
        array(),
        filemtime(get_template_directory() . '/assets/css/vendor/blossom-carousel.css')
    );
}
add_action('wp_enqueue_scripts', 'thema_enqueue_blossom_carousel');

// ===============================
// 7. Admin styling (ACF backend)
// ===============================
function my_acf_admin_enqueue_styles() {
    wp_enqueue_style(
        'acf-admin-custom',
        get_template_directory_uri() . '/admin/acf-admin.css',
        [],
        filemtime(get_template_directory() . '/admin/acf-admin.css')
    );
}
add_action('admin_enqueue_scripts', 'my_acf_admin_enqueue_styles');

// ===============================
// 8. SCSS compiler via npm (documentatie)
// ===============================
/**
 * 💡 Belangrijk:
 * 
 * De SCSS-structuur compileert via npm scripts, niet in PHP.
 * 
 * In je project-root:
 *  - assets/scss/style.scss (hoofd bestand)
 *  - assets/scss/blocks/ (alle block scss files)
 * 
 * In style.scss importeer je alle blocks:
 * 
 * @import "variables";
 * @import "mixins";
 * @import "blocks/hero";
 * @import "blocks/image";
 * @import "blocks/slider";
 * 
 * Gebruik vervolgens:
 * 
 * ```bash
 * npm run build
 * ```
 * of (voor live compilatie)
 * ```bash
 * npm run watch
 * ```
 * 
 * Dit genereert automatisch `/assets/css/main.css`.
 */
