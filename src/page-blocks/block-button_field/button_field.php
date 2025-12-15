<?php
$button = get_sub_field('button');
$button_style = get_sub_field('button_style');

$button_url    = $button['url'] ?? '#';
$button_title  = $button['title'] ?? '';
$button_target = $button['target'] ?? '_self';

?>
<a href="<?php echo esc_url($button_url); ?>"
   target="<?php echo esc_attr($button_target); ?>"
   class="button button--medium button--medium button--slightly-rounded">
    <?php echo esc_html($button_title); ?>
</a>


