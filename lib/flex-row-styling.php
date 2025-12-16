<?php
/**
 * Genereert dynamische rij-styling op basis van ACF velden.
 * Te gebruiken in 1-kolom, 2-kolommen, 3-kolommen, etc.
 */

if (!function_exists('get_row_styling')) {
    function get_row_styling() {
        $fields = [
            'rij_breedte',
            'horizontale_uitlijning',
            'verticale_uitlijning',
            'volgorde_mobiel',
            'responsive_gedrag',
            'even_hoogte_kolommen',
            'rand',
            'box_schaduw',
            'max_breedte',
            'padding_boven',
            'padding_onder',
            'margin_boven',
            'margin_onder',
            'achtergrond_kleur',
            'gat_kolommen',
            'tekst_kleur',
            'link_kleur',
            'rand_radius',
            'rand_dikte',
            'randkleur',
            'custom_css_class',
            'custom_id',
            'animatie_bij_laden'
        ];

        foreach ($fields as $field) {
            ${$field} = get_sub_field($field) ?: '';
        }

        $style = [];

        // Basis layout
        if ($rij_breedte) $style[] = "max-width:{$rij_breedte}%;margin:0 auto;";
        if ($max_breedte) $style[] = "max-width:{$max_breedte}px;";
        if ($achtergrond_kleur) $style[] = "background-color:{$achtergrond_kleur};";
        if ($padding_boven) $style[] = "padding-top:{$padding_boven}px;";
        if ($padding_onder) $style[] = "padding-bottom:{$padding_onder}px;";
        if ($margin_boven) $style[] = "margin-top:{$margin_boven}px;";
        if ($margin_onder) $style[] = "margin-bottom:{$margin_onder}px;";
        if ($gat_kolommen) $style[] = "gap:{$gat_kolommen}px;";
        if ($tekst_kleur) $style[] = "color:{$tekst_kleur};";
        if ($randkleur) $style[] = "border-color:{$randkleur};";
        if ($rand_radius) $style[] = "border-radius:{$rand_radius}px;";
        if ($rand_dikte) $style[] = "border-width:{$rand_dikte}px;";
        if ($box_schaduw) $style[] = "box-shadow:0 4px 10px rgba(0,0,0,0.1);";

        // Rand
        if ($rand === '1') { $style[] = "border:1px solid {${ $randkleur ?: '#ccc' }};"; }

        // Horizontale uitlijning
        if ($horizontale_uitlijning) {
            $map = [
                'left' => 'flex-start',
                'center' => 'center',
                'right' => 'flex-end',
                'space-between' => 'space-between',
                'space-around' => 'space-around'
            ];
            $style[] = "justify-content:" . ($map[$horizontale_uitlijning] ?? 'center') . ";";
        }

        // Verticale uitlijning
        if ($verticale_uitlijning) {
            $map = [
                'top' => 'flex-start',
                'center' => 'center',
                'bottom' => 'flex-end',
                'stretch' => 'stretch'
            ];
            $style[] = "align-items:" . ($map[$verticale_uitlijning] ?? 'stretch') . ";";
        }

        // Responsive gedrag
        if ($responsive_gedrag === '1') $style[] = "flex-wrap:wrap;";
        if ($even_hoogte_kolommen === '1') $style[] = "align-items:stretch;";

        // Volgorde mobiel
        if ($volgorde_mobiel === 'omgedraaid') $style[] = "flex-direction:column-reverse;";
        if ($volgorde_mobiel === 'stack onder elkaar') $style[] = "flex-direction:column;";

        // Animatie
        $animatie = '';
        if ($animatie_bij_laden && $animatie_bij_laden !== 'geen') {
            $animatie = 'animate__animated animate__' . str_replace(' ', '', $animatie_bij_laden);
        }

        return [
            'id' => $custom_id ?: '',
            'class' => trim(($custom_css_class ?: '') . ' ' . $animatie),
            'style' => implode('', $style)
        ];
    }
}
