<?php
$text = get_sub_field('text');
?>

<?php if ($text): ?>
    <div class="text-cta">
        <?php echo $text; ?>
    </div>

    <style>
        .text-cta p {
            font-size: 1rem !important;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
            margin-left: 1rem;
        }

        .text-cta * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
        }
    </style>
<?php endif; ?>
