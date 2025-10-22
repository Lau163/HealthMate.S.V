/**
 * Sidebar Component
 * Maneja la funcionalidad del sidebar colapsable
 */

class SidebarComponent {
    constructor() {
        this.sidebar = null;
        this.mainContent = null;
        this.toggleSidebar = null;
        this.sidebarItems = null;
        this.sidebarTexts = null;
        this.mobileMenuButton = null;

        this.init();
    }

    init() {
        // Solo inicializar si los elementos existen en la página
        this.sidebar = document.getElementById('sidebar');
        this.mainContent = document.getElementById('main-content');
        this.toggleSidebar = document.getElementById('toggle-sidebar');
        this.sidebarItems = document.querySelectorAll('.sidebar-item');
        this.sidebarTexts = document.querySelectorAll('.sidebar-text');
        this.mobileMenuButton = document.getElementById('mobile-menu-button');

        if (this.sidebar && this.toggleSidebar) {
            this.bindEvents();
            this.initializeSidebarState();
        }
    }

    bindEvents() {
        // Toggle sidebar desktop
        if (this.toggleSidebar) {
            this.toggleSidebar.addEventListener('click', () => this.toggleSidebarDesktop());
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', (event) => this.handleOutsideClick(event));

        // Mobile menu toggle
        if (this.mobileMenuButton) {
            this.mobileMenuButton.addEventListener('click', () => this.toggleSidebarMobile());
        }
    }

    toggleSidebarDesktop() {
        if (!this.sidebar || !this.mainContent) return;

        const isCollapsed = this.sidebar.classList.contains('w-20');

        if (isCollapsed) {
            this.expandSidebar();
        } else {
            this.collapseSidebar();
        }
    }

    expandSidebar() {
        this.sidebar.classList.remove('w-20');
        this.sidebar.classList.add('w-64');
        this.mainContent.classList.remove('md:ml-20');
        this.mainContent.classList.add('md:ml-64');

        // Show text in sidebar items
        this.sidebarTexts.forEach(text => {
            text.classList.remove('hidden');
            text.classList.add('md:inline-block');
        });

        // Reset icons position
        this.sidebarItems.forEach(item => {
            item.classList.remove('justify-center');
            item.classList.add('px-6');
        });
    }

    collapseSidebar() {
        this.sidebar.classList.remove('w-64');
        this.sidebar.classList.add('w-20');
        this.mainContent.classList.remove('md:ml-64');
        this.mainContent.classList.add('md:ml-20');

        // Hide text in sidebar items
        this.sidebarTexts.forEach(text => {
            text.classList.add('hidden');
            text.classList.remove('md:inline-block');
        });

        // Center icons
        this.sidebarItems.forEach(item => {
            item.classList.add('justify-center');
            item.classList.remove('px-6');
        });
    }

    toggleSidebarMobile() {
        if (!this.sidebar || !this.mainContent) return;

        if (this.sidebar.classList.contains('hidden')) {
            this.sidebar.classList.remove('hidden');
            this.mainContent.classList.add('md:ml-64');
        } else {
            this.sidebar.classList.add('hidden');
            this.mainContent.classList.remove('md:ml-64');
        }
    }

    handleOutsideClick(event) {
        if (window.innerWidth < 768 &&
            this.sidebar &&
            !this.sidebar.contains(event.target) &&
            event.target !== this.toggleSidebar) {
            this.sidebar.classList.add('hidden');
            this.mainContent.classList.remove('md:ml-64');
        }
    }

    initializeSidebarState() {
        // Si el sidebar existe, asegurarse de que esté en el estado correcto
        if (this.sidebar && this.sidebar.classList.contains('w-20')) {
            this.sidebarTexts.forEach(text => {
                text.classList.add('hidden');
                text.classList.remove('md:inline-block');
            });

            this.sidebarItems.forEach(item => {
                item.classList.add('justify-center');
                item.classList.remove('px-6');
            });
        }
    }
}

// Inicializar el componente cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    new SidebarComponent();
});
