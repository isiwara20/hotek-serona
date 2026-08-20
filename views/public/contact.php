<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC CONTACT HERO
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section contact-hero" id="contact-hero" aria-labelledby="contact-hero-title">
    <div class="hero-bg-wrapper">
        <img
            src="<?= asset('images/hero/hero-bg.jpg') ?>"
            alt="Serona Hotel & Resort lush tropical landscape in Sigiriya Sri Lanka"
            class="hero-bg-image"
        >
        <div class="hero-overlay contact-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">
                <i class="fa-solid fa-compass" aria-hidden="true" style="font-size: 0.8rem; color: var(--color-sage-light);"></i>
                SERONA HOTEL &amp; RESORT — GET IN TOUCH
            </span>
            <h1 class="hero-title" id="contact-hero-title">Connect with<br>Nature’s Embrace</h1>
            <p class="hero-subtitle">
                Whether planning a tranquil getaway, a private dining event, or a bespoke excursion across Sigiriya, our dedicated concierge team is at your service 24/7.
            </p>
            <div class="hero-actions contact-hero-actions">
                <a href="#contact-form-section" class="btn btn-light" id="hero-send-msg-btn">
                    Send a Message <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                </a>
                <a href="#contact-channels" class="btn btn-outline-white" id="hero-direct-channels-btn">
                    Direct Channels <i class="fa-solid fa-phone" aria-hidden="true"></i>
                </a>
                <a href="#contact-map" class="btn btn-outline-white" id="hero-location-btn">
                    Location &amp; Map <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="contact-hero-decoration" aria-hidden="true">
        <i class="fa-solid fa-leaf"></i>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. DIRECT CONTACT CHANNELS
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory contact-channels-section" id="contact-channels" aria-labelledby="channels-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">DIRECT COMMUNICATION</span>
            <h2 class="section-title" id="channels-heading">How May We Assist You Today?</h2>
            <p class="section-subtitle">Connect directly with our reservation specialists, concierge desk, or host team.</p>
        </div>

        <div class="contact-cards-grid">
            <!-- Card 1: Reservations -->
            <div class="contact-card reveal-up">
                <div class="contact-card-icon-badge">
                    <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                </div>
                <h3 class="contact-card-title">Room Reservations</h3>
                <p class="contact-card-desc">Direct room bookings, suite availability &amp; group packages.</p>
                <div class="contact-card-value">
                    <a href="tel:0777872280" class="contact-link">+94 77 787 2280</a>
                </div>
                <span class="contact-card-meta"><i class="fa-solid fa-clock" aria-hidden="true"></i> Available 24/7</span>
                <a href="tel:0777872280" class="btn btn-outline-dark btn-sm full-width margin-top-auto">
                    Call Reservations <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Card 2: Concierge Desk -->
            <div class="contact-card reveal-up">
                <div class="contact-card-icon-badge">
                    <i class="fa-solid fa-hotel" aria-hidden="true"></i>
                </div>
                <h3 class="contact-card-title">Front Desk &amp; Concierge</h3>
                <p class="contact-card-desc">Guest arrivals, airport transfers &amp; on-property requests.</p>
                <div class="contact-card-value">
                    <a href="tel:0817872280" class="contact-link">+94 81 787 2280</a>
                </div>
                <span class="contact-card-meta"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Front Desk Support</span>
                <a href="tel:0817872280" class="btn btn-outline-dark btn-sm full-width margin-top-auto">
                    Call Front Desk <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Card 3: Email Support -->
            <div class="contact-card reveal-up">
                <div class="contact-card-icon-badge">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                </div>
                <h3 class="contact-card-title">Email Inquiries</h3>
                <p class="contact-card-desc">Detailed itineraries, dining requests &amp; media inquiries.</p>
                <div class="contact-card-value">
                    <a href="mailto:<?= e(ADMIN_EMAIL) ?>" class="contact-link text-truncate"><?= e(ADMIN_EMAIL) ?></a>
                </div>
                <span class="contact-card-meta"><i class="fa-solid fa-reply" aria-hidden="true"></i> Responds within 2 hrs</span>
                <a href="mailto:<?= e(ADMIN_EMAIL) ?>" class="btn btn-outline-dark btn-sm full-width margin-top-auto">
                    Send an Email <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Card 4: WhatsApp Direct -->
            <div class="contact-card contact-card-highlight reveal-up">
                <div class="contact-card-icon-badge whatsapp-badge">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                </div>
                <h3 class="contact-card-title">WhatsApp Instant</h3>
                <p class="contact-card-desc">Instant real-time messaging with our guest relation host.</p>
                <div class="contact-card-value">
                    <span class="whatsapp-status-dot"></span> Online Now
                </div>
                <span class="contact-card-meta"><i class="fa-solid fa-bolt" aria-hidden="true"></i> Fastest Response</span>
                <a href="<?= (new WhatsAppService())->generateGeneralUrl() ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-sm full-width margin-top-auto">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. CONTACT FORM & CONCIERGE INFORMATION SPLIT
     ───────────────────────────────────────────────────────────── -->
