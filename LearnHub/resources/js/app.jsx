import './bootstrap';
import React, { useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { initAllAnimations } from './animations';

function App() {
    useEffect(() => {
        // Khởi tạo animations sau khi React component đã render
        initAllAnimations();
    }, []);

    return <h1>Welcome to LearnHub (React + Laravel)</h1>;
}

const rootElement = document.getElementById('react-root');
if (rootElement) {
    createRoot(rootElement).render(<App />);
}
