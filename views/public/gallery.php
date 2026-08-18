<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- ─────────────────────────────────────────────────────────────
     1. CINEMATIC GALLERY HERO
     ───────────────────────────────────────────────────────────── -->
<section class="hero-section gallery-hero" id="hero" aria-labelledby="hero-title">
    <div class="hero-bg-wrapper">
        <img src="<?= asset('images/gallery/gallery-1.jpg') ?>" alt="Serona Hotel & Resort infinity pool surrounded by rainforest foliage at dusk" class="hero-bg-image">
        <div class="hero-overlay gallery-hero-overlay"></div>
    </div>

    <div class="hero-content-container">
        <div class="hero-text-block reveal-up">
            <span class="hero-eyebrow">MOMENTS AT SERONA</span>
            <h1 class="hero-title" id="hero-title">A Glimpse of Serona</h1>
            <p class="hero-subtitle">
                Explore the spaces, flavours, landscapes and quiet moments that define the Serona experience.
            </p>
            <div class="hero-actions">
                <a href="#gallery-grid" class="btn btn-light" id="hero-explore-cta">
                    Explore the Gallery <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                </a>
                <a href="<?= base_url('booking.php') ?>" class="btn btn-outline-white" id="hero-book-cta">
                    Book Your Stay <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Minimal Scroll Indicator -->
    <a href="#intro" class="gallery-scroll-indicator" aria-label="Scroll down to view gallery content">
        <span>EXPLORE</span>
        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
    </a>
</section>

<!-- ─────────────────────────────────────────────────────────────
     2. GALLERY INTRODUCTION
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory gallery-intro-section" id="intro" aria-labelledby="intro-heading">
    <div class="container">
        <div class="gallery-intro-container text-center reveal-up">
            <span class="eyebrow-label">DISCOVER SERONA</span>
            <h2 class="section-title" id="intro-heading">Every Corner Tells a Story</h2>
            <p class="intro-description" style="max-width: 750px; margin-inline: auto;">
                From peaceful rooms and natural surroundings to warm dining moments and unforgettable experiences, discover Serona through a collection of moments captured throughout the resort.
            </p>
            
            <div class="botanical-divider" aria-hidden="true">
                <svg width="80" height="16" viewBox="0 0 80 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8C20 8 20 2 40 2C60 2 60 14 80 8" stroke="#95AB91" stroke-width="1.2"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     3. GALLERY CATEGORY NAVIGATION
     ───────────────────────────────────────────────────────────── -->
<nav class="gallery-filter-section" id="gallery-filter" aria-label="Gallery Categories">
    <div class="container">
        <div class="filter-nav-wrapper">
            <div class="filter-nav-list" role="tablist">
                <?php foreach ($categories as $cat): ?>
                    <button type="button" 
                            class="gallery-filter-btn <?= $selected_category === $cat['key'] ? 'active' : '' ?>" 
                            data-filter="<?= e($cat['key']) ?>"
                            role="tab"
                            aria-selected="<?= $selected_category === $cat['key'] ? 'true' : 'false' ?>">
                        <?= e($cat['label']) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>

<!-- ─────────────────────────────────────────────────────────────
     4. FEATURED VISUAL STORY BANNER
     ───────────────────────────────────────────────────────────── -->
