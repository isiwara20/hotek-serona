<nav class="admin-sidebar" id="admin-sidebar" aria-label="Admin navigation">
    <div class="sidebar-brand">
        <span class="sidebar-brand-name"><?= e(APP_NAME) ?></span>
        <span class="sidebar-brand-sub">Admin Panel</span>
    </div>

    <ul class="sidebar-nav" role="list">
        <li class="sidebar-nav-item">
            <a href="<?= base_url('admin_dashboard.php') ?>" class="sidebar-link" id="sidebar-dashboard">
                <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-rooms">
                <i class="fa-solid fa-bed" aria-hidden="true"></i>
                <span>Rooms</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-bookings">
                <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                <span>Booking Enquiries</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-gallery">
                <i class="fa-solid fa-images" aria-hidden="true"></i>
                <span>Gallery</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-dining">
                <i class="fa-solid fa-utensils" aria-hidden="true"></i>
                <span>Dining</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-experiences">
                <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                <span>Experiences</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-messages">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                <span>Messages</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-link" id="sidebar-settings">
                <i class="fa-solid fa-gear" aria-hidden="true"></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= base_url() ?>" class="sidebar-view-site" target="_blank" rel="noopener noreferrer" id="sidebar-view-site">
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
            View Website
        </a>
    </div>
</nav>
