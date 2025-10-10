<?php
/**
 * Slider block met Blossom Carousel
 */

$slides  = get_sub_field('slides');
$corners = get_sub_field('corners');

// Optionele ACF-velden
$autoplay   = get_sub_field('autoplay');          // true/false
$interval   = get_sub_field('interval') ?: 3000;  // ms
$arrows     = get_sub_field('arrows');            // true/false
$pagination = get_sub_field('pagination');        // true/false
$loop       = get_sub_field('loop');              // true/false

if (!is_array($slides)) {
    $slides = [];
}

// Bouw HTML-attributen
$attrs = [];
if ($autoplay)   $attrs[] = 'autoplay';
if ($arrows)     $attrs[] = 'arrows';
if ($pagination) $attrs[] = 'pagination';
if ($loop)       $attrs[] = 'loop';
$attrs[] = 'interval="' . esc_attr(intval($interval)) . '"';
$attrs_str = implode(' ', $attrs);
?>

<?php if ($slides): ?>
<section class="slider-block">
    <div class="slider-wrapper">
        <blossom-carousel class="carousel <?php echo esc_attr($corners); ?>" <?php echo $attrs_str; ?>>
            <?php foreach ($slides as $slide):
                $img = $slide['slide_image'] ?? null;
                if (!$img) continue;
            ?>
                <div class="slide">
                    <img src="<?php echo esc_url($img['url']); ?>"
                         alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
                         loading="lazy" draggable="false" />
                </div>
            <?php endforeach; ?>
        </blossom-carousel>
    </div>
</section>
<?php endif; ?>

<style>
/* ===============================
   Slider Block Styles
=============================== */
.slider-block {
    width: 100%;
    padding: 80px 0;
    display: flex;
    justify-content: center;
    background: #f8f6f2;
}

.slider-wrapper {
    width: 90%;
    max-width: 1200px;
    overflow: hidden;
    position: relative;
}

/* Carousel flex layout */
.carousel {
    display: flex;
    gap: 1rem;
}

/* Slides individuele breedtes */
.carousel .slide {
    flex: 0 0 auto;
    height: 400px;
}

/* Voorbeeld custom breedtes: even/odd */
.carousel .slide:nth-child(odd) {
    width: 300px;
}
.carousel .slide:nth-child(even) {
    width: 500px;
}

/* Slide afbeeldingen */
.carousel .slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 12px;
}

/* Responsive */
@media (max-width: 768px) {
    .carousel .slide {
        width: 80%;
        height: 250px;
    }
}
</style>
