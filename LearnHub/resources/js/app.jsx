import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';

function App() {
    return <h1>Welcome to LearnHub (React + Laravel)</h1>;
}

const rootElement = document.getElementById('react-root');
if (rootElement) {
    createRoot(rootElement).render(<App />);
}
