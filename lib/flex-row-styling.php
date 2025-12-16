<?php
/**
 * Genereert dynamische rij-styling op basis van ACF velden.
 * Te gebruiken in 1-kolom, 2-kolommen, 3-kolommen, etc.
 */

if (!function_exists('get_row_styling')) {
    function get_row_styling(): array {
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

        $values = [];
        foreach ($fields as $field) {
            $values[$field] = get_sub_field($field) ?: '';
        }

        $style = [];

        if ($values['rij_breedte']) $style[] = "max-width:{$values['rij_breedte']}%;margin:0 auto;";
        if ($values['max_breedte']) $style[] = "max-width:{$values['max_breedte']}px;";
        if ($values['achtergrond_kleur']) $style[] = "background-color:{$values['achtergrond_kleur']};";
        if ($values['padding_boven']) $style[] = "padding-top:{$values['padding_boven']}px;";
        if ($values['padding_onder']) $style[] = "padding-bottom:{$values['padding_onder']}px;";
        if ($values['margin_boven']) $style[] = "margin-top:{$values['margin_boven']}px;";
        if ($values['margin_onder']) $style[] = "margin-bottom:{$values['margin_onder']}px;";
        if ($values['gat_kolommen']) $style[] = "gap:{$values['gat_kolommen']}px;";
        if ($values['tekst_kleur']) $style[] = "color:{$values['tekst_kleur']};";
        if ($values['randkleur']) $style[] = "border-color:{$values['randkleur']};";
        if ($values['rand_radius']) $style[] = "border-radius:{$values['rand_radius']}px;";
        if ($values['rand_dikte']) $style[] = "border-width:{$values['rand_dikte']}px;";
        if ($values['box_schaduw']) $style[] = "box-shadow:0 4px 10px rgba(0,0,0,0.1);";

        if ($values['rand'] === '1') {
            $border_color = $values['randkleur'] ?: '#ccc';
            $style[] = "border:1px solid {$border_color};";
        }

        if (!empty($values['horizontale_uitlijning'])) {
            $map = [
                'left' => 'flex-start',
                'center' => 'center',
                'right' => 'flex-end',
                'space-between' => 'space-between',
                'space-around' => 'space-around'
            ];
            $style[] = "justify-content:" . ($map[$values['horizontale_uitlijning']] ?? 'center') . ";";
        }

        if (!empty($values['verticale_uitlijning'])) {
            $map = [
                'top' => 'flex-start',
                'center' => 'center',
                'bottom' => 'flex-end',
                'stretch' => 'stretch'
            ];
            $style[] = "align-items:" . ($map[$values['verticale_uitlijning']] ?? 'stretch') . ";";
        }

        if ($values['responsive_gedrag'] === '1') $style[] = "flex-wrap:wrap;";
        if ($values['even_hoogte_kolommen'] === '1') $style[] = "align-items:stretch;";

        if ($values['volgorde_mobiel'] === 'omgedraaid') $style[] = "flex-direction:column-reverse;";
        if ($values['volgorde_mobiel'] === 'stack onder elkaar') $style[] = "flex-direction:column;";

        $animatie = '';
        if (!empty($values['animatie_bij_laden']) && $values['animatie_bij_laden'] !== 'geen') {
            $animatie = 'animate__animated animate__' . str_replace(' ', '', $values['animatie_bij_laden']);
        }

        return [
            'id' => $values['custom_id'] ?: '',
            'class' => trim(($values['custom_css_class'] ?: '') . ' ' . $animatie),
            'style' => implode('', $style)
        ];
    }
}
