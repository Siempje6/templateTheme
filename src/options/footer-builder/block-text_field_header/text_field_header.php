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

        font-weight: 800;
        font-size: 27px;
    }
</style>