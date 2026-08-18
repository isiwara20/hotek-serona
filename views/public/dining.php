<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC DINING HERO
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section dining-hero" id="dining-hero" aria-labelledby="dining-hero-title">
    <div class="hero-bg-wrapper">
        <img
            src="<?= asset('images/dining/dining-main.jpg') ?>"
            alt="Serona Hotel & Resort elegant dining setting surrounded by tropical greenery"
            class="hero-bg-image"
        >
        <div class="hero-overlay dining-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">
                <i class="fa-solid fa-seedling" aria-hidden="true" style="font-size: 0.8rem; color: var(--color-sage-light);"></i>
                TASTE SERONA
            </span>
            <h1 class="hero-title" id="dining-hero-title">Dining Inspired<br>by Nature</h1>
            <p class="hero-subtitle">
                Thoughtfully prepared dishes, fresh ingredients and warm hospitality come together in a dining experience shaped by the spirit of Serona.
            </p>
            <div class="hero-actions">
                <a href="#dining-philosophy" class="btn btn-light" id="hero-discover-dining-btn">
                    Discover Our Dining <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                </a>
                <a href="<?= base_url('contact.php') ?>" class="btn btn-outline-white" id="hero-dining-enquiry-btn">
                    Make an Enquiry <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="dining-hero-decoration" aria-hidden="true">
        <i class="fa-solid fa-leaf"></i>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. DINING PHILOSOPHY / INTRODUCTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="dining-philosophy" aria-labelledby="dining-intro-heading">
    <div class="container">
        <div class="intro-grid">

            <!-- Left: Content -->
            <div class="intro-content reveal-left">
                <span class="eyebrow-label">OUR DINING PHILOSOPHY</span>
                <h2 class="section-title" id="dining-intro-heading">A Celebration of<br>Fresh Flavours</h2>
                <p class="intro-description">
                    Dining at Serona is about more than the meal. It is a celebration of fresh ingredients, comforting flavours, thoughtful presentation and moments shared in a peaceful natural setting.
                </p>
                <p class="intro-description" style="margin-top: calc(var(--space-4) * -1);">
                    From relaxed breakfasts to memorable evening dining, every experience is created to complement the calm rhythm of your stay.
                </p>

                <div class="dining-intro-features">
                    <div class="dining-intro-feature">
                        <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                        <span>Fresh Ingredients</span>
                    </div>
                    <div class="dining-intro-feature">
                        <i class="fa-solid fa-bowl-food" aria-hidden="true"></i>
                        <span>Thoughtful Plating</span>
                    </div>
                    <div class="dining-intro-feature">
                        <i class="fa-solid fa-sun" aria-hidden="true"></i>
                        <span>Natural Settings</span>
                    </div>
                    <div class="dining-intro-feature">
                        <i class="fa-solid fa-hands-holding-circle" aria-hidden="true"></i>
                        <span>Warm Hospitality</span>
                    </div>
                </div>

                <a href="#dining-categories" class="btn btn-outline-dark" id="dining-intro-explore-btn">
                    Explore the Experience <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Right: Layered Image Composition -->
            <div class="intro-image-composition reveal-right">
                <img
                    src="<?= asset('images/gallery/gallery-2.jpg') ?>"
                    alt="Serona restaurant warm interior with natural wood elements and garden view"
                    class="intro-img-main"
                    loading="lazy"
                >
                <img
                    src="<?= asset('images/dining/dining-main.jpg') ?>"
                    alt="Beautifully plated dish with fresh herbs and local ingredients at Serona"
                    class="intro-img-secondary dining-intro-img-secondary"
                    loading="lazy"
                >
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. SIGNATURE DINING EXPERIENCE (DARK SECTION)
     ───────────────────────────────────────────────────────────── -->
