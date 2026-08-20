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
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'bookings',
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
            redirect(BASE_URL . 'admin.php?page=bookings');
        }

        csrf_check();

        $id     = sanitize_int(post('booking_id') ?? '') ?? 0;
        $status = post('status') ?? '';
        $notes  = post('admin_notes') ?? '';

        $success = $this->adminBLL->updateBookingStatus($id, $status, $notes);

        if ($success) {
            set_flash('success', 'Booking status updated successfully.');
        } else {
            set_flash('error', 'Failed to update booking status.');
        }

        $redirectUrl = post('redirect_to') ?? (BASE_URL . 'admin.php?page=bookings');
        redirect($redirectUrl);
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
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'messages',
        ];

        $this->render('admin/bookings/messages', $data);
    }

    /**
     * Mark a contact message as read (POST / GET).
     */
    public function markMessageRead(): void
    {
        require_admin();

        $id = sanitize_int(post('message_id') ?? get('id') ?? '') ?? 0;

        if ($id > 0) {
            $this->adminBLL->markMessageAsRead($id);
            set_flash('success', 'Message marked as read.');
        }

        redirect(BASE_URL . 'admin.php?page=messages');
    }

    /**
     * Display all rooms catalogue for admin.
     */
    public function rooms(): void
    {
        require_admin();

        $data = [
            'page_title' => 'Rooms & Suites — Admin',
            'rooms'      => $this->adminBLL->getAllRooms(),
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'rooms',
        ];

        $this->render('admin/rooms/index', $data);
    }

    public function saveRoom(): void
    {
        require_admin();
        csrf_check();

        $id = !empty(post('id')) ? (int)post('id') : null;
        $uploadedPath = upload_image('image_file', 'rooms');

        $data = [
            'name'              => post('name') ?? '',
            'slug'              => post('slug') ?? '',
            'category'          => post('category') ?? 'rooms',
            'short_description' => post('short_description') ?? '',
            'capacity'          => (int)(post('capacity') ?? 2),
            'bed_type'          => post('bed_type') ?? 'King Bed',
            'room_size'         => post('room_size') ?? '45 sqm',
            'image_path'        => $uploadedPath ?? post('image_path') ?? 'images/rooms/deluxe-suite.jpg',
            'status'            => post('status') ?? 'AVAILABLE',
            'is_featured'       => isset($_POST['is_featured']) ? 1 : 0,
        ];

        $this->adminBLL->saveRoom($data, $id);
        set_flash('success', $id ? 'Room updated successfully.' : 'New room created successfully.');
        redirect(BASE_URL . 'admin.php?page=rooms');
    }

    public function deleteRoom(): void
    {
        require_admin();
        $id = (int)(get('id') ?? post('id') ?? 0);
        if ($id > 0) {
            $this->adminBLL->deleteRoom($id);
            set_flash('success', 'Room deleted successfully.');
        }
        redirect(BASE_URL . 'admin.php?page=rooms');
    }

    /**
     * Display all dining items.
     */
    public function dining(): void
    {
        require_admin();

        $data = [
            'page_title' => 'Dining Catalogue — Admin',
            'dining'     => $this->adminBLL->getAllDining(),
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'dining',
        ];

        $this->render('admin/dining/index', $data);
    }

    public function saveDining(): void
    {
        require_admin();
        csrf_check();

        $id = !empty(post('id')) ? (int)post('id') : null;
        $uploadedPath = upload_image('image_file', 'dining');

        $data = [
            'name'        => post('name') ?? '',
            'category'    => post('category') ?? 'Breakfast',
            'price'       => post('price') ?? '$18.00',
            'description' => post('description') ?? '',
            'filename'    => $uploadedPath ?? post('filename') ?? 'images/dining/dining-main.jpg',
            'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        ];

        $this->adminBLL->saveDining($data, $id);
        set_flash('success', $id ? 'Meal updated successfully.' : 'New meal added to menu.');
        redirect(BASE_URL . 'admin.php?page=dining');
    }

    public function deleteDining(): void
    {
        require_admin();
        $id = (int)(get('id') ?? post('id') ?? 0);
        if ($id > 0) {
            $this->adminBLL->deleteDining($id);
            set_flash('success', 'Meal deleted from menu.');
        }
        redirect(BASE_URL . 'admin.php?page=dining');
    }

    /**
     * Display all experiences.
     */
    public function experiences(): void
    {
        require_admin();

        $data = [
            'page_title'  => 'Resort Experiences — Admin',
            'experiences' => $this->adminBLL->getAllExperiences(),
            'stats'       => $this->adminBLL->getDashboardStats(),
            'admin'       => current_admin(),
            'active_tab'  => 'experiences',
        ];

        $this->render('admin/experiences/index', $data);
    }

    public function saveExperience(): void
    {
        require_admin();
        csrf_check();

        $id = !empty(post('id')) ? (int)post('id') : null;
        $uploadedPath = upload_image('image_file', 'experiences');

        $data = [
            'name'        => post('name') ?? '',
            'description' => post('description') ?? '',
            'filename'    => $uploadedPath ?? post('filename') ?? 'images/experiences/nature-walk.jpg',
            'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        ];

        $this->adminBLL->saveExperience($data, $id);
        set_flash('success', $id ? 'Experience updated.' : 'New experience created.');
        redirect(BASE_URL . 'admin.php?page=experiences');
    }

    public function deleteExperience(): void
    {
        require_admin();
        $id = (int)(get('id') ?? post('id') ?? 0);
        if ($id > 0) {
            $this->adminBLL->deleteExperience($id);
            set_flash('success', 'Experience deleted.');
        }
        redirect(BASE_URL . 'admin.php?page=experiences');
    }

    /**
     * Display resort gallery items.
     */
    public function gallery(): void
    {
        require_admin();

        $data = [
            'page_title' => 'Resort Gallery — Admin',
            'gallery'    => $this->adminBLL->getAllGallery(),
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'gallery',
        ];

        $this->render('admin/gallery/index', $data);
    }

    public function saveGallery(): void
    {
        require_admin();
        csrf_check();

        $id = !empty(post('id')) ? (int)post('id') : null;
        $uploadedPath = upload_image('image_file', 'gallery');

        $data = [
            'filename'  => $uploadedPath ?? post('filename') ?? 'images/gallery/gallery-1.jpg',
            'caption'   => post('caption') ?? '',
            'category'  => post('category') ?? 'rooms',
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        $this->adminBLL->saveGallery($data, $id);
        set_flash('success', $id ? 'Gallery item updated.' : 'New photo added to gallery.');
        redirect(BASE_URL . 'admin.php?page=gallery');
    }

    public function deleteGallery(): void
    {
        require_admin();
        $id = (int)(get('id') ?? post('id') ?? 0);
        if ($id > 0) {
            $this->adminBLL->deleteGallery($id);
            set_flash('success', 'Gallery item deleted.');
        }
        redirect(BASE_URL . 'admin.php?page=gallery');
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
            redirect(BASE_URL . 'admin.php?page=settings');
        }

        $data = [
            'page_title' => 'Site Settings — Admin',
            'settings'   => $this->adminBLL->getSettings(),
            'stats'      => $this->adminBLL->getDashboardStats(),
            'admin'      => current_admin(),
            'active_tab' => 'settings',
        ];

        $this->render('admin/settings/index', $data);
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
