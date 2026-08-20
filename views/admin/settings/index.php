<?php include VIEWS_PATH . '/partials/admin-header.php'; ?>

<div class="admin-page-content" id="admin-settings-page">
    <div class="admin-page-header">
        <div>
            <h1 class="page-title">Resort Configuration &amp; Settings</h1>
            <p class="page-subtitle">Update resort contact information, hotlines, and booking engine preferences.</p>
        </div>
    </div>

    <div class="admin-card" style="max-width: 900px;">
        <form action="<?= base_url('admin.php?action=save_settings') ?>" method="POST" class="admin-settings-form">
            <?= csrf_field() ?>

            <div class="form-section-title">
                <i class="fa-solid fa-hotel"></i> General Property Information
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="setting-resort-name" class="form-label">Resort Name</label>
                    <input
                        type="text"
                        id="setting-resort-name"
                        name="settings[site_name]"
                        class="form-input"
                        value="<?= e($settings['site_name'] ?? APP_NAME) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="setting-email" class="form-label">Primary Concierge Email</label>
                    <input
                        type="email"
                        id="setting-email"
                        name="settings[contact_email]"
                        class="form-input"
                        value="<?= e($settings['contact_email'] ?? ADMIN_EMAIL) ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-section-title" style="margin-top: 1.5rem;">
                <i class="fa-solid fa-phone"></i> Contact Hotlines &amp; WhatsApp
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="setting-phone-res" class="form-label">Room Reservations Hotline</label>
                    <input
                        type="text"
                        id="setting-phone-res"
                        name="settings[phone_reservations]"
                        class="form-input"
                        value="<?= e($settings['phone_reservations'] ?? '+94 77 787 2280') ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="setting-phone-desk" class="form-label">Front Desk Hotline</label>
                    <input
                        type="text"
                        id="setting-phone-desk"
                        name="settings[phone_front_desk]"
                        class="form-input"
                        value="<?= e($settings['phone_front_desk'] ?? '+94 81 787 2280') ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="setting-whatsapp" class="form-label">WhatsApp Direct Number (with Country Code)</label>
                <input
                    type="text"
                    id="setting-whatsapp"
                    name="settings[whatsapp_number]"
                    class="form-input"
                    value="<?= e($settings['whatsapp_number'] ?? '+94777872280') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="setting-address" class="form-label">Resort Address</label>
                <textarea
                    id="setting-address"
                    name="settings[resort_address]"
                    class="form-textarea"
                    rows="2"
                ><?= e($settings['resort_address'] ?? 'Sigiriya Road, Water Garden Zone, Sigiriya 21120, Sri Lanka') ?></textarea>
            </div>

            <div class="form-section-title" style="margin-top: 1.5rem;">
                <i class="fa-solid fa-sliders"></i> System Preferences
            </div>

            <div class="form-row-two-col">
                <div class="form-group">
                    <label for="setting-currency" class="form-label">Default Currency</label>
                    <input
                        type="text"
                        id="setting-currency"
                        name="settings[currency_code]"
                        class="form-input"
                        value="<?= e($settings['currency_code'] ?? 'USD ($)') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="setting-booking-engine" class="form-label">Booking Engine Status</label>
                    <select id="setting-booking-engine" name="settings[booking_engine_active]" class="form-select">
                        <option value="1" <?= ($settings['booking_engine_active'] ?? '1') === '1' ? 'selected' : '' ?>>Active — Accepting Online Enquiries</option>
                        <option value="0" <?= ($settings['booking_engine_active'] ?? '1') === '0' ? 'selected' : '' ?>>Paused — Maintenance Mode</option>
                    </select>
                </div>
            </div>

            <div class="form-submit-row" style="margin-top: 2rem;">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

</div><!-- /.admin-content -->
</div><!-- /.admin-layout -->

<script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
