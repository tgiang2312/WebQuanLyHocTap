import './bootstrap';
import { initAllAnimations } from './animations';
import '../css/footer.css';
import './footer';

// Import CSS files thông qua JavaScript
function importCss(cssFile) {
    if (typeof document !== 'undefined') {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = cssFile;
        document.head.appendChild(link);
    }
}

// Khởi chạy animations cho các phần tử không phải React
document.addEventListener('DOMContentLoaded', () => {
    initAllAnimations();
    // Footer animations được xử lý trong file footer.js riêng biệt
    // CSS có thể được import trực tiếp hoặc thông qua function
});
