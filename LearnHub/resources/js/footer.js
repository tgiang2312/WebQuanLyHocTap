/**
 * Footer Animations with GSAP
 */
document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra xem GSAP đã được tải hay chưa
    if (typeof gsap === 'undefined') {
        console.warn('GSAP library not loaded. Footer animations will not work.');
        initBasicFooterFunctionality();
        return;
    }

    // Khởi tạo GSAP ScrollTrigger nếu có
    if (gsap.registerPlugin && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        initFooterAnimations();
    } else {
        console.warn('GSAP ScrollTrigger not loaded. Using basic animations instead.');
        initBasicFooterAnimations();
    }
    
    // Các chức năng cơ bản không phụ thuộc GSAP
    initBasicFooterFunctionality();
});

/**
 * Khởi tạo hiệu ứng với GSAP và ScrollTrigger
 */
function initFooterAnimations() {
    // Hiệu ứng reveal cho các phần của footer
    const footerColumns = document.querySelectorAll('.footer-column');
    footerColumns.forEach((column, index) => {
        gsap.fromTo(column, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 0.2 * index,
                scrollTrigger: {
                    trigger: column,
                    start: "top 90%",
                    once: true
                }
            }
        );
    });
    
    // Hiệu ứng cho newsletter và footer bottom
    const newsletter = document.querySelector('.footer-newsletter');
    const footerBottom = document.querySelector('.footer-bottom');
    
    if (newsletter) {
        gsap.fromTo(newsletter, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 0.8,
                scrollTrigger: {
                    trigger: newsletter,
                    start: "top 90%",
                    once: true
                }
            }
        );
    }
    
    if (footerBottom) {
        gsap.fromTo(footerBottom, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 1,
                scrollTrigger: {
                    trigger: footerBottom,
                    start: "top 95%",
                    once: true
                }
            }
        );
    }
    
    // Hiệu ứng cho footer link items
    const footerLinkItems = document.querySelectorAll('.footer-link-item');
    footerLinkItems.forEach((item, index) => {
        const columnIndex = Math.floor(index / 4); // Giả sử mỗi cột có tối đa 4 links
        gsap.fromTo(item,
            { x: -10, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 0.5,
                delay: 0.3 + (0.1 * index),
                ease: "power2.out",
                scrollTrigger: {
                    trigger: item.closest('.footer-column'),
                    start: "top 90%",
                    once: true
                }
            }
        );
    });
    
    // Hiệu ứng cho footer contact items
    const footerContactItems = document.querySelectorAll('.footer-contact-item');
    footerContactItems.forEach((item, index) => {
        gsap.fromTo(item,
            { x: -10, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 0.5,
                delay: 0.7 + (0.1 * index),
                ease: "power2.out",
                scrollTrigger: {
                    trigger: item.closest('.footer-column'),
                    start: "top 90%",
                    once: true
                }
            }
        );
    });
    
    // Hiệu ứng parallax cho footer wave
    gsap.to('.footer-wave', {
        y: -20,
        ease: "none",
        scrollTrigger: {
            trigger: '.footer-modern',
            start: "top bottom",
            end: "bottom top",
            scrub: true
        }
    });
    
    // Hiệu ứng tương tác cho social icons
    const socialIcons = document.querySelectorAll('.social-icon');
    socialIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            gsap.to(this, { scale: 1.2, duration: 0.3, ease: "back.out(1.7)" });
        });
        
        icon.addEventListener('mouseleave', function() {
            gsap.to(this, { scale: 1, duration: 0.3, ease: "power2.out" });
        });
    });
    
    // Tạo hiệu ứng particles cho footer
    createFooterParticles();
}

/**
 * Khởi tạo hiệu ứng cơ bản với GSAP (không dùng ScrollTrigger)
 */
function initBasicFooterAnimations() {
    // Hiệu ứng reveal đơn giản cho footer column
    const footerColumns = document.querySelectorAll('.footer-column');
    footerColumns.forEach((column, index) => {
        gsap.fromTo(column, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 0.2 * index
            }
        );
    });
    
    // Hiệu ứng cho newsletter và footer bottom
    const newsletter = document.querySelector('.footer-newsletter');
    const footerBottom = document.querySelector('.footer-bottom');
    
    if (newsletter) {
        gsap.fromTo(newsletter, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 0.8
            }
        );
    }
    
    if (footerBottom) {
        gsap.fromTo(footerBottom, 
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: "power3.out",
                delay: 1
            }
        );
    }
    
    // Tạo hiệu ứng particles cho footer
    createFooterParticles();
}

/**
 * Các chức năng cơ bản không phụ thuộc GSAP
 */
function initBasicFooterFunctionality() {
    // Hiệu ứng cho back-to-top button
    const backToTopBtn = document.getElementById('backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

/**
 * Hàm tạo hiệu ứng particles bằng GSAP
 */
function createFooterParticles() {
    const particlesContainer = document.querySelector('.footer-particles');
    if (!particlesContainer) return;
    
    // Xóa hết các particles cũ (nếu có)
    while (particlesContainer.firstChild) {
        particlesContainer.removeChild(particlesContainer.firstChild);
    }
    
    // Số lượng particles dựa theo kích thước màn hình
    const isMobile = window.innerWidth < 768;
    const particleCount = isMobile ? 20 : 50;
    
    // Tạo các hạt mới
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'footer-particle';
        particle.style.position = 'absolute';
        particle.style.width = Math.random() * 4 + 1 + 'px';
        particle.style.height = particle.style.width;
        particle.style.backgroundColor = 'rgba(255, 255, 255, ' + (Math.random() * 0.3 + 0.1) + ')';
        particle.style.borderRadius = '50%';
        
        // Vị trí ngẫu nhiên
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        
        particlesContainer.appendChild(particle);
        
        // Animation cho từng hạt
        if (typeof gsap !== 'undefined') {
            gsap.to(particle, {
                x: Math.random() * 100 - 50,
                y: Math.random() * 100 - 50,
                opacity: Math.random() * 0.5 + 0.1,
                duration: Math.random() * 20 + 10,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });
        }
    }
} 