<section class="section contact-form-section" id="contact-form-section" aria-labelledby="contact-form-title">
    <div class="container">
        <div class="contact-main-grid">

            <!-- Left Column: Serona Hospitality Promise -->
            <div class="contact-info-column reveal-left">
                <span class="eyebrow-label">EXCELLENCE IN HOSPITALITY</span>
                <h2 class="section-title" id="contact-form-title">We Are Here to Assist Your Journey</h2>
                <p class="contact-lead-text">
                    From arranging private luxury chauffeur transfers from Bandaranaike Airport to setting up romantic candlelit dinners under Sri Lanka's starry night sky, every detail of your stay is effortlessly managed.
                </p>

                <!-- Feature Highlights -->
                <div class="contact-feature-list">
                    <div class="contact-feature-item">
                        <div class="contact-feature-icon">
                            <i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i>
                        </div>
                        <div class="contact-feature-content">
                            <h4>24/7 Dedicated Concierge</h4>
                            <p>Round-the-clock support for pre-arrival requests, room upgrades, and local transport.</p>
                        </div>
                    </div>

                    <div class="contact-feature-item">
                        <div class="contact-feature-icon">
                            <i class="fa-solid fa-shield-heart" aria-hidden="true"></i>
                        </div>
                        <div class="contact-feature-content">
                            <h4>Direct Booking Benefits</h4>
                            <p>Enjoy guaranteed best rates, flexible cancellation policies, and welcome amenities.</p>
                        </div>
                    </div>

                    <div class="contact-feature-item">
                        <div class="contact-feature-icon">
                            <i class="fa-solid fa-car-side" aria-hidden="true"></i>
                        </div>
                        <div class="contact-feature-content">
                            <h4>Private Chauffeur Service</h4>
                            <p>Air-conditioned private vehicle transfers available to and from anywhere in Sri Lanka.</p>
                        </div>
                    </div>

                    <div class="contact-feature-item">
                        <div class="contact-feature-icon">
                            <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                        </div>
                        <div class="contact-feature-content">
                            <h4>Eco-Luxury Hospitality</h4>
                            <p>Crafted experiences honoring Sigiriya's natural beauty and rich cultural heritage.</p>
                        </div>
                    </div>
                </div>

                <!-- Operating Hours Card -->
                <div class="contact-hours-card">
                    <h4 class="hours-card-title">
                        <i class="fa-solid fa-calendar-days" aria-hidden="true"></i> Resort Operating Hours
                    </h4>
                    <ul class="hours-list">
                        <li>
                            <span class="hours-label">Front Desk &amp; Concierge</span>
                            <span class="hours-value">24 Hours / 7 Days</span>
                        </li>
                        <li>
                            <span class="hours-label">Main Restaurant &amp; Dining</span>
                            <span class="hours-value">06:30 AM – 10:30 PM</span>
                        </li>
                        <li>
                            <span class="hours-label">Serona Spa &amp; Wellness</span>
                            <span class="hours-value">08:00 AM – 08:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Interactive Luxury Contact Form -->
            <div class="contact-form-column reveal-right">
                <div class="contact-form-card">
                    <div class="form-card-header">
                        <h3 class="form-card-title">Send Us a Message</h3>
                        <p class="form-card-subtitle">Fill in your details below and our team will get back to you promptly.</p>
                    </div>

                    <form
                        action="<?= base_url('contact.php') ?>"
                        method="POST"
                        class="contact-form-element"
                        id="contact-form"
                        novalidate
                    >
                        <?= csrf_field() ?>

                        <div class="form-row-two-col">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name <span class="required-star">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa-regular fa-user input-icon" aria-hidden="true"></i>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-input"
                                        placeholder="e.g. Eleanor Vance"
                                        value="<?= old('name') ?>"
                                        required
                                        autocomplete="name"
                                    >
                                </div>
                                <span class="field-error-msg" id="name-error"></span>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address <span class="required-star">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa-regular fa-envelope input-icon" aria-hidden="true"></i>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-input"
                                        placeholder="e.g. eleanor@example.com"
                                        value="<?= old('email') ?>"
                                        required
                                        autocomplete="email"
                                    >
                                </div>
                                <span class="field-error-msg" id="email-error"></span>
                            </div>
                        </div>

                        <div class="form-row-two-col">
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone / WhatsApp Number</label>
                                <div class="input-with-icon">
                                    <i class="fa-solid fa-phone input-icon" aria-hidden="true"></i>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        class="form-input"
                                        placeholder="+94 77 123 4567"
                                        value="<?= old('phone') ?>"
                                        autocomplete="tel"
                                    >
                                </div>
                            </div>

                            <!-- Subject Dropdown -->
                            <div class="form-group">
                                <label for="subject" class="form-label">Enquiry Topic</label>
                                <div class="input-with-icon">
                                    <i class="fa-solid fa-list-check input-icon" aria-hidden="true"></i>
                                    <select id="subject" name="subject" class="form-select">
                                        <option value="General Enquiry" <?= old('subject') === 'General Enquiry' ? 'selected' : '' ?>>General Enquiry</option>
                                        <option value="Room &amp; Suite Reservation" <?= old('subject') === 'Room & Suite Reservation' ? 'selected' : '' ?>>Room &amp; Suite Reservation</option>
                                        <option value="Private Dining &amp; Culinary Event" <?= old('subject') === 'Private Dining & Culinary Event' ? 'selected' : '' ?>>Private Dining &amp; Culinary Event</option>
                                        <option value="Spa &amp; Wellness Packages" <?= old('subject') === 'Spa & Wellness Packages' ? 'selected' : '' ?>>Spa &amp; Wellness Packages</option>
                                        <option value="Excursions &amp; Sigiriya Tours" <?= old('subject') === 'Excursions & Sigiriya Tours' ? 'selected' : '' ?>>Excursions &amp; Sigiriya Tours</option>
                                        <option value="Weddings &amp; Special Celebrations" <?= old('subject') === 'Weddings & Special Celebrations' ? 'selected' : '' ?>>Weddings &amp; Special Celebrations</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="form-group">
                            <label for="message" class="form-label">Your Message <span class="required-star">*</span></label>
                            <textarea
                                id="message"
                                name="message"
                                class="form-textarea"
                                rows="5"
                                placeholder="Please share details about your travel dates, room preferences, or special requests..."
                                required
                            ><?= old('message') ?></textarea>
                            <div class="textarea-footer">
                                <span class="field-error-msg" id="message-error"></span>
                                <span class="char-count" id="char-count">0 / 2000</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-forest btn-lg full-width" id="contact-submit-btn">
                            <span>Send Message</span> <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                        </button>

                        <div class="form-privacy-note">
                            <i class="fa-solid fa-lock" aria-hidden="true"></i>
                            Your personal details are kept strictly confidential under our Privacy Policy.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     4. LOCATION, DIRECTIONS & MAP SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory contact-map-section" id="contact-map" aria-labelledby="location-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">FINDING SERONA</span>
            <h2 class="section-title" id="location-heading">Located in the Heart of Sigiriya</h2>
            <p class="section-subtitle">Surrounded by ancient heritage, lush greenery, and serene natural views.</p>
        </div>

        <div class="location-split-grid">
            <!-- Google Maps Embed Card -->
            <div class="map-wrapper-card reveal-left">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.498372651478!2d80.75841231477965!3d7.952936294272186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afca0d014c27891%3A0xb351e39a3f2d26f6!2sSigiriya%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1692000000000!5m2!1sen!2slk"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Serona Hotel & Resort Sigiriya Location Map"
                    ></iframe>
                </div>
                <div class="map-badge-bar">
                    <div class="map-badge-item">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span>Serona Hotel &amp; Resort, Sigiriya Road, Central Province, Sri Lanka</span>
                    </div>
                    <a href="https://maps.google.com/?q=Sigiriya,+Sri+Lanka" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-xs">
                        Open in Google Maps <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <!-- Transport & Distances List -->
            <div class="directions-card reveal-right">
                <h3 class="directions-title">
                    <i class="fa-solid fa-route" aria-hidden="true"></i> Key Distances &amp; Travel Times
                </h3>
                <p class="directions-subtitle">We can organize seamless private transfer vehicles directly to our lobby.</p>

                <div class="distance-items-list">
                    <div class="distance-item">
                        <div class="distance-icon"><i class="fa-solid fa-plane-departure" aria-hidden="true"></i></div>
                        <div class="distance-details">
                            <h4>Bandaranaike International Airport (CMB)</h4>
                            <p>148 km &bull; Approx 3 hrs 15 mins via Highway &amp; A6</p>
                        </div>
                    </div>

                    <div class="distance-item">
                        <div class="distance-icon"><i class="fa-solid fa-mountain" aria-hidden="true"></i></div>
                        <div class="distance-details">
                            <h4>Sigiriya Lion Rock Fortress</h4>
                            <p>4.5 km &bull; 10 mins private resort shuttle</p>
                        </div>
                    </div>

                    <div class="distance-item">
                        <div class="distance-icon"><i class="fa-solid fa-gopuram" aria-hidden="true"></i></div>
                        <div class="distance-details">
                            <h4>Dambulla Cave Temple Complex</h4>
                            <p>16 km &bull; 20 mins drive</p>
                        </div>
                    </div>

                    <div class="distance-item">
                        <div class="distance-icon"><i class="fa-solid fa-city" aria-hidden="true"></i></div>
                        <div class="distance-details">
                            <h4>Kandy Cultural Capital</h4>
                            <p>72 km &bull; 1.5 hrs scenic drive</p>
                        </div>
                    </div>
                </div>

                <div class="airport-transfer-box">
                    <div class="transfer-box-icon"><i class="fa-solid fa-taxi" aria-hidden="true"></i></div>
                    <div class="transfer-box-text">
                        <h5>Require Airport Transfer?</h5>
                        <p>Our chauffeur vehicles are sanitized, air-conditioned &amp; available 24/7 upon request.</p>
                    </div>
                    <a href="https://wa.me/94777872280?text=Hello%20Serona%20Resort,%20I%20would%20like%20to%20enquire%20about%20an%20airport%20transfer." target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-xs">
                        Book Transfer
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. FREQUENTLY ASKED QUESTIONS (FAQ) ACCORDION
     ───────────────────────────────────────────────────────────── -->
