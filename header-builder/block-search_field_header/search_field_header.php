<?php
$settings = $block['instellingen'] ?? [];

$placeholder = $settings['placeholder'] ?? 'Zoek hier…';
$button_text = $settings['button_text'] ?? 'Zoeken';
$show_button = $settings['show_button'] ?? true;
$method = $settings['method'] ?? 'get';
$action_url = $settings['action_url'] ?? '';
?>

<form class="search-header-form" action="<?php echo esc_url($action_url ?: home_url('/')); ?>" method="<?php echo esc_attr($method); ?>" style="position:relative; max-width:400px; display:flex; gap:0;">
    <input 
        type="text" 
        id="header-search-input" 
        name="s" 
        placeholder="<?php echo esc_attr($placeholder); ?>" 
        autocomplete="off"
        style="
            padding:10px 12px; 
            flex:1; 
            border:1px solid #94928dff; 
            border-radius:4px 0 0 4px;
            font-size:16px;
            outline:none;
            background-color:#f8f6f2;
        "
    >
    <?php if ($show_button): ?>
        <button type="submit" style="
            padding:10px 16px; 
            border:none; 
            background:#1a5427; 
            color:#fff; 
            font-weight:bold; 
            border-radius:0 4px 4px 0; 
            cursor:pointer;
            transition: background 0.3s;
        " onmouseover="this.style.background='#1a5427d2';" onmouseout="this.style.background='#1a5427';">
            <?php echo esc_html($button_text); ?>
        </button>
    <?php endif; ?>
    <ul id="search-suggestions" style="
        position:absolute; 
        top:100%; 
        left:0; 
        right:0; 
        background:#f8f6f2; 
        border:1px solid #ccc; 
        border-top:none; 
        z-index:9999; 
        list-style:none; 
        margin:0; 
        padding:0; 
        display:none; 
        max-height:250px; 
        overflow-y:auto;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius:0 0 4px 4px;
    "></ul>
</form>

<style>
#search-suggestions li {
    padding: 10px 12px;
    cursor: pointer;
    transition: background 0.2s;
}
#search-suggestions li:hover {
    background-color: #f8f6f2;
}
#search-suggestions li.active {
    background-color: #f8f6f2;
}
.search-header-form input:focus {
    border-color: #1a5427;
    box-shadow: 0 0 4px rgba(0, 115, 230, 0.4);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('header-search-input');
    const suggestions = document.getElementById('search-suggestions');
    let activeIndex = -1;

    input.addEventListener('keyup', function(e) {
        const query = this.value;

        // Pijltjestoetsen navigatie
        const items = suggestions.querySelectorAll('li');
        if (items.length) {
            if (e.key === 'ArrowDown') {
                activeIndex = (activeIndex + 1) % items.length;
                setActive(items);
                return;
            } else if (e.key === 'ArrowUp') {
                activeIndex = (activeIndex - 1 + items.length) % items.length;
                setActive(items);
                return;
            } else if (e.key === 'Enter') {
                if (activeIndex > -1 && items[activeIndex]) {
                    window.location.href = items[activeIndex].dataset.url;
                    return;
                }
            }
        }

        if (query.length < 2) {
            suggestions.style.display = 'none';
            suggestions.innerHTML = '';
            return;
        }

        fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=search_pages&term=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                suggestions.innerHTML = '';
                activeIndex = -1;
                if (data.length) {
                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item.title;
                        li.dataset.url = item.url;
                        li.addEventListener('click', () => window.location.href = item.url);
                        suggestions.appendChild(li);
                    });
                    suggestions.style.display = 'block';
                } else {
                    suggestions.style.display = 'none';
                }
            });
    });

    function setActive(items) {
        items.forEach((el, i) => {
            if (i === activeIndex) {
                el.classList.add('active');
                el.scrollIntoView({ block: 'nearest' });
            } else {
                el.classList.remove('active');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (!input.contains(e.target)) {
            suggestions.style.display = 'none';
        }
    });
});
</script>
