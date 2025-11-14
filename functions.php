<?php

/**
 * Thema functies en scripts
 */

// Include typography functions
require_once get_template_directory() . '/lib/typography.php';

// ===============================
// 1. Scripts & Styles inladen
// ===============================
function thema_enqueue_assets()
{
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
function thema_remove_wp_styling()
{
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
function thema_setup()
{
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
function thema_enqueue_blossom_carousel()
{
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
function my_acf_admin_enqueue_styles()
{
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


add_filter('template_include', function ($template) {
    if (!function_exists('set_query_var')) return $template;
    return $template;
});


function mytheme_enqueue_column_rows_css()
{
    wp_enqueue_style(
        'column-rows-style',
        get_template_directory_uri() . '/assets/css/builder.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/builder.css')
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_column_rows_css');








// AJAX handler voor pagina zoekfunctie
add_action('wp_ajax_search_pages', 'search_pages_autocomplete');
add_action('wp_ajax_nopriv_search_pages', 'search_pages_autocomplete');

function search_pages_autocomplete()
{
    $term = sanitize_text_field($_GET['term'] ?? '');
    if (!$term) {
        wp_send_json([]);
    }

    $pages = get_posts([
        'post_type' => 'page',
        's' => $term,
        'posts_per_page' => 5
    ]);

    $results = [];
    foreach ($pages as $page) {
        $results[] = [
            'title' => get_the_title($page),
            'url' => get_permalink($page)
        ];
    }

    wp_send_json($results);
}



add_filter('acf/load_field/key=field_6909bb0fc3ab5', function ($field) {
    $pt_args = [
        'public' => true,
    ];
    $post_types = get_post_types($pt_args, 'objects');

    $choices = [];

    foreach ($post_types as $name => $obj) {
        $label = $obj->labels->singular_name ?? $obj->label ?? $name;
        $choices[$name] = $label;
    }

    asort($choices);

    $field['choices'] = $choices;
    $field['return_format'] = 'value';

    return $field;
});



add_filter('acf/load_field/key=field_690c612ebdf84', function ($field) {
    $terms = get_terms([
        'taxonomy'   => 'categorie',
        'hide_empty' => true,
    ]);

    if (!is_wp_error($terms) && !empty($terms)) {
        $field['choices'] = [];
        foreach ($terms as $term) {
            $field['choices'][$term->term_id] = $term->name;
        }
    }

    return $field;
});





// functions.php

add_filter('acf/fields/color_picker/wp_color_picker_args', function ($args, $field) {
    // Zet je eigen paletten
    $args['palettes'] = [
        '#000000', // zwart
        '#ffffff', // wit
        '#dd3333', // rood
        '#dd9933', // oranje
        '#eeee22', // geel
        '#81d742', // groen
        '#1e73be', // blauw
        '#8224e3', // paars
    ];
    return $args;
}, 10, 2);

add_action('acf/input/admin_enqueue_scripts', function () {
    wp_enqueue_style(
        'custom-acf-colorpicker-css',
        get_stylesheet_directory_uri() . 'assets/css/custom-colorpicker.css',
        [],
        null
    );
});



add_action('wp_ajax_search_pages', 'search_pages_callback');
add_action('wp_ajax_nopriv_search_pages', 'search_pages_callback');

function search_pages_callback()
{
    $term = sanitize_text_field($_GET['term'] ?? '');
    $results = [];

    $pages = get_posts([
        'post_type' => 'page',
        's' => $term,
        'posts_per_page' => 10,
    ]);

    foreach ($pages as $page) {
        $results[] = [
            'title' => $page->post_title,
            'url' => get_permalink($page->ID),
        ];
    }

    wp_send_json($results);
}






function render_cta_preview_page()
{
    $file = get_template_directory() . '/lib/cta-preview/render.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<div class="notice notice-error"><p>CTA Preview bestand niet gevonden in lib/cta-preview/!</p></div>';
    }
}

add_action('admin_menu', 'mytheme_register_theme_settings');

function mytheme_register_theme_settings()
{

    add_menu_page(
        __('Theme Settings', 'mytheme'),
        __('Theme Settings', 'mytheme'),
        'manage_options',
        'mytheme-settings',
        'mytheme_render_main_page',
        'dashicons-admin-customizer',
        60
    );

    add_submenu_page(
        'mytheme-settings',
        __('CTA Preview', 'mytheme'),
        __('CTA Preview', 'mytheme'),
        'manage_options',
        'cta-preview',
        'render_cta_preview_page'
    );

    add_submenu_page(
        'mytheme-settings',
        __('Required Plugins', 'mytheme'),
        __('Required Plugins', 'mytheme'),
        'manage_options',
        'mytheme-required-plugins',
        'mytheme_render_plugins_page'
    );
}

function mytheme_render_main_page()
{
    echo '<div class="wrap"><h1>' . __('Theme Settings', 'mytheme') . '</h1>';
    echo '<p>Welkom bij de Theme Settings van je thema.</p></div>';
}

function mytheme_render_plugins_page()
{

    $plugins = [
        [
            'name' => 'Advanced Custom Fields Pro',
            'slug' => 'advanced-custom-fields-pro',
            'description' => 'Maak krachtige custom fields voor je website.',
            'link' => 'https://www.advancedcustomfields.com/pro/'
        ],
        [
            'name' => 'Advanced Custom Fields: Extended',
            'slug' => 'acf-extended',
            'description' => 'Breid ACF uit met extra functies.',
            'link' => 'https://wordpress.org/plugins/acf-extended/'
        ],
        [
            'name' => 'Classic Editor',
            'slug' => 'classic-editor',
            'description' => 'Breng de klassieke WordPress editor terug.',
            'link' => 'https://wordpress.org/plugins/classic-editor/'
        ],
        [
            'name' => 'LuckyWP ACF Menu Field',
            'slug' => 'acf-menu-field',
            'description' => 'Voeg menu-velden toe aan ACF.',
            'link' => 'https://wordpress.org/plugins/acf-menu-field/'
        ],
        [
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'description' => 'Maak eenvoudig contactformulieren.',
            'link' => 'https://wordpress.org/plugins/contact-form-7/'
        ],
    ];

    echo '<div class="wrap"><h1>' . __('Required Plugins', 'mytheme') . '</h1>';

    echo '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">';

    foreach ($plugins as $plugin) {
        $installed = file_exists(WP_PLUGIN_DIR . '/' . $plugin['slug']);
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        $active = $installed && is_plugin_active($plugin['slug'] . '/' . $plugin['slug'] . '.php');
        $status = $installed ? ($active ? 'Active' : 'Installed') : 'Not Installed';

        echo '<div style="border:1px solid #ddd; border-radius:8px; padding:20px; display:flex; flex-direction:column; justify-content:space-between; min-height:200px;">';
        echo '<h2 style="margin-top:0;">' . esc_html($plugin['name']) . '</h2>';
        echo '<p>' . esc_html($plugin['description']) . '</p>';
        echo '<p><strong>Status: </strong>' . esc_html($status) . '</p>';
        echo '<a href="' . esc_url($plugin['link']) . '" target="_blank" style="text-decoration:none; background:#1A73E8; color:#fff; padding:10px 15px; border-radius:5px; text-align:center; display:inline-block;">Download / View</a>';
        echo '</div>';
    }

    echo '</div></div>';
}

add_filter('acf/load_field/key=field_6916e99707106', function($field) {

    $field['choices'] = [];

    $ctas = get_field('call_to_action', 'option');

    if ($ctas && is_array($ctas)) {
        foreach ($ctas as $cta) {

            $class = $cta['class'] ?? false;

            if ($class) {
                $field['choices'][$class] = $class;
            }
        }
    }

    if (empty($field['choices'])) {
        $field['choices'][''] = 'Geen CTA classes gevonden';
    }

    return $field;
});
