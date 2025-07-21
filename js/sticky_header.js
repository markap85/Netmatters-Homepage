document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const body = document.body;
    let lastScrollTop = 0;
    let ticking = false;
    const scrollThreshold = 10; // Minimum scroll distance to trigger hide/show

    // Add initial classes
    header.classList.add('sticky-header');
    body.classList.add('sticky-header-active');

    function updateHeader() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Prevent negative values when over-scrolling on mobile
        const currentScrollTop = Math.max(scrollTop, 0);
        
        // Only proceed if scroll difference is significant enough
        if (Math.abs(currentScrollTop - lastScrollTop) < scrollThreshold) {
            ticking = false;
            return;
        }

        if (currentScrollTop > lastScrollTop && currentScrollTop > header.offsetHeight) {
            // Scrolling down & past header height - hide header
            header.classList.add('header-hidden');
            header.classList.remove('header-visible');
        } else if (currentScrollTop < lastScrollTop) {
            // Scrolling up - show header
            header.classList.remove('header-hidden');
            header.classList.add('header-visible');
        }

        // If at the very top, ensure header is visible
        if (currentScrollTop <= 0) {
            header.classList.remove('header-hidden');
            header.classList.add('header-visible');
        }

        lastScrollTop = currentScrollTop;
        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }

    // Listen for scroll events
    window.addEventListener('scroll', requestTick, { passive: true });

    // Handle resize events to recalculate header height if needed
    window.addEventListener('resize', function() {
        requestTick();
    }, { passive: true });
});
