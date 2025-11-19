<div class="nav-wrapper">
    <div id="menuDebug" style="background:#f0f0f0;color:#000;padding:10px;font-size:12px;border:1px solid #ccc;margin-bottom:10px;">
        <strong>DEBUG MENU FRONTEND:</strong>
        <div id="menuDebugContent">Laden...</div>
    </div>

    <button class="hamburger" id="hamburgerBtn">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="main-menu" id="mainMenu">
        <?php
        $menu = $block['menu'] ?? null;

        if (!empty($menu)) {
            if (strpos($menu, '<ul') === false) {
                echo '<ul class="menu">' . $menu . '</ul>';
            } else {
                $menu = preg_replace('/<ul(.*?)>/', '<ul$1 class="menu">', $menu, 1);
                echo $menu;
            }
        } else {
            echo '<!-- Geen menu gevonden -->';
        }
        ?>
    </nav>
</div>

<style>
    
</style>

<script>
    const hamburger = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mainMenu');
    const debugContent = document.getElementById('menuDebugContent');

    hamburger.addEventListener('click', function() {
        menu.classList.toggle('open');
        hamburger.classList.toggle('active');
        updateDebug();
    });

    document.querySelectorAll('#mainMenu > ul > li').forEach(function(li) {
        const submenu = li.querySelector('ul');
        if (submenu) {
            submenu.classList.add('sub-menu');
            submenu.style.display = 'none';

            const btn = document.createElement('span');
            btn.classList.add('dropdown-btn');
            btn.textContent = '+';
            li.appendChild(btn);

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
                btn.textContent = (submenu.style.display === 'block') ? '−' : '+';
                updateDebug();
            });
        }
    });

    function updateDebug() {
        if (!menu) return;
        let debugHtml = '<ul>';
        menu.querySelectorAll('ul.menu > li').forEach(function(li, idx) {
            const text = li.querySelector('a') ? li.querySelector('a').textContent : '(geen tekst)';
            const submenu = li.querySelector('ul');
            const hasSub = submenu ? 'Ja' : 'Nee';
            const subState = submenu ? (submenu.style.display === 'block' ? 'Open' : 'Gesloten') : '-';
            debugHtml += `<li>Item ${idx+1}: ${text} | Submenu: ${hasSub} | Status: ${subState}</li>`;
        });
        debugHtml += '</ul>';
        debugContent.innerHTML = debugHtml;
    }

    updateDebug();
</script>