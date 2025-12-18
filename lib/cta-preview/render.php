<?php

echo '<div class="wrap cta-preview-admin">';
echo '<h1 style="margin-bottom: 1.5rem;">Herbruikbaar blok</h1>';

$ctas = get_field('call_to_action', 'option');

if (!$ctas) {
    echo '<div class="notice notice-warning"><p>Geen blokken gevonden in de instellingen.</p></div>';
    echo '</div>';
    return;
}

echo '<label for="cta_class">Selecteer een Herbruikbaar blok:</label> ';
echo '<select name="cta_class" id="cta_class" class="regular-text">';
foreach ($ctas as $cta) {
    $class = $cta['class'] ?? '';
    if (!$class)  {
        continue;
    }
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
                container.innerHTML = '<p style="color:#a00;">Geen Herbruikaar blok gevonden voor deze selectie.</p>';
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

                    const titleColor = cta.title_color || '#1a5428';
                    const textColor = cta.text_color || '#444';
                    const buttonColor = cta.button_color || '#1a5428';
                    const titleWeight = cta.font_weight_title || '400';

                    const borderRadius = cta.border_radius || '12px';

                    if (col.cta_options && col.cta_options.length) {
                        col.cta_options.forEach(block => {
                            const layout = block.acf_fc_layout;
                            const contentDiv = document.createElement('div');

                            switch (layout) {
                                case 'title':
                                    contentDiv.innerHTML = `<h2 class="title-cta" style="font-size:25px; font-weight: ${titleWeight}; margin-bottom:10px; color:${titleColor}">${block.title || ''}</h2>`;
                                    break;
                                case 'text':
                                    contentDiv.innerHTML = `<div class="cta-text" style="color: ${textColor};">${block.text || ''}</div>`;
                                    break;
                                case 'button':
                                    if (block.button && block.button.url) {
                                        contentDiv.innerHTML = `<a href="${block.button.url}" style=" background-color: ${buttonColor};" class="button" target="${block.button.target || '_self'}">${block.button.title || 'Button'}</a>`;
                                    }
                                    break;
                                case 'image':
                                    if (block.image && block.image.url) {
                                        contentDiv.innerHTML = `<div class="cta-image">
                                                                <img src="${block.image.url}" alt="${block.image.alt || ''}" style="max-width:100%;height:auto; border-radius: ${borderRadius};">
                                                                ${block.text_under_image ? '<div class="cta-image-text">'+block.text_under_image+'</div>' : ''}
                                                            </div>`;
                                    }
                                    break;
                                case 'social_icons':

                                    const rows = block.icons_social || [];

                                    const faIcons = {
                                        Facebook: '<i class="fa fa-facebook"></i>',
                                        Instagram: '<i class="fa fa-instagram"></i>',
                                        LinkedIn: '<i class="fa fa-linkedin"></i>',
                                        YouTube: '<i class="fa fa-youtube-play"></i>',
                                        TikTok: '<i class="fa fa-music"></i>',
                                        X: '<i class="fa fa-twitter"></i>',
                                        Pinterest: '<i class="fa fa-pinterest"></i>',
                                        Snapchat: '<i class="fa fa-snapchat-ghost"></i>',
                                        WhatsApp: '<i class="fa fa-whatsapp"></i>',
                                        Telegram: '<i class="fa fa-send"></i>'
                                    };

                                    const svgIcons = {
                                        Facebook: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597..."/></svg>`,
                                        Instagram: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0..." /></svg>`,
                                        LinkedIn: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h..." /></svg>`,
                                        YouTube: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 6.2s..." /></svg>`,
                                        TikTok: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12.7 0h3.2..." /></svg>`,
                                        X: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M18.9 0h3.1..." /></svg>`,
                                        Pinterest: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 0C5.39..." /></svg>`,
                                        Snapchat: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c3 0..." /></svg>`,
                                        WhatsApp: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .5A11.5..." /></svg>`,
                                        Telegram: `<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M23.9 2.6a1.5..." /></svg>`
                                    };

                                    let html = `<div class="social-icons" style="display:flex; gap:12px; align-items:center;">`;

                                    rows.forEach(row => {
                                        const selectedIcons = row.icons || [];
                                        const link = row.icon_link?.url || '#';
                                        const target = row.icon_link?.target || '_self';

                                        selectedIcons.forEach(icon => {

                                            const iconHTML = svgIcons[icon] || faIcons[icon] || '';

                                            html += `
                                                <a href="${link}" target="${target}" class="social-icon" style="font-size:28px; display:flex;">
                                                    ${iconHTML}
                                                </a>
                                            `;
                                        });
                                    });

                                    html += `</div>`;
                                    contentDiv.innerHTML = html;

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

    .cta-preview-column img {
        margin-bottom: 10px;
        max-width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0px;
    }

    .cta-preview-column a.button {
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
        font-size: 16px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .cta-preview-column .title-cta {
        font-family: 'Times New Roman', Times, serif;
        font-weight: 700;
        font-size: 40px;
        margin-top: 0px;
        line-height: 1.2;
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

    @media (max-width: 1500px) {
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
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            margin-bottom: 0;
        }
    }
</style>