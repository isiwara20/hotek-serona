<?php

declare(strict_types=1);

/**
 * AdminController — Handles admin panel pages.
 *
 * All methods in this controller must call require_admin() first.
 * Admin routes are completely separate from the public website.
 */
class AdminController
{
    private AdminBLL $adminBLL;

    public function __construct()
    {
        $pdo           = Database::getConnection();
        $this->adminBLL = new AdminBLL(
            new BookingDAL($pdo),
            new ContactDAL($pdo),
            new SettingsDAL($pdo)
        );
    }

    /**
     * Display the admin dashboard.
     */
    public function dashboard(): void
    {
        require_admin();

        $stats = $this->adminBLL->getDashboardStats();

        $data = [
            'page_title' => 'Dashboard — ' . APP_NAME . ' Admin',
            'stats'      => $stats,
            'admin'      => current_admin(),
        ];

        $this->render('admin/dashboard', $data);
    }

    /**
     * Display all booking enquiries.
     */
    public function bookings(): void
    {
        require_admin();

        $data = [
            'page_title' => 'Booking Enquiries — Admin',
            'bookings'   => $this->adminBLL->getAllBookings(),
            'admin'      => current_admin(),
        ];

        $this->render('admin/bookings/index', $data);
    }

    /**
     * Update a booking enquiry status (POST).
     */
    public function updateBookingStatus(): void
    {
        require_admin();

        if (!is_post()) {
            redirect(BASE_URL . 'admin_dashboard.php');
        }

        csrf_check();

        $id     = sanitize_int(post('booking_id') ?? '') ?? 0;
        $status = post('status') ?? '';
        $notes  = post('admin_notes') ?? '';

        $success = $this->adminBLL->updateBookingStatus($id, $status, $notes);

        if ($success) {
            set_flash('success', 'Booking status updated.');
        } else {
            set_flash('error', 'Failed to update booking status.');
        }

        redirect(BASE_URL . 'admin_dashboard.php');
    }

    /**
     * Display all contact messages.
     */
    public function messages(): void
    {
        require_admin();

        $data = [
            'page_title' => 'Contact Messages — Admin',
            'messages'   => $this->adminBLL->getAllMessages(),
            'admin'      => current_admin(),
        ];

        $this->render('admin/bookings/messages', $data);
    }

    /**
     * Display and process the settings form.
     */
    public function settings(): void
    {
        require_admin();

        if (is_post()) {
            csrf_check();

            $settingsInput = $_POST['settings'] ?? [];
            $settingsInput = array_map('sanitize_string', $settingsInput);

            $this->adminBLL->saveSettings($settingsInput);
            set_flash('success', 'Settings saved successfully.');
            redirect(BASE_URL . 'admin_dashboard.php');
        }

        $data = [
            'page_title' => 'Site Settings — Admin',
            'settings'   => $this->adminBLL->getSettings(),
            'admin'      => current_admin(),
        ];

        $this->render('admin/settings/index', $data);
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
