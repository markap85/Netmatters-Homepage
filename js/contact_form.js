/**
 * Contact Form Handler with AJAX and Notifications
 * Handles form submission, button states, and notification display
 */

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form form');
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.textContent;
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted via AJAX'); // Debug log
        
        // Change button state to submitting
        submitButton.textContent = 'Submitting...';
        submitButton.classList.add('submitting');
        submitButton.disabled = true;
        
        // Hide any existing notifications
        hideNotification();
        
        // Prepare form data
        const formData = new FormData(form);
        
        // Send AJAX request
        fetch('contact-us.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Response received:', response); // Debug log
            return response.json();
        })
        .then(data => {
            console.log('Data parsed:', data); // Debug log
            
            // Reset button state
            submitButton.textContent = originalButtonText;
            submitButton.classList.remove('submitting');
            submitButton.disabled = false;
            
            // Debug: Check notification elements before clearing errors
            console.log('Before clearFormErrors - notification elements exist:', {
                notification: !!document.getElementById('form-notification'),
                messageElement: !!document.getElementById('notification-message')
            });
            
            // Clear previous errors
            clearFormErrors();
            
            // Debug: Check notification elements after clearing errors
            console.log('After clearFormErrors - notification elements exist:', {
                notification: !!document.getElementById('form-notification'),
                messageElement: !!document.getElementById('notification-message')
            });
            
            if (data.success) {
                // Reset form first
                form.reset();
                
                // Show success notification using server message
                showNotification(data.message || 'Your message has been sent successfully!', 'success');
            } else {
                // Show validation errors in notification box
                if (data.errors && Object.keys(data.errors).length > 0) {
                    showValidationErrors(data.errors);
                } else if (data.message) {
                    showNotification(data.message, 'error');
                } else {
                    showNotification('Please check your form and try again.', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Form submission error:', error);
            
            // Reset button state
            submitButton.textContent = originalButtonText;
            submitButton.classList.remove('submitting');
            submitButton.disabled = false;
            
            // Show error notification
            showNotification('Sorry, there was a technical problem. Please try again.', 'error');
        });
    });
});

/**
 * Show notification with message and type
 */
function showNotification(message, type = 'success') {
    const notification = document.getElementById('form-notification');
    const messageElement = document.getElementById('notification-message');
    
    // Check if elements exist
    if (!notification || !messageElement) {
        console.error('Notification elements not found:', {
            notification: !!notification,
            messageElement: !!messageElement
        });
        return;
    }
    
    // Set message
    messageElement.textContent = message;
    
    // Set type classes
    notification.className = 'form-notification ' + type;
    
    // Show notification
    notification.style.display = 'block';
    
    // Scroll to notification to ensure it's visible
    setTimeout(() => {
        notification.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
    }, 100);
    
    // Auto-hide after 8 seconds for success messages (increased time so user can see it)
    if (type === 'success') {
        setTimeout(() => {
            hideNotification();
        }, 8000);
    }
}

/**
 * Hide notification
 */
function hideNotification() {
    const notification = document.getElementById('form-notification');
    notification.style.display = 'none';
}

/**
 * Close notification (called by X button)
 */
function closeNotification() {
    hideNotification();
}

/**
 * Clear all form error styling
 */
function clearFormErrors() {
    // Remove error classes from inputs
    const errorInputs = document.querySelectorAll('.contact-form input.error, .contact-form textarea.error');
    errorInputs.forEach(input => {
        input.classList.remove('error');
    });
    
    // Remove error messages (but NOT notification elements)
    const errorMessages = document.querySelectorAll('.contact-form .error:not(#form-notification):not(#notification-message)');
    errorMessages.forEach(error => {
        error.remove();
    });
}

/**
 * Show multiple validation errors in notification box
 */
function showValidationErrors(errors) {
    const errorMessages = Object.values(errors);
    const message = errorMessages.length === 1 
        ? errorMessages[0] 
        : `Please correct the following errors:\n• ${errorMessages.join('\n• ')}`;
    
    showNotification(message, 'error');
}