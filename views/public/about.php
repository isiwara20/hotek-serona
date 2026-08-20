<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC ABOUT HERO
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section about-hero" id="about-hero" aria-labelledby="about-hero-title">
    <div class="hero-bg-wrapper">
        <img
            src="<?= asset('images/hero/hero-bg.jpg') ?>"
            alt="Serona Hotel & Resort ancient forest canopy view in Sigiriya"
            class="hero-bg-image"
        >
        <div class="hero-overlay about-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">
                <i class="fa-solid fa-seedling" aria-hidden="true" style="font-size: 0.8rem; color: var(--color-sage-light);"></i>
                OUR STORY &amp; HERITAGE
            </span>
            <h1 class="hero-title" id="about-hero-title">Harmonious Luxury,<br>Rooted in Sri Lanka</h1>
            <p class="hero-subtitle">
                Serona Hotel &amp; Resort was born from a vision to create a peaceful sanctuary where untouched nature, refined Sri Lankan hospitality, and sustainable luxury exist in perfect rhythm.
            </p>
            <div class="hero-actions about-hero-actions">
                <a href="#about-philosophy" class="btn btn-light" id="hero-our-story-btn">
                    Explore Our Story <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                </a>
                <a href="#sustainability" class="btn btn-outline-white" id="hero-sustainability-btn">
                    Sustainability &amp; Eco-Luxury <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                </a>
                <a href="#facilities" class="btn btn-outline-white" id="hero-facilities-btn">
                    Resort Facilities <i class="fa-solid fa-hotel" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="about-hero-decoration" aria-hidden="true">
        <i class="fa-solid fa-tree"></i>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. RESORT VISION & PHILOSOPHY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory about-philosophy-section" id="about-philosophy" aria-labelledby="philosophy-heading">
    <div class="container">
        <div class="intro-grid">

            <!-- Left: Story & Philosophy Content -->
            <div class="intro-content reveal-left">
                <span class="eyebrow-label">NATURE’S EMBRACE</span>
                <h2 class="section-title" id="philosophy-heading">A Sanctuary Created<br>with Intention</h2>
                <p class="intro-description">
                    Set against the timeless backdrop of Sigiriya's ancient kingdom, Serona was designed not merely as a resort, but as a living sanctuary. Every villa and suite is constructed using local teak, granite stone, and high thatched ceilings to integrate seamlessly into the surrounding tropical canopy.
                </p>
                <p class="intro-description" style="margin-top: calc(var(--space-4) * -1);">
                    Our philosophy centers on gentle luxury — providing world-class, modern comfort while honoring the land, preserving native wildlife, and supporting local communities.
                </p>

                <!-- Core Pillars Grid -->
                <div class="about-pillars-grid">
                    <div class="about-pillar-item">
                        <div class="pillar-icon">
                            <i class="fa-solid fa-building-tree" aria-hidden="true"></i>
                        </div>
                        <div class="pillar-text">
                            <h4>Low-Impact Architecture</h4>
                            <p>Built with indigenous materials and natural cross-breeze airflow design.</p>
                        </div>
                    </div>

                    <div class="about-pillar-item">
                        <div class="pillar-icon">
                            <i class="fa-solid fa-bottle-water" aria-hidden="true"></i>
                        </div>
                        <div class="pillar-text">
                            <h4>Single-Use Plastic Free</h4>
                            <p>Pure glass-bottled spring water and 100% biodegradable bath amenities.</p>
                        </div>
                    </div>

                    <div class="about-pillar-item">
                        <div class="pillar-icon">
                            <i class="fa-solid fa-handshake-angle" aria-hidden="true"></i>
                        </div>
                        <div class="pillar-text">
                            <h4>Local Community First</h4>
                            <p>Over 85% of our hospitality team hail from neighbouring Sigiriya villages.</p>
                        </div>
                    </div>

                    <div class="about-pillar-item">
                        <div class="pillar-icon">
                            <i class="fa-solid fa-utensils" aria-hidden="true"></i>
                        </div>
                        <div class="pillar-text">
                            <h4>Farm-to-Table Dining</h4>
                            <p>Organic herbs, tropical fruits, and vegetables harvested daily from our garden.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Layered Image Composition -->
            <div class="intro-image-composition reveal-right">
                <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Serona Resort suite interior bathed in natural sunlight" class="intro-img-main">
                <img src="<?= asset('images/dining/dining-main.jpg') ?>" alt="Serona Resort open air garden dining view" class="intro-img-secondary">
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. THE EVOLUTION / MILESTONES TIMELINE
     ───────────────────────────────────────────────────────────── -->
