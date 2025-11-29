/**
 * RecyConnect - Sidebar Toggle Functionality
 * Handles collapsible sidebar with smooth transitions
 */

(function() {
    'use strict';
    
    // Get elements
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mainContent = document.getElementById('mainContent');
    
    // Check if elements exist
    if (!sidebar || !sidebarToggle || !mainContent) {
        console.error('Sidebar elements not found');
        return;
    }
    
    // Get sidebar state from localStorage
    const getSidebarState = () => {
        return localStorage.getItem('sidebarCollapsed') === 'true';
    };
    
    // Save sidebar state to localStorage
    const setSidebarState = (collapsed) => {
        localStorage.setItem('sidebarCollapsed', collapsed);
    };
    
    // Toggle sidebar
    const toggleSidebar = () => {
        const isCollapsed = sidebar.classList.contains('collapsed');
        
        if (isCollapsed) {
            // Show sidebar
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
            setSidebarState(false);
        } else {
            // Hide sidebar
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            setSidebarState(true);
        }
    };
    
    // Toggle sidebar for mobile (with overlay)
    const toggleSidebarMobile = () => {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('active');
        
        // Prevent body scroll when sidebar is open on mobile
        if (sidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    };
    
    // Close sidebar on mobile
    const closeSidebarMobile = () => {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    };
    
    // Initialize sidebar state on page load
    const initializeSidebar = () => {
        const isMobile = window.innerWidth < 768;
        
        if (!isMobile) {
            // Desktop: restore saved state
            const isCollapsed = getSidebarState();
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
        } else {
            // Mobile: sidebar hidden by default
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    };
    
    // Event listeners
    sidebarToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const isMobile = window.innerWidth < 768;
        
        if (isMobile) {
            toggleSidebarMobile();
        } else {
            toggleSidebar();
        }
    });
    
    // Close button for mobile
    if (sidebarClose) {
        sidebarClose.addEventListener('click', (e) => {
            e.preventDefault();
            closeSidebarMobile();
        });
    }
    
    // Close sidebar when clicking overlay
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            closeSidebarMobile();
        });
    }
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const isMobile = window.innerWidth < 768;
            
            if (isMobile) {
                // Mobile: close sidebar and remove desktop classes
                closeSidebarMobile();
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            } else {
                // Desktop: restore saved state
                closeSidebarMobile(); // Close mobile view first
                const isCollapsed = getSidebarState();
                if (isCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }
        }, 250);
    });
    
    // Initialize on load
    initializeSidebar();
    
    // Smooth scroll to top when sidebar links are clicked
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Close mobile sidebar when link is clicked
            if (window.innerWidth < 768) {
                closeSidebarMobile();
            }
        });
    });
    
})();

