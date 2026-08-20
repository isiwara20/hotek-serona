<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-bookings-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Booking Enquiries Manager</h1>
            <p class="page-subtitle">Manage guest reservation requests, update booking statuses, and connect directly via WhatsApp or Email.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="admin-filter-bar">
        <div class="filter-pills">
            <button class="filter-pill active" data-filter="all">All Enquiries (<?= count($bookings) ?>)</button>
            <button class="filter-pill" data-filter="NEW">New (<?= count(array_filter($bookings, fn($b) => $b['status'] === 'NEW')) ?>)</button>
            <button class="filter-pill" data-filter="CONTACTED">Contacted (<?= count(array_filter($bookings, fn($b) => $b['status'] === 'CONTACTED')) ?>)</button>
            <button class="filter-pill" data-filter="CONFIRMED">Confirmed (<?= count(array_filter($bookings, fn($b) => $b['status'] === 'CONFIRMED')) ?>)</button>
            <button class="filter-pill" data-filter="CANCELLED">Cancelled (<?= count(array_filter($bookings, fn($b) => $b['status'] === 'CANCELLED')) ?>)</button>
        </div>
    </div>

    <!-- Bookings Table Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="admin-table" id="bookings-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Guest Details</th>
                        <th>Room Requested</th>
                        <th>Dates &amp; Occupancy</th>
                        <th>Pref. Channel</th>
                        <th>Status</th>
                        <th>Admin Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $b): ?>
                            <?php
                            $statusClass = match ($b['status']) {
                                'NEW'       => 'status-badge--new',
                                'CONTACTED' => 'status-badge--contacted',
                                'CONFIRMED' => 'status-badge--confirmed',
                                'CANCELLED' => 'status-badge--cancelled',
                                'COMPLETED' => 'status-badge--completed',
                                default     => 'status-badge--new',
                            };
                            $cleanPhone = preg_replace('/[^0-9]/', '', $b['guest_phone']);
                            ?>
                            <tr data-status="<?= e($b['status']) ?>" id="booking-row-<?= (int)$b['id'] ?>">
                                <td>
                                    <strong class="ref-code"><?= e($b['reference_number']) ?></strong>
                                    <span class="created-time"><?= date('M d, H:i', strtotime($b['created_at'])) ?></span>
                                </td>
                                <td>
                                    <div class="table-user-info">
                                        <span class="user-name"><?= e($b['guest_name']) ?></span>
                                        <span class="user-sub"><i class="fa-solid fa-envelope"></i> <?= e($b['guest_email']) ?></span>
                                        <span class="user-sub"><i class="fa-solid fa-phone"></i> <?= e($b['guest_phone']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="room-pill"><?= e($b['room_name'] ?? 'General Sanctuary') ?></span>
                                </td>
                                <td>
                                    <div class="stay-dates">
                                        <div><i class="fa-solid fa-arrow-right-to-bracket text-sage"></i> <?= e($b['check_in']) ?></div>
                                        <div><i class="fa-solid fa-arrow-right-from-bracket text-sage"></i> <?= e($b['check_out']) ?></div>
                                        <div class="occupancy-info"><?= (int)$b['adults'] ?> Adults / <?= (int)$b['children'] ?> Children</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="channel-badge channel-<?= strtolower($b['communication_method']) ?>">
                                        <i class="fa-<?= $b['communication_method'] === 'WHATSAPP' ? 'brands fa-whatsapp' : 'solid fa-envelope' ?>"></i>
                                        <?= e($b['communication_method']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge <?= $statusClass ?>"><?= e($b['status']) ?></span>
                                </td>
                                <td>
                                    <span class="admin-notes-text"><?= !empty($b['admin_notes']) ? e($b['admin_notes']) : '<em>No notes</em>' ?></span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a
                                            href="https://wa.me/<?= e($cleanPhone) ?>?text=<?= urlencode("Hello " . $b['guest_name'] . ", regarding your booking enquiry " . $b['reference_number'] . " at Serona Hotel & Resort:") ?>"
                                            target="_blank"
                                            class="action-btn action-btn--whatsapp"
                                            title="Chat on WhatsApp"
                                        >
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>

                                        <!-- Update Status Form Trigger -->
                                        <button
                                            type="button"
                                            class="action-btn action-btn--edit open-status-modal"
                                            data-id="<?= (int)$b['id'] ?>"
                                            data-ref="<?= e($b['reference_number']) ?>"
                                            data-guest="<?= e($b['guest_name']) ?>"
                                            data-status="<?= e($b['status']) ?>"
                                            data-notes="<?= e($b['admin_notes'] ?? '') ?>"
                                            title="Update Status"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="empty-table-msg">No booking enquiries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Updating Booking Status -->
<div class="admin-modal-overlay" id="status-modal-overlay" aria-hidden="true">
    <div class="admin-modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Update Booking Status</h3>
            <button type="button" class="modal-close-btn" id="close-modal-btn">&times;</button>
        </div>

        <form action="<?= base_url('admin.php?action=update_booking_status') ?>" method="POST" class="modal-body-form">
            <?= csrf_field() ?>
            <input type="hidden" name="booking_id" id="modal-booking-id">
            <input type="hidden" name="redirect_to" value="<?= base_url('admin.php?page=bookings') ?>">

            <div class="form-group">
                <label class="form-label">Booking Reference</label>
                <input type="text" id="modal-booking-ref" class="form-input" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Guest Name</label>
                <input type="text" id="modal-guest-name" class="form-input" readonly>
            </div>

            <div class="form-group">
                <label for="modal-status-select" class="form-label">New Status</label>
                <select name="status" id="modal-status-select" class="form-select" required>
                    <option value="NEW">NEW (Unprocessed)</option>
                    <option value="CONTACTED">CONTACTED (Guest Reached)</option>
                    <option value="CONFIRMED">CONFIRMED (Reservation Locked)</option>
                    <option value="CANCELLED">CANCELLED (Closed Enquiry)</option>
                    <option value="COMPLETED">COMPLETED (Checked Out)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="modal-admin-notes" class="form-label">Internal Admin Notes</label>
                <textarea name="admin_notes" id="modal-admin-notes" class="form-textarea" rows="3" placeholder="e.g. Sent quotation via WhatsApp. Confirmed 20% advance deposit."></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="admin-btn admin-btn--secondary" id="cancel-modal-btn">Cancel</button>
                <button type="submit" class="admin-btn admin-btn--primary">Save Booking Status</button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
