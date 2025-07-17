// Sidebar Menu Toggle
const openSidebar = document.querySelector('.mobile-menu-toggle');
const closeSidebar = document.getElementById('closeSidebar');
const body = document.body;

console.log('Sidebar script loaded');

if (openSidebar) {
    console.log('Mobile Menu Toggle button found');
    openSidebar.addEventListener('click', () => {
        console.log('Mobile Menu Toggle clicked');
        body.classList.add('sidebar-active');
    });
} else {
    console.error('Mobile Menu Toggle button not found');
}

if (closeSidebar) {
    console.log('Close Sidebar button found');
    closeSidebar.addEventListener('click', () => {
        console.log('Close Sidebar clicked');
        body.classList.remove('sidebar-active');
    });
} else {
    console.error('Close Sidebar button not found');
}
