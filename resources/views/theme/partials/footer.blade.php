<!-- Footer Area Start -->
<div class="custom-footer">
    <div class="container">
        <div class="row">
            <!-- Map Section -->
            <div class="col-lg-4">
                <div class="custom-footer-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019284923!2d144.963057915316!3d-37.81410797975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d9f0b1b1b1b1!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1614151234567!5m2!1sen!2sau"
                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <!-- Navigation Links Section -->
            <div class="col-lg-4">
                <div class="custom-footer-nav">
                    <ul>
                        <li><a href="{{ route('user.home') }}">Home</a></li>
                        <li><a href="{{ route('collections') }}">Shop</a></li>
                        <li><a href="{{ route('theme.about') }}">About Us</a></li>
                        <li><a href="{{ route('theme.contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('theme.login_register') }}">Join as Vendor</a></li>
                    </ul>
                </div>
            </div>
            <!-- Contact Info Section -->
            <div class="col-lg-4">
                <div class="custom-footer-contact">
                    <p>Email: Handéva@gmail.com</p>
                    <p>Address: 7th circle, Amman</p>
                </div>
            </div>
        </div>
        <div class="custom-footer-bottom text-center">
            <p>© {{ date('Y') }} Handmade Treasures. All rights reserved.</p>
        </div>
    </div>
</div>
<!-- Footer Area End -->