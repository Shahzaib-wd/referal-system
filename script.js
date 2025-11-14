document.addEventListener('DOMContentLoaded', function() {
    initAnimations();
    initScrollEffects();
    initInteractiveElements();
    showRandomNotifications();
});

function initAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.step-card, .product-card, .dashboard-card');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

function initScrollEffects() {
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(15, 15, 30, 0.98)';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.5)';
        } else {
            navbar.style.background = 'rgba(15, 15, 30, 0.95)';
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
        }
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

function initInteractiveElements() {
    const stepCards = document.querySelectorAll('.step-card');
    stepCards.forEach((card, index) => {
        card.addEventListener('mouseenter', () => {
            card.style.animation = 'none';
            setTimeout(() => {
                card.style.animation = 'bounce-card 0.5s ease';
            }, 10);
        });
    });

    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        const buyBtn = card.querySelector('.btn-buy');
        buyBtn.addEventListener('click', (e) => {
            e.preventDefault();
            createConfetti(buyBtn);
            showNotification('Product added! Redirecting to checkout...', 'success');
        });
    });

    const dashboardCards = document.querySelectorAll('.dashboard-card');
    dashboardCards.forEach(card => {
        card.addEventListener('click', () => {
            card.style.animation = 'none';
            setTimeout(() => {
                card.style.animation = 'pulse-card 0.3s ease';
            }, 10);
        });
    });

    const badgeItems = document.querySelectorAll('.badge-item');
    badgeItems.forEach(badge => {
        badge.addEventListener('click', () => {
            if (badge.classList.contains('earned')) {
                createSparkles(badge);
                showNotification('Badge earned! Keep up the great work!', 'success');
            }
        });
    });
}

function createConfetti(element) {
    const rect = element.getBoundingClientRect();
    const colors = ['#ffc107', '#00d4ff', '#b537f2', '#00ff88'];

    for (let i = 0; i < 30; i++) {
        const confetti = document.createElement('div');
        confetti.style.position = 'fixed';
        confetti.style.left = rect.left + rect.width / 2 + 'px';
        confetti.style.top = rect.top + rect.height / 2 + 'px';
        confetti.style.width = '10px';
        confetti.style.height = '10px';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
        confetti.style.pointerEvents = 'none';
        confetti.style.zIndex = '10000';

        document.body.appendChild(confetti);

        const angle = Math.random() * Math.PI * 2;
        const velocity = 5 + Math.random() * 10;
        const vx = Math.cos(angle) * velocity;
        const vy = Math.sin(angle) * velocity - 5;

        animateConfetti(confetti, vx, vy);
    }
}

function animateConfetti(element, vx, vy) {
    let x = 0;
    let y = 0;
    let rotation = 0;
    const gravity = 0.5;

    function update() {
        vy += gravity;
        x += vx;
        y += vy;
        rotation += 10;

        element.style.transform = `translate(${x}px, ${y}px) rotate(${rotation}deg)`;
        element.style.opacity = Math.max(0, 1 - y / 500);

        if (y < 500) {
            requestAnimationFrame(update);
        } else {
            element.remove();
        }
    }

    update();
}

function createSparkles(element) {
    const rect = element.getBoundingClientRect();

    for (let i = 0; i < 10; i++) {
        const sparkle = document.createElement('div');
        sparkle.innerHTML = '<i class="fas fa-star"></i>';
        sparkle.style.position = 'fixed';
        sparkle.style.left = rect.left + rect.width / 2 + 'px';
        sparkle.style.top = rect.top + rect.height / 2 + 'px';
        sparkle.style.color = '#ffc107';
        sparkle.style.pointerEvents = 'none';
        sparkle.style.zIndex = '10000';
        sparkle.style.fontSize = '1rem';

        document.body.appendChild(sparkle);

        const angle = (Math.PI * 2 * i) / 10;
        const distance = 50 + Math.random() * 30;
        const tx = Math.cos(angle) * distance;
        const ty = Math.sin(angle) * distance;

        sparkle.animate([
            {
                transform: 'translate(0, 0) scale(0) rotate(0deg)',
                opacity: 1
            },
            {
                transform: `translate(${tx}px, ${ty}px) scale(1) rotate(360deg)`,
                opacity: 0
            }
        ], {
            duration: 800,
            easing: 'ease-out'
        }).onfinish = () => sparkle.remove();
    }
}

function showNotification(message, type = 'info') {
    const container = document.getElementById('notification-container');
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;

    const icon = type === 'success'
        ? '<i class="fas fa-check-circle"></i>'
        : '<i class="fas fa-info-circle"></i>';

    notification.innerHTML = `
        ${icon}
        <div>
            <strong>${type === 'success' ? 'Success!' : 'Info'}</strong>
            <p style="margin: 0; font-size: 0.9rem; color: var(--text-gray);">${message}</p>
        </div>
    `;

    container.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function showRandomNotifications() {
    const messages = [
        { text: 'John earned 200 PKR just now!', type: 'success' },
        { text: 'Sarah unlocked a new badge!', type: 'success' },
        { text: 'Ahmed reached Level 10!', type: 'success' },
        { text: 'New user joined your network!', type: 'success' }
    ];

    let notificationCount = 0;
    const maxNotifications = 3;

    function showRandomNotification() {
        if (notificationCount >= maxNotifications) return;

        const randomMessage = messages[Math.floor(Math.random() * messages.length)];
        showNotification(randomMessage.text, randomMessage.type);
        notificationCount++;

        if (notificationCount < maxNotifications) {
            setTimeout(showRandomNotification, 5000 + Math.random() * 5000);
        }
    }

    setTimeout(showRandomNotification, 3000);
}

function copyReferralLink() {
    const input = document.querySelector('.referral-input');
    input.select();
    input.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(input.value).then(() => {
        showNotification('Referral link copied to clipboard!', 'success');

        const btn = document.querySelector('.btn-copy');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';

        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    });
}

const style = document.createElement('style');
style.textContent = `
    @keyframes bounce-card {
        0%, 100% { transform: translateY(-10px) scale(1); }
        50% { transform: translateY(-15px) scale(1.02); }
    }

    @keyframes pulse-card {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
`;
document.head.appendChild(style);