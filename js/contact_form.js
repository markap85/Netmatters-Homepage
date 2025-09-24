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
        .then(response => response.json())
        .then(data => {
            // Reset button state
            submitButton.textContent = originalButtonText;
            submitButton.classList.remove('submitting');
            submitButton.disabled = false;
            
            // Clear previous errors
            clearFormErrors();
            
            if (data.success) {
                // Show success notification
                showNotification('Your message has been sent successfully!', 'success');
                
                // Reset form
                form.reset();
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
    
    // Set message
    messageElement.textContent = message;
    
    // Set type classes
    notification.className = 'form-notification ' + type;
    
    // Show notification
    notification.style.display = 'block';
    
    // Auto-hide after 5 seconds for success messages
    if (type === 'success') {
        setTimeout(() => {
            hideNotification();
        }, 5000);
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
    
    // Remove error messages
    const errorMessages = document.querySelectorAll('.contact-form .error');
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