<section class="section-dark dining-signature-section" id="dining-signature" aria-labelledby="dining-sig-heading">
    <div class="dining-split-grid">

        <!-- Left: Image -->
        <div class="dining-img-wrapper dining-sig-image-col">
            <img
                src="<?= asset('images/gallery/gallery-1.jpg') ?>"
                alt="Elegant Serona dining space with warm lighting and natural surroundings"
                loading="lazy"
                class="dining-sig-img"
            >
        </div>

        <!-- Right: Dark Content Panel -->
        <div class="dining-content-panel" aria-label="Signature dining experience details">
            <span class="eyebrow-label">SIGNATURE EXPERIENCE</span>
            <h2 class="section-title" id="dining-sig-heading">Dine in the Heart<br>of Serona</h2>
            <p class="dining-description">
                Enjoy thoughtfully prepared cuisine in a setting where warm interiors, natural textures and peaceful surroundings come together to create something truly memorable.
            </p>

            <ul class="dining-sig-features" aria-label="Signature dining features">
                <li class="dining-sig-feature">
                    <span class="dining-sig-icon"><i class="fa-solid fa-leaf" aria-hidden="true"></i></span>
                    <div>
                        <strong>Freshly Prepared</strong>
                        <p>Every dish crafted with care and attention each day.</p>
                    </div>
                </li>
                <li class="dining-sig-feature">
                    <span class="dining-sig-icon"><i class="fa-solid fa-map-location" aria-hidden="true"></i></span>
                    <div>
                        <strong>Locally Inspired</strong>
                        <p>Flavours that reflect the richness of Sri Lankan cuisine.</p>
                    </div>
                </li>
                <li class="dining-sig-feature">
                    <span class="dining-sig-icon"><i class="fa-solid fa-utensils" aria-hidden="true"></i></span>
                    <div>
                        <strong>Thoughtful Presentation</strong>
                        <p>Simple elegance in every plate and setting.</p>
                    </div>
                </li>
                <li class="dining-sig-feature">
                    <span class="dining-sig-icon"><i class="fa-solid fa-heart" aria-hidden="true"></i></span>
                    <div>
                        <strong>Warm Hospitality</strong>
                        <p>Attentive, unhurried service throughout your meal.</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     4. CULINARY CATEGORIES
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream" id="dining-categories" aria-labelledby="dining-cat-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">WHAT WE OFFER</span>
            <h2 class="section-title" id="dining-cat-heading">Savour Every Moment</h2>
            <p class="section-subtitle">
                From the first light of morning through to quiet evening dining, Serona offers a complete culinary experience for every mood and occasion.
            </p>
        </div>

        <!-- Asymmetric Category Grid -->
        <div class="dining-category-grid reveal-up">

            <!-- Large Feature: Breakfast -->
            <article class="dining-cat-card dining-cat-large" id="cat-breakfast">
                <img
                    src="<?= asset('images/gallery/gallery-3.jpg') ?>"
                    alt="Fresh Sri Lankan breakfast spread with tropical fruits and local delicacies"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Breakfast</span>
                    <p class="dining-cat-desc">A comforting selection of traditional flavours prepared fresh each morning. Begin the day gently, surrounded by nature.</p>
                    <span class="dining-cat-tag">7:00 AM – 10:30 AM</span>
                </div>
            </article>

            <!-- Medium: Lunch -->
            <article class="dining-cat-card dining-cat-medium" id="cat-lunch">
                <img
                    src="<?= asset('images/gallery/gallery-4.jpg') ?>"
                    alt="Light fresh lunch plates with garden vegetables and herbs"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Lunch</span>
                    <p class="dining-cat-desc">Garden fresh plates celebrating seasonal vegetables and local ingredients.</p>
                </div>
            </article>

            <!-- Medium: Local Specialities -->
            <article class="dining-cat-card dining-cat-medium" id="cat-local">
                <img
                    src="<?= asset('images/dining/dining-main.jpg') ?>"
                    alt="Sri Lankan local speciality dishes with spices and traditional flavours"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Local Specialities</span>
                    <p class="dining-cat-desc">Authentic Sri Lankan flavours prepared with genuine care and tradition.</p>
                </div>
            </article>

            <!-- Small Tiles Row -->
            <article class="dining-cat-card dining-cat-small" id="cat-dinner">
                <img
                    src="<?= asset('images/gallery/gallery-1.jpg') ?>"
                    alt="Elegant evening dinner setting at Serona"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Dinner</span>
                </div>
            </article>

            <article class="dining-cat-card dining-cat-small" id="cat-desserts">
                <img
                    src="<?= asset('images/gallery/gallery-2.jpg') ?>"
                    alt="Serona desserts and sweet treats"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Desserts</span>
                </div>
            </article>

            <article class="dining-cat-card dining-cat-small" id="cat-beverages">
                <img
                    src="<?= asset('images/hero/experience-band.jpg') ?>"
                    alt="Artisan beverages and fresh drinks at Serona"
                    class="dining-cat-img"
                    loading="lazy"
                >
                <div class="dining-cat-overlay">
                    <span class="dining-cat-label">Beverages</span>
                </div>
            </article>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. FRESH INGREDIENTS STORY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="dining-story" aria-labelledby="dining-story-heading">
    <div class="container">
        <div class="dining-story-grid">

            <!-- Left: Image -->
            <div class="dining-story-image-col reveal-left">
                <div class="dining-story-img-wrap">
                    <img
                        src="<?= asset('images/gallery/gallery-4.jpg') ?>"
                        alt="Fresh vegetables, herbs and local ingredients sourced for Serona kitchen"
                        class="dining-story-main-img"
                        loading="lazy"
                    >
                    <div class="dining-story-badge">
                        <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                        <span>Farm Fresh</span>
                    </div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="dining-story-content reveal-right">
                <span class="eyebrow-label">FROM NATURE TO TABLE</span>
                <h2 class="section-title" id="dining-story-heading">Fresh Ingredients.<br>Thoughtful Cooking.</h2>
                <p class="intro-description">
                    Our culinary approach celebrates freshness, simplicity and flavour, with ingredients selected to create meals that feel both familiar and memorable.
                </p>

                <div class="dining-story-features">
                    <div class="dining-story-feature">
                        <div class="dining-story-icon">
                            <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="dining-story-feature-title">Seasonal Produce</h3>
                            <p>Ingredients chosen to reflect what each season offers naturally.</p>
                        </div>
                    </div>
                    <div class="dining-story-feature">
                        <div class="dining-story-icon">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="dining-story-feature-title">Locally Sourced</h3>
                            <p>Supporting local growers and celebrating Sri Lankan produce.</p>
                        </div>
                    </div>
                    <div class="dining-story-feature">
                        <div class="dining-story-icon">
                            <i class="fa-solid fa-fire-flame-simple" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="dining-story-feature-title">Crafted With Care</h3>
                            <p>Every plate prepared with attention to flavour, balance and presentation.</p>
                        </div>
                    </div>
                    <div class="dining-story-feature">
                        <div class="dining-story-icon">
                            <i class="fa-solid fa-spa" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="dining-story-feature-title">Natural &amp; Simple</h3>
                            <p>Honest cooking that lets quality ingredients speak for themselves.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. DINING EXPERIENCES (ASYMMETRIC TILES)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream" id="dining-experiences" aria-labelledby="dining-exp-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">WAYS TO DINE</span>
            <h2 class="section-title" id="dining-exp-heading">Every Meal, a Moment</h2>
            <p class="section-subtitle">
                Whether you prefer a slow start to the morning or a leisurely evening in the open air, Serona dining adapts to your mood.
            </p>
        </div>

        <!-- Asymmetric Experience Grid -->
        <div class="dining-exp-grid reveal-up">

            <!-- Large Left: Garden Dining -->
            <article class="dining-exp-card dining-exp-large" id="exp-garden">
                <img
                    src="<?= asset('images/hero/experience-band.jpg') ?>"
                    alt="Open-air garden dining surrounded by tropical nature at Serona"
                    class="dining-exp-img"
                    loading="lazy"
                >
                <div class="dining-exp-overlay">
                    <span class="dining-exp-eyebrow">Garden Dining</span>
                    <h3 class="dining-exp-title">Embrace the Outdoors</h3>
                    <p class="dining-exp-desc">Enjoy a meal embraced by the natural beauty of Serona — gentle breeze, tropical greenery, open skies.</p>
                </div>
            </article>

            <!-- Right Stack -->
            <div class="dining-exp-stack">

                <!-- Breakfast -->
                <article class="dining-exp-card dining-exp-small" id="exp-breakfast">
                    <img
                        src="<?= asset('images/gallery/gallery-3.jpg') ?>"
                        alt="Relaxed Serona breakfast with fresh tropical fruits and warm morning light"
                        class="dining-exp-img"
                        loading="lazy"
                    >
                    <div class="dining-exp-overlay">
                        <span class="dining-exp-eyebrow">Morning</span>
                        <h3 class="dining-exp-title">Relaxed Breakfast</h3>
                        <p class="dining-exp-desc">Begin the day with fresh flavours and peaceful surroundings.</p>
                    </div>
                </article>

                <!-- Evening Dining -->
                <article class="dining-exp-card dining-exp-small" id="exp-evening">
                    <img
                        src="<?= asset('images/gallery/gallery-1.jpg') ?>"
                        alt="Warm evening dining atmosphere at Serona with soft candlelight"
                        class="dining-exp-img"
                        loading="lazy"
                    >
                    <div class="dining-exp-overlay">
                        <span class="dining-exp-eyebrow">Evening</span>
                        <h3 class="dining-exp-title">Evening Favourites</h3>
                        <p class="dining-exp-desc">Slow down with carefully prepared dishes in a warm evening atmosphere.</p>
                    </div>
                </article>

            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     7. DINING GALLERY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory" id="dining-gallery" aria-labelledby="dining-gallery-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">DINING MOMENTS</span>
            <h2 class="section-title" id="dining-gallery-heading">A Taste of Serona</h2>
        </div>

        <div class="dining-gallery-grid reveal-up">

            <div class="dining-gallery-item dining-gal-1">
                <img src="<?= asset('images/dining/dining-main.jpg') ?>" alt="Elegantly plated dish at Serona restaurant" loading="lazy">
                <div class="gallery-overlay"><span>Restaurant</span></div>
            </div>

            <div class="dining-gallery-item dining-gal-2">
                <img src="<?= asset('images/gallery/gallery-3.jpg') ?>" alt="Fresh breakfast spread with tropical fruits at Serona" loading="lazy">
                <div class="gallery-overlay"><span>Breakfast</span></div>
            </div>

            <div class="dining-gallery-item dining-gal-3">
                <img src="<?= asset('images/gallery/gallery-2.jpg') ?>" alt="Warm Serona dining interior with natural textures" loading="lazy">
                <div class="gallery-overlay"><span>Interior</span></div>
            </div>

            <div class="dining-gallery-item dining-gal-4">
                <img src="<?= asset('images/gallery/gallery-1.jpg') ?>" alt="Garden dining at Serona in the evening light" loading="lazy">
                <div class="gallery-overlay"><span>Garden Dining</span></div>
            </div>

            <div class="dining-gallery-item dining-gal-5">
                <img src="<?= asset('images/gallery/gallery-4.jpg') ?>" alt="Fresh local ingredients and produce used in Serona kitchen" loading="lazy">
                <div class="gallery-overlay"><span>Fresh Produce</span></div>
            </div>

            <div class="dining-gallery-item dining-gal-6">
                <img src="<?= asset('images/hero/experience-band.jpg') ?>" alt="Serona open-air dining terrace with tropical greenery" loading="lazy">
                <div class="gallery-overlay"><span>Al Fresco</span></div>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     8. DINING INFORMATION
     ───────────────────────────────────────────────────────────── -->
