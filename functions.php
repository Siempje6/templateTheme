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




add_action('admin_post_nopriv_send_newsletter_email', 'handle_newsletter_form');
add_action('admin_post_send_newsletter_email', 'handle_newsletter_form');

function handle_newsletter_form() {
    if (!isset($_POST['newsletter_nonce_field']) || !wp_verify_nonce($_POST['newsletter_nonce_field'], 'newsletter_nonce')) {
        wp_die('Beveiligingscheck mislukt!');
    }

    if (!isset($_POST['newsletter_email']) || !is_email($_POST['newsletter_email'])) {
        wp_die('Ongeldig e-mailadres!');
    }

    $user_email = sanitize_email($_POST['newsletter_email']); 
    $admin_email = get_field('email', 'option'); 

    if (!$admin_email || !is_email($admin_email)) {
        wp_die('Geen geldig admin e-mailadres ingesteld.');
    }

    $admin_subject = 'Nieuwe nieuwsbriefinschrijving';
    $admin_message = 'Er is een nieuwe inschrijving voor de nieuwsbrief: ' . $user_email;
    $admin_headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($admin_email, $admin_subject, $admin_message, $admin_headers);

    $user_subject = 'Bevestiging nieuwsbriefinschrijving';
    $user_message = "Hallo,\n\nBedankt voor je inschrijving voor onze nieuwsbrief!\n\nMet vriendelijke groet,\n[Je Bedrijf]";
    $user_headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($user_email, $user_subject, $user_message, $user_headers);

    wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    exit;
}
