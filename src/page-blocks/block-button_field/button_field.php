<?php
$button = get_sub_field('button');
$button_style = get_sub_field('button_style');

$button_url    = $button['url'] ?? '#';
$button_title  = $button['title'] ?? '';
$button_target = $button['target'] ?? '_self';

?>
<a href="<?php echo esc_url($button_url); ?>"
    target="<?php echo esc_attr($button_target); ?>"
    class="button">
    <?php echo esc_html($button_title); ?>
</a>

<a href="<?php echo esc_url($button_url); ?>"
    target="<?php echo esc_attr($button_target); ?>"
    class="button-back">
    <
</a>

<a href="<?php echo esc_url($button_url); ?>"
    target="<?php echo esc_attr($button_target); ?>"
    class="button-next">
    <?php echo esc_html($button_title); ?>
</a>

<a href="<?php echo esc_url($button_url); ?>"
    target="<?php echo esc_attr($button_target); ?>"
    class="button-icon">
    <?php echo esc_html($button_title); ?>
</a>

<a href="<?php echo esc_url($button_url); ?>"
    target="<?php echo esc_attr($button_target); ?>"
    class="button-round">
    <?php echo esc_html($button_title); ?>
</a>