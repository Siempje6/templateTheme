<?php
$text = $block['text'] ?? '';
if ($text):
?>
    <div class="textcolumn">
        <p><?php echo esc_html($text); ?></p>
    </div>

<?php endif; ?>

<style>
    .textcolumn {
        display: flex;

        justify-content: center;
        align-items: center;
    }

    .textcolumn p {
        font-weight: 900;
        font-size: 20px;
    }
</style>