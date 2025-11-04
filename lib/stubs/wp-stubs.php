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
function have_rows($field_name) { return false; }
function the_row() {}
function get_row_layout() { return ''; }
function get_template_part($slug, $name = null) {}
function esc_html($text) { return $text; }
function wp_dequeue_style($handle) {}
function remove_action($hook, $function_to_remove, $priority = 10) {}
function body_class($class = '') {}
function wp_head() {}
function wp_footer() {}
function is_front_page() { return false; }
function bloginfo($show) { return ''; }
function language_attributes() { return ''; }
function wp_body_open() {}
function get_field($field_name, $post_id = false) { return null; }
function admin_url($path = '') { return ''; }
function wp_nonce_field($action = -1, $name = "_wpnonce", $referer = true , $echo = true) {}
function wp_verify_nonce($nonce, $action = -1) { return true; }
function is_email($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) !== false; }
function wp_die($message) { die($message); }
function sanitize_email($email) { return filter_var($email, FILTER_SANITIZE_EMAIL); }
function wp_mail($to, $subject, $message, $headers = '', $attachments = array()) { return true; }  
function wp_redirect($location, $status = 302) { header("Location: $location", true, $status); exit; }
function add_query_arg($key, $value, $url = '') { return $url .
    (strpos($url, '?') === false ? '?' : '&') . urlencode($key) . '=' . urlencode($value); 
}
function wp_get_referer() { return ''; }
function wp_kses_post($data) { return $data; }
function do_shortcode($shortcode) { return $shortcode; }
function locate_template($template_names, $load = false, $require_once = true) { return false; }

function home_url($path = '') { return 'http://example.com/' . ltrim($path, '/'); }
function is_category() { return false; }
function is_single() { return false; }
function is_page() { return false; }
function get_the_category() { return []; } 
function get_category($category_id) { return (object)['term_id' => $category_id, 'name' => 'Category ' . $category_id]; }
function get_category_link($category) { return home_url('category/' . $category->term_id); }
function get_ancestors($object_id, $object_type) { return []; } 
function get_the_title($post_id = null) { return $post_id ? 'Page ' . $post_id : 'Current Page'; }
function get_queried_object() { return (object)['term_id' => 1, 'name' => 'Example Category']; }
function get_post_ancestors($post) { return []; }
function get_permalink($post_id) { return home_url('page/' . $post_id); }
?>
