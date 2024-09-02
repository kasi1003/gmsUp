<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly Tomb - Graveyard Management System</title>
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="landing-page.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
        integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="overlay">
            <div class="content">
                <h1>Heavenly Tomb - Preserving Memories with Dignity</h1>
                <p>Efficiently manage, locate, and honor those who rest in peace.</p>
                <div class="cta-buttons">
                    <a href="#get-started" class="btn-primary">Get Started</a>
                    <a href="#features" class="btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services/Features Section -->
    <section id="features" class="features-section">
        <h2>Our Features</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Cemetery Locator</h3>
                <p>Easily find loved ones across various cemeteries.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-list-alt"></i>
                <h3>Plot Management</h3>
                <p>Manage and organize plots effortlessly.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-calendar-alt"></i>
                <h3>Memorial Services</h3>
                <p>Schedule and manage memorial services.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-map"></i>
                <h3>Interactive Maps</h3>
                <p>View and navigate cemetery layouts.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <h2>What Our Users Say</h2>
        <div class="testimonials-carousel">
            <div class="testimonial-item">
                <p>"Heavenly Tomb made it so easy to find and honor my ancestors. The service is respectful and efficient."</p>
                <h4>- Sarah J.</h4>
            </div>
            <div class="testimonial-item">
                <p>"A truly remarkable service that has brought peace to our family. We can now manage everything from one place."</p>
                <h4>- Michael T.</h4>
            </div>
            <div class="testimonial-item">
                <p>"The interactive map is a game changer. It’s so easy to find the exact location of my loved ones."</p>
                <h4>- Linda W.</h4>
            </div>
        </div>
    </section>

    <!-- Interactive Map Section -->
    <section class="map-section">
        <h2>Explore Our Cemeteries</h2>
        <div class="map-container">
            <p>Interactive Map Placeholder</p>
            <!-- Replace with actual map integration (e.g., Google Maps API) -->
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section">
        <h2>How It Works</h2>
        <div class="steps-container">
            <div class="step-item">
                <i class="fas fa-search"></i>
                <h3>Search</h3>
                <p>Find a cemetery or a loved one’s resting place.</p>
            </div>
            <div class="step-item">
                <i class="fas fa-info-circle"></i>
                <h3>View Information</h3>
                <p>Access detailed information and memorials.</p>
            </div>
            <div class="step-item">
                <i class="fas fa-calendar-check"></i>
                <h3>Schedule Services</h3>
                <p>Manage and schedule memorial services.</p>
            </div>
            <div class="step-item">
                <i class="fas fa-phone-alt"></i>
                <h3>Contact Us</h3>
                <p>Get assistance for any other queries.</p>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2>Stay Connected</h2>
            <p>Get updates and memorial reminders delivered to your inbox.</p>
            <form action="#" method="post">
                <input type="email" name="email" placeholder="Enter your email">
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
            <small>Your privacy is important to us.</small>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact Us</h4>
                <p>Phone: (123) 456-7890</p>
                <p>Email: support@heavenlytomb.com</p>
                <p>Address: 123 Peaceful Lane, Serenity City, ST 12345</p>
            </div>
            <div class="footer-column">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Heavenly Tomb. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Testimonials Carousel -->
    <script>
        // Basic auto-scrolling carousel
        const testimonials = document.querySelector('.testimonials-carousel');
        let index = 0;
        setInterval(() => {
            testimonials.scrollBy({ left: testimonials.clientWidth, behavior: 'smooth' });
            index++;
            if (index >= testimonials.children.length) {
                testimonials.scrollTo({ left: 0, behavior: 'smooth' });
                index = 0;
            }
        }, 5000);
    </script>
</body>

</html>
