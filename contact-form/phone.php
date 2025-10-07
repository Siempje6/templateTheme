<?php
$label = get_sub_field('input_label');
$name = get_sub_field('input_name');
$placeholder = get_sub_field('placeholder');

$country_codes = [
    ['code' => '+61', 'label' => 'Australië (+61)'],
    ['code' => '+32', 'label' => 'België (+32)'],
    ['code' => '+55', 'label' => 'Brazilië (+55)'],
    ['code' => '+359', 'label' => 'Bulgarije (+359)'],
    ['code' => '+1', 'label' => 'Verenigde Staten / Canada (+1)'],
    ['code' => '+86', 'label' => 'China (+86)'],
    ['code' => '+45', 'label' => 'Denemarken (+45)'],
    ['code' => '+49', 'label' => 'Duitsland (+49)'],
    ['code' => '+20', 'label' => 'Egypte (+20)'],
    ['code' => '+34', 'label' => 'Spanje (+34)'],
    ['code' => '+358', 'label' => 'Finland (+358)'],
    ['code' => '+33', 'label' => 'Frankrijk (+33)'],
    ['code' => '+44', 'label' => 'Verenigd Koninkrijk (+44)'],
    ['code' => '+30', 'label' => 'Griekenland (+30)'],
    ['code' => '+299', 'label' => 'Groenland (+299)'],
    ['code' => '+852', 'label' => 'Hong Kong (+852)'],
    ['code' => '+36', 'label' => 'Hongarije (+36)'],
    ['code' => '+91', 'label' => 'India (+91)'],
    ['code' => '+62', 'label' => 'Indonesië (+62)'],
    ['code' => '+353', 'label' => 'Ierland (+353)'],
    ['code' => '+972', 'label' => 'Israël (+972)'],
    ['code' => '+39', 'label' => 'Italië (+39)'],
    ['code' => '+81', 'label' => 'Japan (+81)'],
    ['code' => '+254', 'label' => 'Kenia (+254)'],
    ['code' => '+965', 'label' => 'Koeweit (+965)'],
    ['code' => '+370', 'label' => 'Litouwen (+370)'],
    ['code' => '+352', 'label' => 'Luxemburg (+352)'],
    ['code' => '+60', 'label' => 'Maleisië (+60)'],
    ['code' => '+356', 'label' => 'Malta (+356)'],
    ['code' => '+52', 'label' => 'Mexico (+52)'],
    ['code' => '+31', 'label' => 'Nederland (+31)'],
    ['code' => '+47', 'label' => 'Noorwegen (+47)'],
    ['code' => '+64', 'label' => 'Nieuw-Zeeland (+64)'],
    ['code' => '+43', 'label' => 'Oostenrijk (+43)'],
    ['code' => '+48', 'label' => 'Polen (+48)'],
    ['code' => '+351', 'label' => 'Portugal (+351)'],
    ['code' => '+40', 'label' => 'Roemenië (+40)'],
    ['code' => '+7', 'label' => 'Rusland (+7)'],
    ['code' => '+966', 'label' => 'Saoedi-Arabië (+966)'],
    ['code' => '+46', 'label' => 'Zweden (+46)'],
    ['code' => '+41', 'label' => 'Zwitserland (+41)'],
    ['code' => '+421', 'label' => 'Slowakije (+421)'],
    ['code' => '+386', 'label' => 'Slovenië (+386)'],
    ['code' => '+27', 'label' => 'Zuid-Afrika (+27)'],
    ['code' => '+82', 'label' => 'Zuid-Korea (+82)'],
    ['code' => '+90', 'label' => 'Turkije (+90)'],
    ['code' => '+380', 'label' => 'Oekraïne (+380)'],
    ['code' => '+420', 'label' => 'Tsjechië (+420)'],
    ['code' => '+971', 'label' => 'Verenigde Arabische Emiraten (+971)'],
    ['code' => '+84', 'label' => 'Vietnam (+84)'],
];

