<?php
$button = get_sub_field('button'); 

if ($button):
    $button_url = $button['url'] ?? '#';
    $button_title = $button['title'] ?? '';
    $button_target = $button['target'] ?? '_self';
?>
    <a href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>" class="btn">
        <?php echo esc_html($button_title); ?>
    </a>
<?php endif; ?>

