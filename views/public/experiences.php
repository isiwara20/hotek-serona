<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC EXPERIENCES HERO
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section experiences-hero" id="hero" aria-labelledby="hero-title">
    <div class="hero-bg-wrapper">
        <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Guests on a tranquil nature trail at Serona Hotel & Resort surrounded by rainforest canopy" class="hero-bg-image">
        <div class="hero-overlay experiences-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">EXPERIENCE SERONA</span>
            <h1 class="hero-title" id="hero-title">Reconnect With What Matters</h1>
            <p class="hero-subtitle">
                From peaceful mornings surrounded by greenery to memorable evenings under the stars, every Serona experience is designed to bring you closer to nature, people and the moments that matter.
            </p>
            <div class="hero-actions">
                <a href="#experiences-filter" class="btn btn-light" id="hero-explore-cta">
                    Explore Experiences <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                </a>
                <a href="<?= base_url('booking.php') ?>" class="btn btn-outline-white" id="hero-book-cta">
                    Book Your Stay <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Organic Botanical Line Motif -->
    <div class="hero-botanical-motif" aria-hidden="true">
        <svg width="120" height="24" viewBox="0 0 120 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 12C30 12 30 2 60 2C90 2 90 22 120 12" stroke="rgba(198, 211, 193, 0.4)" stroke-width="1.5"/>
        </svg>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. EXPERIENCES INTRODUCTION (EDITORIAL SPLIT)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory experience-intro" id="intro" aria-labelledby="intro-heading">
    <div class="container">
        <div class="intro-grid">
            <!-- Content Left -->
            <div class="intro-content reveal-left">
                <span class="eyebrow-label">DISCOVER MORE</span>
                <h2 class="section-title" id="intro-heading">Made for Meaningful Moments</h2>
                <p class="intro-description">
                    Serona is designed for more than rest. It is a place to slow down, explore, reconnect and create memories through experiences shaped by nature and thoughtful hospitality.
                </p>
                <p class="intro-description-secondary">
                    Whether you prefer quiet relaxation, outdoor discovery or meaningful time with family and friends, there is a Serona experience for every kind of stay.
                </p>

                <div class="intro-cta-wrapper" style="margin-top: var(--space-6);">
                    <a href="#experiences-filter" class="btn-text-link" id="intro-discover-link">
                        Find Your Experience <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <!-- Composition Right -->
            <div class="intro-image-composition reveal-right">
                <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Serona rainforest trail walk" class="intro-img-main">
                <img src="<?= asset('images/experiences/wellness.jpg') ?>" alt="Quiet garden rest pavilion at Serona" class="intro-img-secondary">
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. EXPERIENCE CATEGORY NAVIGATION
     ───────────────────────────────────────────────────────────── -->
