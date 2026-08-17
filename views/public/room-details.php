<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<section class="section page-hero" aria-labelledby="room-detail-heading">
    <div class="container">
        <h1 class="page-title" id="room-detail-heading"><?= e($room['name'] ?? 'Room Details') ?></h1>
    </div>
</section>

<?php if (!empty($room)): ?>
<section class="section room-detail" id="room-detail">
    <div class="container">
        <div class="room-detail-grid">
            <div class="room-detail-info">
                <p class="room-description"><?= nl2br(e($room['description'] ?? $room['short_description'] ?? '')) ?></p>

                <ul class="room-specs">
                    <li><i class="fa-solid fa-user" aria-hidden="true"></i> <strong>Capacity:</strong> <?= e((string) $room['capacity']) ?> Guests</li>
                    <li><i class="fa-solid fa-bed" aria-hidden="true"></i> <strong>Bed Type:</strong> <?= e($room['bed_type'] ?? 'N/A') ?></li>
                    <?php if (!empty($room['room_size'])): ?>
                    <li><i class="fa-solid fa-expand" aria-hidden="true"></i> <strong>Room Size:</strong> <?= e($room['room_size']) ?></li>
                    <?php endif; ?>
                </ul>

                <div class="room-detail-actions">
                    <a href="<?= base_url('booking.php?room_id=' . (int) $room['id']) ?>" class="btn btn-primary" id="room-book-btn">
                        Book This Room
                    </a>
                    <a href="<?= base_url('rooms.php') ?>" class="btn btn-outline">
                        &larr; All Rooms
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
