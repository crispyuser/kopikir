// Enhanced navigation functionality
document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    const navLinks = document.querySelectorAll('.nav-link');
    const navBrand = document.querySelector('.text-xl.font-bold');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    
    // Set initial state
    function updateNavbarStyle() {
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
                
                // Update text colors for better visibility on white background
                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-amber-300');
                    link.classList.add('text-gray-700', 'hover:text-amber-800');
                });
                
                if (navBrand) {
                    navBrand.classList.remove('text-white');
                    navBrand.classList.add('text-gray-800');
                }
                
                if (mobileMenuButton) {
                    mobileMenuButton.classList.remove('text-white', 'hover:text-amber-300');
                    mobileMenuButton.classList.add('text-gray-700', 'hover:text-amber-800');
                }
            } else {
                navbar.classList.remove('bg-white', 'shadow-lg');
                navbar.classList.add('bg-transparent');
                
                // Reset text colors for transparent background
                navLinks.forEach(link => {
                    link.classList.remove('text-gray-700', 'hover:text-amber-800');
                    link.classList.add('text-white', 'hover:text-amber-300');
                });
                
                if (navBrand) {
                    navBrand.classList.remove('text-gray-800');
                    navBrand.classList.add('text-white');
                }
                
                if (mobileMenuButton) {
                    mobileMenuButton.classList.remove('text-gray-700', 'hover:text-amber-800');
                    mobileMenuButton.classList.add('text-white', 'hover:text-amber-300');
                }
            }
        }
    }
    
    // Apply initial state
    updateNavbarStyle();
    
    // Update on scroll
    if (navbar) {
        window.addEventListener('scroll', updateNavbarStyle);
    }

    // Mobile menu toggle
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            // Handle external links
            if (targetId.startsWith('http')) {
                window.open(targetId, '_blank');
                return;
            }
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            // Simple validation
            if (!name || !email || !message) {
                alert('Please fill in all fields.');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Show success message
            alert(`Terima kasih ${name}! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.`);
            
            // Reset form
            contactForm.reset();
        });
    }

    // Animation on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
            }
        });
    }, observerOptions);

    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Add hover effects to buttons
    const buttons = document.querySelectorAll('button, .btn-hover');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.classList.add('btn-hover');
        });
        
        button.addEventListener('mouseleave', function() {
            this.classList.remove('btn-hover');
        });
    });
});