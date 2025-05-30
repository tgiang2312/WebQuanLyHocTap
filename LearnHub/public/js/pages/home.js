document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM Content Loaded - Initializing Homepage JS");
    
    // Register GSAP plugins
    if (typeof gsap !== 'undefined') {
        console.log("GSAP loaded successfully");
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            console.log("ScrollTrigger registered");
        } else {
            console.error("ScrollTrigger not loaded");
        }
        
        if (typeof ScrollToPlugin !== 'undefined') {
            gsap.registerPlugin(ScrollToPlugin);
            console.log("ScrollToPlugin registered");
        } else {
            console.error("ScrollToPlugin not loaded");
        }
    } else {
        console.error("GSAP not loaded");
    }
    
    // Check for particles.js
    if(typeof particlesJS !== 'undefined') {
        console.log("Particles.js is available");
    } else {
        console.error("Particles.js not available");
    }
    
    // Lưu trữ các phần tử đã hiển thị hiệu ứng
    const animatedElements = new Set();
    
    // Khởi tạo Particles.js nếu thư viện đã được tải
    const particlesContainer = document.getElementById('particles-js');
    if(particlesContainer && typeof particlesJS !== 'undefined') {
        console.log("Initializing particles on element:", particlesContainer);
        try {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 2,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 0.5
                            }
                        },
                        "push": {
                            "particles_nb": 3
                        }
                    }
                },
                "retina_detect": true
            });
            console.log("Particles.js initialized successfully");
        } catch(e) {
            console.error('ParticlesJS initialization failed:', e);
        }
    } else {
        console.warn('ParticlesJS not available or particles-js element not found');
        if (!particlesContainer) {
            console.warn('particles-js element not found in DOM');
        }
    }
    
    // Đảm bảo ScrollTrigger được khởi tạo đúng cách
    if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.matchMedia({
            "(min-width: 1px)": function() {
                // Xóa các ScrollTrigger cũ để tránh xung đột
                ScrollTrigger.getAll().forEach(trigger => trigger.kill());
                
                console.log("Initializing all animations");
                
                // Hero Section - không áp dụng scroll reveal
                initHeroAnimations();
                
                // Thiết lập các hiệu ứng cuộn cho từng phần
                setupRevealSections();
                setupFeatureCardsAnimation();
                setupCategoryCardsAnimation();
                setupFeaturedCourseAnimation();
                setupCourseGridAnimation();
                setupRoadmapAnimation();
                setupWhyChooseAnimation();
                setupTechStackAnimation();
                setupCTAAnimation();
                setupBlogCardsAnimation();
                setupStatsAnimation();
                
                // Khởi tạo hover effects
                initHoverEffects();
            }
        });
    }
    
    function initHeroAnimations() {
        console.log("Initializing hero animations");
        
        // Smooth scroll khi click vào scroll indicator
        const scrollIndicator = document.querySelector('.scroll-down-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', function() {
                if (typeof gsap !== 'undefined' && typeof ScrollToPlugin !== 'undefined') {
                    gsap.to(window, {
                        duration: 1, 
                        scrollTo: {y: window.innerHeight, autoKill: false},
                        ease: 'power2.inOut'
                    });
                } else {
                    // Fallback to standard scroll if GSAP is not available
                    window.scrollTo({
                        top: window.innerHeight,
                        behavior: 'smooth'
                    });
                }
            });
            console.log("Scroll indicator click event added");
        } else {
            console.warn("Scroll indicator not found");
        }
        
        // Parallax effect cho hero background
        const heroSection = document.querySelector('.hero-section');
        const heroBackground = document.querySelector('.hero-bg');
        
        if (heroSection && heroBackground && typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.to(heroBackground, {
                yPercent: 20,
                ease: 'none',
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 0.5
                }
            });
            console.log("Hero background parallax effect set up");
        } else {
            console.warn("Could not set up hero background parallax effect");
        }
        
        // Parallax effect cho floating cards
        const floatingElements = [
            { element: '.floating-card-1', y: -50, scrub: 0.5 },
            { element: '.floating-card-2', y: -80, scrub: 0.7 },
            { element: '.floating-card-3', y: -30, scrub: 0.3 }
        ];
        
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            floatingElements.forEach(item => {
                const element = document.querySelector(item.element);
                if (element && heroSection) {
                    gsap.to(element, {
                        y: item.y,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: item.scrub
                        }
                    });
                    console.log(`Floating element ${item.element} parallax effect set up`);
                } else {
                    console.warn(`Floating element ${item.element} not found`);
                }
            });
        }
        
        // Parallax effect cho các shape
        const shapes = document.querySelectorAll('.animated-shapes .shape');
        if (shapes.length > 0 && typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            shapes.forEach((shape, index) => {
                if (shape && heroSection) {
                    gsap.to(shape, {
                        y: -30 - (index * 10),
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: 0.5 + (index * 0.1)
                        }
                    });
                }
            });
            console.log(`${shapes.length} shape parallax effects set up`);
        } else {
            console.warn("No shape elements found for parallax effects");
        }
    }
    
    function setupRevealSections() {
        console.log("Setting up reveal sections");
        // Thiết lập hiệu ứng cho các section
        const revealSections = document.querySelectorAll('.reveal-section');
        console.log(`Found ${revealSections.length} reveal sections`);
        
        if (typeof ScrollTrigger !== 'undefined') {
            revealSections.forEach((section, index) => {
                ScrollTrigger.create({
                    trigger: section,
                    start: 'top 80%',
                    once: true,
                    onEnter: () => {
                        console.log(`Revealing section #${index}`);
                        section.classList.add('is-visible');
                        // Add reveal-active class for backward compatibility
                        section.classList.add('reveal-active');
                    }
                });
            });
        } else {
            // Fallback for when ScrollTrigger is not available
            revealSections.forEach(section => {
                section.classList.add('is-visible', 'reveal-active');
            });
            console.warn("ScrollTrigger not available, applying static reveal to all sections");
        }
    }
    
    function setupFeatureCardsAnimation() {
        console.log("Setting up feature cards animation");
        // Hiệu ứng cho "Tại sao chọn LearnHub?"
        const featureCards = document.querySelectorAll('.feature-card');
        console.log(`Found ${featureCards.length} feature cards`);
        
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.create({
                trigger: '.features-cards',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('features-cards')) {
                        featureCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        console.log('Feature cards animation triggered');
                        animatedElements.add('features-cards');
                    }
                }
            });
        } else {
            // Fallback for when ScrollTrigger is not available
            featureCards.forEach(card => {
                card.classList.add('is-visible');
            });
            console.warn("ScrollTrigger not available, applying static reveal to feature cards");
        }
    }
    
    function setupCategoryCardsAnimation() {
        console.log("Setting up category cards animation");
        // Hiệu ứng cho danh mục khóa học
        const categoryCards = document.querySelectorAll('.category-card');
        console.log(`Found ${categoryCards.length} category cards`);
        
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.create({
                trigger: '.categories-slider',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('categories-slider')) {
                        categoryCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 100);
                        });
                        console.log('Category cards animation triggered');
                        animatedElements.add('categories-slider');
                    }
                }
            });
        } else {
            // Fallback for when ScrollTrigger is not available
            categoryCards.forEach(card => {
                card.classList.add('is-visible');
            });
            console.warn("ScrollTrigger not available, applying static reveal to category cards");
        }
    }
    
    function setupFeaturedCourseAnimation() {
        console.log("Setting up featured course animation");
        // Animation cho featured course
        const featuredCourse = document.querySelector('.featured-course');
        if (featuredCourse) {
            const elements = featuredCourse.querySelectorAll('.animated-element');
            
            elements.forEach((element, index) => {
                gsap.fromTo(
                    element,
                    { x: index % 2 === 0 ? -30 : 30, opacity: 0 },
                    {
                        x: 0,
                        opacity: 1,
                        duration: 0.6,
                        delay: 0.1 * index,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: featuredCourse,
                            start: 'top 70%',
                            toggleActions: 'play none none none'
                        }
                    }
                );
            });
        }
    }
    
    function setupCourseGridAnimation() {
        console.log("Setting up course grid animation");
        // Animation cho course grid
        const courseCards = document.querySelectorAll('.course-card');
        
        courseCards.forEach((card, index) => {
            gsap.fromTo(
                card,
                { y: 40, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.5,
                    delay: 0.07 * (index % 3), // Để tạo hiệu ứng sóng theo hàng
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: card.parentElement.parentElement,
                        start: 'top 80%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        });
    }
    
    function setupRoadmapAnimation() {
        console.log("Setting up roadmap animation");
        // Hiệu ứng cho lộ trình học tập
        const roadmapContainer = document.querySelector('.roadmap-container');
        
        if (!roadmapContainer) {
            console.warn("Roadmap container not found");
            return;
        }
        
        console.log("Roadmap container found, setting up animation");
        
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.create({
                trigger: '.roadmap-container',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('roadmap-container')) {
                        // Thêm class is-visible cho đường line trước
                        const line = document.querySelector('.roadmap-line');
                        if (line) {
                            line.classList.add('is-visible');
                            console.log("Roadmap line animation triggered");
                        } else {
                            console.warn("Roadmap line element not found");
                        }
                        
                        // Sau đó hiển thị từng phần tử theo thứ tự
                        const items = document.querySelectorAll('.roadmap-item');
                        const points = document.querySelectorAll('.roadmap-point');
                        const contents = document.querySelectorAll('.roadmap-content');
                        const icons = document.querySelectorAll('.roadmap-icon');
                        const titles = document.querySelectorAll('.roadmap-title');
                        const texts = document.querySelectorAll('.roadmap-text');
                        const buttons = document.querySelectorAll('.roadmap-btn');
                        
                        console.log(`Found roadmap elements: ${items.length} items, ${points.length} points, ${contents.length} contents`);
                        
                        // Hiển thị các item theo thứ tự
                        items.forEach((item, index) => {
                            setTimeout(() => {
                                item.classList.add('is-visible');
                            }, 400 + (index * 200));
                        });
                        
                        // Hiển thị các điểm
                        points.forEach((point, index) => {
                            setTimeout(() => {
                                point.classList.add('is-visible');
                            }, 600 + (index * 200));
                        });
                        
                        // Hiển thị nội dung
                        contents.forEach((content, index) => {
                            setTimeout(() => {
                                content.classList.add('is-visible');
                            }, 800 + (index * 200));
                        });
                        
                        // Hiển thị icon
                        icons.forEach((icon, index) => {
                            setTimeout(() => {
                                icon.classList.add('is-visible');
                            }, 1000 + (index * 200));
                        });
                        
                        // Hiển thị tiêu đề
                        titles.forEach((title, index) => {
                            setTimeout(() => {
                                title.classList.add('is-visible');
                            }, 1200 + (index * 200));
                        });
                        
                        // Hiển thị đoạn văn
                        texts.forEach((text, index) => {
                            setTimeout(() => {
                                text.classList.add('is-visible');
                            }, 1400 + (index * 200));
                        });
                        
                        // Hiển thị nút
                        buttons.forEach((button, index) => {
                            setTimeout(() => {
                                button.classList.add('is-visible');
                            }, 1600 + (index * 200));
                        });
                        
                        console.log('Roadmap animation sequence triggered');
                        animatedElements.add('roadmap-container');
                    }
                }
            });
        } else {
            // Fallback for when ScrollTrigger is not available
            document.querySelectorAll('.roadmap-line, .roadmap-item, .roadmap-point, .roadmap-content, .roadmap-icon, .roadmap-title, .roadmap-text, .roadmap-btn')
                .forEach(el => el.classList.add('is-visible'));
            console.warn("ScrollTrigger not available, applying static reveal to roadmap elements");
        }
    }
    
    function setupWhyChooseAnimation() {
        console.log("Setting up why choose animation");
        const whyChooseCards = document.querySelectorAll('.why-choose-card');
        console.log(`Found ${whyChooseCards.length} why choose cards`);
        
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.create({
                trigger: '.why-choose-section',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('why-choose-section')) {
                        whyChooseCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        console.log('Why choose animation triggered');
                        animatedElements.add('why-choose-section');
                    }
                }
            });
        } else {
            // Fallback for when ScrollTrigger is not available
            whyChooseCards.forEach(card => {
                card.classList.add('is-visible');
            });
            console.warn("ScrollTrigger not available, applying static reveal to why choose cards");
        }
    }
    
    function setupTechStackAnimation() {
        console.log("Setting up tech stack animation");
        // Animation cho tech stack
        const techIcons = document.querySelectorAll('.tech-icon');
        
        techIcons.forEach((icon, index) => {
            gsap.fromTo(
                icon,
                { scale: 0, opacity: 0 },
                {
                    scale: 1,
                    opacity: 1,
                    duration: 0.4,
                    delay: 0.05 * index,
                    ease: 'back.out(1.7)',
                    scrollTrigger: {
                        trigger: icon.parentElement.parentElement,
                        start: 'top 80%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        });
    }
    
    function setupCTAAnimation() {
        console.log("Setting up CTA animation");
        // Animation cho CTA section
        const ctaSection = document.querySelector('.cta-section');
        if (ctaSection) {
            gsap.fromTo(
                ctaSection,
                { backgroundPosition: '0% 50%' },
                {
                    backgroundPosition: '100% 50%',
                    ease: 'none',
                    scrollTrigger: {
                        trigger: ctaSection,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1
                    }
                }
            );
            
            const ctaContent = ctaSection.querySelector('.cta-content');
            if (ctaContent) {
                gsap.fromTo(
                    ctaContent,
                    { y: 50, opacity: 0 },
                    {
                        y: 0,
                        opacity: 1,
                        duration: 0.8,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: ctaSection,
                            start: 'top 70%',
                            toggleActions: 'play none none none'
                        }
                    }
                );
            }
        }
    }
    
    function setupBlogCardsAnimation() {
        console.log("Setting up blog cards animation");
        // Animation cho blog cards
        const blogCards = document.querySelectorAll('.blog-card');
        
        blogCards.forEach((card, index) => {
            gsap.fromTo(
                card,
                { y: 40, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    delay: 0.1 * index,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: card.parentElement.parentElement,
                        start: 'top 80%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        });
    }
    
    function setupStatsAnimation() {
        console.log("Setting up stats animation");
        // Animation cho stats counters
        const statsItems = document.querySelectorAll('.stats-item');
        
        statsItems.forEach((item, index) => {
            const counter = item.querySelector('.counter');
            const targetValue = parseInt(counter.getAttribute('data-target'), 10);
            
            if (counter && !isNaN(targetValue)) {
                // Tạo animation khi scroll đến
                ScrollTrigger.create({
                    trigger: item,
                    start: 'top 80%',
                    onEnter: () => {
                        // Animate từ 0 đến giá trị mục tiêu
                        let startValue = 0;
                        const duration = 2000; // 2 seconds
                        const interval = 20; // Update every 20ms
                        const steps = duration / interval;
                        const increment = targetValue / steps;
                        
                        const counterAnimation = setInterval(() => {
                            startValue += increment;
                            if (startValue >= targetValue) {
                                startValue = targetValue;
                                clearInterval(counterAnimation);
                            }
                            
                            // Hiển thị giá trị với định dạng phù hợp
                            counter.textContent = Math.floor(startValue).toLocaleString();
                        }, interval);
                    },
                    once: true
                });
            }
        });
    }
    
    function initHoverEffects() {
        console.log("Initializing hover effects");
        // Hover effects cho các phần tử
        
        // Feature cards hover effect đã xử lý bằng CSS
        
        // Course cards hover effect
        const courseCards = document.querySelectorAll('.course-card');
        courseCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    y: -10,
                    boxShadow: '0 15px 30px rgba(0, 0, 0, 0.15)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    y: 0,
                    boxShadow: '0 5px 15px rgba(0, 0, 0, 0.08)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });
        
        // Button hover effect
        const buttons = document.querySelectorAll('.btn-glow');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                gsap.to(button, {
                    scale: 1.05,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
            
            button.addEventListener('mouseleave', () => {
                gsap.to(button, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });
    }
}); 