// app.js
(function() {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
        console.warn("GSAP of ScrollTrigger is niet geladen!");
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray('.image-content').forEach((image) => {
        gsap.to(image, {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
                trigger: image,
                start: "top bottom", // start animatie als element in beeld komt
                toggleActions: "play none none reverse"
            }
        });
    });
})();
