<?php
$bg_color = $cta['background_color'] ?? '#f5f5f5';
$columns = $cta['columns'] ?? [];
$width = $cta['width'] ?? '1200';

if (is_numeric($width))  $width  .= 'px';

echo '<div class="cta-preview-wrapper" style="background:' . esc_attr($bg_color) . ';
                                              max-width:' . esc_attr($width) . ';">';

if ($columns) {
    foreach ($columns as $col) {
        $options = $col['cta_options'] ?? [];
        echo '<div class="cta-preview-column">';
        if ($options) {
            foreach ($options as $block) {
                $layout = $block['acf_fc_layout'];
                $partial = __DIR__ . '/' . $layout . '.php';
                if (file_exists($partial)) {
                    include $partial;
                }
            }
        }
        echo '</div>';
    }
} else {
    echo '<p>Geen kolommen gevonden.</p>';
}

echo '</div>';
?>

<style>
    .cta-preview-column:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .cta-preview-column:last-child {
        border-right: none;
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .cta-preview-column a.button:hover {
        background: #247e3b;
        color: white;
    }

    .cta-preview-column img {
        border-radius: 12px;
        margin-bottom: 10px;
        max-width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0px;
    }

    .cta-preview-column a.button {
        background: #1a5428;
        color: #fff;
        border: none;
        font-size: 1rem;
        border-radius: 50px;
        padding: 7px 20px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        display: inline-block;
        margin-top: 10px;
        transition: background 0.2s ease-in-out;
    }

    .cta-preview-column p {
        color: #444;
        font-size: 16px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .title-cta {
        font-family: 'Times New Roman', Times, serif;
        font-weight: 700;
        font-size: 30px;
        margin-top: 0px;
        line-height: 1.2;
        color: #1a5428;
    }

    .cta-preview-wrapper {
        display: flex;
        gap: 0;
        overflow: hidden;
        border-radius: 12px;
        margin: 1rem;
        background: #ebebea;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
    }

    .cta-preview-column {
        flex: 1 1 0;
        padding: 20px 20px;
        text-align: center;
        background: #fff;
    }

    .cta-preview-column {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    @media screen and (max-width: 780px) {
        .cta-preview-wrapper {
            flex-direction: column;
            max-width: 780px;
            box-sizing: border-box;
        }

        .cta-preview-column img {
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
        }


        .cta-preview-column {
            width: 100%;
            flex: none;
            box-sizing: border-box;
        }

        .cta-preview-column:last-child {
            margin-bottom: 0;
        }

        .cta-preview-column:last-child {
            margin-bottom: 0;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
            border-top-right-radius: 0px;
        }

        .cta-preview-column:first-child {
            border-bottom-left-radius: 0px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
    }
</style>