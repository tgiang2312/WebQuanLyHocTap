/**
 * Common JavaScript functionality for LearnHub
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    initTooltips();
    
    // Initialize popovers
    initPopovers();
    
    // Handle responsive sidebar toggling
    handleResponsiveSidebar();
    
    // Smooth scrolling for anchor links
    setupSmoothScrolling();
    
    // Initialize dynamic counters
    initCounters();
    
    // Setup form validations
    setupFormValidations();
    
    // Handle file input customization
    customizeFileInputs();
    
    // Setup mobile nav menu
    setupMobileNav();
});

/**
 * Initialize Bootstrap tooltips
 */
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover'
        });
    });
}

/**
 * Initialize Bootstrap popovers
 */
function initPopovers() {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

/**
 * Handle responsive sidebar toggling
 */
function handleResponsiveSidebar() {
    const sidebarTogglers = document.querySelectorAll('.sidebar-toggler');
    const sidebars = document.querySelectorAll('.responsive-sidebar');
    
    sidebarTogglers.forEach(toggler => {
        toggler.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetSidebar = targetId ? document.querySelector(targetId) : sidebars[0];
            
            if (targetSidebar) {
                targetSidebar.classList.toggle('show');
                
                // Add backdrop if not exists
                if (targetSidebar.classList.contains('show')) {
                    addBackdrop(targetSidebar);
                } else {
                    removeBackdrop();
                }
            }
        });
    });
    
    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        sidebars.forEach(sidebar => {
            const isClickInside = sidebar.contains(event.target);
            const isToggler = Array.from(sidebarTogglers).some(toggler => toggler.contains(event.target));
            
            if (!isClickInside && !isToggler && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                removeBackdrop();
            }
        });
    });
    
    // Handle ESC key to close sidebar
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            sidebars.forEach(sidebar => {
                if (sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    removeBackdrop();
                }
            });
        }
    });
}

/**
 * Add backdrop for mobile sidebar
 */
function addBackdrop(sidebar) {
    removeBackdrop(); // Remove existing backdrop if any
    
    const backdrop = document.createElement('div');
    backdrop.classList.add('sidebar-backdrop');
    backdrop.style.position = 'fixed';
    backdrop.style.top = '0';
    backdrop.style.left = '0';
    backdrop.style.width = '100%';
    backdrop.style.height = '100%';
    backdrop.style.backgroundColor = 'rgba(0,0,0,0.5)';
    backdrop.style.zIndex = '1020';
    
    document.body.appendChild(backdrop);
    
    // Close sidebar when clicking on backdrop
    backdrop.addEventListener('click', function() {
        sidebar.classList.remove('show');
        removeBackdrop();
    });
}

/**
 * Remove backdrop
 */
function removeBackdrop() {
    const backdrop = document.querySelector('.sidebar-backdrop');
    if (backdrop) {
        backdrop.remove();
    }
}

/**
 * Setup smooth scrolling for anchor links
 */
function setupSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            // Skip if href is just "#" or if it's not for scrolling
            if (targetId === '#' || this.getAttribute('data-bs-toggle')) {
                return;
            }
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                
                window.scrollTo({
                    top: targetElement.offsetTop - 70, // Adjust for fixed header
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Initialize number counters
 */
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        
        if (!isNaN(target)) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        let count = 0;
                        const duration = 2000; // 2 seconds
                        const interval = 20; // Update every 20ms
                        const steps = duration / interval;
                        const increment = target / steps;
                        
                        const timer = setInterval(() => {
                            count += increment;
                            
                            if (count >= target) {
                                counter.textContent = target.toLocaleString();
                                clearInterval(timer);
                            } else {
                                counter.textContent = Math.floor(count).toLocaleString();
                            }
                        }, interval);
                        
                        // Stop observing after animation
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        }
    });
}

/**
 * Setup form validations
 */
function setupFormValidations() {
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
}

/**
 * Customize file inputs
 */
function customizeFileInputs() {
    const fileInputs = document.querySelectorAll('.custom-file-input');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = this.files[0]?.name;
            const label = this.nextElementSibling;
            
            if (label && fileName) {
                label.textContent = fileName;
            }
        });
    });
}

/**
 * Setup mobile navigation
 */
function setupMobileNav() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('show');
            document.body.classList.toggle('mobile-menu-open');
            
            if (mobileMenu.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
    }
}

/**
 * Helper function to debounce function calls
 */
function debounce(func, wait) {
    let timeout;
    
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Show success toast notification
 */
function showSuccessToast(message) {
    showToast(message, 'success');
}

/**
 * Show error toast notification
 */
function showErrorToast(message) {
    showToast(message, 'danger');
}

/**
 * Show toast notification
 */
function showToast(message, type = 'info') {
    // Create toast container if not exists
    let toastContainer = document.querySelector('.toast-container');
    
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.classList.add('toast-container', 'position-fixed', 'bottom-0', 'end-0', 'p-3');
        document.body.appendChild(toastContainer);
    }
    
    // Create toast
    const toastId = 'toast-' + Date.now();
    const toast = document.createElement('div');
    toast.classList.add('toast', 'align-items-center', 'text-white', `bg-${type}`, 'border-0');
    toast.setAttribute('id', toastId);
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    // Toast content
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    // Add to container
    toastContainer.appendChild(toast);
    
    // Initialize and show
    const toastInstance = new bootstrap.Toast(toast, {
        autohide: true,
        delay: 5000
    });
    
    toastInstance.show();
    
    // Remove from DOM when hidden
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
} 