<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-messages-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Contact Messages Manager</h1>
            <p class="page-subtitle">Review guest inquiries submitted through the website contact form.</p>
        </div>
    </div>

    <!-- Messages Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date &amp; Time</th>
                        <th>Sender Info</th>
                        <th>Topic / Subject</th>
                        <th>Message Content</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $m): ?>
                            <tr id="message-row-<?= (int)$m['id'] ?>">
                                <td>
                                    <span class="date-tag"><?= date('M d, Y', strtotime($m['created_at'])) ?></span>
                                    <span class="created-time"><?= date('H:i', strtotime($m['created_at'])) ?></span>
                                </td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($m['name']) ?></span>
                                        <span class="user-sub"><i class="fa-solid fa-envelope"></i> <?= e($m['email']) ?></span>
                                        <?php if (!empty($m['phone'])): ?>
                                            <span class="user-sub"><i class="fa-solid fa-phone"></i> <?= e($m['phone']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="subject-pill"><?= e($m['subject'] ?? 'General Enquiry') ?></span>
                                </td>
                                <td>
                                    <div class="message-full-box">
                                        <?= nl2br(e($m['message'])) ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($m['status'] === 'UNREAD'): ?>
                                        <span class="status-badge status-badge--new">UNREAD</span>
                                    <?php else: ?>
                                        <span class="status-badge status-badge--completed">READ</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($m['status'] === 'UNREAD'): ?>
                                        <a
                                            href="<?= base_url('admin.php?page=messages&action=mark_read&id=' . (int)$m['id']) ?>"
                                            class="admin-btn admin-btn--sm admin-btn--primary"
                                        >
                                            <i class="fa-solid fa-check"></i> Mark Read
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fa-solid fa-check-double"></i> Read</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-table-msg">No contact messages received.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
