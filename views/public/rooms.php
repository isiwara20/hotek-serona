<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<section class="section page-hero" aria-labelledby="rooms-page-heading">
    <div class="container">
        <h1 class="page-title" id="rooms-page-heading">Rooms &amp; Suites</h1>
        <p class="page-subtitle">Choose your perfect retreat at Serona.</p>
    </div>
</section>

<section class="section rooms-listing" id="rooms-listing" aria-label="Available rooms">
    <div class="container">
        <?php if (empty($rooms)): ?>
            <p class="empty-state">No rooms are currently available. Please check back soon.</p>
        <?php else: ?>
        <div class="rooms-grid">
            <?php foreach ($rooms as $room): ?>
            <article class="room-card" id="room-<?= e((string) $room['id']) ?>">
                <div class="room-card-body">
                    <h2 class="room-card-title"><?= e($room['name']) ?></h2>
                    <p class="room-card-meta">
                        <span><i class="fa-solid fa-user" aria-hidden="true"></i> <?= e((string) $room['capacity']) ?> Guests</span>
                        <span><i class="fa-solid fa-bed" aria-hidden="true"></i> <?= e($room['bed_type'] ?? '') ?></span>
                        <?php if (!empty($room['room_size'])): ?>
                        <span><i class="fa-solid fa-expand" aria-hidden="true"></i> <?= e($room['room_size']) ?></span>
                        <?php endif; ?>
                    </p>
                    <p class="room-card-desc"><?= e($room['short_description'] ?? '') ?></p>
                    <div class="room-card-actions">
                        <a href="<?= base_url('room-details.php?slug=' . urlencode($room['slug'])) ?>" class="btn btn-outline btn-sm">View Details</a>
                        <a href="<?= base_url('booking.php?room_id=' . (int) $room['id']) ?>" class="btn btn-primary btn-sm">Book Enquiry</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
