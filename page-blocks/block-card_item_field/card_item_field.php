<?php
$cards = get_sub_field('card_item_field') ?: []; // haal de flexibele items op

if ($cards): ?>
    <div class="card-field">
        <div class="cards-grid">
            <?php foreach ($cards as $card): ?>
                <div class="card-item">
                    <?php if (!empty($card['card_icon'])): ?>
                        <div class="card-icon">
                            <img src="<?php echo esc_url($card['card_icon']['url']); ?>" alt="<?php echo esc_attr($card['card_icon']['alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($card['card_title'])): ?>
                        <h3 class="card-title"><?php echo esc_html($card['card_title']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($card['card_paragraph'])): ?>
                        <div class="card-paragraph"><?php echo wp_kses_post($card['card_paragraph']); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($card['card_link'])): 
                        $link_url = $card['card_link']['url'] ?? '';
                        $link_title = $card['card_link']['title'] ?? '';
                        $link_target = $card['card_link']['target'] ?? '_self';
                        if ($link_url && $link_title): ?>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="card-link">
                                <?php echo esc_html($link_title); ?>
                            </a>
                    <?php endif; endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
