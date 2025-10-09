<?php
$slides  = get_sub_field('slides');
$corners = get_sub_field('corners');

if (!is_array($slides)) {
    $slides = [];
}
?>

<?php if ($slides): ?>
    <section class="slider-block">
        <div class="slider-wrapper">
            <div class="slider-track <?php echo esc_attr($corners); ?>">
                <?php foreach ($slides as $slide):
                    $img = $slide['slide_image'] ?? null;
                    if (!$img) continue;
                ?>
                    <div class="slide">
                        <img src="<?php echo esc_url($img['url']); ?>"
                            alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
                            draggable="false">
                    </div>
                <?php endforeach; ?>
            </div>
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
        width: 100%;
        max-width: 1200px;
        overflow: hidden;
        position: relative;
    }

    .slider-track {
        display: flex;
        transition: transform 0.5s ease;
        gap: 20px;
    }

    .slide {
        cursor: grab;
        flex: 0 0 auto;
        height: 500px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        transform: scale(0.8);
        opacity: 0.5;
        filter: blur(2px);
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .slide img {
        height: 100%;
        width: auto;
        border-radius: inherit;
        pointer-events: none;
        display: block;
    }

    .slide.active {
        transform: scale(1);
        opacity: 1;
        z-index: 2;
        filter: blur(0);
    }

    .slider-track.none {
        border-radius: 0;
    }

    .slider-track.small {
        border-radius: 6px;
    }

    .slider-track.medium {
        border-radius: 12px;
    }

    .slider-track.large {
        border-radius: 24px;
    }

    @media (max-width: 768px) {
        .slider-block {
            width: 100%;
            padding: 80px 0;
            display: flex;
            justify-content: center;
            background: #f8f6f2;
        }

        .slider-wrapper {
            width: 90%;
            max-width: 800px;
            overflow: hidden;
            position: relative;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
            gap: 20px;
        }

        .slide {
            cursor: grab;
            flex: 0 0 auto;
            height: 240px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: scale(0.8);
            filter: blur(2px);
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .slide img {
            height: 100%;
            width: auto;
            border-radius: inherit;
            pointer-events: none;
            display: block;
        }

        .slide.active {
            transform: scale(1);
            opacity: 1;
            z-index: 2;
            filter: blur(0);
        }

        .slider-track.none {
            border-radius: 0;
        }

        .slider-track.small {
            border-radius: 6px;
        }

        .slider-track.medium {
            border-radius: 12px;
        }

        .slider-track.large {
            border-radius: 24px;
        }

    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.querySelector('.slider-track');
        if (!track) return;

        const slides = Array.from(track.querySelectorAll('.slide'));
        let currentIndex = 0;

        function updateSlider() {
            const trackWidth = track.parentElement.offsetWidth;
            let offset = trackWidth / 2 - (slides[currentIndex].offsetWidth / 2);
            for (let i = 0; i < currentIndex; i++) {
                offset -= slides[i].offsetWidth + 20;
            }
            track.style.transform = `translateX(${offset}px)`;
            slides.forEach((slide, i) => slide.classList.toggle('active', i === currentIndex));
        }

        updateSlider();

        let isDown = false,
            startX = 0;

        track.addEventListener('mousedown', e => {
            isDown = true;
            startX = e.pageX;
            track.style.transition = 'none';
        });
        track.addEventListener('mouseup', e => {
            if (!isDown) return;
            isDown = false;
            track.style.transition = 'transform 0.5s ease';
            const moved = e.pageX - startX;
            if (moved < -50 && currentIndex < slides.length - 1) currentIndex++;
            if (moved > 50 && currentIndex > 0) currentIndex--;
            updateSlider();
        });
        track.addEventListener('mouseleave', () => {
            isDown = false;
        });
        track.addEventListener('mousemove', e => {
            if (!isDown) return;
            const moved = e.pageX - startX;
            let offset = track.parentElement.offsetWidth / 2 - slides[currentIndex].offsetWidth / 2;
            for (let i = 0; i < currentIndex; i++) offset -= slides[i].offsetWidth + 20;
            track.style.transform = `translateX(${offset + moved}px)`;
        });

        let touchStartX = 0;
        track.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
            track.style.transition = 'none';
        });
        track.addEventListener('touchmove', e => {
            const moved = e.touches[0].clientX - touchStartX;
            let offset = track.parentElement.offsetWidth / 2 - slides[currentIndex].offsetWidth / 2;
            for (let i = 0; i < currentIndex; i++) offset -= slides[i].offsetWidth + 20;
            track.style.transform = `translateX(${offset + moved}px)`;
        });
        track.addEventListener('touchend', e => {
            const moved = e.changedTouches[0].clientX - touchStartX;
            track.style.transition = 'transform 0.5s ease';
            if (moved < -50 && currentIndex < slides.length - 1) currentIndex++;
            if (moved > 50 && currentIndex > 0) currentIndex--;
            updateSlider();
        });

        window.addEventListener('resize', updateSlider);
    });
</script>