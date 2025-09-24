/**
 * Accordion functionality for contact page
 * Handles the "Out of Hours IT Support" accordion
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get all accordion headers (only direct p children, not nested ones)
    const accordionHeaders = document.querySelectorAll('.accordion > p');
    
    accordionHeaders.forEach(header => {
        // Add click event listener to each header
        header.addEventListener('click', function() {
            // Get the content div that follows this header
            const content = this.nextElementSibling;
            
            // Toggle the accordion
            if (content && content.classList.contains('accordion-content')) {
                // Check if currently open
                const isOpen = content.classList.contains('open');
                
                // Close all accordions first
                document.querySelectorAll('.accordion-content').forEach(item => {
                    item.classList.remove('open');
                });
                
                // Open this accordion if it wasn't already open
                if (!isOpen) {
                    content.classList.add('open');
                }
            }
        });
        
        // Add pointer cursor and active styling
        header.style.cursor = 'pointer';
        header.style.position = 'relative';
        
        // Add arrow indicator
        if (!header.querySelector('.accordion-arrow')) {
            const arrow = document.createElement('span');
            arrow.className = 'accordion-arrow icon-keyboard_arrow_down';
            // Styling is now handled by CSS
            header.appendChild(arrow);
        }
    });
    
    // Initially ensure all accordion content is closed
    document.querySelectorAll('.accordion-content').forEach(content => {
        content.classList.remove('open');
    });
    
    // Add CSS for transitions
    const style = document.createElement('style');
    style.textContent = `
        .accordion-content {
            overflow: hidden;
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});