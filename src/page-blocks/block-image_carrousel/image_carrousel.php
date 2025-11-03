<?php
if (!defined('ABSPATH')) exit;

$carrousel_images = get_sub_field('carrousel_images');
if (!$carrousel_images) return;

$carousel_id = 'carousel-' . uniqid();
?>

<div class="acf-image-carousel-wrapper">
    <div id="<?php echo esc_attr($carousel_id); ?>" class="swiper acf-image-carousel">
        <div class="swiper-wrapper">
            <?php foreach ($carrousel_images as $item): 
                $image = $item['image'] ?? null;
                $title = $item['image_title'] ?? '';
                $date  = $item['image_date'] ?? '';
                if (!$image) continue;
            ?>
                <div class="swiper-slide">
                    <div class="acf-carousel-slide">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        <?php if ($title || $date): ?>
                            <div class="acf-carousel-overlay">
                                <?php if ($title): ?>
                                    <h3 class="acf-carousel-title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if ($date): ?>
                                    <p class="acf-carousel-date"><?php echo esc_html($date); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
.acf-image-carousel-wrapper {
    max-width: 900px;
    margin: 3rem auto;
    position: relative;
}

.acf-image-carousel {
    width: 100%;
}

.acf-carousel-slide {
    position: relative;
}

.acf-carousel-slide img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 12px;
    display: block;
}

.acf-carousel-overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: rgba(0,0,0,0.4);
    color: #fff;
    padding: 0.5rem 1rem;
    box-sizing: border-box;
    text-align: left;
    border-radius: 0 0 12px 12px;
}

.acf-carousel-title {
    font-size: 1.2rem;
    margin: 0;
    font-weight: 600;
}

.acf-carousel-date {
    font-size: 0.9rem;
    margin-top: 0.2rem;
    color: #ddd;
}

.swiper-pagination {
    position: absolute;
    bottom: -0.6rem;
    width: 100%;
    text-align: center;
}

.swiper-pagination-bullet {
    background: #ccc;
    opacity: 1;
    margin: 0 3px;
}

.swiper-pagination-bullet-active {
    background: #1a5428;
    opacity: 1;
}

.swiper-button-prev,
.swiper-button-next {
    color: #fff;
    top: 50%;
    transform: translateY(-50%);
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    background: transparent;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    font-size: 1.5rem;
    color: #fff;
}

.swiper-button-prev:hover::after,
.swiper-button-next:hover::after {
    color: #1a5428;
}

.swiper-button-prev { left: 0.5rem; }
.swiper-button-next { right: 0.5rem; }

@media screen and (max-width: 980px) {
    .acf-image-carousel-wrapper { max-width: 90%; }
    .acf-carousel-title { font-size: 1rem; }
    .acf-carousel-date { font-size: 0.8rem; }
    .swiper-button-prev,
    .swiper-button-next {
        width: 2rem;
        height: 2rem;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new Swiper("#<?php echo esc_js($carousel_id); ?>", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: "#<?php echo esc_js($carousel_id); ?> .swiper-button-next",
            prevEl: "#<?php echo esc_js($carousel_id); ?> .swiper-button-prev",
        },
        pagination: {
            el: "#<?php echo esc_js($carousel_id); ?> .swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
        },
        effect: "slide",
        speed: 700,
    });
});
</script>
