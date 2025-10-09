<?php

function thema_enqueue_assets() {
    wp_enqueue_style(
        'theme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        null
    );

    if (file_exists(get_template_directory() . '/template-blokken/block-header/style.css')) {
        wp_enqueue_style(
            'header-block-style',
            get_template_directory_uri() . '/template-blokken/block-header/style.css',
            array(),
            null
        );
    }



    // Ale: block specifieke CSS komen hieronder te staan!!!!!!!!!
    



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

function thema_remove_wp_styling() {

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); 

    wp_dequeue_style('classic-theme-styles');

    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('wp_enqueue_scripts', 'thema_remove_wp_styling', 100);

function thema_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'thema')
    ));
}
add_action('after_setup_theme', 'thema_setup');

add_filter('acf/settings/save_json', function($path) {
    return get_stylesheet_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

