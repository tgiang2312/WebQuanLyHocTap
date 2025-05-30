import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';

// Đăng ký các plugins
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Animation cho hero section
export function initHeroAnimation() {
    const timeline = gsap.timeline();
    
    timeline
        .from('.hero-title', {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: 'power3.out'
        })
        .from('.hero-subtitle', {
            y: 30,
            opacity: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.6')
        .from('.hero-cta', {
            y: 20,
            opacity: 0,
            duration: 0.6,
            ease: 'power3.out'
        }, '-=0.4');
}

// Animation cho course cards
export function initCourseCardAnimations() {
    gsap.from('.course-card', {
        scrollTrigger: {
            trigger: '.course-section',
            start: 'top 80%'
        },
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.2,
        ease: 'power2.out'
    });
}

// Animation cho counter stats
export function initCounterAnimations() {
    const counters = document.querySelectorAll('.counter-number');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        
        gsap.to(counter, {
            scrollTrigger: {
                trigger: counter,
                start: 'top 90%'
            },
            innerHTML: target,
            duration: 2,
            snap: { innerHTML: 1 },
            ease: 'power2.out'
        });
    });
}

// Animation cho các section khi scroll
export function initScrollAnimations() {
    gsap.utils.toArray('.animate-on-scroll').forEach(section => {
        gsap.from(section, {
            scrollTrigger: {
                trigger: section,
                start: 'top 80%'
            },
            y: 50,
            opacity: 0,
            duration: 1,
            ease: 'power3.out'
        });
    });
}

// Animation cho navigation menu
export function initNavAnimation() {
    const navTimeline = gsap.timeline();
    
    navTimeline
        .from('.navbar-brand', {
            x: -20,
            opacity: 0,
            duration: 0.6
        })
        .from('.nav-item', {
            y: -20,
            opacity: 0,
            duration: 0.4,
            stagger: 0.1
        }, '-=0.3');
}

// Animation cho stagger containers
export function initStaggerAnimations() {
    gsap.utils.toArray('.stagger-container').forEach(container => {
        // Đảm bảo các phần tử con có opacity: 1 trước khi áp dụng animation
        gsap.set(container.children, { opacity: 1 });
        
        gsap.from(container.children, {
            scrollTrigger: {
                trigger: container,
                start: 'top 80%'
            },
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.15,
            ease: 'power2.out'
        });
    });
}

// Animation cho gallery images
export function initGalleryAnimations() {
    gsap.utils.toArray('.hover-card').forEach((card, index) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 90%'
            },
            scale: 0.9,
            opacity: 0,
            duration: 0.8,
            delay: index * 0.1,
            ease: 'back.out(1.7)'
        });
    });
}

// Animation cho text typing effect
export function initTextAnimations() {
    const typingTexts = document.querySelectorAll('.typing-text');
    
    typingTexts.forEach(text => {
        const content = text.textContent;
        text.textContent = '';
        
        gsap.to(text, {
            scrollTrigger: {
                trigger: text,
                start: 'top 80%'
            },
            text: content,
            duration: 2,
            ease: 'none'
        });
    });
}

// Animation cho page transitions
export function initPageTransitions() {
    // Fade in page content on load
    gsap.from('body > *', {
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power1.out'
    });
}

// Animation cho footer
export function initFooterAnimation() {
    // Footer animations được xử lý trong file footer.js riêng biệt
    // Import thông qua module hoặc file riêng
    console.log("Footer animations are handled in separate footer.js file");
}

// Animation cho form elements
export function initFormAnimations() {
    gsap.from('.form-control, .form-label, .form-check, .btn', {
        scrollTrigger: {
            trigger: 'form',
            start: 'top 80%'
        },
        y: 20,
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out'
    });
}

// Animation cho tables
export function initTableAnimations() {
    gsap.from('table tbody tr', {
        scrollTrigger: {
            trigger: 'table',
            start: 'top 80%'
        },
        opacity: 0,
        y: 20,
        duration: 0.4,
        stagger: 0.1,
        ease: 'power1.out'
    });
}

// Animation cho modals
export function initModalAnimations() {
    const modals = document.querySelectorAll('.modal');
    
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', () => {
            const modalDialog = modal.querySelector('.modal-dialog');
            gsap.fromTo(modalDialog, 
                { y: -50, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.3, ease: 'power2.out' }
            );
        });
    });
}

// Animation cho tabs
export function initTabAnimations() {
    const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
    
    tabLinks.forEach(tabLink => {
        tabLink.addEventListener('shown.bs.tab', (event) => {
            const target = document.querySelector(event.target.getAttribute('href'));
            gsap.fromTo(target,
                { opacity: 0, y: 20 },
                { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
            );
        });
    });
}

// Animation cho buttons
export function initButtonAnimations() {
    const buttons = document.querySelectorAll('.btn-animated');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                scale: 1.05,
                duration: 0.2,
                ease: 'power1.out'
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                scale: 1,
                duration: 0.2,
                ease: 'power1.in'
            });
        });
    });
}

// Khởi tạo tất cả animations
export function initAllAnimations() {
    // Đảm bảo tất cả các phần tử stagger-container đều hiển thị
    document.querySelectorAll('.stagger-container > *').forEach(el => {
        el.style.opacity = '1';
    });
    
    // Sau đó mới áp dụng animations
    setTimeout(() => {
        initPageTransitions();
        initHeroAnimation();
        initNavAnimation();
        initCourseCardAnimations();
        initCounterAnimations();
        initScrollAnimations();
        initStaggerAnimations();
        initGalleryAnimations();
        initTextAnimations();
        initFooterAnimation();
        initFormAnimations();
        initTableAnimations();
        initModalAnimations();
        initTabAnimations();
        initButtonAnimations();
    }, 100);
}

// Export default để dễ dàng import
export default { 
    initAllAnimations,
    initHeroAnimation,
    initNavAnimation,
    initCourseCardAnimations,
    initCounterAnimations,
    initScrollAnimations,
    initStaggerAnimations,
    initGalleryAnimations,
    initTextAnimations,
    initPageTransitions,
    initFooterAnimation,
    initFormAnimations,
    initTableAnimations,
    initModalAnimations,
    initTabAnimations,
    initButtonAnimations
}; 