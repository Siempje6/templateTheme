<?php
function get_template_directory() {}
function get_stylesheet_directory() {}
function add_filter($hook, $callback, $priority = 10, $accepted_args = 1) {}
function __($text, $domain = '') { return $text; }

function wp_enqueue_style($handle, $src = '', $deps = [], $ver = false, $media = 'all') {}
function wp_enqueue_script($handle, $src = '', $deps = [], $ver = false, $in_footer = false) {}
function get_template_directory_uri() { return ''; }
function get_stylesheet_uri() { return ''; }
function add_action($hook, $callback, $priority = 10, $accepted_args = 1) {}
function add_theme_support($feature, $args = null) {}
function register_nav_menus($locations) {}
function get_sub_field($field_name) { return ''; }
function esc_url($url) { return $url; }
function esc_attr($text) { return $text; }
