/**
 * Client-side form validation for contact form
 * Validates form fields before submission
 */

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form form');
    
    if (!form) return;
    
    // Form field elements
    const fields = {
        firstName: form.querySelector('#first_name'),
        lastName: form.querySelector('#last_name'),
        email: form.querySelector('#email'),
        phone: form.querySelector('#phone'),
        company: form.querySelector('#company'),
        subject: form.querySelector('#subject'),
        message: form.querySelector('#message'),
        marketingConsent: form.querySelector('#marketing_consent')
    };
    
    // Validation functions
    const validators = {
        required: (value) => value.trim() !== '',
        email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        minLength: (value, min) => value.trim().length >= min,
        phone: (value) => {
            // Optional field, but if provided should be valid UK format
            if (!value.trim()) return true;
            return /^(\+44\s?|0)(\d{4}\s?\d{6}|\d{3}\s?\d{3}\s?\d{4}|\d{2}\s?\d{4}\s?\d{4})$/.test(value.replace(/\s/g, ''));
        }
    };
    
    // Error display functions
    function showError(field, message) {
        // Remove existing error
        clearError(field);
        
        // Add error class to field
        field.classList.add('error');
        
        // Create and show error message
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error';
        errorSpan.textContent = message;
        field.parentNode.appendChild(errorSpan);
    }
    
    function clearError(field) {
        field.classList.remove('error');
        const existingError = field.parentNode.querySelector('span.error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    function clearAllErrors() {
        Object.values(fields).forEach(field => {
            if (field) clearError(field);
        });
    }
    
    // Real-time validation
    Object.entries(fields).forEach(([name, field]) => {
        if (!field) return;
        
        field.addEventListener('blur', function() {
            validateField(name, field);
        });
        
        field.addEventListener('input', function() {
            // Clear error on input if field was previously invalid
            if (field.classList.contains('error')) {
                clearError(field);
            }
        });
    });
    
    // Individual field validation
    function validateField(fieldName, field) {
        const value = field.value;
        let isValid = true;
        
        switch (fieldName) {
            case 'firstName':
                if (!validators.required(value)) {
                    showError(field, 'First name is required.');
                    isValid = false;
                }
                break;
                
            case 'lastName':
                if (!validators.required(value)) {
                    showError(field, 'Last name is required.');
                    isValid = false;
                }
                break;
                
            case 'email':
                if (!validators.required(value)) {
                    showError(field, 'Email is required.');
                    isValid = false;
                } else if (!validators.email(value)) {
                    showError(field, 'Please enter a valid email address.');
                    isValid = false;
                }
                break;
                
            case 'phone':
                if (!validators.phone(value)) {
                    showError(field, 'Please enter a valid UK phone number.');
                    isValid = false;
                }
                break;
                
            case 'subject':
                if (!validators.required(value)) {
                    showError(field, 'Subject is required.');
                    isValid = false;
                }
                break;
                
            case 'message':
                if (!validators.required(value)) {
                    showError(field, 'Message is required.');
                    isValid = false;
                } else if (!validators.minLength(value, 10)) {
                    showError(field, 'Message must be at least 10 characters long.');
                    isValid = false;
                }
                break;
        }
        
        return isValid;
    }
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        clearAllErrors();
        
        // Validate all fields
        let formIsValid = true;
        
        Object.entries(fields).forEach(([name, field]) => {
            if (field && ['firstName', 'lastName', 'email', 'subject', 'message', 'phone'].includes(name)) {
                if (!validateField(name, field)) {
                    formIsValid = false;
                }
            }
        });
        
        // If form is valid, submit it
        if (formIsValid) {
            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Sending...';
            submitButton.disabled = true;
            
            // Submit the form
            form.submit();
        } else {
            // Scroll to first error
            const firstError = form.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // Add CSS for better error styling
    const style = document.createElement('style');
    style.textContent = `
        .contact-form input.error,
        .contact-form textarea.error {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .contact-form .error {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .contact-form button[type="submit"]:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    `;
    document.head.appendChild(style);
});