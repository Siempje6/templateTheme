<div class="nav-wrapper">

    <button class="menu-toggle" aria-expanded="false" aria-controls="mainMenu">
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
.menu-toggle {
    display: flex;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
}

.menu-toggle span {
    width: 28px;
    height: 3px;
    background: #000;
    border-radius: 2px;
    transition: all 0.3s ease;
}

.menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px,6px);
}
.menu-toggle.active span:nth-child(2) { opacity: 0; }
.menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(6px,-6px);
}

.main-menu {
    display: none;
    background: #fff;
    border-bottom: 1px solid #ddd;
    flex-direction: column;
    padding: 20px;
    z-index: 999;
}

.main-menu.open {
    display: flex;
}

.main-menu ul.menu {
    display: flex;
    flex-direction: column;
    gap: 0;
    list-style: none;
    margin: 0;
    padding: 0;
}

.main-menu li {
    position: relative;
}

.main-menu a {
    display: block;
    padding: 12px 16px;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #eee;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.main-menu a:hover { background: #f0f0f0; }

.main-menu li ul.sub-menu {
    display: none;
    flex-direction: column;
    padding-left: 15px;
    background: #f8f8f8;
}

.main-menu li ul.sub-menu li a {
    padding: 10px 16px;
    border-bottom: 1px solid #ddd;
}
 
.dropdown-btn {
    display: inline-block;
    margin-left: 8px;
    cursor: pointer;
    font-weight: bold;
    background: none;
    border: none;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const hamburger = document.querySelector(".menu-toggle");
    const menu = document.getElementById("mainMenu");

    hamburger.addEventListener("click", () => {
        menu.classList.toggle("open");
        hamburger.classList.toggle("active");
    });

    document.querySelectorAll("#mainMenu li").forEach(li => {
        const submenu = li.querySelector("ul");
        if(submenu){
            submenu.classList.add("sub-menu");

            const btn = document.createElement("button");
            btn.classList.add("dropdown-btn");
            btn.innerHTML = "&#9660;"; 
            li.insertBefore(btn, li.querySelector("a").nextSibling);

            btn.addEventListener("click", e => {
                e.preventDefault();
                submenu.classList.toggle("open");
                btn.innerHTML = submenu.classList.contains("open") ? "&#9650;" : "&#9660;"; 
            });

            li.querySelector("a").addEventListener("click", e => {
                if(window.innerWidth <= 768){
                }
            });
        }
    });

});
</script>