<nav class="experiences-filter-section" id="experiences-filter" aria-label="Experience Categories">
    <div class="container">
        <div class="filter-nav-wrapper">
            <ul class="filter-nav-list" role="tablist">
                <?php foreach ($categories as $cat): ?>
                    <li role="presentation">
                        <button type="button" 
                                class="filter-tab-btn <?= $selected_category === $cat['key'] ? 'active' : '' ?>"
                                data-filter="<?= e($cat['key']) ?>"
                                role="tab"
                                aria-selected="<?= $selected_category === $cat['key'] ? 'true' : 'false' ?>">
                            <?= e($cat['label']) ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- ─────────────────────────────────────────────────────────────
     4. SIGNATURE FEATURED EXPERIENCE
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream featured-experience-section" id="featured-experience" aria-labelledby="featured-title">
    <div class="container">
        <div class="featured-experience-card reveal-up">
            <!-- Left Large Image -->
            <div class="featured-exp-media">
                <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Walk Into the Quiet — Signature Serona Nature Experience" class="featured-exp-image">
                <span class="featured-exp-badge">SIGNATURE EXPERIENCE</span>
            </div>

            <!-- Right Content Panel -->
            <div class="featured-exp-content">
                <span class="eyebrow-label">SIGNATURE EXPERIENCE</span>
                <h2 class="featured-exp-title" id="featured-title">Walk Into the Quiet</h2>
                <p class="featured-exp-desc">
                    Explore Serona’s natural surroundings at a slower pace, surrounded by greenery, fresh air and the calming rhythm of the landscape.
                </p>

                <!-- Meta Pills -->
                <div class="exp-meta-pills">
                    <span class="meta-pill"><i class="fa-solid fa-tree" aria-hidden="true"></i> Nature</span>
                    <span class="meta-pill"><i class="fa-solid fa-compass" aria-hidden="true"></i> Outdoor</span>
                    <span class="meta-pill"><i class="fa-solid fa-feather" aria-hidden="true"></i> Relaxing</span>
                    <span class="meta-pill"><i class="fa-solid fa-users" aria-hidden="true"></i> Couples &amp; Families</span>
                </div>

                <!-- Actions -->
                <div class="featured-exp-actions">
                    <a href="<?= e($general_whatsapp_url) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary" id="featured-enquire-btn">
                        Enquire About This Experience <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. NATURE & DISCOVERY SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory experience-category-block" id="nature-section" data-category="nature" aria-labelledby="nature-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">NATURE &amp; DISCOVERY</span>
            <h2 class="section-title" id="nature-heading">Closer to the Natural World</h2>
            <p class="section-subtitle">Immerse yourself in untouched greenery, gentle mountain trails, and quiet canopy views.</p>
        </div>

        <div class="experiences-asymmetric-grid">
            <!-- Large Card -->
            <article class="experience-card-large reveal-left">
                <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Guided rainforest walk" class="exp-card-bg-img">
                <div class="experience-card-overlay">
                    <span class="eyebrow-label">Nature Walk</span>
                    <h3 class="experience-card-title">Guided Rainforest Trails</h3>
                    <p>Take in the calm landscapes, endemic bird species, and natural streams surrounding Serona.</p>
                    <div class="card-action-bar">
                        <a href="<?= e($general_whatsapp_url) ?>" target="_blank" rel="noopener noreferrer" class="btn-card-link">
                            Enquire Experience <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Stacked Small Cards -->
            <div class="experiences-stack reveal-right">
                <article class="experience-card-small">
                    <img src="<?= asset('images/hero/experience-band.jpg') ?>" alt="Sunrise mountain views" class="exp-card-bg-img">
                    <div class="experience-card-overlay">
                        <span class="eyebrow-label">Morning Light</span>
                        <h3 class="experience-card-title" style="font-size:1.5rem;">Sunrise Moments</h3>
                        <p style="font-size:0.875rem; color:var(--color-sage-light);">Begin the day with soft mountain light and crisp forest air.</p>
                    </div>
                </article>

                <article class="experience-card-small">
                    <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Scenic viewpoints" class="exp-card-bg-img">
                    <div class="experience-card-overlay">
                        <span class="eyebrow-label">Canopy Views</span>
                        <h3 class="experience-card-title" style="font-size:1.5rem;">Scenic Viewpoints</h3>
                        <p style="font-size:0.875rem; color:var(--color-sage-light);">Find quiet pavilions crafted for conversation and views.</p>
                    </div>
                </article>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-10);">
            <a href="<?= base_url('contact.php') ?>" class="btn-text-link" id="nature-discover-link">
                Discover Nature at Serona <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. WELLNESS & RELAXATION SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream experience-category-block" id="wellness-section" data-category="wellness" aria-labelledby="wellness-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">WELLNESS &amp; RELAXATION</span>
            <h2 class="section-title" id="wellness-heading">Slow Down. Breathe Deeper.</h2>
            <p class="section-subtitle">
                Restful spaces created for quiet reflection, reading in the shade, and unhurried peace.
            </p>
        </div>

        <div class="wellness-editorial-grid reveal-up">
            <div class="wellness-card">
                <div class="wellness-card-icon"><i class="fa-solid fa-leaf" aria-hidden="true"></i></div>
                <h3 class="wellness-card-title">Quiet Garden Moments</h3>
                <p class="wellness-card-desc">
                    Secluded shaded seating tucked away among native spice trees and tropical flora for quiet solitude.
                </p>
            </div>

            <div class="wellness-card">
                <div class="wellness-card-icon"><i class="fa-solid fa-water" aria-hidden="true"></i></div>
                <h3 class="wellness-card-title">Poolside Relaxation</h3>
                <p class="wellness-card-desc">
                    Recline by the infinity pool with refreshing herbal mocktails and peaceful forest ambient sounds.
                </p>
            </div>

            <div class="wellness-card">
                <div class="wellness-card-icon"><i class="fa-solid fa-sun" aria-hidden="true"></i></div>
                <h3 class="wellness-card-title">Morning Rest &amp; Stretch</h3>
                <p class="wellness-card-desc">
                    Open wooden decks designed for personal morning stretches as the sun warms the mountain canopy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     7. POOL & LEISURE SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section experience-category-block pool-leisure-section" id="leisure-section" data-category="leisure" aria-labelledby="leisure-heading">
    <div class="pool-leisure-bg-wrapper">
        <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Serona infinity pool surrounded by rainforest" class="pool-leisure-bg-img">
        <div class="pool-leisure-overlay"></div>
    </div>

    <div class="container pool-leisure-content-wrapper reveal-up">
        <div class="pool-leisure-panel">
            <span class="eyebrow-label">POOL &amp; LEISURE</span>
            <h2 class="section-title" id="leisure-heading">Time to Simply Enjoy</h2>
            <p class="dining-description">
                Spend unhurried hours by the water, enjoy the warmth of the day and let the pace of your stay become beautifully simple.
            </p>

            <div class="pool-highlights-grid">
                <div class="pool-hl-item"><i class="fa-solid fa-person-swimming" aria-hidden="true"></i> <span>Infinity Pool</span></div>
                <div class="pool-hl-item"><i class="fa-solid fa-umbrella-beach" aria-hidden="true"></i> <span>Poolside Loungers</span></div>
                <div class="pool-hl-item"><i class="fa-solid fa-glass-water" aria-hidden="true"></i> <span>Herbal Drinks</span></div>
                <div class="pool-hl-item"><i class="fa-solid fa-cloud-sun" aria-hidden="true"></i> <span>Sunset Hours</span></div>
            </div>

            <div style="margin-top: var(--space-6);">
                <a href="<?= base_url('booking.php') ?>" class="btn btn-light" id="pool-book-cta">
                    Plan Your Pool Stay <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     8. LOCAL EXPERIENCES (LOCAL CONNECTIONS)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory experience-category-block" id="local-section" data-category="local" aria-labelledby="local-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">LOCAL CONNECTIONS</span>
            <h2 class="section-title" id="local-heading">Discover More Beyond Your Stay</h2>
            <p class="section-subtitle">
                Our team can help guests discover nearby places, local flavours and meaningful experiences around the region.
            </p>
        </div>

        <div class="local-cards-grid reveal-up">
            <article class="local-card">
                <div class="local-card-icon"><i class="fa-solid fa-map-location-dot" aria-hidden="true"></i></div>
                <h3 class="local-card-title">Local Discovery</h3>
                <p class="local-card-desc">
                    Explore nearby heritage locations and scenic spots with tailored recommendations from the Serona team.
                </p>
            </article>

            <article class="local-card">
                <div class="local-card-icon"><i class="fa-solid fa-utensils" aria-hidden="true"></i></div>
                <h3 class="local-card-title">Taste the Region</h3>
                <p class="local-card-desc">
                    Discover authentic regional spices, traditional harvests, and island culinary traditions during your stay.
                </p>
            </article>

            <article class="local-card">
                <div class="local-card-icon"><i class="fa-solid fa-people-group" aria-hidden="true"></i></div>
                <h3 class="local-card-title">Culture &amp; Community</h3>
                <p class="local-card-desc">
                    Experience the gentle rhythm and everyday warmth of Sigiriya and surrounding village life.
                </p>
            </article>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     9. FAMILY EXPERIENCES (TOGETHER AT SERONA)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream experience-category-block" id="family-section" data-category="family" aria-labelledby="family-heading">
    <div class="container">
        <div class="intro-grid">
            <!-- Image Left -->
            <div class="intro-image-composition reveal-left">
                <img src="<?= asset('images/rooms/family-suite.jpg') ?>" alt="Family moments at Serona resort" class="intro-img-main">
            </div>

            <!-- Content Right -->
            <div class="intro-content reveal-right">
                <span class="eyebrow-label">TOGETHER AT SERONA</span>
                <h2 class="section-title" id="family-heading">Moments Made for Sharing</h2>
                <p class="intro-description">
                    Serona offers open space, peaceful surroundings, and comfortable multi-bedroom villa suites ideal for families spending quality time together.
                </p>
                <div class="intro-features-list" style="margin-top: var(--space-6);">
                    <div class="intro-feature-item"><i class="fa-solid fa-water"></i> <span>Pool Time Together</span></div>
                    <div class="intro-feature-item"><i class="fa-solid fa-leaf"></i> <span>Garden Exploration</span></div>
                    <div class="intro-feature-item"><i class="fa-solid fa-utensils"></i> <span>Casual Family Meals</span></div>
                    <div class="intro-feature-item"><i class="fa-solid fa-camera"></i> <span>Memorable Photography</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     10. PRIVATE & SPECIAL EXPERIENCES (PRIVATE MOMENTS)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-dark private-moments-section experience-category-block" id="private-section" data-category="private" aria-labelledby="private-heading">
    <div class="private-dining-bg-wrapper">
        <img src="<?= asset('images/experiences/private-dining.jpg') ?>" alt="Candlelit jungle private dining" class="private-dining-bg">
        <div class="private-dining-overlay"></div>
    </div>

    <div class="container private-dining-content reveal-up">
        <div class="private-dining-panel">
            <span class="eyebrow-label" style="color: var(--color-sage-light);">PRIVATE MOMENTS</span>
            <h2 class="section-title" id="private-heading" style="color: var(--color-white);">Make the Moment Your Own</h2>
            <p class="private-dining-desc" style="color: var(--color-sage-pale);">
                Speak with the Serona team about creating a more personal experience for meaningful occasions, from romantic candlelit setups to intimate celebrations under the stars.
            </p>
            <a href="<?= e($general_whatsapp_url) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-light" id="private-plan-btn">
                Plan a Special Moment <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     11. EXPERIENCE GALLERY (SERONA MOMENTS)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory experience-gallery-section" id="gallery" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">SERONA MOMENTS</span>
            <h2 class="section-title" id="gallery-heading">Experiences to Remember</h2>
            <p class="section-subtitle">Moments of quiet joy, outdoor discovery, and peaceful relaxation captured across Serona.</p>
        </div>

        <div class="exp-gallery-asymmetric-grid reveal-up">
            <div class="exp-gal-item exp-gal-1">
                <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Rainforest nature trail walk">
                <div class="exp-gal-overlay">
                    <span class="exp-gal-tag">NATURE</span>
                </div>
            </div>

            <div class="exp-gal-item exp-gal-2">
                <img src="<?= asset('images/experiences/wellness.jpg') ?>" alt="Quiet garden rest pavilion">
                <div class="exp-gal-overlay">
                    <span class="exp-gal-tag">RELAXATION</span>
                </div>
            </div>

            <div class="exp-gal-item exp-gal-3">
                <img src="<?= asset('images/experiences/private-dining.jpg') ?>" alt="Candlelit dining under stars">
                <div class="exp-gal-overlay">
                    <span class="exp-gal-tag">DINING</span>
                </div>
            </div>

            <div class="exp-gal-item exp-gal-4">
                <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Infinity pool at golden hour">
                <div class="exp-gal-overlay">
                    <span class="exp-gal-tag">TOGETHER</span>
                </div>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-8);">
            <a href="<?= base_url('gallery.php') ?>" class="btn btn-outline-dark" id="exp-gallery-full-btn">
                View Full Resort Gallery <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     12. PLANNING INFORMATION SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream experience-info-section" id="planning-info" aria-labelledby="info-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">PLAN YOUR EXPERIENCE</span>
            <h2 class="section-title" id="info-heading">A Stay Shaped Around You</h2>
            <p class="section-subtitle">Helpful guidance to ensure your resort experiences are effortless and memorable.</p>
        </div>

        <div class="exp-info-grid reveal-up">
            <div class="exp-info-card">
                <div class="exp-info-icon"><i class="fa-solid fa-cloud-sun-rain" aria-hidden="true"></i></div>
                <h3 class="exp-info-title">Availability</h3>
                <p class="exp-info-desc">Some outdoor experiences may depend on weather, season or daily availability.</p>
            </div>

            <div class="exp-info-card">
                <div class="exp-info-icon"><i class="fa-solid fa-calendar-check" aria-hidden="true"></i></div>
                <h3 class="exp-info-title">Advance Requests</h3>
                <p class="exp-info-desc">For special arrangements, guests are encouraged to contact our team prior to arrival.</p>
            </div>

            <div class="exp-info-card">
                <div class="exp-info-icon"><i class="fa-solid fa-users" aria-hidden="true"></i></div>
                <h3 class="exp-info-title">Families</h3>
                <p class="exp-info-desc">Our team is happy to recommend suitable activities based on your group or family preferences.</p>
            </div>

            <div class="exp-info-card">
                <div class="exp-info-icon"><i class="fa-solid fa-sparkles" aria-hidden="true"></i></div>
                <h3 class="exp-info-title">Special Occasions</h3>
                <p class="exp-info-desc">Speak with us about creating a more personal experience for birthdays, anniversaries or special moments.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     13. FINAL EXPERIENCE CTA
     ───────────────────────────────────────────────────────────── -->
<section class="final-cta-section section-dark" id="final-cta">
    <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Serona resort infinity pool at dusk" class="final-cta-bg">
    <div class="container final-cta-content reveal-up">
        <span class="eyebrow-label">YOUR SERONA EXPERIENCE</span>
        <h2 class="section-title">Make Your Stay More Memorable</h2>
        <p class="section-subtitle" style="margin-bottom: var(--space-8);">
            Tell us how you would like to spend your time at Serona, and our team will help you create a stay filled with the moments that matter most.
        </p>

        <div class="hero-actions" style="justify-content: center;">
            <a href="<?= base_url('booking.php') ?>" class="btn btn-light" id="final-book-btn">
                Book Your Stay <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
            </a>
            <a href="<?= base_url('rooms.php') ?>" class="btn btn-outline-white" id="final-rooms-btn">
                Explore Rooms
            </a>
            <a href="<?= base_url('contact.php') ?>" class="btn btn-outline-white" id="final-contact-btn">
                Contact Serona
            </a>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
