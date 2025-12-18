<?php
$settings = $block['instellingen'] ?? [];
$placeholder = $settings['placeholder'] ?? 'Zoek hier…';
$button_text = $settings['button_text'] ?? 'Zoeken';
$show_button = $settings['show_button'] ?? true;
?>

<div style="display:flex; justify-content:center; align-items:center; display: none;">
    <form class="search-header-form" action="<?php echo esc_url(home_url('/zoeken/')); ?>" method="get" style="position:relative; max-width:400px; display:flex; gap:0;">
        <input
            type="text"
            id="header-search-input"
            name="s"
            placeholder="<?php echo esc_attr($placeholder); ?>"
            autocomplete="off"
            style="padding:10px 12px; flex:1; border:1px solid #94928dff; border-radius:4px 0 0 4px; font-size:16px; outline:none; background-color:#f8f6f2;">
        <?php if ($show_button): ?>
            <button type="submit" style="padding:10px 16px; border:none; background:#1a5427; color:#fff; font-weight:bold; border-radius:0 4px 4px 0; cursor:pointer; transition:background 0.3s;" onmouseover="this.style.background='#1a5427d2';" onmouseout="this.style.background='#1a5427';">
                <?php echo esc_html($button_text); ?>
            </button>
        <?php endif; ?>
        <ul id="search-suggestions" style="position:absolute; top:100%; left:0; right:0; background:#f8f6f2; border:1px solid #ccc; border-top:none; z-index:9999; list-style:none; margin:0; padding:0; display:none; max-height:250px; overflow-y:auto; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-radius:0 0 4px 4px;"></ul>
    </form>
</div>

<style>
    #search-suggestions li {
        padding: 10px 12px;
        cursor: pointer;
        transition: background 0.2s;
    }

    #search-suggestions li:hover,
    #search-suggestions li.active {
        background-color: #eceae4;
    }

    .search-header-form input:focus {
        border-color: #1a5427;
        box-shadow: 0 0 4px rgba(26, 84, 39, 0.4);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('header-search-input');
        const suggestions = document.getElementById('search-suggestions');
        let activeIndex = -1;

        input.closest('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const query = input.value.trim();
            if (!query) return;

            const items = suggestions.querySelectorAll('li');
            if (activeIndex > -1 && items[activeIndex]) {
                window.location.href = '<?php echo esc_url(home_url("/zoeken/?s=")); ?>' + encodeURIComponent(items[activeIndex].textContent);
                return;
            }

            window.location.href = '<?php echo esc_url(home_url("/zoeken/?s=")); ?>' + encodeURIComponent(query);
        });

        input.addEventListener('keyup', function(e) {
            const query = this.value.trim();
            if (query.length < 2) {
                suggestions.style.display = 'none';
                suggestions.innerHTML = '';
                activeIndex = -1;
                return;
            }

            fetch('<?php echo esc_url(admin_url("admin-ajax.php")); ?>?action=search_pages&term=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    activeIndex = -1;
                    if (!data.length) {
                        suggestions.style.display = 'none';
                        return;
                    }

                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item.title;
                        li.dataset.url = '<?php echo esc_url(home_url("/zoeken/?s=")); ?>' + encodeURIComponent(item.title);
                        li.addEventListener('click', () => window.location.href = li.dataset.url);
                        suggestions.appendChild(li);
                    });

                    suggestions.style.display = 'block';
                });
        });

        function setActive(items) {
            items.forEach((el, i) => {
                el.classList.toggle('active', i === activeIndex);
                if (i === activeIndex) el.scrollIntoView({
                    block: 'nearest'
                });
            });
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-header-form')) suggestions.style.display = 'none';
        });
    });
</script>