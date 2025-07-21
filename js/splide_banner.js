document.addEventListener('DOMContentLoaded', function() {
    // Initialize Splide for banner slideshow
    const splide = new Splide('.banner-slideshow', {
        type: 'loop',           // Infinite loop
        autoplay: true,         // Auto-advance slides
        interval: 5000,         // 5 seconds between slides
        pauseOnHover: true,     // Pause on hover
        pauseOnFocus: true,     // Pause when focused
        arrows: false,          // Hide navigation arrows
        pagination: true,       // Show dots/pagination
        drag: true,             // Allow drag/swipe
        keyboard: true,         // Keyboard navigation
        speed: 600,             // Transition speed
        easing: 'ease',         // Transition easing
        height: '550px',        // Match original banner height
        cover: true,            // Cover background images
        heightRatio: 0,         // Disable automatic height ratio
        breakpoints: {
            768: {
                height: '400px',  // Smaller height on mobile
            }
        }
    });

    // Mount the Splide instance
    splide.mount();

    // Set background images for each slide
    const slides = document.querySelectorAll('.splide__slide[data-bg]');
    slides.forEach(slide => {
        const bgImage = slide.getAttribute('data-bg');
        if (bgImage) {
            slide.style.backgroundImage = `url('./img/Backgrounds/${bgImage}')`;
            slide.style.backgroundSize = 'cover';
            slide.style.backgroundPosition = 'center';
            slide.style.backgroundRepeat = 'no-repeat';
        }
    });

    // Add event listeners for additional functionality
    splide.on('moved', function(newIndex) {
        console.log('Slide moved to:', newIndex);
        // You can add custom logic here when slides change
    });

    splide.on('autoplay:playing', function() {
        console.log('Autoplay started');
    });

    splide.on('autoplay:pause', function() {
        console.log('Autoplay paused');
    });
});