<section class="section dining-info-section" id="dining-information" aria-labelledby="dining-info-heading">
    <div class="container">
        <div class="section-header text-center reveal-up">
            <span class="eyebrow-label">DINING INFORMATION</span>
            <h2 class="section-title" id="dining-info-heading">Join Us at the Table</h2>
            <p class="section-subtitle">
                We look forward to welcoming you. Please contact the Serona team for reservations or any special arrangements.
            </p>
        </div>

        <div class="dining-info-grid reveal-up">

            <!-- Opening Hours Column -->
            <div class="dining-hours-col">
                <h3 class="dining-hours-heading">
                    <i class="fa-regular fa-clock" aria-hidden="true"></i> Dining Hours
                </h3>
                <p class="dining-hours-note">Hours shown are indicative. Please confirm with the Serona team during your stay.</p>

                <div class="dining-hours-list">

                    <div class="dining-hours-card">
                        <div class="dining-hours-card-icon">
                            <i class="fa-solid fa-mug-hot" aria-hidden="true"></i>
                        </div>
                        <div class="dining-hours-card-body">
                            <span class="dining-hours-meal">Breakfast</span>
                            <span class="dining-hours-time">7:00 AM – 10:30 AM</span>
                        </div>
                    </div>

                    <div class="dining-hours-card">
                        <div class="dining-hours-card-icon">
                            <i class="fa-solid fa-sun" aria-hidden="true"></i>
                        </div>
                        <div class="dining-hours-card-body">
                            <span class="dining-hours-meal">Lunch</span>
                            <span class="dining-hours-time">12:00 PM – 3:00 PM</span>
                        </div>
                    </div>

                    <div class="dining-hours-card">
                        <div class="dining-hours-card-icon">
                            <i class="fa-solid fa-moon" aria-hidden="true"></i>
                        </div>
                        <div class="dining-hours-card-body">
                            <span class="dining-hours-meal">Dinner</span>
                            <span class="dining-hours-time">7:00 PM – 10:00 PM</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Info Column -->
            <div class="dining-details-col">
                <h3 class="dining-hours-heading">
                    <i class="fa-solid fa-circle-info" aria-hidden="true"></i> Good to Know
                </h3>

                <div class="dining-detail-cards">

                    <div class="dining-detail-card">
                        <i class="fa-solid fa-chair" aria-hidden="true"></i>
                        <div>
                            <h4>Seating</h4>
                            <p>Indoor and outdoor seating available. Enjoy the garden or the warm comfort of our dining room.</p>
                        </div>
                    </div>

                    <div class="dining-detail-card">
                        <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                        <div>
                            <h4>Reservations</h4>
                            <p>Advance arrangements are recommended, particularly for evening dining or larger groups.</p>
                        </div>
                    </div>

                    <div class="dining-detail-card">
                        <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                        <div>
                            <h4>Dietary Preferences</h4>
                            <p>Guests with dietary requirements or preferences are welcome to contact the Serona team ahead of their visit so we can assist where possible.</p>
                        </div>
                    </div>

                    <div class="dining-detail-card">
                        <i class="fa-solid fa-shirt" aria-hidden="true"></i>
                        <div>
                            <h4>Dress Code</h4>
                            <p>Smart casual. We invite guests to dress comfortably and respectfully in keeping with the Serona atmosphere.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     9. PRIVATE DINING
     ───────────────────────────────────────────────────────────── -->
