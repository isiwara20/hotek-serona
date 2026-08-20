<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-experiences-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Resort Experiences Management</h1>
            <p class="page-subtitle">Add new activities, edit guest excursions, and manage guided experience descriptions.</p>
        </div>
        <div class="header-actions">
            <button type="button" class="admin-btn admin-btn--primary" id="open-add-exp-modal">
                <i class="fa-solid fa-plus"></i> Add New Experience
            </button>
            <a href="<?= base_url('experiences.php') ?>" target="_blank" class="admin-btn admin-btn--secondary">
                <i class="fa-solid fa-eye"></i> View Public Experiences
            </a>
        </div>
    </div>

    <!-- Experiences Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Experience Title</th>
                        <th>Description Snippet</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($experiences)): ?>
                        <?php foreach ($experiences as $eItem): ?>
                            <tr>
                                <td>#<?= (int)$eItem['id'] ?></td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($eItem['title'] ?? $eItem['name']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="message-snippet"><?= e($eItem['short_description'] ?? $eItem['description'] ?? 'No description') ?></span>
                                </td>
                                <td>
                                    <span class="status-badge status-badge--confirmed">PUBLISHED</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button
                                            type="button"
                                            class="action-btn action-btn--edit edit-exp-btn"
                                            data-id="<?= (int)$eItem['id'] ?>"
                                            data-name="<?= e($eItem['title'] ?? $eItem['name']) ?>"
                                            data-desc="<?= e($eItem['short_description'] ?? $eItem['description'] ?? '') ?>"
                                            title="Edit Experience"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a
                                            href="<?= base_url('admin.php?page=experiences&action=delete&id=' . (int)$eItem['id']) ?>"
                                            class="action-btn"
                                            style="background-color: #FDF2E9; color: #d9534f;"
                                            onclick="return confirm('Delete this experience?');"
                                            title="Delete Experience"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-table-msg">No experiences found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Experience -->
<div class="admin-modal-overlay" id="exp-modal-overlay" aria-hidden="true">
    <div class="admin-modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="exp-modal-title">Add Experience</h3>
            <button type="button" class="modal-close-btn" id="close-exp-modal">&times;</button>
        </div>

        <form action="<?= base_url('admin.php?action=save_experience') ?>" method="POST" enctype="multipart/form-data" class="modal-body-form">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="exp-id">

            <div class="form-group">
                <label for="exp-name" class="form-label">Experience Title *</label>
                <input type="text" name="name" id="exp-name" class="form-input" placeholder="e.g. Guided Sigiriya Night Safari" required>
            </div>

            <div class="form-group">
                <label for="exp-file" class="form-label"><i class="fa-solid fa-upload"></i> Select Photo from Device</label>
                <input type="file" name="image_file" id="exp-file" class="form-input" accept="image/*">
                <small style="color: #6F776F; margin-top: 0.25rem;">Supported formats: JPG, PNG, WebP (Max 5MB)</small>
            </div>

            <div class="form-group">
                <label for="exp-desc" class="form-label">Description</label>
                <textarea name="description" id="exp-desc" class="form-textarea" rows="3" placeholder="Highlight details of the activity..."></textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" id="exp-active" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                <label for="exp-active" class="form-label" style="margin: 0; cursor: pointer;">Set Experience as Active</label>
            </div>

            <div class="modal-footer">
                <button type="button" class="admin-btn admin-btn--secondary" id="cancel-exp-modal">Cancel</button>
                <button type="submit" class="admin-btn admin-btn--primary">Save Experience</button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
