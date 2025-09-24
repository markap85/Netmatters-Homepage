/**
 * Accordion functionality for contact page
 * Handles the "Out of Hours IT Support" accordion
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get all accordion headers (now targeting p elements)
    const accordionHeaders = document.querySelectorAll('.accordion p');
    
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
                    item.previousElementSibling.classList.remove('active');
                });
                
                // Update all arrows to point down
                document.querySelectorAll('.accordion-arrow').forEach(arrow => {
                    arrow.style.transform = 'rotate(0deg)';
                });
                
                // Open this accordion if it wasn't already open
                if (!isOpen) {
                    content.classList.add('open');
                    this.classList.add('active');
                    
                    // Rotate arrow for active accordion
                    const arrow = this.querySelector('.accordion-arrow');
                    if (arrow) {
                        arrow.style.transform = 'rotate(180deg)';
                    }
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
    
    // Initially ensure all accordion content is closed
    document.querySelectorAll('.accordion-content').forEach(content => {
        content.classList.remove('open');
    });
    
    // Add CSS for active state
    const style = document.createElement('style');
    style.textContent = `
        .accordion p.active .accordion-arrow {
            transform: rotate(180deg);
        }
        .accordion-content {
            overflow: hidden;
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});