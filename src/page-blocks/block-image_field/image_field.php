<?php
$image = get_sub_field('image'); 
$styling = get_sub_field('styling') ?: [];

function px($val, $default = '0px') {
    if ($val === '' || $val === null) return $default;
    return is_numeric($val) ? $val . 'px' : $val;
}

$width               = $styling['width'] ?? '100%';
$max_width           = $styling['max_width'] ?? 'none';
$height              = $styling['height'] ?? 'auto';
$object_fit          = $styling['object_fit'] ?? 'cover';
$object_position     = $styling['object_position'] ?? 'center';
$border_radius       = px($styling['border_radius'], '12px');
$border_width        = px($styling['border_width'], '0px');
$border_style        = $styling['border_style'] ?? 'solid';
$border_color        = $styling['border_color'] ?? 'transparent';
$border              = "$border_width $border_style $border_color";
$outline             = $styling['outline'] ?? 'none';
$box_shadow          = $styling['box_shadow'] ?? 'none';
$margin              = px($styling['margin']);
$margin_top          = px($styling['margin_top']);
$margin_right        = px($styling['margin_right']);
$margin_bottom       = px($styling['margin_bottom']);
$margin_left         = px($styling['margin_left']);
$custom_margin       = "$margin_top $margin_right $margin_bottom $margin_left";
$padding             = px($styling['padding']);
$display             = $styling['display'] ?? 'block';
$overflow            = $styling['overflow'] ?? 'visible';
$opacity             = $styling['opacity'] ?? '1';
$filter              = $styling['filter'] ?? 'none';
$mix_blend_mode      = $styling['mix_blend_mode'] ?? 'normal';
$transform           = $styling['transform'] ?? 'none';
$transform_origin    = $styling['transform_origin'] ?? 'center';
$transition          = $styling['transition'] ?? 'all 0.3s ease';
$cursor              = $styling['cursor'] ?? 'default';
$bg_color            = $styling['background_color'] ?? 'transparent';
$container_overflow  = $styling['container_overflow'] ?? 'hidden';
$text_align          = $styling['text_align'] ?? 'left';
$box_sizing          = $styling['box_sizing'] ?? 'border-box';
$position            = $styling['position'] ?? 'static';
$z_index             = $styling['z_index'] ?? 'auto';
$clip_path           = $styling['clip_path'] ?? 'none';
$mask_image          = $styling['mask_image'] ?? 'none';
$will_change         = $styling['will_change'] ?? 'auto';
?>

<?php if ($image): ?>
<section class="block-image-field">
    <div class="image-container" style="
        --img-radius: <?= esc_attr($border_radius); ?>;

        width: <?= esc_attr($width); ?>;
        max-width: <?= esc_attr($max_width); ?>;
        height: <?= esc_attr($height); ?>;
        border: <?= esc_attr($border); ?>;
        border-radius: var(--img-radius);
        outline: <?= esc_attr($outline); ?>;
        box-shadow: <?= esc_attr($box_shadow); ?>;
        margin: <?= esc_attr($margin); ?>;
        margin-top: <?= esc_attr($margin_top); ?>;
        margin-right: <?= esc_attr($margin_right); ?>;
        margin-bottom: <?= esc_attr($margin_bottom); ?>;
        margin-left: <?= esc_attr($margin_left); ?>;
        padding: <?= esc_attr($padding); ?>;
        display: <?= esc_attr($display); ?>;
        overflow: <?= esc_attr($overflow); ?>;
        opacity: <?= esc_attr($opacity); ?>;
        filter: <?= esc_attr($filter); ?>;
        mix-blend-mode: <?= esc_attr($mix_blend_mode); ?>;
        transform: <?= esc_attr($transform); ?>;
        transform-origin: <?= esc_attr($transform_origin); ?>;
        transition: <?= esc_attr($transition); ?>;
        cursor: <?= esc_attr($cursor); ?>;
        background-color: <?= esc_attr($bg_color); ?>;
        overflow: <?= esc_attr($container_overflow); ?>;
        text-align: <?= esc_attr($text_align); ?>;
        box-sizing: <?= esc_attr($box_sizing); ?>;
        position: <?= esc_attr($position); ?>;
        z-index: <?= esc_attr($z_index); ?>;
        clip-path: <?= esc_attr($clip_path); ?>;
        mask-image: <?= esc_attr($mask_image); ?>;
        will-change: <?= esc_attr($will_change); ?>;
        object-fit: <?= esc_attr($object_fit); ?>;
        object-position: <?= esc_attr($object_position); ?>;
    ">
        <img src="<?= esc_url($image['url']); ?>" 
             alt="<?= esc_attr($image['alt']); ?>" 
             style="
                width:100%; 
                height:100%; 
                display:block; 
                border-radius: var(--img-radius);
             " 
             loading="lazy">
    </div>
</section>
<?php endif; ?>
