<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC HERO SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section" id="hero" aria-labelledby="hero-title">
    <div class="hero-bg-wrapper">
        <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Serona Hotel & Resort infinity pool surrounded by tropical rainforest" class="hero-bg-image">
        <div class="hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">Serona Hotel &amp; Resort</span>
            <h1 class="hero-title" id="hero-title">Nature’s Embrace</h1>
            <p class="hero-subtitle">
                Escape into a peaceful retreat where thoughtful hospitality, natural beauty, and refined comfort come together in Sri Lanka.
            </p>
            <div class="hero-actions">
                <a href="#booking-bar" class="btn btn-light" id="hero-book-cta">Book Your Stay</a>
                <a href="#discover" class="btn btn-outline-white" id="hero-discover-cta">
                    Discover Serona <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. FLOATING BOOKING / ENQUIRY BAR
     ───────────────────────────────────────────────────────────── -->
<div class="container booking-bar-wrapper" id="booking-bar">
    <div class="booking-bar reveal-up">
        <form action="<?= base_url('booking.php') ?>" method="GET" class="booking-bar-form" id="hero-booking-bar-form">
            <!-- Check-In -->
            <div class="booking-field-group">
                <label for="bar-check-in" class="field-label">
                    <i class="fa-regular fa-calendar" aria-hidden="true"></i> Check In
                </label>
                <input type="date" id="bar-check-in" name="check_in" class="field-input" required>
            </div>

            <!-- Check-Out -->
            <div class="booking-field-group">
                <label for="bar-check-out" class="field-label">
                    <i class="fa-regular fa-calendar-check" aria-hidden="true"></i> Check Out
                </label>
                <input type="date" id="bar-check-out" name="check_out" class="field-input" required>
            </div>

            <!-- Guests -->
            <div class="booking-field-group">
                <label for="bar-guests" class="field-label">
                    <i class="fa-solid fa-user-group" aria-hidden="true"></i> Guests
                </label>
                <select id="bar-guests" name="adults" class="field-select">
                    <option value="1">1 Guest</option>
                    <option value="2" selected>2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5">5+ Guests</option>
                </select>
            </div>

            <!-- Room Category -->
            <div class="booking-field-group">
                <label for="bar-room-type" class="field-label">
                    <i class="fa-solid fa-bed" aria-hidden="true"></i> Room Category
                </label>
                <select id="bar-room-type" name="room_id" class="field-select">
                    <option value="">All Rooms &amp; Suites</option>
                    <option value="1">Deluxe Room</option>
                    <option value="2">Premium Suite</option>
                    <option value="3">Family Villa Suite</option>
                </select>
            </div>

            <!-- Submit Action -->
            <button type="submit" class="btn btn-primary" id="bar-submit-btn">
                Check Availability <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>

