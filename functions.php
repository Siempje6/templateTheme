<?php

/**
 * Thema functies en scripts
 */

require_once get_template_directory() . '/lib/typography.php';

function thema_enqueue_assets()
{
    wp_enqueue_style(
        'theme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    wp_enqueue_script(
        'gsap-core',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js',
        array(),
        null,
        true
    );

    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
        array('gsap-core'),
        null,
        true
    );

    wp_enqueue_script(
        'theme-app-js',
        get_template_directory_uri() . '/assets/js/script.js',
        array('gsap-core', 'gsap-scrolltrigger'),
        filemtime(get_template_directory() . '/assets/js/script.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'thema_enqueue_assets');

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

function thema_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'thema')
    ));
}
add_action('after_setup_theme', 'thema_setup');

add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

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

function render_fonts_preview_page()
{
    $file = get_template_directory() . '/lib/theme-settings/render.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<div class="notice notice-error"><p>Settings page bestand niet gevonden in lib/theme-settings/!</p></div>';
    }
}

function render_settings_page()
{
    $file = get_template_directory() . '/lib/settings/render.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<div class="notice notice-error"><p>Settings page bestand niet gevonden in lib/settings/!</p></div>';
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
        'render_settings_page',
        'dashicons-admin-customizer',
        60
    );

    add_submenu_page(
        'mytheme-settings',
        __('Fonts Preview', 'mytheme'),
        __('Fonts Preview', 'mytheme'),
        'manage_options',
        'fonts-preview',
        'render_fonts_preview_page'
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

add_action('acf/render_field', function($field){

    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'settings_page_cta') return;

    if ($field['type'] !== 'message') return;

    $ctas = get_field('call_to_action', 'option');
    if (!$ctas) return;

    echo '<div class="cta-options-preview" style="margin-bottom:30px; padding:20px; background:#f6f7f7; border-radius:8px; max-width:1200px; margin-left:auto; margin-right:auto;">';
    echo '<h2 style="margin-bottom:15px;">Herbruikbaar blok Preview</h2>';

    $cta = $ctas[0];
    echo '<div class="cta-preview-wrapper" style="margin-bottom:20px;">';

    $cta_rows = [$cta];
    $file = get_template_directory() . '/lib/cta-preview/render.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<p style="color:red;">Herbruikbaar blok render bestand niet gevonden!</p>';
    }

    echo '</div>';
    echo '</div>';

}, 10, 1);

function load_accordion_css() {
    wp_enqueue_style(
        'accordion-css',
        get_template_directory_uri() . '/css/accordion/accordion.css',
        array(),
        filemtime(get_template_directory() . '/css/accordion/accordion.css')
    );
}
add_action('wp_enqueue_scripts', 'load_accordion_css');

function load_breadcrumbs_css() {
    wp_enqueue_style(
        'breadcrumbs-css',
        get_template_directory_uri() . '/css/breadcrumbs/breadcrumbs.css',
        array(),
        filemtime(get_template_directory() . '/css/breadcrumbs/breadcrumbs.css')
    );
}
add_action('wp_enqueue_scripts', 'load_breadcrumbs_css');

function load_button_css() {
    wp_enqueue_style(
        'button-css',
        get_template_directory_uri() . '/css/button/button.css',
        array(),
        filemtime(get_template_directory() . '/css/button/button.css')
    );
}
add_action('wp_enqueue_scripts', 'load_button_css');
