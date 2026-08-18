<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC ROOMS HERO SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section rooms-hero" id="hero" aria-labelledby="rooms-hero-title">
    <div class="hero-bg-wrapper">
        <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Serona Hotel & Resort luxury room balcony overlooking tropical forest" class="hero-bg-image">
        <div class="hero-overlay rooms-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">
                <i class="fa-solid fa-leaf" aria-hidden="true" style="font-size: 0.8rem; color: var(--color-sage-light);"></i> STAY AT SERONA
            </span>
            <h1 class="hero-title" id="rooms-hero-title">Rooms &amp; Suites</h1>
            <p class="hero-subtitle">
                Thoughtfully designed spaces where natural beauty, quiet comfort and effortless relaxation come together.
            </p>
            <p class="hero-secondary-line" style="color: var(--color-sage-light); font-size: 1rem; margin-bottom: var(--space-8); font-weight: 300;">
                Find the space that feels right for your Serona escape.
            </p>
            <div class="hero-actions">
                <a href="#rooms-listing" class="btn btn-light" id="hero-explore-rooms-cta">
                    Explore Rooms <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                </a>
                <a href="<?= base_url('booking.php') ?>" class="btn btn-outline-white" id="hero-book-stay-cta">
                    Book Your Stay <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Decorative Corner Leaf Accent -->
    <div class="rooms-hero-decoration" aria-hidden="true">
        <i class="fa-solid fa-tree"></i>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. INTRODUCTION / ACCOMMODATION PHILOSOPHY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="philosophy" aria-labelledby="intro-heading">
    <div class="container">
        <div class="intro-grid">
            <!-- Left Content Column -->
            <div class="intro-content reveal-left">
                <span class="eyebrow-label">A SERONA STAY</span>
                <h2 class="section-title" id="intro-heading">Spaces Designed for Rest</h2>
                <p class="intro-description">
                    Each Serona room and suite is designed to offer a peaceful balance of natural surroundings, thoughtful details and modern comfort. From quiet mornings to restful evenings, every space is created to help you slow down and feel at home.
                </p>

                <div class="intro-features-list">
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                        <span>Teak &amp; Linen Interiors</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-mountain-sun" aria-hidden="true"></i>
                        <span>Forest Canopy Balconies</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-wind" aria-hidden="true"></i>
                        <span>Tropical Ventilation</span>
                    </div>
                    <div class="intro-feature-item">
                        <i class="fa-solid fa-shield-heart" aria-hidden="true"></i>
                        <span>Complete Solitude &amp; Privacy</span>
                    </div>
                </div>

                <a href="#featured-stay" class="btn btn-outline-dark" id="intro-discover-stay-btn">
                    Discover Your Stay <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Right Layered Image Composition -->
            <div class="intro-image-composition reveal-right">
                <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Serona room balcony bathed in morning light" class="intro-img-main">
                <img src="<?= asset('images/rooms/premium-suite.jpg') ?>" alt="Serona suite private plunge pool terrace" class="intro-img-secondary">
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. ROOM CATEGORY / FILTER BAR
     ───────────────────────────────────────────────────────────── -->
<div class="rooms-filter-section" id="rooms-filter">
    <div class="container">
        <nav class="rooms-filter-nav" aria-label="Room category filter">
            <button type="button" class="filter-btn active" data-filter="all">All Stays</button>
            <button type="button" class="filter-btn" data-filter="rooms">Deluxe Rooms</button>
            <button type="button" class="filter-btn" data-filter="suites">Signature Suites</button>
            <button type="button" class="filter-btn" data-filter="family">Family Villas</button>
        </nav>
    </div>
</div>

<!-- ─────────────────────────────────────────────────────────────
     4. FEATURED ACCOMMODATION SPOTLIGHT
     ───────────────────────────────────────────────────────────── -->
