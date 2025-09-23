/**
 * Accordion functionality for contact page
 * Handles the "Out of Hours IT Support" accordion
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get all accordion headers
    const accordionHeaders = document.querySelectorAll('.accordion h3');
    
    accordionHeaders.forEach(header => {
        // Add click event listener to each header
        header.addEventListener('click', function() {
            // Get the content div that follows this header
            const content = this.nextElementSibling;
            
            // Toggle the accordion
            if (content && content.classList.contains('accordion-content')) {
                // Check if currently open
                const isOpen = content.style.display === 'block';
                
                // Close all accordions first
                document.querySelectorAll('.accordion-content').forEach(item => {
                    item.style.display = 'none';
                    item.previousElementSibling.classList.remove('active');
                });
                
                // Open this accordion if it wasn't already open
                if (!isOpen) {
                    content.style.display = 'block';
                    this.classList.add('active');
                }
            }
        });
        
        // Add pointer cursor and active styling
        header.style.cursor = 'pointer';
        header.style.position = 'relative';
        
        // Add arrow indicator
        if (!header.querySelector('.accordion-arrow')) {
            const arrow = document.createElement('span');
            arrow.className = 'accordion-arrow';
            arrow.innerHTML = ' ▼';
            arrow.style.cssText = `
                position: absolute;
                right: 10px;
                transition: transform 0.3s ease;
                font-size: 12px;
            `;
            header.appendChild(arrow);
        }
    });
    
    // Initially hide all accordion content
    document.querySelectorAll('.accordion-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Add CSS for active state
    const style = document.createElement('style');
    style.textContent = `
        .accordion h3.active .accordion-arrow {
            transform: rotate(180deg);
        }
        .accordion-content {
            overflow: hidden;
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});