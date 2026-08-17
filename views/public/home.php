<?php include VIEWS_PATH . '/partials/header.php'; ?>

<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<!-- Hero Section (Phase 1 placeholder) -->
<section class="hero" id="hero" aria-labelledby="hero-heading">
    <div class="hero-content">
        <p class="hero-eyebrow">Welcome to</p>
        <h1 class="hero-title" id="hero-heading"><?= e(APP_NAME) ?></h1>
        <p class="hero-subtitle"><?= e(APP_TAGLINE) ?></p>
        <div class="hero-actions">
            <a href="<?= base_url('rooms.php') ?>" class="btn btn-primary" id="hero-explore-btn">Explore Rooms</a>
            <a href="<?= base_url('booking.php') ?>" class="btn btn-outline" id="hero-book-btn">Book an Enquiry</a>
        </div>
    </div>
</section>

<!-- Featured Rooms (Phase 1 placeholder) -->
<?php if (!empty($featured_rooms)): ?>
<section class="section featured-rooms" id="featured-rooms" aria-labelledby="featured-rooms-heading">
    <div class="container">
        <h2 class="section-title" id="featured-rooms-heading">Featured Rooms</h2>
        <div class="rooms-grid">
            <?php foreach ($featured_rooms as $room): ?>
            <article class="room-card">
                <h3 class="room-card-title"><?= e($room['name']) ?></h3>
                <p class="room-card-desc"><?= e($room['short_description'] ?? '') ?></p>
                <a href="<?= base_url('room-details.php?slug=' . urlencode($room['slug'])) ?>" class="btn btn-outline btn-sm">View Details</a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Phase 2: Full hero, animations, galleries, dining, experiences will be built here -->

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
