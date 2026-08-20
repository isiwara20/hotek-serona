<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-rooms-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Rooms &amp; Suites Management</h1>
            <p class="page-subtitle">Add new rooms, upload suite photography, update specs, and toggle featured spotlight.</p>
        </div>
        <div class="header-actions">
            <button type="button" class="admin-btn admin-btn--primary" id="open-add-room-modal">
                <i class="fa-solid fa-plus"></i> Add New Room
            </button>
            <a href="<?= base_url('rooms.php') ?>" target="_blank" class="admin-btn admin-btn--secondary">
                <i class="fa-solid fa-eye"></i> Preview Public Rooms
            </a>
        </div>
    </div>

    <!-- Rooms Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Photo</th>
                        <th>Room Name &amp; Slug</th>
                        <th>Short Description</th>
                        <th>Capacity</th>
                        <th>Bed Type &amp; Size</th>
                        <th>Spotlight</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rooms)): ?>
                        <?php foreach ($rooms as $r): ?>
                            <tr>
                                <td>#<?= (int)$r['id'] ?></td>
                                <td>
                                    <img
                                        src="<?= asset($r['image_path'] ?? 'images/rooms/deluxe-suite.jpg') ?>"
                                        alt="<?= e($r['name']) ?>"
                                        style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #E5E2DA;"
                                    >
                                </td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($r['name']) ?></span>
                                        <span class="user-sub"><?= e($r['slug']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="message-snippet"><?= e($r['short_description'] ?? 'No description') ?></span>
                                </td>
                                <td>
                                    <span class="date-tag"><i class="fa-solid fa-user"></i> <?= (int)$r['capacity'] ?> Guests</span>
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 0.1rem;">
                                        <span><?= e($r['bed_type'] ?? 'King Bed') ?></span>
                                        <span class="user-sub"><?= e($r['room_size'] ?? '45 sqm') ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($r['is_featured'])): ?>
                                        <span class="status-badge status-badge--confirmed"><i class="fa-solid fa-crown"></i> FEATURED</span>
                                    <?php else: ?>
                                        <span class="status-badge status-badge--completed">Standard</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($r['status'] === 'AVAILABLE'): ?>
                                        <span class="status-badge status-badge--confirmed">AVAILABLE</span>
                                    <?php else: ?>
                                        <span class="status-badge status-badge--cancelled"><?= e($r['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button
                                            type="button"
                                            class="action-btn action-btn--edit edit-room-btn"
                                            data-id="<?= (int)$r['id'] ?>"
                                            data-name="<?= e($r['name']) ?>"
                                            data-slug="<?= e($r['slug']) ?>"
                                            data-desc="<?= e($r['short_description'] ?? '') ?>"
                                            data-category="<?= e($r['category'] ?? 'rooms') ?>"
                                            data-capacity="<?= (int)$r['capacity'] ?>"
                                            data-bed="<?= e($r['bed_type'] ?? 'King Bed') ?>"
                                            data-size="<?= e($r['room_size'] ?? '45 sqm') ?>"
                                            data-status="<?= e($r['status']) ?>"
                                            data-featured="<?= !empty($r['is_featured']) ? '1' : '0' ?>"
                                            title="Edit Room"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a
                                            href="<?= base_url('admin.php?page=rooms&action=delete&id=' . (int)$r['id']) ?>"
                                            class="action-btn"
                                            style="background-color: #FDF2E9; color: #d9534f;"
                                            onclick="return confirm('Are you sure you want to delete this room?');"
                                            title="Delete Room"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="empty-table-msg">No rooms found in database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Room -->
<div class="admin-modal-overlay" id="room-modal-overlay" aria-hidden="true">
    <div class="admin-modal-card" style="max-width: 600px;">
        <div class="modal-header">
            <h3 class="modal-title" id="room-modal-title">Add New Room</h3>
            <button type="button" class="modal-close-btn" id="close-room-modal">&times;</button>
        </div>

        <form action="<?= base_url('admin.php?action=save_room') ?>" method="POST" enctype="multipart/form-data" class="modal-body-form">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="room-id">

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="room-name" class="form-label">Room / Suite Name *</label>
                    <input type="text" name="name" id="room-name" class="form-input" placeholder="e.g. Executive Forest Villa" required>
                </div>
                <div class="form-group">
                    <label for="room-slug" class="form-label">URL Slug</label>
                    <input type="text" name="slug" id="room-slug" class="form-input" placeholder="e.g. executive-forest-villa">
                </div>
            </div>

            <div class="form-group">
                <label for="room-file" class="form-label"><i class="fa-solid fa-upload"></i> Select Room Photo from Device</label>
                <input type="file" name="image_file" id="room-file" class="form-input" accept="image/*">
                <small style="color: #6F776F; margin-top: 0.25rem;">Supported formats: JPG, PNG, WebP (Max 5MB)</small>
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="room-category" class="form-label">Room Category *</label>
                    <select name="category" id="room-category" class="form-select" required>
                        <option value="rooms">Deluxe Rooms</option>
                        <option value="suites">Signature Suites</option>
                        <option value="family">Family Villas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="room-short-desc" class="form-label">Short Description</label>
                    <textarea name="short_description" id="room-short-desc" class="form-textarea" rows="2" placeholder="Brief summary of room layout and views..."></textarea>
                </div>
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="room-capacity" class="form-label">Guest Capacity</label>
                    <input type="number" name="capacity" id="room-capacity" class="form-input" value="2" min="1" max="10" required>
                </div>
                <div class="form-group">
                    <label for="room-bed-type" class="form-label">Bed Type</label>
                    <input type="text" name="bed_type" id="room-bed-type" class="form-input" value="King Bed" required>
                </div>
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="room-size" class="form-label">Floor Area / Size</label>
                    <input type="text" name="room_size" id="room-size" class="form-input" value="45 sqm" required>
                </div>
                <div class="form-group">
                    <label for="room-status" class="form-label">Availability Status</label>
                    <select name="status" id="room-status" class="form-select">
                        <option value="AVAILABLE">AVAILABLE</option>
                        <option value="UNAVAILABLE">UNAVAILABLE</option>
                        <option value="HIDDEN">HIDDEN</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                <input type="checkbox" name="is_featured" id="room-featured" value="1" style="width: 18px; height: 18px; cursor: pointer;">
                <label for="room-featured" class="form-label" style="margin: 0; cursor: pointer;">Set as Featured Room Spotlight</label>
            </div>

            <div class="modal-footer">
                <button type="button" class="admin-btn admin-btn--secondary" id="cancel-room-modal">Cancel</button>
                <button type="submit" class="admin-btn admin-btn--primary">Save Room Details</button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
