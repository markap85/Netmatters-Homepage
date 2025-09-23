document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const mainNav = document.querySelector('.main-nav');
    const body = document.body;
    let lastScrollTop = 0;
    let ticking = false;
    const scrollThreshold = 10; // Minimum scroll distance to trigger hide/show

    // Add initial classes to both header and navigation
    if (header) {
        header.classList.add('sticky-header');
        header.classList.add('header-visible'); // Start visible
        header.classList.add('no-transition'); // Disable transitions initially
    }
    if (mainNav) {
        mainNav.classList.add('sticky-nav');
        mainNav.classList.add('nav-visible'); // Start visible
        mainNav.classList.add('no-transition'); // Disable transitions initially
    }
    body.classList.add('sticky-header-active');

    // Enable transitions after a short delay to allow smooth scroll animations
    setTimeout(() => {
        if (header) {
            header.classList.remove('no-transition');
        }
        if (mainNav) {
            mainNav.classList.remove('no-transition');
        }
    }, 100);

    function updateHeader() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Prevent negative values when over-scrolling on mobile
        const currentScrollTop = Math.max(scrollTop, 0);
        
        // Only proceed if scroll difference is significant enough
        if (Math.abs(currentScrollTop - lastScrollTop) < scrollThreshold) {
            ticking = false;
            return;
        }

        // Calculate combined height of header and navigation
        const headerHeight = header ? header.offsetHeight : 0;
        const navHeight = mainNav ? mainNav.offsetHeight : 0;
        const totalHeight = headerHeight + navHeight;

        if (currentScrollTop > lastScrollTop && currentScrollTop > totalHeight) {
            // Scrolling down & past header+nav height - hide both as one unit
            if (header) {
                header.classList.add('header-hidden');
                header.classList.remove('header-visible');
            }
            if (mainNav) {
                mainNav.classList.add('nav-hidden');
                mainNav.classList.remove('nav-visible');
            }
        } else if (currentScrollTop < lastScrollTop) {
            // Scrolling up - show both as one unit
            if (header) {
                header.classList.remove('header-hidden');
                header.classList.add('header-visible');
            }
            if (mainNav) {
                mainNav.classList.remove('nav-hidden');
                mainNav.classList.add('nav-visible');
            }
        }

        // If at the very top, ensure both are visible
        if (currentScrollTop <= 0) {
            if (header) {
                header.classList.remove('header-hidden');
                header.classList.add('header-visible');
            }
            if (mainNav) {
                mainNav.classList.remove('nav-hidden');
                mainNav.classList.add('nav-visible');
            }
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
