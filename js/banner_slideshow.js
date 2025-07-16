/**
 * Banner Slideshow Script
 * Auto-advancing slideshow with navigation dots
 */

document.addEventListener('DOMContentLoaded', function() {
    const slideshow = document.querySelector('.banner-slideshow');
    
    if (!slideshow) return; // Exit if slideshow doesn't exist
    
    const slides = slideshow.querySelectorAll('.slide');
    const dots = slideshow.querySelectorAll('.dot');
    
    if (slides.length === 0) return; // Exit if no slides
    
    let currentSlide = 0;
    let slideInterval;
    const slideDelay = 5000; // 5 seconds between slides
    
    // Initialize slideshow
    function initSlideshow() {
        // Set first slide and dot as active
        slides[0].classList.add('active');
        if (dots.length > 0) {
            dots[0].classList.add('active');
        }
        
        // Start auto-advance
        startAutoAdvance();
        
        // Add click handlers to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
                restartAutoAdvance();
            });
        });
    }
    
    // Go to specific slide
    function goToSlide(slideIndex) {
        // Remove active class from current slide and dot
        slides[currentSlide].classList.remove('active');
        if (dots.length > 0) {
            dots[currentSlide].classList.remove('active');
        }
        
        // Update current slide index
        currentSlide = slideIndex;
        
        // Add active class to new slide and dot
        slides[currentSlide].classList.add('active');
        if (dots.length > 0) {
            dots[currentSlide].classList.add('active');
        }
    }
    
    // Advance to next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        goToSlide(next);
    }
    
    // Start auto-advance timer
    function startAutoAdvance() {
        slideInterval = setInterval(nextSlide, slideDelay);
    }
    
    // Stop auto-advance timer
    function stopAutoAdvance() {
        if (slideInterval) {
            clearInterval(slideInterval);
        }
    }
    
    // Restart auto-advance timer
    function restartAutoAdvance() {
        stopAutoAdvance();
        startAutoAdvance();
    }
    
    // Pause slideshow on hover
    slideshow.addEventListener('mouseenter', stopAutoAdvance);
    slideshow.addEventListener('mouseleave', startAutoAdvance);
    
    // Handle visibility change (pause when tab is not active)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoAdvance();
        } else {
            startAutoAdvance();
        }
    });
    
    // Initialize the slideshow
    initSlideshow();
});
