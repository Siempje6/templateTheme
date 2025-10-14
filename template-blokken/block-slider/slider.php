<?php
$slides  = get_sub_field('slides');
$corners = get_sub_field('corners');

if (!is_array($slides)) $slides = [];
?>

<?php if ($slides): ?>
    <section class="slider-block">
        <div class="slider-wrapper">
            <blossom-carousel class="carousel <?php echo esc_attr($corners); ?>">
                <?php foreach ($slides as $slide):
                    $img = $slide['slide_image'] ?? null;
                    if (!$img) continue;
                ?>
                    <div class="slide">
                        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" draggable="false" />
                    </div>
                <?php endforeach; ?>
            </blossom-carousel>
        </div>
    </section>
<?php endif; ?>

<style>
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
    }

    .carousel {
        display: flex;
        gap: 16px;
        cursor: grab;
        user-select: none;
        transform: translateX(0);
    }

    .carousel.grabbing {
        cursor: grabbing;
    }

    .slide {
        flex-shrink: 0;
        border-radius: 12px;
        overflow: hidden;
        user-select: none;
    }

    .slide img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
        pointer-events: none;
        user-select: none;
        min-width: 300px;
    }

    .slide:nth-child(even) img {
        min-width: 500px;
    }

    @media (max-width:768px) {
        .slide img {
            height: 250px;
            min-width: 80%;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const carousels = document.querySelectorAll('blossom-carousel');
        carousels.forEach(carousel => {
            let isDown = false,
                startX = 0,
                currentTranslate = 0,
                prevTranslate = 0;
            let maxTranslate = 0,
                velocity = 0,
                lastTime = 0,
                rafId;
            const wrapper = carousel.parentElement;
            const MAX_OVERSCROLL = 50;
            const MAX_VELOCITY = 120;

            function updateLimits() {
                maxTranslate = carousel.scrollWidth - wrapper.offsetWidth;
            }

            function clamp(value, min, max) {
                return Math.max(min, Math.min(max, value));
            }
            const getEventX = e => e.touches ? e.touches[0].clientX : e.clientX;

            function startDrag(e) {
                isDown = true;
                startX = getEventX(e);
                carousel.classList.add("grabbing");
                carousel.style.transition = "none";
                velocity = 0;
                lastTime = performance.now();
                updateLimits();
                cancelAnimationFrame(rafId);
            }

            function moveDrag(e) {
                if (!isDown) return;
                const x = getEventX(e);
                const delta = x - startX;
                const now = performance.now();
                let dt = now - lastTime;
                lastTime = now;
                dt = Math.max(dt, 16);

                let newVelocity = delta / dt * 1000;
                velocity = velocity * 0.8 + newVelocity * 0.2;
                velocity = clamp(velocity, -MAX_VELOCITY, MAX_VELOCITY);

                currentTranslate = prevTranslate + delta;

                if (currentTranslate > MAX_OVERSCROLL) currentTranslate = MAX_OVERSCROLL + (currentTranslate - MAX_OVERSCROLL) * 0.3;
                if (currentTranslate < -maxTranslate - MAX_OVERSCROLL) currentTranslate = -maxTranslate - MAX_OVERSCROLL + (currentTranslate + maxTranslate + MAX_OVERSCROLL) * 0.3;

                carousel.style.transform = `translateX(${currentTranslate}px)`;
            }

            function endDrag() {
                if (!isDown) return;
                isDown = false;
                carousel.classList.remove("grabbing");

                function momentum() {
                    currentTranslate += velocity * 0.016;
                    velocity *= 0.85;

                    if (currentTranslate > MAX_OVERSCROLL) velocity *= 0.5;
                    if (currentTranslate < -maxTranslate - MAX_OVERSCROLL) velocity *= 0.5;

                    carousel.style.transform = `translateX(${currentTranslate}px)`;

                    if (Math.abs(velocity) > 0.5) {
                        rafId = requestAnimationFrame(momentum);
                    } else {
                        currentTranslate = clamp(currentTranslate, -maxTranslate, 0);
                        carousel.style.transition = "transform 0.25s ease-out";
                        carousel.style.transform = `translateX(${currentTranslate}px)`;
                        prevTranslate = currentTranslate;
                    }
                }
                rafId = requestAnimationFrame(momentum);
            }

            carousel.addEventListener("mousedown", startDrag);
            window.addEventListener("mousemove", moveDrag);
            window.addEventListener("mouseup", endDrag);
            carousel.addEventListener("touchstart", startDrag);
            window.addEventListener("touchmove", moveDrag);
            window.addEventListener("touchend", endDrag);
            window.addEventListener("resize", updateLimits);
            updateLimits();
        });
    });
</script>