<?php if (!empty($featured_room)): ?>
<section class="section section-cream featured-stay-section" id="featured-stay" aria-labelledby="featured-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">FEATURED STAY</span>
            <h2 class="section-title" id="featured-heading">Signature Accommodation</h2>
            <p class="section-subtitle">Experience our most requested sanctuary designed for unparalleled comfort and privacy.</p>
        </div>

        <div class="featured-suite-card reveal-up">
            <div class="featured-suite-image-col">
                <img src="<?= asset($featured_room['image'] ?? 'images/rooms/premium-suite.jpg') ?>" alt="<?= e($featured_room['name']) ?> at Serona Hotel &amp; Resort" class="featured-suite-img">
                <span class="featured-suite-badge">
                    <i class="fa-solid fa-crown" aria-hidden="true"></i> <?= e($featured_room['tag'] ?? 'Featured Stay') ?>
                </span>
            </div>

            <div class="featured-suite-content-col">
                <span class="eyebrow-label"><?= e($featured_room['category_label'] ?? 'Signature Suite') ?></span>
                <h3 class="featured-suite-title"><?= e($featured_room['name']) ?></h3>
                <p class="featured-suite-desc">
                    <?= e($featured_room['short_description']) ?>
                </p>

                <div class="featured-suite-specs">
                    <div class="featured-spec-pill">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        <span><?= e((string) $featured_room['capacity']) ?> Guests</span>
                    </div>
                    <div class="featured-spec-pill">
                        <i class="fa-solid fa-bed" aria-hidden="true"></i>
                        <span><?= e($featured_room['bed_type']) ?></span>
                    </div>
                    <div class="featured-spec-pill">
                        <i class="fa-solid fa-expand" aria-hidden="true"></i>
                        <span><?= e($featured_room['room_size']) ?></span>
                    </div>
                    <div class="featured-spec-pill">
                        <i class="fa-solid fa-mountain-sun" aria-hidden="true"></i>
                        <span><?= e($featured_room['view_type'] ?? 'Nature View') ?></span>
                    </div>
                </div>

                <div class="featured-suite-actions">
                    <a href="<?= base_url('room-details.php?slug=' . urlencode($featured_room['slug'])) ?>" class="btn btn-outline-dark" id="featured-explore-btn">
                        Explore Suite Details <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="<?= base_url('booking.php?room_id=' . (int) $featured_room['id']) ?>" class="btn btn-primary" id="featured-book-btn">
                        Book This Stay <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ─────────────────────────────────────────────────────────────
     5. MAIN ROOMS & SUITES LISTING (EDITORIAL ALTERNATING LAYOUT)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory rooms-listing-section" id="rooms-listing" aria-labelledby="listing-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">ACCOMMODATION CATALOGUE</span>
            <h2 class="section-title" id="listing-heading">Rooms &amp; Suites Collection</h2>
            <p class="section-subtitle">
                Explore each thoughtful space and find the ideal setting for your Sri Lankan sanctuary experience.
            </p>
        </div>

        <div class="rooms-editorial-list" id="rooms-grid-container">
            <?php foreach ($rooms as $index => $room): ?>
                <?php
                // Alternate image alignment for elegant editorial rhythm
                $isReversed = ($index % 2 !== 0);
                $categorySlug = e($room['category'] ?? 'rooms');
                ?>
                <article class="room-editorial-row reveal-up <?= $isReversed ? 'row-reversed' : '' ?>" data-category="<?= $categorySlug ?>" id="room-card-<?= e((string)$room['id']) ?>">
                    <!-- Image Column -->
                    <div class="room-row-media">
                        <img src="<?= asset($room['image']) ?>" alt="<?= e($room['name']) ?> room view" class="room-row-image" loading="lazy">
                        <?php if (!empty($room['tag'])): ?>
                            <span class="room-row-tag"><?= e($room['tag']) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Content Column -->
                    <div class="room-row-body">
                        <span class="eyebrow-label"><?= e($room['category_label'] ?? 'Room') ?></span>
                        <h3 class="room-row-title"><?= e($room['name']) ?></h3>
                        <p class="room-row-desc"><?= e($room['short_description']) ?></p>

                        <!-- Specifications Icons -->
                        <div class="room-row-specs">
                            <div class="spec-item">
                                <i class="fa-solid fa-user" aria-hidden="true"></i>
                                <span><?= e((string)$room['capacity']) ?> Guests</span>
                            </div>
                            <div class="spec-item">
                                <i class="fa-solid fa-bed" aria-hidden="true"></i>
                                <span><?= e($room['bed_type']) ?></span>
                            </div>
                            <div class="spec-item">
                                <i class="fa-solid fa-expand" aria-hidden="true"></i>
                                <span><?= e($room['room_size']) ?></span>
                            </div>
                            <?php if (!empty($room['view_type'])): ?>
                            <div class="spec-item">
                                <i class="fa-solid fa-mountain-sun" aria-hidden="true"></i>
                                <span><?= e($room['view_type']) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Feature Chips -->
                        <?php if (!empty($room['features'])): ?>
                        <div class="room-row-features">
                            <?php foreach (array_slice($room['features'], 0, 4) as $feat): ?>
                                <span class="feature-chip"><i class="fa-solid fa-check" aria-hidden="true"></i> <?= e($feat) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <div class="room-row-actions">
                            <a href="<?= base_url('room-details.php?slug=' . urlencode($room['slug'])) ?>" class="btn btn-outline-dark btn-room-explore">
                                View Room Details <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </a>
                            <a href="<?= base_url('booking.php?room_id=' . (int)$room['id']) ?>" class="btn btn-primary btn-room-book">
                                Book Your Stay
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. ROOM COMPARISON SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream room-comparison-section" id="comparison" aria-labelledby="comparison-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">AT A GLANCE</span>
            <h2 class="section-title" id="comparison-heading">Compare Accommodation</h2>
            <p class="section-subtitle">A side-by-side view to help you select the ideal space for your stay.</p>
        </div>

        <!-- Desktop Comparison Table / Mobile Card Converter -->
        <div class="room-comparison-wrapper reveal-up">
            <!-- Desktop Table View -->
            <table class="room-comparison-table" aria-label="Room specification comparison table">
                <thead>
                    <tr>
                        <th scope="col" class="th-spec">Specification</th>
                        <th scope="col">Deluxe Room</th>
                        <th scope="col" class="th-highlight">Premium Suite</th>
                        <th scope="col">Family Villa Suite</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Ideal For</th>
                        <td>Couples &amp; Solo Travellers</td>
                        <td class="td-highlight">Couples &amp; Honeymooners</td>
                        <td>Families &amp; Small Groups</td>
                    </tr>
                    <tr>
                        <th scope="row">Max Guests</th>
                        <td>2 Guests</td>
                        <td class="td-highlight">2 Guests</td>
                        <td>4 Guests</td>
                    </tr>
                    <tr>
                        <th scope="row">Bed Type</th>
                        <td>1 King Bed</td>
                        <td class="td-highlight">1 King Bed</td>
                        <td>2 King Bedrooms</td>
                    </tr>
                    <tr>
                        <th scope="row">Floor Size</th>
                        <td>32 m²</td>
                        <td class="td-highlight">54 m²</td>
                        <td>85 m²</td>
                    </tr>
                    <tr>
                        <th scope="row">Outdoor Space</th>
                        <td>Private Balcony</td>
                        <td class="td-highlight">Private Deck &amp; Plunge Pool</td>
                        <td>Private Garden Pavilion</td>
                    </tr>
                    <tr>
                        <th scope="row">View Type</th>
                        <td>Garden &amp; Forest</td>
                        <td class="td-highlight">Panoramic Jungle Sunrise</td>
                        <td>Tropical Sanctuary Garden</td>
                    </tr>
                    <tr>
                        <th scope="row">In-Room Breakfast</th>
                        <td><i class="fa-solid fa-check check-yes" aria-hidden="true"></i></td>
                        <td class="td-highlight"><i class="fa-solid fa-check check-yes" aria-hidden="true"></i></td>
                        <td><i class="fa-solid fa-check check-yes" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <th scope="row">Personal Concierge</th>
                        <td>—</td>
                        <td class="td-highlight"><i class="fa-solid fa-check check-yes" aria-hidden="true"></i></td>
                        <td><i class="fa-solid fa-check check-yes" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <th scope="row">Action</th>
                        <td><a href="<?= base_url('booking.php?room_id=1') ?>" class="btn btn-outline-dark btn-sm">Enquire Room</a></td>
                        <td class="td-highlight"><a href="<?= base_url('booking.php?room_id=2') ?>" class="btn btn-primary btn-sm">Enquire Suite</a></td>
                        <td><a href="<?= base_url('booking.php?room_id=3') ?>" class="btn btn-outline-dark btn-sm">Enquire Villa</a></td>
                    </tr>
                </tbody>
            </table>

            <!-- Mobile Comparison Stack (renders on screen <= 768px) -->
            <div class="mobile-comparison-cards">
                <!-- Deluxe Card -->
                <div class="mobile-comp-card">
                    <h3 class="comp-card-title">Deluxe Room</h3>
                    <ul class="comp-card-specs">
                        <li><strong>Capacity:</strong> 2 Guests</li>
                        <li><strong>Bed:</strong> King Bed</li>
                        <li><strong>Size:</strong> 32 m²</li>
                        <li><strong>Outdoor:</strong> Private Balcony</li>
                        <li><strong>View:</strong> Garden &amp; Forest</li>
                    </ul>
                    <a href="<?= base_url('booking.php?room_id=1') ?>" class="btn btn-outline-dark btn-sm full-width">Enquire Deluxe Room</a>
                </div>

                <!-- Premium Suite Card -->
                <div class="mobile-comp-card comp-card-highlight">
                    <span class="comp-card-badge">Signature</span>
                    <h3 class="comp-card-title">Premium Suite</h3>
                    <ul class="comp-card-specs">
                        <li><strong>Capacity:</strong> 2 Guests</li>
                        <li><strong>Bed:</strong> King Bed</li>
                        <li><strong>Size:</strong> 54 m²</li>
                        <li><strong>Outdoor:</strong> Private Deck &amp; Plunge Pool</li>
                        <li><strong>View:</strong> Panoramic Jungle Sunrise</li>
                        <li><strong>Butler Service:</strong> Included</li>
                    </ul>
                    <a href="<?= base_url('booking.php?room_id=2') ?>" class="btn btn-primary btn-sm full-width">Enquire Premium Suite</a>
                </div>

                <!-- Family Villa Card -->
                <div class="mobile-comp-card">
                    <h3 class="comp-card-title">Family Villa Suite</h3>
                    <ul class="comp-card-specs">
                        <li><strong>Capacity:</strong> 4 Guests</li>
                        <li><strong>Bed:</strong> 2 King Bedrooms</li>
                        <li><strong>Size:</strong> 85 m²</li>
                        <li><strong>Outdoor:</strong> Private Garden Pavilion</li>
                        <li><strong>View:</strong> Tropical Sanctuary Garden</li>
                    </ul>
                    <a href="<?= base_url('booking.php?room_id=3') ?>" class="btn btn-outline-dark btn-sm full-width">Enquire Family Villa</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     7. INCLUDED AMENITIES SECTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory amenities-section" id="amenities" aria-labelledby="amenities-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">COMFORT INCLUDED</span>
            <h2 class="section-title" id="amenities-heading">Thoughtful Details in Every Stay</h2>
            <p class="section-subtitle">
                Carefully selected amenities provided in all Serona rooms and suites to ensure your stay is completely effortless.
            </p>
        </div>

        <div class="facilities-grid reveal-up">
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-snowflake" aria-hidden="true"></i></div>
                <h3 class="facility-title">Climate Control</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-wifi" aria-hidden="true"></i></div>
                <h3 class="facility-title">High-Speed Wi-Fi</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-bed" aria-hidden="true"></i></div>
                <h3 class="facility-title">Teak &amp; Linen Bedding</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-bath" aria-hidden="true"></i></div>
                <h3 class="facility-title">En-Suite Bathroom</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-shower" aria-hidden="true"></i></div>
                <h3 class="facility-title">Hot Spring Shower</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-bell-concierge" aria-hidden="true"></i></div>
                <h3 class="facility-title">In-Room Dining</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-mug-hot" aria-hidden="true"></i></div>
                <h3 class="facility-title">Organic Tea &amp; Coffee</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-vault" aria-hidden="true"></i></div>
                <h3 class="facility-title">Wardrobe &amp; Safe</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-pump-soap" aria-hidden="true"></i></div>
                <h3 class="facility-title">Organic Toiletries</h3>
            </div>
            <div class="facility-item">
                <div class="facility-icon"><i class="fa-solid fa-broom" aria-hidden="true"></i></div>
                <h3 class="facility-title">Daily Housekeeping</h3>
            </div>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
