<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<?php
$pdo = Database::getConnection();
$bookingDAL = new BookingDAL($pdo);
$contactDAL = new ContactDAL($pdo);

$recentBookings = array_slice($bookingDAL->findAll(), 0, 5);
$recentMessages = array_slice($contactDAL->findAll(), 0, 5);
?>

<div class="admin-page-content" id="admin-dashboard">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Dashboard Overview</h1>
            <p class="page-subtitle">Welcome back, <strong><?= e($admin['name'] ?? 'Admin') ?></strong>. Here is what is happening at Serona Resort today.</p>
        </div>
        <div class="header-actions">
            <a href="<?= base_url('admin.php?page=bookings') ?>" class="admin-btn admin-btn--primary">
                <i class="fa-solid fa-calendar-plus"></i> View All Enquiries
            </a>
            <a href="<?= base_url() ?>" target="_blank" class="admin-btn admin-btn--secondary">
                <i class="fa-solid fa-globe"></i> Live Website
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <div class="stat-card" id="stat-total-bookings">
            <div class="stat-icon"><i class="fa-solid fa-calendar-check" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['total_bookings'] ?? 0) ?></span>
                <span class="stat-label">Total Booking Enquiries</span>
            </div>
        </div>

        <div class="stat-card stat-card--accent" id="stat-new-bookings">
            <div class="stat-icon stat-icon--accent"><i class="fa-solid fa-bell" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['new_bookings'] ?? 0) ?></span>
                <span class="stat-label">New Enquiries (Action Needed)</span>
            </div>
        </div>

        <div class="stat-card" id="stat-total-messages">
            <div class="stat-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['total_messages'] ?? 0) ?></span>
                <span class="stat-label">Total Contact Messages</span>
            </div>
        </div>

        <div class="stat-card stat-card--info" id="stat-unread-messages">
            <div class="stat-icon stat-icon--info"><i class="fa-solid fa-envelope-open" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['unread_messages'] ?? 0) ?></span>
                <span class="stat-label">Unread Messages</span>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="dashboard-tables-grid">

        <!-- Recent Booking Enquiries Card -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-calendar-day" aria-hidden="true"></i> Recent Booking Enquiries
                </h3>
                <a href="<?= base_url('admin.php?page=bookings') ?>" class="view-all-link">
                    View All Enquiries <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Guest Name</th>
                            <th>Room Requested</th>
                            <th>Check-In / Out</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentBookings)): ?>
                            <?php foreach ($recentBookings as $b): ?>
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
                                <tr>
                                    <td><strong><?= e($b['reference_number']) ?></strong></td>
                                    <td>
                                        <div class="table-user-info">
                                            <span class="user-name"><?= e($b['guest_name']) ?></span>
                                            <span class="user-sub"><?= e($b['guest_email']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= e($b['room_name'] ?? 'General Stay') ?></td>
                                    <td>
                                        <span class="date-tag"><?= e($b['check_in']) ?></span> to <span class="date-tag"><?= e($b['check_out']) ?></span>
                                    </td>
                                    <td><?= (int)$b['adults'] ?> Ad / <?= (int)$b['children'] ?> Ch</td>
                                    <td>
                                        <span class="status-badge <?= $statusClass ?>"><?= e($b['status']) ?></span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a
                                                href="https://wa.me/<?= e($cleanPhone) ?>?text=<?= urlencode("Hello " . $b['guest_name'] . ", regarding your booking enquiry " . $b['reference_number'] . " at Serona Hotel & Resort:") ?>"
                                                target="_blank"
                                                class="action-btn action-btn--whatsapp"
                                                title="Contact via WhatsApp"
                                            >
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </a>
                                            <a href="<?= base_url('admin.php?page=bookings') ?>" class="action-btn action-btn--edit" title="Manage Status">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-table-msg">No booking enquiries received yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Messages Card -->
        <div class="admin-card" style="margin-top: 2rem;">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-comments" aria-hidden="true"></i> Recent Contact Messages
                </h3>
                <a href="<?= base_url('admin.php?page=messages') ?>" class="view-all-link">
                    View All Messages <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sender</th>
                            <th>Topic / Subject</th>
                            <th>Message Snippet</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentMessages)): ?>
                            <?php foreach ($recentMessages as $m): ?>
                                <tr>
                                    <td><span class="date-tag"><?= date('M d, Y', strtotime($m['created_at'])) ?></span></td>
                                    <td>
                                        <div class="table-user-info">
                                            <span class="user-name"><?= e($m['name']) ?></span>
                                            <span class="user-sub"><?= e($m['email']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= e($m['subject'] ?? 'General Enquiry') ?></td>
                                    <td>
                                        <span class="message-snippet"><?= e(mb_strimwidth($m['message'], 0, 75, '...')) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($m['status'] === 'UNREAD'): ?>
                                            <span class="status-badge status-badge--new">UNREAD</span>
                                        <?php else: ?>
                                            <span class="status-badge status-badge--completed">READ</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin.php?page=messages') ?>" class="action-btn action-btn--edit" title="View Full Message">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-table-msg">No contact messages received yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
