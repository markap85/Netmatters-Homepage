// Cookie Consent Popup JavaScript - USE resetCookieConsent() to Test

document.addEventListener('DOMContentLoaded', function() {
    const cookieConsent = document.getElementById('cookieConsent');
    const acceptButton = document.getElementById('acceptCookies');
    const declineButton = document.getElementById('declineCookies');
    
    // Cookie management functions
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
    }
    
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    
    // Show/hide popup functions
    function showCookieConsent() {
        document.body.classList.add('cookie-popup-active'); // Disable scroll
        cookieConsent.classList.remove('hidden');
        setTimeout(() => {
            cookieConsent.style.visibility = 'visible';
        }, 10);
    }
    
    function hideCookieConsent() {
        document.body.classList.remove('cookie-popup-active'); // Re-enable scroll
        cookieConsent.classList.add('hidden');
        setTimeout(() => {
            cookieConsent.style.visibility = 'hidden';
        }, 300);
    }
    
    // Check if user has already made a choice
    function checkCookieConsent() {
        const consent = getCookie('cookieConsent');
        if (!consent) {
            // Show popup after a short delay
            setTimeout(() => {
                showCookieConsent();
            }, 1000);
        }
    }
    
    // Handle accept cookies
    function acceptCookies() {
        setCookie('cookieConsent', 'accepted', 365); // Store for 1 year
        hideCookieConsent();
        console.log('Cookies accepted');
    }
    
    // Handle decline cookies
    function declineCookies() {
        setCookie('cookieConsent', 'declined', 365); // Store for 1 year
        hideCookieConsent();
        console.log('Cookies declined');
    }
    
    // Event listeners
    acceptButton.addEventListener('click', acceptCookies);
    declineButton.addEventListener('click', declineCookies);
    
    // Close popup when clicking outside (optional)
    cookieConsent.addEventListener('click', function(e) {
        if (e.target === cookieConsent) {
            // Don't auto-accept, just inform user to make a choice
            console.log('Please make a choice about cookies');
        }
    });
    
    // Initialize cookie consent check
    checkCookieConsent();
    
    // Optional: Function to reset cookie consent (for testing)
    window.resetCookieConsent = function() {
        document.cookie = 'cookieConsent=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        location.reload();
    };
});