<section class="section about-timeline-section" id="story-timeline" aria-labelledby="timeline-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">OUR JOURNEY</span>
            <h2 class="section-title" id="timeline-heading">The Evolution of Serona</h2>
            <p class="section-subtitle">From a quiet woodland sanctuary to Sri Lanka’s premier eco-luxury retreat.</p>
        </div>

        <div class="about-timeline-grid reveal-up">

            <!-- Milestone 1 -->
            <div class="timeline-card">
                <div class="timeline-year">2018</div>
                <h3 class="timeline-title">The Discovery</h3>
                <p class="timeline-desc">
                    Our founders discovered this pristine 12-acre forest sanctuary overlooking the Sigiriya rock horizon, committing to preserve its ancient trees and wildlife.
                </p>
            </div>

            <!-- Milestone 2 -->
            <div class="timeline-card">
                <div class="timeline-year">2020</div>
                <h3 class="timeline-title">Sustainable Craftsmanship</h3>
                <p class="timeline-desc">
                    Master Sri Lankan artisans constructed our suites using hand-carved teak, local stone masonry, and natural spring water features.
                </p>
            </div>

            <!-- Milestone 3 -->
            <div class="timeline-card">
                <div class="timeline-year">2022</div>
                <h3 class="timeline-title">Opening Nature’s Embrace</h3>
                <p class="timeline-desc">
                    Serona opened its doors welcoming international guests to experience a calm, quiet luxury where nature takes center stage.
                </p>
            </div>

            <!-- Milestone 4 -->
            <div class="timeline-card timeline-card-highlight">
                <div class="timeline-year">2026</div>
                <h3 class="timeline-title">Eco-Luxury Leadership</h3>
                <p class="timeline-desc">
                    Recognized as an award-winning eco-luxury resort featuring 100% solar water heating, organic farming, and wildlife conservation.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     4. SUSTAINABILITY & ECO-LUXURY POLICY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream sustainability-section" id="sustainability" aria-labelledby="sustainability-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">SUSTAINABLE LUXURY</span>
            <h2 class="section-title" id="sustainability-heading">Preserving Sri Lanka’s Natural Heritage</h2>
            <p class="section-subtitle">Our pledge to protect the environment, support local fauna, and nurture our culture.</p>
        </div>

        <div class="sustainability-cards-grid">

            <!-- Card 1: Biodiversity -->
            <div class="sustainability-card reveal-up">
                <div class="sustainability-icon">
                    <i class="fa-solid fa-feather-pointed" aria-hidden="true"></i>
                </div>
                <h3 class="sustainability-title">Wildlife &amp; Flora Conservation</h3>
                <p class="sustainability-desc">
                    Our 12-acre sanctuary provides a safe corridor for endemic birds, butterflies, and native flora. We strictly maintain natural tree canopies without deforestation.
                </p>
            </div>

            <!-- Card 2: Renewable Energy -->
            <div class="sustainability-card reveal-up">
                <div class="sustainability-icon">
                    <i class="fa-solid fa-sun-plant-wilt" aria-hidden="true"></i>
                </div>
                <h3 class="sustainability-title">Energy &amp; Water Stewardship</h3>
                <p class="sustainability-desc">
                    Utilizing solar water heating, energy-efficient inverter systems, rainwater harvesting, and eco-friendly wastewater recycling for garden irrigation.
                </p>
            </div>

            <!-- Card 3: Cultural Heritage -->
            <div class="sustainability-card reveal-up">
                <div class="sustainability-icon">
                    <i class="fa-solid fa-hands-holding-circle" aria-hidden="true"></i>
                </div>
                <h3 class="sustainability-title">Cultural &amp; Community Empowerment</h3>
                <p class="sustainability-desc">
                    We actively support local artisans, sponsor nearby village schools, and provide fair-wage employment to local families across Sigiriya.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. RESORT FACILITIES & AMENITIES
     ───────────────────────────────────────────────────────────── -->
<section class="section facilities-section" id="facilities" aria-labelledby="facilities-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">RESORT AMENITIES</span>
            <h2 class="section-title" id="facilities-heading">Crafted for Total Relaxation</h2>
            <p class="section-subtitle">Thoughtful amenities designed to complement your tranquil stay.</p>
        </div>

        <div class="facilities-grid">

            <!-- Facility 1 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-water-ladder" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">Forest Infinity Pool</h3>
                <p class="facility-desc">Immerse yourself in our mineral infinity pool overlooking the tropical tree canopy.</p>
            </div>

            <!-- Facility 2 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-spa" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">Ayurveda &amp; Wellness Spa</h3>
                <p class="facility-desc">Traditional herbal therapies, steam baths, and morning yoga sessions in our open pavilion.</p>
            </div>

            <!-- Facility 3 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-utensils" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">The Canopy Restaurant</h3>
                <p class="facility-desc">Open-air fine dining serving organic Sri Lankan flavors and international gastronomy.</p>
            </div>

            <!-- Facility 4 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">Organic Botanical Garden</h3>
                <p class="facility-desc">Stroll through our private spice and vegetable gardens harvested daily by our chefs.</p>
            </div>

            <!-- Facility 5 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-wifi" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">High-Speed Fiber Wi-Fi</h3>
                <p class="facility-desc">Seamless high-speed internet available across all suites, dining areas, and pool decks.</p>
            </div>

            <!-- Facility 6 -->
            <div class="facility-card reveal-up">
                <div class="facility-icon">
                    <i class="fa-solid fa-car-side" aria-hidden="true"></i>
                </div>
                <h3 class="facility-title">Private Chauffeur Service</h3>
                <p class="facility-desc">24/7 airport transfers and private air-conditioned excursions across Sigiriya &amp; Dambulla.</p>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. CALL TO ACTION SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section about-cta-section" id="about-cta" aria-labelledby="cta-heading">
    <div class="container text-center reveal-up">
        <span class="hero-eyebrow" style="color: var(--color-sage-light);">
            <i class="fa-solid fa-compass" aria-hidden="true"></i> YOUR SANCTUARY AWAITS
        </span>
        <h2 class="section-title text-white" id="cta-heading">Ready to Experience Nature’s Embrace?</h2>
        <p class="section-subtitle text-white-muted" style="max-width: 680px; margin-inline: auto;">
            Book your room or suite directly with Serona to enjoy guaranteed best rates, flexible cancellation policies, and bespoke concierge service.
        </p>
        <div class="cta-actions" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: var(--space-8);">
            <a href="<?= base_url('booking.php') ?>" class="btn btn-light" id="about-cta-book-btn">
                Book Your Stay <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
            </a>
            <a href="<?= base_url('contact.php') ?>" class="btn btn-outline-white" id="about-cta-contact-btn">
                Contact Our Concierge <i class="fa-solid fa-envelope" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
