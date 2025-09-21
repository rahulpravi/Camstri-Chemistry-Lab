// Set current year in footer
const currentYearElement = document.getElementById('current-year');
if (currentYearElement) {
    currentYearElement.textContent = new Date().getFullYear();
}

// Mobile menu toggle
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        mobileMenuButton.setAttribute('aria-expanded', mobileMenu.classList.contains('open'));
    });
}

// Scroll animations
const sections = document.querySelectorAll('.section');
const cards = document.querySelectorAll('.about-card, .research-card, .instrument-card, .team-card, .contact-info, .contact-form, .map-container');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        } else {
            entry.target.classList.remove('visible'); // Optional: re-animate on scroll
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

sections.forEach(section => observer.observe(section));
cards.forEach(card => observer.observe(card));

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        if (mobileMenu && mobileMenu.classList.contains('open')) {
            mobileMenu.classList.remove('open');
            if (mobileMenuButton) {
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        }
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        } else {
            console.warn(`Target element ${targetId} not found`);
        }
    });
});

// Lightbox functionality
function openLightbox(img) {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'flex';
    document.getElementById('lightbox-img').src = img.src;
    document.getElementById('lightbox-caption').innerText = img.alt;
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}

// Close lightbox with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && document.getElementById('lightbox').style.display === 'flex') {
        closeLightbox();
    }
});

// Select all buttons with data-status="closed"
        const closedButtons = document.querySelectorAll('a[data-status="closed"]');
        const alertContainer = document.getElementById('alertContainer');

        // Add click event listener to each closed button
        closedButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                // Create alert with icon
                alertContainer.innerHTML = `
                    <div class="alert show">
                        <span class="alert-icon">⚠️</span>
                        <span>Applications are currently closed. Please wait for the next round.</span>
                        <button class="alert-close">✕</button>
                    </div>
                `;
                // Add close functionality
                const closeButton = document.querySelector('.alert-close');
                closeButton.addEventListener('click', function() {
                    const alert = document.querySelector('.alert');
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 300); // Remove after fade-out
                });
            });
        });
        
        // Modal functionality
const modals = document.querySelectorAll('.modal');
const openButtons = document.querySelectorAll('.more-details');
const closeButtons = document.querySelectorAll('.modal .close');

openButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const modalId = btn.getAttribute('data-modal');
    document.getElementById(modalId).style.display = 'flex';
  });
});

closeButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    btn.closest('.modal').style.display = 'none';
  });
});

window.addEventListener('click', (e) => {
  modals.forEach(modal => {
    if (e.target === modal) modal.style.display = 'none';
  });
});

// Tab switching inside modal
const tabLinks = document.querySelectorAll('.tab-link');
tabLinks.forEach(tab => {
  tab.addEventListener('click', () => {
    const tabId = tab.getAttribute('data-tab');
    document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    tab.classList.add('active');
    document.getElementById(tabId).classList.add('active');
  });
});