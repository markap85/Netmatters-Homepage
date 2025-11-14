document.addEventListener('DOMContentLoaded', function() {
    // Check if banner slideshow exists on this page
    const bannerElement = document.querySelector('.banner-slideshow');
    if (!bannerElement) {
        return; // Exit if not on a page with banner
    }
    
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
        height: '550px',        // Match original banner height on all screen sizes
        cover: true,            // Cover background images
        heightRatio: 0,         // Disable automatic height ratio
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

    // Sidebar integration - pause/resume slideshow when sidebar opens/closes
    const body = document.body;
    let wasPausedBySidebar = false;
    
    // Function to check if sidebar is active and control slideshow
    function handleSidebarState() {
        if (body.classList.contains('sidebar-active')) {
            // Sidebar is open - pause the slideshow
            if (splide.Components.Autoplay.isPaused() === false) {
                wasPausedBySidebar = true;
                splide.Components.Autoplay.pause();
                console.log('Slideshow paused due to sidebar opening');
            }
        } else {
            // Sidebar is closed - resume the slideshow if we paused it
            if (wasPausedBySidebar && splide.Components.Autoplay.isPaused()) {
                wasPausedBySidebar = false;
                splide.Components.Autoplay.play();
                console.log('Slideshow resumed after sidebar closing');
            }
        }
    }
    
    // Use MutationObserver to watch for changes to the body class
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                handleSidebarState();
            }
        });
    });
    
    // Start observing changes to the body class
    observer.observe(body, {
        attributes: true,
        attributeFilter: ['class']
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
