<?php include VIEWS_PATH . '/partials/header.php'; ?>
<?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>

<section class="section page-hero" aria-labelledby="booking-page-heading">
    <div class="container">
        <h1 class="page-title" id="booking-page-heading">Booking Enquiry</h1>
        <p class="page-subtitle">Fill in the form below. We will confirm your reservation via WhatsApp or email.</p>
    </div>
</section>

<section class="section booking-section" id="booking-section">
    <div class="container container--narrow">
        <form
            action="<?= base_url('booking.php') ?>"
            method="POST"
            class="booking-form"
            id="booking-form"
            novalidate
        >
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="submit">

            <div class="form-group">
                <label for="room_id" class="form-label">Room (optional)</label>
                <select name="room_id" id="room_id" class="form-select">
                    <option value="">— Select a room —</option>
                    <?php foreach ($rooms as $room): ?>
                    <option
                        value="<?= (int) $room['id'] ?>"
                        <?= ((int)($preselected_room_id ?? 0) === (int) $room['id']) ? 'selected' : '' ?>
                    >
                        <?= e($room['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="guest_name" class="form-label">Full Name <span aria-hidden="true">*</span></label>
                    <input type="text" id="guest_name" name="guest_name" class="form-input" value="<?= old('guest_name') ?>" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="guest_email" class="form-label">Email Address <span aria-hidden="true">*</span></label>
                    <input type="email" id="guest_email" name="guest_email" class="form-input" value="<?= old('guest_email') ?>" required autocomplete="email">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="guest_phone" class="form-label">Phone Number <span aria-hidden="true">*</span></label>
                    <input type="tel" id="guest_phone" name="guest_phone" class="form-input" value="<?= old('guest_phone') ?>" required autocomplete="tel">
                </div>
                <div class="form-group">
                    <label for="communication_method" class="form-label">Preferred Contact</label>
                    <select name="communication_method" id="communication_method" class="form-select">
                        <option value="WHATSAPP">WhatsApp</option>
                        <option value="EMAIL">Email</option>
                        <option value="BOTH">Both</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="check_in" class="form-label">Check-in Date <span aria-hidden="true">*</span></label>
                    <input type="date" id="check_in" name="check_in" class="form-input" value="<?= old('check_in') ?>" required>
                </div>
                <div class="form-group">
                    <label for="check_out" class="form-label">Check-out Date <span aria-hidden="true">*</span></label>
                    <input type="date" id="check_out" name="check_out" class="form-input" value="<?= old('check_out') ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="adults" class="form-label">Adults <span aria-hidden="true">*</span></label>
                    <input type="number" id="adults" name="adults" class="form-input" value="<?= old('adults', '1') ?>" min="1" max="20" required>
                </div>
                <div class="form-group">
                    <label for="children" class="form-label">Children</label>
                    <input type="number" id="children" name="children" class="form-input" value="<?= old('children', '0') ?>" min="0" max="10">
                </div>
            </div>

            <div class="form-group">
                <label for="special_request" class="form-label">Special Requests</label>
                <textarea id="special_request" name="special_request" class="form-textarea" rows="4" placeholder="Any dietary requirements, accessibility needs, celebrations..."><?= old('special_request') ?></textarea>
            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary btn-full" id="booking-submit-btn">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    Submit Enquiry via WhatsApp
                </button>
                <p class="form-note">No payment required. Our team will confirm your reservation manually.</p>
            </div>
        </form>
    </div>
</section>

<?php include VIEWS_PATH . '/partials/footer.php'; ?>
