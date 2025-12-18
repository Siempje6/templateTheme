<?php if (!defined('ABSPATH')) exit; ?>

<div class="rs-mega-nav">

    <div class="rs-mega-inner">

        <button class="rs-mega-toggle" aria-label="Menu openen">
            <span></span><span></span><span></span>
        </button>

        <nav class="rs-mega-menu">
            <?php
            if (!empty($block['menu'])) {
                echo $block['menu'];
            }
            ?>
        </nav>
    </div>

</div>

<style>
.rs-mega-nav * { 
    box-sizing: border-box;
    display: flex;
    gap: 30px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.rs-mega-nav {
    position: relative;
    width: 100%;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    z-index: 999;
}
.rs-mega-inner {
    display: flex;
    align-items: center;
    justify-content: center;
}
.rs-mega-brand a {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
}

.rs-mega-toggle {
    display: none;
    background: none;
    border: 0;
    cursor: pointer;
    flex-direction: column;
    gap: 5px;
}
.rs-mega-toggle span {
    width: 24px;
    height: 2px;
    background: #111;
}

.rs-mega-menu > ul {
    gap: 32px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.rs-mega-menu a {
    text-decoration: none;
    color: #fff;
    font-weight: 500;
    padding: 8px 0;
    display: inline-block;
}

.rs-mega-menu li {
    position: relative;
}

.rs-mega-menu li ul.sub-menu {
    position: absolute;
    top: 100%;
    left: -20px;
    width: auto;
    background: #fff;
    padding: 32px;
    border-radius: 14px;
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 24px;
    box-shadow: 0 30px 70px rgba(0,0,0,.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(12px);
    transition: all .25s ease;
}
.rs-mega-menu li:hover > ul.sub-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.rs-mega-menu ul.sub-menu li {
    list-style: none;
}
.rs-mega-menu ul.sub-menu a {
    font-size: 14px;
    color: #374151;
}
.rs-mega-menu ul.sub-menu a:hover {
    color: #6366f1;
}

@media (max-width: 900) {

    .rs-mega-toggle {
        display: flex;
    }

    .rs-mega-menu {
        position: absolute;
        top: 72px;
        left: 0;
        width: 100%;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        display: none;
    }
    .rs-mega-menu.is-open {
        display: block;
    }
    .rs-mega-menu > ul {
        display: flex;
        flex-direction: column;
        padding: 16px;
        list-style: none;
        gap: 0;
    }
    .rs-mega-menu li {
        border-bottom: 1px solid #f1f1f1;
    }
    .rs-mega-menu li ul.sub-menu {
        position: static;
        width: 100%;
        grid-template-columns: 1fr;
        box-shadow: none;
        padding: 16px 0;
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
    }
    .rs-mega-menu li.is-open > ul.sub-menu {
        display: grid;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const toggle = document.querySelector('.rs-mega-toggle');
    const menu   = document.querySelector('.rs-mega-menu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('is-open');
    });

    document.querySelectorAll('.rs-mega-menu li.menu-item-has-children > a')
        .forEach(link => {
            link.addEventListener('click', e => {
                if (window.innerWidth <= 1024) {
                    e.preventDefault();
                    link.parentElement.classList.toggle('is-open');
                }
            });
        });
});
</script>
