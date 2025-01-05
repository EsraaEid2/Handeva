<!-- Footer Area Start -->
<footer class="site-footer">


    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Map Column -->
                <div class="footer-column footer-map">
                    <h4 class="footer-heading">Find Us</h4>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019284923!2d144.963057915316!3d-37.81410797975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d9f0b1b1b1b1!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1614151234567!5m2!1sen!2sau"
                            width="100%" height="200" loading="lazy" class="map-frame">
                        </iframe>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div class="footer-column footer-nav">
                    <h4 class="footer-heading">Quick Links</h4>
                    <nav class="footer-menu">
                        <ul class="footer-links">
                            <li><a href="{{ route('user.home') }}" class="footer-link">Home</a></li>
                            <li><a href="{{ route('collections') }}" class="footer-link">Shop</a></li>
                            <li><a href="{{ route('theme.about') }}" class="footer-link">About Us</a></li>
                            <li><a href="{{ route('theme.contact') }}" class="footer-link">Contact Us</a></li>
                            <li><a href="{{ route('login_register') }}" class="footer-link">Join as Vendor</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Contact Column -->
                <div class="footer-column footer-contact">
                    <h4 class="footer-heading">Contact Us</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="contact-icon email-icon"></i>
                            <p style="color:var(--secondary-color)">Handéva@gmail.com</p>
                        </div>
                        <div class="contact-item">
                            <i class="contact-icon location-icon"></i>
                            <p style="color:var(--secondary-color)">7th circle, Amman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="copyright" style="color:var(--secondary-color)">© {{ date('Y') }} Handmade Treasures. All rights
                reserved.</p>
        </div>
    </div>
</footer>
<!-- Footer Area End -->