$patterns = [
    '+61'  => '^4\s?\d{8}$',
    '+32'  => '^4\s?\d{8}$',
    '+55'  => '^[1-9]{2}9\s?\d{8}$',
    '+359' => '^8[7-9]\s?\d{7}$',
    '+1'   => '^\d{10}$',
    '+86'  => '^1[3-9]\d{9}$',
    '+45'  => '^[2-9]\d{7}$',
    '+49'  => '^1\d{1,2}\s?\d{8,9}$',
    '+20'  => '^1[0125]\d{8}$',
    '+34'  => '^[6-7]\s?\d{8}$',
    '+358' => '^4[0-9]\s?\d{7}$',
    '+33'  => '^(6|7)\s?\d{8}$',
    '+44'  => '^7\d{9}$',
    '+30'  => '^69\d{8}$',
    '+299' => '^[2-9]\d{5}$',
    '+852' => '^[569]\d{7}$',
    '+36'  => '^([237]0|5[0-9])\s?\d{7}$',
    '+91'  => '^[6-9]\d{9}$',
    '+62'  => '^8[1-9]\s?\d{7,10}$',
    '+353' => '^(8[3-9]|7[5-9])\s?\d{7}$',
    '+972' => '^5[0-9]\s?\d{7}$',
    '+39'  => '^3\d{2}\s?\d{6,7}$',
    '+81'  => '^([789]0)\d{8}$',
    '+254' => '^7\d{8}$',
    '+965' => '^5[05]\d{6}$',
    '+370' => '^6\s?\d{7}$',
    '+352' => '^6[269]\s?\d{6}$',
    '+60'  => '^1[02-9]\s?\d{7,8}$',
    '+356' => '^99\d{6}$',
    '+52'  => '^1\d{10}$',
    '+31'  => '^06\s?\d{8}$',
    '+47'  => '^(4|9)\d{7}$',
    '+64'  => '^2\d{7,9}$',
    '+43'  => '^6[56789]\s?\d{7,8}$',
    '+48'  => '^5\d{8}$',
    '+351' => '^9[1236]\d{7}$',
    '+40'  => '^7[2-8]\s?\d{7}$',
    '+7'   => '^9\d{9}$',
    '+966' => '^5\d{8}$',
    '+46'  => '^7[0236]\d{7}$',
    '+41'  => '^7[5-9]\d{7}$',
    '+421' => '^9[0-5]\d{7}$',
    '+386' => '^([347]\d{7})$',
    '+27'  => '^([678])\d{8}$',
    '+82'  => '^1[016789]\d{7,8}$',
    '+90'  => '^5\d{9}$',
    '+380' => '^([39]\d{8})$',
    '+420' => '^6\d{8}$',
    '+971' => '^5[024568]\d{7}$',
    '+84'  => '^((3[2-9]|5[689]|7[06789]|8[1-5]|9[0-9]))\s?\d{7}$',
];

$default_starts = [
    '+61'  => '4',
    '+32'  => '4',
    '+55'  => '99',
    '+359' => '87',
    '+1'   => '',
    '+86'  => '13',
    '+45'  => '2',
    '+49'  => '15',
    '+20'  => '10',
    '+34'  => '6',
    '+358' => '40',
    '+33'  => '6',
    '+44'  => '7',
    '+30'  => '69',
    '+299' => '2',
    '+852' => '5',
    '+36'  => '30',
    '+91'  => '9',
    '+62'  => '81',
    '+353' => '83',
    '+972' => '50',
    '+39'  => '3',
    '+81'  => '90',
    '+254' => '7',
    '+965' => '50',
    '+370' => '6',
    '+352' => '621',
    '+60'  => '12',
    '+356' => '99',
    '+52'  => '1',
    '+31'  => '06',
    '+47'  => '4',
    '+64'  => '21',
    '+43'  => '66',
    '+48'  => '5',
    '+351' => '91',
    '+40'  => '72',
    '+7'   => '9',
    '+966' => '5',
    '+46'  => '70',
    '+41'  => '76',
    '+421' => '90',
    '+386' => '31',
    '+27'  => '6',
    '+82'  => '10',
    '+90'  => '5',
    '+380' => '39',
    '+420' => '6',
    '+971' => '50',
    '+84'  => '32',
];

$default_country_code = '+31';
$default_pattern = isset($patterns[$default_country_code]) ? $patterns[$default_country_code] : '.*';
$default_start = isset($default_starts[$default_country_code]) ? $default_starts[$default_country_code] : '';
?>
<label for="<?php echo esc_attr($name); ?>">
    <?php echo esc_html($label); ?>
</label>
<div style="display: flex; gap: 8px;">
    <select name="<?php echo esc_attr($name); ?>_country_code" id="<?php echo esc_attr($name); ?>_country_code" autocomplete="tel-country-code" onchange="updatePhonePattern_<?php echo esc_attr($name); ?>(this)">
        <?php foreach ($country_codes as $country): ?>
            <option value="<?php echo esc_attr($country['code']); ?>" <?php echo $country['code'] === $default_country_code ? 'selected' : ''; ?>>
                <?php echo esc_html($country['label']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input
        type="tel"
        id="<?php echo esc_attr($name); ?>"
        name="<?php echo esc_attr($name); ?>"
        placeholder="<?php echo esc_attr($placeholder ?: 'Telefoonnummer'); ?>"
        autocomplete="tel"
        pattern="<?php echo esc_attr($default_pattern); ?>"
        value="<?php echo esc_attr($default_start); ?>"
        required>
</div>
<script>
    function updatePhonePattern_<?php echo esc_attr($name); ?>(select) {
        var patterns = <?php echo json_encode($patterns); ?>;
        var starts = <?php echo json_encode($default_starts); ?>;
        var input = document.getElementById('<?php echo esc_attr($name); ?>');
        var code = select.value;
        input.pattern = patterns[code] || '.*';
        input.value = starts[code] !== undefined ? starts[code] : '';
    }
</script>
<style>
    .contact-form select {
    font-family: Arial, sans-serif;
    width: 100%;
    padding: 14px 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 0.9rem;
    outline: none;
    background-color: #f9f9f9;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
    cursor: pointer;
}

.contact-form select:focus {
    border-color: #007bff;
}

.contact-form .select-wrapper {
    position: relative;
}


</style>