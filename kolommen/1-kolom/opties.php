<?php
$rij_breedte = get_field('rij_breedte');

$horizontale_uitlijning = get_field('horizontale_uitlijning');
$verticale_uitlijning = get_field('verticale_uitlijning');
$volgorde_mobiel = get_field('volgorde_mobiel');
$responsive_gedrag = get_field('responsive_gedrag');
$even_hoogte_kolommen = get_field('even_hoogte_kolommen');

$rand = get_field('rand');
$box_schaduw = get_field('box_schaduw');

$max_breedte = get_field('max_breedte');
$padding_boven = get_field('padding_boven');
$padding_onder = get_field('padding_onder');
$margin_boven = get_field('margin_boven');
$margin_onder = get_field('margin_onder');
$achtergrond_kleur = get_field('achtergrond_kleur');

$gat_kolommen = get_field('gat_kolommen');

$tekst_kleur = get_field('tekst_kleur');
$link_kleur = get_field('link_kleur');
$rand_radius = get_field('rand_radius');
$rand_dikte = get_field('rand_dikte');
$randkleur = get_field('randkleur');

$custom_css_class = get_field('custom_css_class');
$custom_id = get_field('custom_id');
$animatie_bij_laden = get_field('animatie_bij_laden');

$breedte_rij_style = '';

$uitlijning_horizontaal = '';
$uitlijning_verticaal = '';
$volgorde_mobiel = '';
$responsive_gedrag = '';
$even_hoogte_kolommen = '';

$rand = '';
$box_schaduw_style = '';

$max_breedte_style = '';
$padding_boven_style = '';
$padding_onder_style = '';
$margin_boven_style = '';
$margin_onder_style = '';
$achtergrond_kleur_style = '';

$gat_kolommen_style = '';

$tekst_kleur_style = '';
$link_kleur_style = '';
$rand_radius_style = '';
$rand_dikte_style = '';
$randkleur_style = '';

$custom_css_class_style = '';
$custom_id_style = '';
$animatie_bij_laden_style = '';

if ($rij_breedte) {
    switch ($rij_breedte) {
        case '50':
            $breedte_rij_style = 'max-width:50%;';
            break;
        case '60':
            $breedte_rij_style = 'max-width:60%;';
            break;
        case '70':
            $breedte_rij_style = 'max-width:70%;';
            break;
        case '80':
            $breedte_rij_style = 'max-width:80%;';
            break;
        case '90':
            $breedte_rij_style = 'max-width:90%;';
            break;
        case '100':
            $breedte_rij_style = 'max-width:100%;';
            break;
    }
}
if ($horizontale_uitlijning) {
    switch ($horizontale_uitlijning) {
        case 'left':
            $uitlijning_horizontaal = 'justify-content: flex-start;';
            break;
        case 'center':
            $uitlijning_horizontaal = 'justify-content: center;';
            break;
        case 'right':
            $uitlijning_horizontaal = 'justify-content: flex-end;';
            break;
        case 'space-between':
            $uitlijning_horizontaal = 'justify-content: space-between;';
            break;
        case 'space-around':
            $uitlijning_horizontaal = 'justify-content: space-around;';
            break;
    }
}
if ($verticale_uitlijning) {
    switch ($verticale_uitlijning) {
        case 'top':
            $uitlijning_verticaal = 'align-items: flex-start;';
            break;
        case 'center':
            $uitlijning_verticaal = 'align-items: center;';
            break;
        case 'bottom':
            $uitlijning_verticaal = 'align-items: flex-end;';
            break;
        case 'stretch':
            $uitlijning_verticaal = 'align-items: stretch;';
            break;
    }
}
if ($volgorde_mobiel) {
    switch ($volgorde_mobiel) {
        case 'standaard':
            $volgorde_mobiel = '';
            break;
        case 'omgedraaid':
            $volgorde_mobiel = 'flex-direction: column-reverse;';
            break;
        case 'stack onder elkaar':
            $volgorde_mobiel = 'flex-direction: column;';
            break;
    }
}
if ($responsive_gedrag) {
    switch ($responsive_gedrag) {
        case '1':
            $responsive_gedrag = 'flex-wrap: wrap;';
            break;
        case '0':
            $responsive_gedrag = '';
            break;
    }
}
if ($even_hoogte_kolommen) {
    switch ($even_hoogte_kolommen) {
        case '1':
            $even_hoogte_kolommen = 'align-items: stretch;';
            break;
        case '0':
            $even_hoogte_kolommen = '';
            break;
    }
}
if ($rand) {
    switch ($rand) {
        case '1':
            $rand = 'border: 1px solid #000;';
            break;
        case '0':
            $rand = '';
            break;
    }
}
if ($box_schaduw) {
    switch ($box_schaduw) {
        case '1':
            $box_schaduw_style = 'box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);';
            break;
        case '0':
            $box_schaduw_style = '';
            break;
    }
}



if ($max_breedte) {
    $max_breedte_style = 'max-width:' . esc_attr($max_breedte) . 'px;';
}
if ($padding_boven) {
    $padding_boven_style = 'padding-top:' . esc_attr($padding_boven) . 'px;';
}
if ($padding_onder) {
    $padding_onder_style = 'padding-bottom:' . esc_attr($padding_onder) . 'px;';
}
if ($margin_boven) {
    $margin_boven_style = 'margin-top:' . esc_attr($margin_boven) . 'px;';
}
if ($margin_onder) {
    $margin_onder_style = 'margin-bottom:' . esc_attr($margin_onder) . 'px;';
}
if ($achtergrond_kleur) {
    $achtergrond_kleur_style = 'background-color:' . esc_attr($achtergrond_kleur) . ';';
}
if ($gat_kolommen) {
    $gat_kolommen_style = 'gap:' . esc_attr($gat_kolommen) . 'px;';
}


if ($tekst_kleur) {
    $tekst_kleur_style = 'color:' . esc_attr($tekst_kleur) . ';';
}
if ($link_kleur) {
    $link_kleur_style = 'color:' . esc_attr($link_kleur) . ';';
}
if ($rand_radius) {
    $rand_radius_style = 'border-radius:' . esc_attr($rand_radius) . 'px;';
}
if ($rand_dikte) {
    $rand_dikte_style = 'border-width:' . esc_attr($rand_dikte) . 'px;';
}
if ($randkleur) {
    $randkleur_style = 'border-color:' . esc_attr($randkleur) . ';';
}


if ($custom_css_class) {
    $custom_css_class_style = esc_attr($custom_css_class);
}
if ($custom_id) {
    $custom_id_style = esc_attr($custom_id);
}
if ($animatie_bij_laden) {
    switch ($animatie_bij_laden) {
        case 'geen':
            $animatie_bij_laden_style = '';
            break;
        case 'fade in':
            $animatie_bij_laden_style = 'animate__animated animate__fadeIn';
            break;
        case 'slide up':
            $animatie_bij_laden_style = 'animate__animated animate__slideInUp';
            break;
        case 'slide left':
            $animatie_bij_laden_style = 'animate__animated animate__slideInLeft';
            break;
        case 'zoom in':
            $animatie_bij_laden_style = 'animate__animated animate__zoomIn';
            break;
    }
}
