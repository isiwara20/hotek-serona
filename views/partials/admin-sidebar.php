<?php
$activeTab        = $active_tab ?? 'dashboard';
$newBookingsCount = (int) ($stats['new_bookings'] ?? 0);
$unreadMsgCount   = (int) ($stats['unread_messages'] ?? 0);
?>
<nav class="admin-sidebar" id="admin-sidebar" aria-label="Admin navigation">
    <div class="sidebar-brand">
        <div class="sidebar-logo-badge">
            <img src="<?= asset('images/branding/Logo.png') ?>" alt="<?= e(APP_NAME) ?> Logo">
        </div>
        <div>
            <span class="sidebar-brand-name"><?= e(APP_NAME) ?></span>
            <span class="sidebar-brand-sub">Management Portal</span>
        </div>
    </div>

    <ul class="sidebar-nav" role="list">
        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=dashboard') ?>" class="sidebar-link <?= $activeTab === 'dashboard' ? 'active' : '' ?>" id="sidebar-dashboard">
                <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=bookings') ?>" class="sidebar-link <?= $activeTab === 'bookings' ? 'active' : '' ?>" id="sidebar-bookings">
                <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                <span>Booking Enquiries</span>
                <?php if ($newBookingsCount > 0): ?>
                    <span class="sidebar-badge badge-accent"><?= $newBookingsCount ?></span>
                <?php endif; ?>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=messages') ?>" class="sidebar-link <?= $activeTab === 'messages' ? 'active' : '' ?>" id="sidebar-messages">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                <span>Contact Messages</span>
                <?php if ($unreadMsgCount > 0): ?>
                    <span class="sidebar-badge badge-info"><?= $unreadMsgCount ?></span>
                <?php endif; ?>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=rooms') ?>" class="sidebar-link <?= $activeTab === 'rooms' ? 'active' : '' ?>" id="sidebar-rooms">
                <i class="fa-solid fa-bed" aria-hidden="true"></i>
                <span>Rooms &amp; Suites</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=dining') ?>" class="sidebar-link <?= $activeTab === 'dining' ? 'active' : '' ?>" id="sidebar-dining">
                <i class="fa-solid fa-utensils" aria-hidden="true"></i>
                <span>Dining Catalogue</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=experiences') ?>" class="sidebar-link <?= $activeTab === 'experiences' ? 'active' : '' ?>" id="sidebar-experiences">
                <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                <span>Experiences</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=gallery') ?>" class="sidebar-link <?= $activeTab === 'gallery' ? 'active' : '' ?>" id="sidebar-gallery">
                <i class="fa-solid fa-images" aria-hidden="true"></i>
                <span>Resort Gallery</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin.php?page=settings') ?>" class="sidebar-link <?= $activeTab === 'settings' ? 'active' : '' ?>" id="sidebar-settings">
                <i class="fa-solid fa-gear" aria-hidden="true"></i>
                <span>Site Settings</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= base_url() ?>" class="sidebar-view-site" target="_blank" rel="noopener noreferrer" id="sidebar-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
            View Live Website
        </a>
    </div>
</nav>
