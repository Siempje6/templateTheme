<?php
$image = get_sub_field('image');
$corners = get_sub_field('corners');
$border_class = 'small';
if ($corners && is_array($corners) && isset($corners[0]['imagecorners'])) {
    $border_class = $corners[0]['imagecorners'];
}

$size_repeater = get_sub_field('size');
$size_class = 'normal';
if ($size_repeater && is_array($size_repeater) && isset($size_repeater[0]['imagesize'])) {
    $size_class = $size_repeater[0]['imagesize'];
}

$animation_type = get_sub_field('animatie') ?: 'fade-up';
?>

<section class="image-block">

    <style>
        .image-block {
            width: 100%;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            background-color: #f8f6f2;
        }

        .image-container {
            max-width: 1200px;
            display: flex;
            justify-content: center;
        }

        .image-container.small { width: 50%; }
        .image-container.normal { width: 60%; }
        .image-container.large { width: 70%; }

        .image-content {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            opacity: 0; 
        }

        .image-content.none { border-radius: 0; }
        .image-content.small { border-radius: 6px; }
        .image-content.medium { border-radius: 12px; }
        .image-content.large { border-radius: 24px; }
    </style>

    <div class="container image-container <?php echo esc_attr($size_class); ?>">
        <?php if ($image): ?>
            <img
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt']); ?>"
                class="image-content <?php echo esc_attr($border_class); ?>"
                loading="eager"
                data-animation="<?php echo esc_attr($animation_type); ?>">
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script>
        (function() {
            const images = document.querySelectorAll('.image-content');

            images.forEach(img => {
                if (img.complete) {
                    animateImage(img);
                } else {
                    img.addEventListener('load', () => animateImage(img));
                }
            });

            function animateImage(image) {
                const type = image.dataset.animation;

                switch(type) {
                    case 'fade-up':
                        gsap.fromTo(image, { opacity: 0, y: 100 }, { opacity: 1, y: 0, duration: 1, ease: "power2.out", delay: 1 });
                        break;

                    case 'fade-down':
                        gsap.fromTo(image, { opacity: 0, y: -100 }, { opacity: 1, y: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'fade-left':
                        gsap.fromTo(image, { opacity: 0, x: -100 }, { opacity: 1, x: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'fade-right':
                        gsap.fromTo(image, { opacity: 0, x: 100 }, { opacity: 1, x: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'zoom-in':
                        gsap.fromTo(image, { opacity: 0, scale: 0.5 }, { opacity: 1, scale: 1, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'zoom-out':
                        gsap.fromTo(image, { opacity: 0, scale: 1.5 }, { opacity: 1, scale: 1, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'rotate-left':
                        gsap.fromTo(image, { opacity: 0, rotation: -45 }, { opacity: 1, rotation: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'rotate-right':
                        gsap.fromTo(image, { opacity: 0, rotation: 45 }, { opacity: 1, rotation: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    case 'bounce':
                        gsap.fromTo(image, { opacity: 0, y: -50 }, { opacity: 1, y: 0, duration: 1, ease: "bounce.out", delay: 0 });
                        break;

                    case 'slide-up':
                        gsap.fromTo(image, { opacity: 0, y: 200 }, { opacity: 1, y: 0, duration: 1, ease: "power2.out", delay: 0 });
                        break;

                    default:
                        gsap.fromTo(image, { opacity: 0, y: 100 }, { opacity: 1, y: 0, duration: 1, ease: "power2.out", delay: 0 });
                }
            }
        })();
    </script>
</section>
