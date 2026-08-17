<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<section class="section page-hero" aria-labelledby="contact-heading">
    <div class="container">
        <h1 class="page-title" id="contact-heading">Contact Us</h1>
        <p class="page-subtitle">We would love to hear from you.</p>
    </div>
</section>

<section class="section contact-section" id="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2 class="contact-info-title">Get in Touch</h2>
                <ul class="contact-details">
                    <li>
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span>Serona Resort, Sri Lanka</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <a href="tel:+94XXXXXXXXX">+94 XX XXX XXXX</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                        <a href="mailto:<?= e(ADMIN_EMAIL) ?>"><?= e(ADMIN_EMAIL) ?></a>
                    </li>
                </ul>
                <a href="<?= (new WhatsAppService())->generateGeneralUrl() ?>" class="btn btn-whatsapp" target="_blank" rel="noopener noreferrer" id="contact-whatsapp-btn">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Chat on WhatsApp
                </a>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <form
                    action="<?= base_url('contact.php') ?>"
                    method="POST"
                    class="contact-form"
                    id="contact-form"
                    novalidate
                >
                    <?= csrf_field() ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name <span aria-hidden="true">*</span></label>
                            <input type="text" id="name" name="name" class="form-input" value="<?= old('name') ?>" required autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address <span aria-hidden="true">*</span></label>
                            <input type="email" id="email" name="email" class="form-input" value="<?= old('email') ?>" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-input" value="<?= old('phone') ?>" autocomplete="tel">
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-input" value="<?= old('subject') ?>">
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">Message <span aria-hidden="true">*</span></label>
                        <textarea id="message" name="message" class="form-textarea" rows="5" required><?= old('message') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="contact-submit-btn">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