<section class="private-dining-section" id="private-dining" aria-labelledby="private-dining-heading">
    <img
        src="<?= asset('images/gallery/gallery-1.jpg') ?>"
        alt="Intimate candlelit private dining setting at Serona Hotel & Resort"
        class="private-dining-bg"
        loading="lazy"
    >
    <div class="private-dining-overlay"></div>

    <div class="container private-dining-content reveal-up">
        <div class="private-dining-panel">
            <span class="eyebrow-label">PRIVATE MOMENTS</span>
            <h2 class="section-title" id="private-dining-heading">Dining Made<br>More Personal</h2>
            <p class="private-dining-desc">
                For intimate celebrations, meaningful moments or a quieter dining experience, speak with our team about arranging something special. We are here to make it effortless.
            </p>
            <a
                href="<?= (new WhatsAppService())->generateGeneralUrl('Hello Serona Hotel & Resort,' . "\n\n" . 'I would like to enquire about Private Dining arrangements. Please assist me.') ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-light"
                id="private-dining-whatsapp-btn"
            >
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Enquire About Private Dining
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     10. FINAL DINING CTA
     ───────────────────────────────────────────────────────────── -->
<section class="final-cta-section dining-final-cta" id="dining-cta" aria-labelledby="dining-cta-heading">
    <img
        src="<?= asset('images/hero/hero-bg.jpg') ?>"
        alt="Serona Hotel & Resort nature backdrop for dining enquiry"
        class="final-cta-bg"
        loading="lazy"
    >
    <div class="container final-cta-content reveal-up">
        <span class="eyebrow-label">EXPERIENCE SERONA</span>
        <h2 class="section-title" id="dining-cta-heading">A Table Is Waiting</h2>
        <p class="section-subtitle" style="margin-bottom: var(--space-8);">
            Whether you are joining us for a relaxed breakfast, a memorable evening meal or a special occasion, the Serona team is ready to make your dining experience feel effortless.
        </p>

        <div class="hero-actions" style="justify-content: center; gap: var(--space-4);">
            <a href="<?= base_url('contact.php') ?>" class="btn btn-light" id="dining-cta-enquiry-btn">
                Make a Dining Enquiry <i class="fa-solid fa-envelope" aria-hidden="true"></i>
            </a>
            <a
                href="<?= (new WhatsAppService())->generateGeneralUrl('Hello Serona Hotel & Resort,' . "\n\n" . 'I would like to make a dining enquiry. Please assist me.') ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-outline-white"
                id="dining-cta-whatsapp-btn"
            >
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> WhatsApp Us
            </a>
            <a href="mailto:<?= e(ADMIN_EMAIL) ?>" class="btn btn-outline-white" id="dining-cta-email-btn">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i> Email Us
            </a>
        </div>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