<!-- ─────────────────────────────────────────────────────────────
     3. DISCOVER SERONA INTRODUCTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="discover" aria-labelledby="intro-heading">
    <div class="container">
        <div class="intro-grid">
            <!-- Composition Left -->
            <div class="intro-image-composition reveal-left">
                <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Serona resort architectural landscape" class="intro-img-main">
                <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Deluxe suite interior with forest balcony view" class="intro-img-secondary">
            </div>

            <!-- Content Right -->
            <div class="intro-content reveal-right">
                <span class="eyebrow-label">Discover Serona</span>
                <h2 class="section-title" id="intro-heading">A Retreat Inspired by Nature</h2>
                <p class="intro-description">
                    Serona Hotel &amp; Resort brings together untouched natural surroundings, thoughtful hospitality, and beautifully designed living spaces to create a stay that feels peaceful, personal, and deeply restorative.
                </p>

                <div class="intro-features-list">
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                        <span>Eco-Friendly Architecture</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-water" aria-hidden="true"></i>
                        <span>Rainforest Infinity Pool</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-utensils" aria-hidden="true"></i>
                        <span>Farm-to-Table Cuisine</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-spa" aria-hidden="true"></i>
                        <span>Holistic Jungle Wellness</span>
                    </div>
                </div>

                <a href="<?= base_url('about.php') ?>" class="btn btn-outline-dark" id="discover-story-btn">
                    Discover Our Story <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     4. ROOMS & SUITES SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream" id="rooms" aria-labelledby="rooms-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">Stay at Serona</span>
            <h2 class="section-title" id="rooms-heading">Rest Naturally</h2>
            <p class="section-subtitle">
                Beautifully crafted rooms and private suites created for quiet comfort, complete privacy, and effortless relaxation.
            </p>
        </div>

        <div class="rooms-grid">
            <!-- Room Card 1: Deluxe Room -->
            <article class="room-card reveal-up">
                <div class="room-card-image-wrapper">
                    <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Serona Deluxe Room with rainforest balcony" class="room-card-image">
                    <span class="room-card-tag">Popular Choice</span>
                </div>
                <div class="room-card-content">
                    <h3 class="room-card-title">Deluxe Room</h3>
                    <p class="room-card-description">
                        Designed for quiet comfort with organic teak wood furnishings, a king-size bed, and a private balcony overlooking the forest canopy.
                    </p>
                    <div class="room-card-specs">
                        <div class="room-spec-item">
                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                            <span>2 Guests</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-bed" aria-hidden="true"></i>
                            <span>King Bed</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-expand" aria-hidden="true"></i>
                            <span>32 m²</span>
                        </div>
                    </div>
                    <a href="<?= base_url('booking.php?room_id=1') ?>" class="room-card-action">
                        Explore Room &amp; Book <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </article>

            <!-- Room Card 2: Premium Suite -->
            <article class="room-card reveal-up">
                <div class="room-card-image-wrapper">
                    <img src="<?= asset('images/rooms/premium-suite.jpg') ?>" alt="Serona Premium Suite with private plunge pool" class="room-card-image">
                    <span class="room-card-tag">Signature Suite</span>
                </div>
                <div class="room-card-content">
                    <h3 class="room-card-title">Premium Suite</h3>
                    <p class="room-card-description">
                        An expansive private suite featuring a sun-drenched wooden deck, a private infinity plunge pool, and panoramic jungle sunrise views.
                    </p>
                    <div class="room-card-specs">
                        <div class="room-spec-item">
                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                            <span>2 Guests</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-water" aria-hidden="true"></i>
                            <span>Plunge Pool</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-expand" aria-hidden="true"></i>
                            <span>54 m²</span>
                        </div>
                    </div>
                    <a href="<?= base_url('booking.php?room_id=2') ?>" class="room-card-action">
                        Explore Suite &amp; Book <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </article>

            <!-- Room Card 3: Family Suite -->
            <article class="room-card reveal-up">
                <div class="room-card-image-wrapper">
                    <img src="<?= asset('images/rooms/family-suite.jpg') ?>" alt="Serona Family Villa Suite surrounded by tropical gardens" class="room-card-image">
                    <span class="room-card-tag">Family Villa</span>
                </div>
                <div class="room-card-content">
                    <h3 class="room-card-title">Family Villa Suite</h3>
                    <p class="room-card-description">
                        Two interconnected bedroom suites with a spacious shared living pavilion, private outdoor garden terrace, and premium amenities.
                    </p>
                    <div class="room-card-specs">
                        <div class="room-spec-item">
                            <i class="fa-solid fa-users" aria-hidden="true"></i>
                            <span>4 Guests</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-bed" aria-hidden="true"></i>
                            <span>2 Bedrooms</span>
                        </div>
                        <div class="room-spec-item">
                            <i class="fa-solid fa-expand" aria-hidden="true"></i>
                            <span>85 m²</span>
                        </div>
                    </div>
                    <a href="<?= base_url('booking.php?room_id=3') ?>" class="room-card-action">
                        Explore Villa &amp; Book <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. SIGNATURE NATURE EXPERIENCE HERO BAND
     ───────────────────────────────────────────────────────────── -->