<section class="section contact-faq-section" id="contact-faq" aria-labelledby="faq-heading">
    <div class="container container-narrow">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">NEED QUICK ANSWERS?</span>
            <h2 class="section-title" id="faq-heading">Frequently Asked Questions</h2>
            <p class="section-subtitle">Common questions regarding reservations, transfers, and your stay at Serona.</p>
        </div>

        <div class="faq-accordion-wrapper reveal-up">
            <!-- FAQ 1 -->
            <div class="faq-item">
                <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-1">
                    <span class="faq-question">What are the check-in and check-out times at Serona Hotel &amp; Resort?</span>
                    <i class="fa-solid fa-chevron-down faq-icon" aria-hidden="true"></i>
                </button>
                <div class="faq-content" id="faq-ans-1" hidden>
                    <p>Standard check-in begins at <strong>2:00 PM</strong> and check-out is until <strong>11:00 AM</strong>. Early check-in or late check-out can be requested in advance and is subject to room availability.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item">
                <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-2">
                    <span class="faq-question">Does Serona offer airport pick-up and drop-off transfers?</span>
                    <i class="fa-solid fa-chevron-down faq-icon" aria-hidden="true"></i>
                </button>
                <div class="faq-content" id="faq-ans-2" hidden>
                    <p>Yes! We provide private luxury air-conditioned chauffeur transfers to and from Bandaranaike International Airport (CMB) as well as Colombo city. Please share your flight details with our reservations team at least 24 hours prior to arrival.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item">
                <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-3">
                    <span class="faq-question">Can special dietary needs (Vegan, Gluten-Free, Halal) be accommodated?</span>
                    <i class="fa-solid fa-chevron-down faq-icon" aria-hidden="true"></i>
                </button>
                <div class="faq-content" id="faq-ans-3" hidden>
                    <p>Absolutely. Our executive culinary team specializes in customized dining. We happily cater to Vegetarian, Vegan, Gluten-Free, Halal, and specific allergy requirements. Kindly mention your preferences when submitting your message or booking.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item">
                <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-4">
                    <span class="faq-question">How far is the resort from Sigiriya Lion Rock Fortress?</span>
                    <i class="fa-solid fa-chevron-down faq-icon" aria-hidden="true"></i>
                </button>
                <div class="faq-content" id="faq-ans-4" hidden>
                    <p>Serona Resort is located just 4.5 km (approx 10 minutes drive) from the Sigiriya Lion Rock Fortress. We provide complimentary advice, guided excursion bookings, and private tuk-tuk or car transfers to both Sigiriya and Pidurangala Rock.</p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item">
                <button type="button" class="faq-trigger" aria-expanded="false" aria-controls="faq-ans-5">
                    <span class="faq-question">What is the cancellation policy for direct reservations?</span>
                    <i class="fa-solid fa-chevron-down faq-icon" aria-hidden="true"></i>
                </button>
                <div class="faq-content" id="faq-ans-5" hidden>
                    <p>Direct bookings offer the most flexible terms! Cancellations made up to 7 days prior to arrival qualify for full refunds or free date modifications. For detailed seasonal terms, please contact our reservations team.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