<section class="featured-visual-banner" aria-labelledby="featured-visual-heading">
    <img src="<?= asset('images/hero/hero-bg.jpg') ?>" alt="Panoramic rainforest view of Serona resort" class="featured-banner-img">
    <div class="featured-banner-overlay"></div>
    <div class="container featured-banner-content text-center reveal-up">
        <span class="eyebrow-label" style="color: var(--color-sage-light);">SERONA HOTEL &amp; RESORT</span>
        <h2 class="featured-banner-title" id="featured-visual-heading">Where Nature Shapes Every Stay</h2>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     5. MAIN EDITORIAL MASONRY GALLERY GRID
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream gallery-grid-section" id="gallery-grid" aria-label="Photographic Gallery Grid">
    <div class="container">
        <div class="gallery-masonry-grid" id="masonry-grid">
            <?php foreach ($all_gallery_items as $index => $item): ?>
                <figure class="gallery-card card-aspect-<?= e($item['aspect_ratio'] ?? 'square') ?>" 
                        data-category="<?= e($item['category']) ?>"
                        data-index="<?= $index ?>"
                        data-full-img="<?= asset($item['image_path']) ?>"
                        data-title="<?= e($item['title']) ?>"
                        data-caption="<?= e($item['caption']) ?>"
                        data-category-label="<?= e($item['category_label'] ?? strtoupper($item['category'])) ?>">
                    
                    <img src="<?= asset($item['image_path']) ?>" 
                         alt="<?= e($item['alt_text']) ?>" 
                         class="gallery-card-img" 
                         loading="lazy" 
                         decoding="async">

                    <div class="gallery-card-overlay">
                        <div class="gallery-card-info">
                            <span class="gallery-card-cat"><?= e($item['category_label'] ?? strtoupper($item['category'])) ?></span>
                            <h3 class="gallery-card-title"><?= e($item['title']) ?></h3>
                            <p class="gallery-card-caption"><?= e($item['caption']) ?></p>
                        </div>
                        <button type="button" class="gallery-expand-btn" aria-label="View larger image of <?= e($item['title']) ?>">
                            <i class="fa-solid fa-expand" aria-hidden="true"></i>
                        </button>
                    </div>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     6. ROOMS & SUITES VISUAL STORY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-ivory gallery-story-section" id="rooms-story" aria-labelledby="rooms-story-title">
    <div class="container">
        <div class="story-header text-center reveal-up">
            <span class="eyebrow-label">REST NATURALLY</span>
            <h2 class="section-title" id="rooms-story-title">Spaces Made for Slow Mornings</h2>
            <p class="section-subtitle">Teak wood craftsmanship, organic linens, and sunlit forest balconies designed for quiet retreat.</p>
        </div>

        <div class="story-grid-rooms reveal-up">
            <!-- Left Large Room Image -->
            <div class="story-media-main">
                <img src="<?= asset('images/rooms/premium-suite.jpg') ?>" alt="Serona Premium Suite private plunge pool and sun deck" class="story-img">
                <div class="story-media-caption">
                    <span>PREMIUM SUITE</span>
                    <h4>Private Infinity Plunge Pool</h4>
                </div>
            </div>

            <!-- Right Stacked Detail Images -->
            <div class="story-media-stack">
                <div class="story-media-sub">
                    <img src="<?= asset('images/rooms/deluxe-room.jpg') ?>" alt="Deluxe Room teak bed and forest balcony view" class="story-img">
                    <div class="story-media-caption">
                        <span>DELUXE ROOM</span>
                        <h4>Forest Canopy Balcony</h4>
                    </div>
                </div>

                <div class="story-media-sub">
                    <img src="<?= asset('images/gallery/gallery-2.jpg') ?>" alt="Suite interior details and natural teak finishes" class="story-img">
                    <div class="story-media-caption">
                        <span>INTERIOR DETAILS</span>
                        <h4>Organic Teak &amp; Linen</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-8);">
            <a href="<?= base_url('rooms.php') ?>" class="btn btn-outline-dark" id="rooms-story-link">
                Explore Rooms &amp; Suites <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     7. DINING VISUAL STORY (DEEP FOREST GREEN)
     ───────────────────────────────────────────────────────────── -->
<section class="section section-dark gallery-story-section dining-story-dark" id="dining-story" aria-labelledby="dining-story-title">
    <div class="container">
        <div class="story-header text-center reveal-up">
            <span class="eyebrow-label" style="color: var(--color-sage-light);">TASTE SERONA</span>
            <h2 class="section-title" id="dining-story-title" style="color: var(--color-white);">Moments Around the Table</h2>
            <p class="section-subtitle" style="color: var(--color-sage-pale);">Organic farm harvests, Sri Lankan spices, and open-air forest lanterns.</p>
        </div>

        <div class="story-grid-dining reveal-up">
            <div class="story-dining-card">
                <img src="<?= asset('images/dining/dining-main.jpg') ?>" alt="Serona open-air evening lantern restaurant" class="story-img">
                <div class="story-card-body">
                    <h3>Open-Air Forest Restaurant</h3>
                    <p>Dining surrounded by warm tropical lanterns and nighttime jungle sounds.</p>
                </div>
            </div>

            <div class="story-dining-card">
                <img src="<?= asset('images/gallery/gallery-3.jpg') ?>" alt="Plated gourmet local dish" class="story-img">
                <div class="story-card-body">
                    <h3>Artisanal Local Flavours</h3>
                    <p>Thoughtfully crafted dishes using local harvest and traditional spices.</p>
                </div>
            </div>

            <div class="story-dining-card">
                <img src="<?= asset('images/experiences/private-dining.jpg') ?>" alt="Candlelit private outdoor dining table" class="story-img">
                <div class="story-card-body">
                    <h3>Candlelit Private Setup</h3>
                    <p>Intimate dinner setups for romantic celebrations and special occasions.</p>
                </div>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-8);">
            <a href="<?= base_url('dining.php') ?>" class="btn btn-light" id="dining-story-link">
                Discover Dining <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- ─────────────────────────────────────────────────────────────
     8. EXPERIENCES & NATURE VISUAL STORY
     ───────────────────────────────────────────────────────────── -->
<section class="section section-cream gallery-story-section" id="experiences-story" aria-labelledby="exp-story-title">
    <div class="container">
        <div class="story-header text-center reveal-up">
            <span class="eyebrow-label">EXPERIENCE SERONA</span>
            <h2 class="section-title" id="exp-story-title">Closer to Nature</h2>
            <p class="section-subtitle">Walks through endemic flora, infinity pool leisure, and peaceful solitude.</p>
        </div>

        <div class="story-wide-banner reveal-up">
            <img src="<?= asset('images/experiences/nature-walk.jpg') ?>" alt="Guided rainforest trail walk" class="story-wide-img">
            <div class="story-wide-content">
                <span class="eyebrow-label">SIGNATURE RETREAT</span>
                <h3 class="story-wide-heading">Guided Rainforest Trails</h3>
                <p>Explore natural streams, birdlife, and lush canopy trails accompanied by resident naturalists.</p>
                <a href="<?= base_url('experiences.php') ?>" class="btn btn-primary" id="exp-story-link">
                    Explore Experiences <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>


<?php include VIEWS_PATH . '/partials/footer.php'; ?>

