// visual-effects.js
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.particles-container');

    if (!container) return;

    createParticles();
    insertFloatingAnimationCSS();

    // Function to create floating particles for background
    function createParticles() {
        const particleCount = 30;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            // Random position
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;

            // Random size and opacity
            const size = Math.random() * 6 + 2;
            const opacity = Math.random() * 0.3 + 0.1;

            // Apply styles
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.opacity = opacity.toString();

            // Random animation duration
            const duration = Math.random() * 20 + 10;
            particle.style.animation = `float ${duration}s linear infinite`;

            container.appendChild(particle);
        }
    }

    // Insert keyframe animation rule into stylesheet
    function insertFloatingAnimationCSS() {
        const keyframes = `
            @keyframes float {
                0%   { transform: translate(0, 0); }
                25%  { transform: translate(${Math.random() * 100}px, ${Math.random() * 100}px); }
                50%  { transform: translate(${Math.random() * -100}px, ${Math.random() * 100}px); }
                75%  { transform: translate(${Math.random() * -100}px, ${Math.random() * -100}px); }
                100% { transform: translate(0, 0); }
            }
        `;

        const styleSheet = document.styleSheets[0] || document.head.appendChild(document.createElement('style')).sheet;
        styleSheet.insertRule(keyframes, styleSheet.cssRules.length);
    }
});
