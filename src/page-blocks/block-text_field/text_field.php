<?php
$text = get_sub_field('text');

$styling_opties = get_sub_field('styling_opties') ?: [];

$font_size = !empty($styling_opties['font_size']) ? $styling_opties['font_size'] . 'px' : '16px';
$line_height = !empty($styling_opties['line_height']) ? $styling_opties['line_height'] : '1.2';
?>

<div class="text-block">
    <?php if ($text): ?>
        <div style="font-size: <?php echo $font_size; ?>; line-height: <?php echo $line_height; ?>; margin: 0;">
            <?php echo $text; ?>
        </div>
    <?php endif; ?>
</div>
