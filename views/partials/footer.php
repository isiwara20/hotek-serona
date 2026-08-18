</main><!-- /#main-content -->

<footer class="site-footer" id="site-footer">
    <div class="footer-container">
        <!-- Brand Column -->
        <div class="footer-brand">
            <a href="<?= base_url() ?>" class="footer-logo-link" aria-label="<?= e(APP_NAME) ?>">
                <img src="<?= asset('images/branding/Logo.jpeg') ?>" alt="<?= e(APP_NAME) ?>" class="footer-logo-img">
            </a>
            <span class="footer-tagline"><?= e(APP_TAGLINE) ?></span>
            <p class="footer-description">
                An eco-luxury retreat in Sri Lanka where untouched nature, refined comfort, and authentic Sri Lankan hospitality unite in perfect harmony.
            </p>
            <div class="footer-socials" aria-label="Social Media links">
                <a href="#" class="social-icon-link" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                <a href="#" class="social-icon-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                <a href="#" class="social-icon-link" aria-label="YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
                <a href="<?= (new WhatsAppService())->generateGeneralUrl() ?>" class="social-icon-link" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
            </div>
        </div>

        <!-- Explore Column -->
        <div class="footer-nav">
            <h3 class="footer-heading">Explore</h3>
            <ul role="list">
                <li><a href="<?= base_url('rooms.php') ?>">Rooms &amp; Suites</a></li>
                <li><a href="<?= base_url('dining.php') ?>">Dining</a></li>
                <li><a href="<?= base_url('experiences.php') ?>">Experiences</a></li>
                <li><a href="<?= base_url('gallery.php') ?>">Gallery</a></li>
                <li><a href="<?= base_url('about.php') ?>">About Us</a></li>
            </ul>
        </div>

        <!-- Guest Services Column -->
        <div class="footer-nav">
            <h3 class="footer-heading">Guest Services</h3>
            <ul role="list">
                <li><a href="<?= base_url('booking.php') ?>">Booking Enquiry</a></li>
                <li><a href="<?= base_url('contact.php') ?>">Contact &amp; Support</a></li>
                <li><a href="<?= base_url('contact.php#location') ?>">Location &amp; Map</a></li>
                <li><a href="<?= base_url('about.php#faq') ?>">FAQs</a></li>
                <li><a href="<?= base_url('about.php#sustainability') ?>">Sustainability Policy</a></li>
            </ul>
        </div>

        <!-- Contact Column -->
        <div class="footer-contact">
            <h3 class="footer-heading">Contact Us</h3>
            <address>
                <p><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Serona Resort, Sigiriya, Sri Lanka</p>
                <p><i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <a href="tel:+94771234567">+94 77 123 4567</a>
                </p>
                <p><i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:<?= e(ADMIN_EMAIL) ?>"><?= e(ADMIN_EMAIL) ?></a>
                </p>
                <p><i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    <a href="<?= (new WhatsAppService())->generateGeneralUrl() ?>" target="_blank" rel="noopener noreferrer">WhatsApp Direct</a>
                </p>
            </address>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; 2026 Serona Hotel &amp; Resort. All Rights Reserved.</p>
            <div class="footer-legal-links">
                <a href="#">Privacy Policy</a>
                <span>&bull;</span>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript Files -->
<script src="<?= asset('js/navigation.js') ?>"></script>
<script src="<?= asset('js/main.js') ?>"></script>
<?php if (isset($active_page) && $active_page === 'gallery'): ?>
<script src="<?= asset('js/gallery.js') ?>"></script>
<?php endif; ?>
</body>
</html>

