<?php

echo '<div class="wrap cta-preview-admin">';
echo '<h1 style="margin-bottom: 1.5rem;">CTA Preview</h1>';

$ctas = get_field('call_to_action', 'option');

if (!$ctas) {
    echo '<div class="notice notice-warning"><p>Geen CTA\'s gevonden in de instellingen.</p></div>';
    echo '</div>';
    return;
}

echo '<label for="cta_class">Selecteer een CTA:</label> ';
echo '<select name="cta_class" id="cta_class" class="regular-text">';
foreach ($ctas as $cta) {
    $class = $cta['class'] ?? '';
    if (!$class) continue;
    echo '<option value="' . esc_attr($class) . '">' . esc_html($class) . '</option>';
}
echo '</select> ';

echo '<div id="cta-preview-container" class="cta-preview-area" style="margin-top:15px;">';
echo '</div>';

echo '</div>';
?>

<style>
    .cta-preview-admin {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .cta-preview-area {
        pointer-events: none;
        background: #f6f7f7;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #dcdcde;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
    }

    .cta-preview-wrapper {
        margin-bottom: 20px;
        padding: 15px;
        background: #fff;
        border-radius: 6px;
        border: 1px solid #ddd;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('cta_class');
        const container = document.getElementById('cta-preview-container');

        const ctas = <?php echo json_encode($ctas); ?>;

        function renderCTA(selectedClass) {
            container.innerHTML = '';

            const cta = ctas.find(c => c.class === selectedClass);
            if (!cta) {
                container.innerHTML = '<p style="color:#a00;">Geen CTA gevonden voor deze selectie.</p>';
                return;
            }

            const wrapper = document.createElement('div');
            wrapper.className = 'cta-preview-wrapper';
            wrapper.style.maxWidth = (cta.width || 1200) + 'px';

            if (cta.columns && cta.columns.length) {
                cta.columns.forEach(col => {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'cta-preview-column';
                    colDiv.style.flex = '1 1 0';
                    colDiv.style.padding = '20px';
                    colDiv.style.textAlign = 'center';
                    colDiv.style.background = cta.background_color || '#f5f5f5';
                    colDiv.style.textDecoration = 'none';
                    colDiv.style.display = 'flex';
                    colDiv.style.flexDirection = 'column';
                    colDiv.style.justifyContent = 'center';
                    colDiv.style.alignItems = 'center';

                    if (col.cta_options && col.cta_options.length) {
                        col.cta_options.forEach(block => {
                            const layout = block.acf_fc_layout;
                            const contentDiv = document.createElement('div');

                            switch (layout) {
                                case 'title':
                                    contentDiv.innerHTML = `<h2 class="title-cta" style=" font-size:25px; margin-bottom:10px;">${block.title || ''}</h2>`;
                                    break;
                                case 'text':
                                    contentDiv.innerHTML = `<div class="cta-text">${block.text || ''}</div>`;
                                    break;
                                case 'button':
                                    if (block.button && block.button.url) {
                                        contentDiv.innerHTML = `<a href="${block.button.url}" class="button" target="${block.button.target || '_self'}">${block.button.title || 'Button'}</a>`;
                                    }
                                    break;
                                case 'image':
                                    if (block.image && block.image.url) {
                                        contentDiv.innerHTML = `<div class="cta-image">
                                                                <img src="${block.image.url}" alt="${block.image.alt || ''}" style="max-width:100%;height:auto;">
                                                                ${block.text_under_image ? '<div class="cta-image-text">'+block.text_under_image+'</div>' : ''}
                                                            </div>`;
                                    }
                                    break;
                            }
                            colDiv.appendChild(contentDiv);
                        });
                    }

                    wrapper.appendChild(colDiv);
                });
            } else {
                wrapper.innerHTML = '<p>Geen kolommen gevonden.</p>';
            }

            container.appendChild(wrapper);
        }

        renderCTA(select.value);

        select.addEventListener('change', function() {
            renderCTA(this.value);
        });
    });
</script>


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
        padding: 1px 20px;
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

    .cta-preview-column .title-cta {
        font-family: 'Times New Roman', Times, serif;
        font-weight: 700;
        font-size: 40px;
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

    @media (max-width: 780px) {
        .cta-preview-wrapper {
            flex-direction: column;
            max-width: 100%;
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

        .cta-preview-column:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 0px;
        }

        .cta-preview-column:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            margin-bottom: 0;
        }
    }
</style>