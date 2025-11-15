document.addEventListener('DOMContentLoaded', () => {

    // --- Set current year in footer ---
    const currentYearElement = document.getElementById('current-year');
    if (currentYearElement) {
        currentYearElement.textContent = new Date().getFullYear();
    }

    // --- Mobile menu toggle ---
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuSpans = mobileMenuButton.querySelectorAll('span');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            // Toggle Tailwind classes
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('max-h-0');
            mobileMenu.classList.toggle('py-4'); // Add padding when open
            
            // Animate hamburger icon
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenuButton.setAttribute('aria-expanded', isOpen);
            
            menuSpans[0].classList.toggle('translate-y-[7px]', isOpen);
            menuSpans[0].classList.toggle('rotate-45', isOpen);
            menuSpans[1].classList.toggle('opacity-0', isOpen);
            menuSpans[2].classList.toggle('-translate-y-[7px]', isOpen);
            menuSpans[2].classList.toggle('-rotate-45', isOpen);
        });
    }

    // --- Scroll animations ---
    const sections = document.querySelectorAll('.section, .animate, .animate-slide-left, .animate-slide-right');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                // Optional: remove to re-animate every time
                // entry.target.classList.remove('visible'); 
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    sections.forEach(section => observer.observe(section));

    // --- Smooth scrolling for anchor links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Close mobile menu if open
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenuButton.click();
            }
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Adjust for sticky nav height (approx 80px)
                const offsetTop = targetElement.offsetTop - 80; 
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // --- Lightbox functionality (FIXED) ---
    const lightbox = document.getElementById('lightbox');
    const lightboxCloseButton = document.querySelector('#lightbox .close');

    window.openLightbox = function(img) {
        if (lightbox) {
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.getElementById('lightbox-img').src = img.src;
            document.getElementById('lightbox-caption').innerText = img.alt;
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }
    }

    window.closeLightbox = function() {
        if (lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = 'auto'; // Restore scroll
        }
    }

    // Add click listener for close button
    if (lightboxCloseButton) {
        lightboxCloseButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent click from bubbling to lightbox background
            closeLightbox();
        });
    }

    // Add click listener for lightbox background
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            // Only close if the background (e.target) is clicked, not the image itself
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
    }
    
    // Close lightbox with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
    // --- End of Lightbox fix ---


    // --- "Applications Closed" Alert ---
    const closedButtons = document.querySelectorAll('a[data-status="closed"]');
    const alertContainer = document.getElementById('alertContainer');

    closedButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            
            // Create alert
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert bg-yellow-400 border border-yellow-500 text-yellow-900 px-4 py-3 rounded-lg shadow-md relative flex items-center gap-3 opacity-0 transition-all duration-300 transform -translate-y-4';
            alertDiv.innerHTML = `
                <span class="alert-icon text-xl">⚠️</span>
                <span>Applications are currently closed. Please wait for the next round.</span>
                <button class="alert-close absolute top-2 right-2 text-yellow-900 hover:text-black">&times;</button>
            `;
            
            // Remove any existing alert
            if(alertContainer.firstChild) {
                alertContainer.removeChild(alertContainer.firstChild);
            }
            
            alertContainer.appendChild(alertDiv);
            
            // Animate in
            setTimeout(() => {
                alertDiv.classList.remove('opacity-0', '-translate-y-4');
                alertDiv.classList.add('opacity-100', 'translate-y-0');
            }, 10);
            
            // Add close functionality
            alertDiv.querySelector('.alert-close').addEventListener('click', function() {
                alertDiv.classList.add('opacity-0');
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.parentNode.removeChild(alertDiv);
                    }
                }, 300);
            });

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                     alertDiv.classList.add('opacity-0');
                     setTimeout(() => {
                        if (alertDiv.parentNode) {
                            alertDiv.parentNode.removeChild(alertDiv);
                        }
                     }, 300);
                }
            }, 5000);
        });
    });
    
    // --- Modal functionality ---
    const modals = document.querySelectorAll('.modal');
    const openButtons = document.querySelectorAll('.more-details');
    const modalCloseButtons = document.querySelectorAll('.modal .close'); // Renamed to avoid conflict

    openButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if(modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }
      });
    });

    const closeModal = (modal) => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto'; // Restore scroll
    };

    modalCloseButtons.forEach(btn => { // Use the new variable name
      btn.addEventListener('click', () => {
        closeModal(btn.closest('.modal'));
      });
    });

    // Close modal on background click
    window.addEventListener('click', (e) => {
      modals.forEach(modal => {
        if (e.target === modal) {
            closeModal(modal);
        }
      });
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    closeModal(modal);
                }
            });
        }
    });

    // --- Tab switching inside modal ---
    const tabLinks = document.querySelectorAll('.tab-link');
    tabLinks.forEach(tab => {
      tab.addEventListener('click', () => {
        const tabId = tab.getAttribute('data-tab');
        const modalContent = tab.closest('.modal-content');
        
        modalContent.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
        modalContent.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        
        tab.classList.add('active');
        modalContent.querySelector(`#${tabId}`).classList.remove('hidden');
      });
    });

}); // End 
