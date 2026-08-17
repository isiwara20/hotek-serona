</main><!-- /#main-content -->

<footer class="site-footer" id="site-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <a href="<?= base_url() ?>" class="footer-logo-link" aria-label="<?= e(APP_NAME) ?>">
                <span class="footer-brand-name"><?= e(APP_NAME) ?></span>
                <span class="footer-tagline"><?= e(APP_TAGLINE) ?></span>
            </a>
            <p class="footer-description">
                An eco-luxury retreat where nature and premium hospitality unite.
            </p>
        </div>

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

        <div class="footer-contact">
            <h3 class="footer-heading">Contact</h3>
            <address>
                <p><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Serona Resort, Sri Lanka</p>
                <p><i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <a href="tel:+94XXXXXXXXX">+94 XX XXX XXXX</a>
                </p>
                <p><i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:<?= e(ADMIN_EMAIL) ?>"><?= e(ADMIN_EMAIL) ?></a>
                </p>
            </address>
        </div>

        <div class="footer-cta">
            <h3 class="footer-heading">Reserve Your Stay</h3>
            <a href="<?= base_url('booking.php') ?>" class="btn btn-primary" id="footer-book-btn">Book an Enquiry</a>
            <a href="<?= (new WhatsAppService())->generateGeneralUrl() ?>" class="btn btn-whatsapp" target="_blank" rel="noopener noreferrer" id="footer-whatsapp-btn">
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> WhatsApp Us
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= e(APP_NAME) ?>. All rights reserved.</p>
    </div>
</footer>

<!-- JavaScript -->
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