<section class="experience-band" id="experience-band">
    <img src="<?= asset('images/hero/experience-band.jpg') ?>" alt="Mountain nature background" class="experience-band-bg">
    <div class="container experience-band-content reveal-up">
        <span class="eyebrow-label">Experience Serona</span>
        <h2 class="section-title">Reconnect With What Matters</h2>
        <p class="section-subtitle">
            Immerse yourself in authentic Sri Lankan sanctuary experiences designed to quiet the mind and rejuvenate the spirit.
        </p>

        <div class="experiences-icon-grid">
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-tree" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Nature Walks</span>
            </div>
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-spa" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Wellness &amp; Spa</span>
            </div>
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-water" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Infinity Pool</span>
            </div>
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-compass" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Local Excursions</span>
            </div>
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-utensils" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Private Dining</span>
            </div>
            <div class="exp-icon-box">
                <div class="exp-icon-circle"><i class="fa-solid fa-feather" aria-hidden="true"></i></div>
                <span class="exp-icon-label">Pure Solitude</span>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. FACILITIES SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="facilities" aria-labelledby="facilities-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">Everything You Need</span>
            <h2 class="section-title" id="facilities-heading">Designed Around Your Stay</h2>
            <p class="section-subtitle">
                Carefully considered resort amenities ensuring complete comfort while maintaining our commitment to sustainable luxury.
            </p>
        </div>

        <div class="facilities-grid reveal-up">
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-person-swimming" aria-hidden="true"></i></div>
                <h3 class="facility-title">Infinity Pool</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-wifi" aria-hidden="true"></i></div>
                <h3 class="facility-title">High-Speed Wi-Fi</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-utensils" aria-hidden="true"></i></div>
                <h3 class="facility-title">Forest Restaurant</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-square-parking" aria-hidden="true"></i></div>
                <h3 class="facility-title">Valet Parking</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-bell-concierge" aria-hidden="true"></i></div>
                <h3 class="facility-title">In-Room Dining</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-van-shuttle" aria-hidden="true"></i></div>
                <h3 class="facility-title">Airport Transfers</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-people-roof" aria-hidden="true"></i></div>
                <h3 class="facility-title">Family Suites</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-user-tie" aria-hidden="true"></i></div>
                <h3 class="facility-title">Personal Concierge</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-snowflake" aria-hidden="true"></i></div>
                <h3 class="facility-title">Climate Control</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-shirt" aria-hidden="true"></i></div>
                <h3 class="facility-title">Eco Laundry</h3>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     7. DINING SECTION (SPLIT-SCREEN)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream" id="dining" aria-labelledby="dining-heading">
    <div class="container">
        <div class="dining-split-grid reveal-up">
            <!-- Left Image -->
            <div class="dining-img-wrapper">
                <img src="<?= asset('images/dining/dining-main.jpg') ?>" alt="Serona open-air evening restaurant under warm lanterns">
            </div>

            <!-- Right Content Panel -->
            <div class="dining-content-panel">
                <span class="eyebrow-label">Taste Serona</span>
                <h2 class="section-title" id="dining-heading">Flavours Inspired by the Journey</h2>
                <p class="dining-description">
                    Enjoy thoughtfully prepared dishes combining fresh organic produce from nearby harvests, local spices, and international culinary favourites served under tropical lanterns.
                </p>
                <div>
                    <a href="<?= base_url('dining.php') ?>" class="btn btn-light" id="dining-explore-btn">
                        Discover Dining <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     8. FEATURED EXPERIENCES (ASYMMETRIC CARDS)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="experiences" aria-labelledby="exp-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">Curated Activities</span>
            <h2 class="section-title" id="exp-heading">Signature Experiences</h2>
            <p class="section-subtitle">
                Tailored experiences that connect you with nature, local culture, and quiet moments of joy.
            </p>
        </div>

        <div class="experiences-asymmetric-grid">
            <!-- Large Card -->
            <div class="experience-card-large reveal-left">
                <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Guided nature trail through lush tropical rainforest">
                <div class="experience-card-overlay">
                    <span class="eyebrow-label">Nature &amp; Discovery</span>
                    <h3 class="experience-card-title">Guided Rainforest Trails</h3>
                    <p>Explore hidden flora, endemic birdlife, and natural streams accompanied by our resident naturalist.</p>
                </div>
            </div>

            <!-- Stacked Small Cards -->
            <div class="experiences-stack reveal-right">
                <div class="experience-card-small">
                    <img src="<?= asset('images/experiences/wellness.jpg') ?>" alt="Serene outdoor river spa pavilion">
                    <div class="experience-card-overlay">
                        <span class="eyebrow-label">Wellness &amp; Healing</span>
                        <h3 class="experience-card-title" style="font-size:1.5rem;">River Spa &amp; Meditation</h3>
                    </div>
                </div>

                <div class="experience-card-small">
                    <img src="<?= asset('images/experiences/private-dining.jpg') ?>" alt="Candlelit private outdoor dinner setup">
                    <div class="experience-card-overlay">
                        <span class="eyebrow-label">Private Moments</span>
                        <h3 class="experience-card-title" style="font-size:1.5rem;">Candlelit Jungle Dinner</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     9. ASYMMETRIC GALLERY SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream" id="gallery" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">Discover The Beauty</span>
            <h2 class="section-title" id="gallery-heading">A Glimpse of Serona</h2>
            <p class="section-subtitle">A collection of moments captured across our resort grounds, suites, and surrounding nature.</p>
        </div>

        <div class="gallery-asymmetric-grid reveal-up">
            <div class="gallery-item gallery-item-1">
                <img src="<?= asset('images/gallery/gallery-1.jpg') ?>" alt="Serona infinity pool sunset view">
                <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></div>
            </div>
            <div class="gallery-item gallery-item-2">
                <img src="<?= asset('images/gallery/gallery-2.jpg') ?>" alt="Serona villa bedroom interior">
                <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></div>
            </div>
            <div class="gallery-item gallery-item-3">
                <img src="<?= asset('images/gallery/gallery-3.jpg') ?>" alt="Gourmet dish at Serona dining">
                <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></div>
            </div>
            <div class="gallery-item gallery-item-4">
                <img src="<?= asset('images/gallery/gallery-4.jpg') ?>" alt="Deluxe terrace balcony">
                <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></div>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-8);">
            <a href="<?= base_url('gallery.php') ?>" class="btn btn-outline-dark" id="gallery-view-all-btn">
                View Full Gallery <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     10. TESTIMONIALS (GUEST STORIES)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="testimonials" aria-labelledby="testimonials-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">Guest Stories</span>
            <h2 class="section-title" id="testimonials-heading">Moments Worth Remembering</h2>
            <p class="section-subtitle">Hear what our guests say about their retreat at Serona Hotel &amp; Resort.</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card reveal-up">
                <p class="testimonial-quote">
                    “A peaceful sanctuary surrounded by nature. Everything from the forest pavilion to the warm hospitality made our stay unforgettable.”
                </p>
                <div class="testimonial-author">
                    <span>Emily R., United Kingdom</span>
                </div>
            </div>

            <div class="testimonial-card reveal-up">
                <p class="testimonial-quote">
                    “The privacy and natural beauty are unmatched. Waking up to the jungle canopy views from our private suite pool was truly magical.”
                </p>
                <div class="testimonial-author">
                    <span>Marcus V., Germany</span>
                </div>
            </div>

            <div class="testimonial-card reveal-up">
                <p class="testimonial-quote">
                    “Serona is luxury at its most authentic. Thoughtful design, incredible dining, and genuine Sri Lankan warmth in every single detail.”
                </p>
                <div class="testimonial-author">
                    <span>Sarah &amp; David K., Australia</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     11. FINAL BOOKING ESCAPE CTA
     ───────────────────────────────────────────────────────────── -->
<section class="final-cta-section" id="final-cta">
    <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Serona resort at dusk" class="final-cta-bg">
    <div class="container final-cta-content reveal-up">
        <span class="eyebrow-label">Plan Your Visit</span>
        <h2 class="section-title">Your Serona Escape Awaits</h2>
        <p class="section-subtitle" style="margin-bottom: var(--space-8);">
            Step away from the ordinary and experience a stay shaped by nature, comfort, and genuine hospitality.
        </p>

        <div class="hero-actions" style="justify-content: center;">
            <a href="<?= base_url('booking.php') ?>" class="btn btn-light" id="final-book-btn">
                Book Your Stay <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
            </a>
            <a href="<?= base_url('contact.php') ?>" class="btn btn-outline-white" id="final-contact-btn">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
