<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-gallery-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Resort Photo Gallery Management</h1>
            <p class="page-subtitle">Upload photography, edit captions, and manage gallery category filters.</p>
        </div>
        <div class="header-actions">
            <button type="button" class="admin-btn admin-btn--primary" id="open-add-gallery-modal">
                <i class="fa-solid fa-plus"></i> Add Gallery Image
            </button>
            <a href="<?= base_url('gallery.php') ?>" target="_blank" class="admin-btn admin-btn--secondary">
                <i class="fa-solid fa-eye"></i> View Live Gallery
            </a>
        </div>
    </div>

    <!-- Gallery Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image Preview</th>
                        <th>Caption / Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gallery)): ?>
                        <?php foreach ($gallery as $g): ?>
                            <tr>
                                <td>#<?= (int)$g['id'] ?></td>
                                <td>
                                    <img
                                        src="<?= asset($g['image_path'] ?? $g['filename']) ?>"
                                        alt="<?= e($g['caption'] ?? 'Gallery Image') ?>"
                                        style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #E5E2DA;"
                                    >
                                </td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($g['title'] ?? $g['caption'] ?? 'Untitled Image') ?></span>
                                        <span class="user-sub"><?= e($g['caption'] ?? '') ?></span>
                                    </div>
                                </td>
                                <td><span class="room-pill"><?= e($g['category'] ?? 'resort') ?></span></td>
                                <td>
                                    <span class="status-badge status-badge--confirmed">PUBLISHED</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button
                                            type="button"
                                            class="action-btn action-btn--edit edit-gallery-btn"
                                            data-id="<?= (int)$g['id'] ?>"
                                            data-caption="<?= e($g['caption'] ?? '') ?>"
                                            data-category="<?= e($g['category'] ?? 'rooms') ?>"
                                            title="Edit Image Caption"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a
                                            href="<?= base_url('admin.php?page=gallery&action=delete&id=' . (int)$g['id']) ?>"
                                            class="action-btn"
                                            style="background-color: #FDF2E9; color: #d9534f;"
                                            onclick="return confirm('Delete this gallery photo?');"
                                            title="Delete Image"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-table-msg">No gallery images found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Gallery -->
<div class="admin-modal-overlay" id="gallery-modal-overlay" aria-hidden="true">
    <div class="admin-modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="gallery-modal-title">Add Gallery Photo</h3>
            <button type="button" class="modal-close-btn" id="close-gallery-modal">&times;</button>
        </div>

        <form action="<?= base_url('admin.php?action=save_gallery') ?>" method="POST" enctype="multipart/form-data" class="modal-body-form">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="gallery-id">

            <div class="form-group">
                <label for="gallery-file" class="form-label"><i class="fa-solid fa-upload"></i> Select Image from Device</label>
                <input type="file" name="image_file" id="gallery-file" class="form-input" accept="image/*">
                <small style="color: #6F776F; margin-top: 0.25rem;">Supported formats: JPG, PNG, WebP (Max 5MB)</small>
            </div>

            <div class="form-group">
                <label for="gallery-filename" class="form-label">Or Image Asset Path</label>
                <input type="text" name="filename" id="gallery-filename" class="form-input" value="images/gallery/gallery-1.jpg">
            </div>

            <div class="form-group">
                <label for="gallery-caption" class="form-label">Caption / Description</label>
                <input type="text" name="caption" id="gallery-caption" class="form-input" placeholder="e.g. Golden hour sunset over Sigiriya pool deck">
            </div>

            <div class="form-group">
                <label for="gallery-category" class="form-label">Category</label>
                <select name="category" id="gallery-category" class="form-select">
                    <option value="rooms">Rooms &amp; Suites</option>
                    <option value="pool">Pool &amp; Sky</option>
                    <option value="dining">Dining</option>
                    <option value="experiences">Experiences</option>
                    <option value="nature">Nature &amp; Views</option>
                    <option value="resort">Resort Grounds</option>
                </select>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" id="gallery-active" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                <label for="gallery-active" class="form-label" style="margin: 0; cursor: pointer;">Set Image as Active</label>
            </div>

            <div class="modal-footer">
                <button type="button" class="admin-btn admin-btn--secondary" id="cancel-gallery-modal">Cancel</button>
                <button type="submit" class="admin-btn admin-btn--primary">Save Gallery Photo</button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
