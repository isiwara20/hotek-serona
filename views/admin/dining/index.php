<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-dining-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Dining Menu &amp; Meals Management</h1>
            <p class="page-subtitle">Add new meals, update menu prices, upload dish photography, and manage culinary offerings.</p>
        </div>
        <div class="header-actions">
            <button type="button" class="admin-btn admin-btn--primary" id="open-add-dining-modal">
                <i class="fa-solid fa-plus"></i> Add New Meal
            </button>
            <a href="<?= base_url('dining.php') ?>" target="_blank" class="admin-btn admin-btn--secondary">
                <i class="fa-solid fa-eye"></i> View Public Dining Page
            </a>
        </div>
    </div>

    <!-- Dining Meals Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Meal Photo</th>
                        <th>Meal / Dish Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Ingredients / Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dining)): ?>
                        <?php foreach ($dining as $d): ?>
                            <tr>
                                <td>#<?= (int)$d['id'] ?></td>
                                <td>
                                    <img
                                        src="<?= asset($d['filename'] ?? 'images/dining/dining-main.jpg') ?>"
                                        alt="<?= e($d['name']) ?>"
                                        style="width: 60px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #E5E2DA;"
                                    >
                                </td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($d['name']) ?></span>
                                    </div>
                                </td>
                                <td><span class="room-pill"><?= e($d['category'] ?? 'Breakfast') ?></span></td>
                                <td><strong style="color: #263B31;"><?= e($d['price'] ?? '$18.00') ?></strong></td>
                                <td><span class="message-snippet"><?= e($d['description'] ?? 'No description') ?></span></td>
                                <td>
                                    <?php if (!empty($d['is_active'])): ?>
                                        <span class="status-badge status-badge--confirmed">AVAILABLE</span>
                                    <?php else: ?>
                                        <span class="status-badge status-badge--cancelled">UNAVAILABLE</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button
                                            type="button"
                                            class="action-btn action-btn--edit edit-dining-btn"
                                            data-id="<?= (int)$d['id'] ?>"
                                            data-name="<?= e($d['name']) ?>"
                                            data-category="<?= e($d['category'] ?? 'Breakfast') ?>"
                                            data-price="<?= e($d['price'] ?? '$18.00') ?>"
                                            data-desc="<?= e($d['description'] ?? '') ?>"
                                            data-active="<?= !empty($d['is_active']) ? '1' : '0' ?>"
                                            title="Edit Meal"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a
                                            href="<?= base_url('admin.php?page=dining&action=delete&id=' . (int)$d['id']) ?>"
                                            class="action-btn"
                                            style="background-color: #FDF2E9; color: #d9534f;"
                                            onclick="return confirm('Are you sure you want to delete this meal from the menu?');"
                                            title="Delete Meal"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="empty-table-msg">No meals found in menu catalogue.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Meal -->
<div class="admin-modal-overlay" id="dining-modal-overlay" aria-hidden="true">
    <div class="admin-modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="dining-modal-title">Add New Meal</h3>
            <button type="button" class="modal-close-btn" id="close-dining-modal">&times;</button>
        </div>

        <form action="<?= base_url('admin.php?action=save_dining') ?>" method="POST" enctype="multipart/form-data" class="modal-body-form">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="dining-id">

            <div class="form-group">
                <label for="dining-name" class="form-label">Meal / Dish Name *</label>
                <input type="text" name="name" id="dining-name" class="form-input" placeholder="e.g. Ceylon Egg Hoppers &amp; Sambal" required>
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="dining-category" class="form-label">Meal Category *</label>
                    <select name="category" id="dining-category" class="form-select" required>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Desserts">Desserts</option>
                        <option value="Beverages &amp; Cocktails">Beverages &amp; Cocktails</option>
                        <option value="Chef's Specials">Chef's Specials</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dining-price" class="form-label">Price *</label>
                    <input type="text" name="price" id="dining-price" class="form-input" placeholder="e.g. $18.00 or LKR 4,500" value="$18.00" required>
                </div>
            </div>

            <div class="form-group">
                <label for="dining-file" class="form-label"><i class="fa-solid fa-upload"></i> Select Meal Photo from Device</label>
                <input type="file" name="image_file" id="dining-file" class="form-input" accept="image/*">
                <small style="color: #6F776F; margin-top: 0.25rem;">Supported formats: JPG, PNG, WebP (Max 5MB)</small>
            </div>

            <div class="form-group">
                <label for="dining-desc" class="form-label">Description &amp; Key Ingredients</label>
                <textarea name="description" id="dining-desc" class="form-textarea" rows="3" placeholder="Describe taste profile, preparation, and key fresh ingredients..."></textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" id="dining-active" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                <label for="dining-active" class="form-label" style="margin: 0; cursor: pointer;">Set Meal as Available on Menu</label>
            </div>

            <div class="modal-footer">
                <button type="button" class="admin-btn admin-btn--secondary" id="cancel-dining-modal">Cancel</button>
                <button type="submit" class="admin-btn admin-btn--primary">Save Meal Details</button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
