document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.particles-container');
    if (container) {
        const particleCount = 20;
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'absolute rounded-full bg-blue-500 opacity-20 animate-pulse';

            const size = Math.random() * 6 + 2;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDuration = `${Math.random() * 3 + 2}s`;

            container.appendChild(particle);
        }
    }

    const cards = document.querySelectorAll('.glassmorphism');
    cards.forEach(card => {
        card.classList.add('transition-transform', 'duration-200', 'hover:-translate-y-1');
    });
});
