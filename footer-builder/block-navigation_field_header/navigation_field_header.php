<?php
// Vervang get_sub_field door $block array
$menu_items = $block['menu_items'] ?? [];

// Zorg dat $menu_items een array is
if (!is_array($menu_items)) {
    $menu_items = [];
}

echo '<!-- DEBUG BLOCK: navigation_field_header -->';
echo '<!-- Aantal menu items: ' . count($menu_items) . ' -->';

if ($menu_items):
?>
    <div class="navbar">
        <ul>
            <?php foreach ($menu_items as $item):
                $link = $item['link'] ?? null;
                if ($link):
                    $url = $link['url'] ?? '#';
                    $title = $link['title'] ?? '';
                    $target = $link['target'] ?? '_self';

                    echo '<!-- DEBUG MENU ITEM: ' . esc_html($title) . ' -->';
            ?>
                <li>
                    <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                </li>
            <?php
                endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<style>
.navbar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.navbar ul {
    list-style: none;
    display: flex;
    gap: 15px;
    margin: 0;
    padding: 0;
}

.navbar li {
    display: inline-block;
}

.navbar a {
    text-decoration: none;
    color: #000;
    font-weight: 500;
}

.navbar a:hover {
    color: #0073e6;
}
</style>
