<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-dashboard">
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, <?= e($admin['name'] ?? 'Admin') ?>.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card" id="stat-total-bookings">
            <div class="stat-icon"><i class="fa-solid fa-calendar-check" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['total_bookings'] ?? 0) ?></span>
                <span class="stat-label">Total Enquiries</span>
            </div>
        </div>

        <div class="stat-card stat-card--accent" id="stat-new-bookings">
            <div class="stat-icon"><i class="fa-solid fa-bell" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['new_bookings'] ?? 0) ?></span>
                <span class="stat-label">New Enquiries</span>
            </div>
        </div>

        <div class="stat-card" id="stat-total-messages">
            <div class="stat-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['total_messages'] ?? 0) ?></span>
                <span class="stat-label">Contact Messages</span>
            </div>
        </div>

        <div class="stat-card stat-card--accent" id="stat-unread-messages">
            <div class="stat-icon"><i class="fa-solid fa-envelope-open" aria-hidden="true"></i></div>
            <div class="stat-info">
                <span class="stat-value"><?= (int) ($stats['unread_messages'] ?? 0) ?></span>
                <span class="stat-label">Unread Messages</span>
            </div>
        </div>
    </div>

    <!-- Phase 3+: Recent bookings table, quick actions, charts will go here -->
    <p class="placeholder-note">Full dashboard content will be built in Phase 3.</p>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->
<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
