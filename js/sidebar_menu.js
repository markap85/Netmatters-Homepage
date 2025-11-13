// Sidebar Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const openSidebar = document.querySelector('.mobile-menu-toggle');
    const closeSidebar = document.getElementById('closeSidebar');
    const body = document.body;
    const screenOverlay = document.querySelector('.screen-overlay');

    if (openSidebar) {
        openSidebar.addEventListener('click', () => {
            body.classList.add('sidebar-active');
        });
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', () => {
            body.classList.remove('sidebar-active');
        });
    }

    if (screenOverlay) {
        screenOverlay.addEventListener('click', () => {
            body.classList.remove('sidebar-active');
        });
    }
});
