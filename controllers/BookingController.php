<?php

declare(strict_types=1);

/**
 * BookingController — Handles booking enquiry form submissions.
 *
 * Flow:
 *   Visitor → BookingController::submitEnquiry()
 *           → BookingBLL (validate + save)
 *           → BookingDAL (DB write)
 *           → WhatsAppService (generate link)
 *           → EmailService (optional notification)
 *           → Redirect to WhatsApp URL or confirmation page.
 */
class BookingController
{
    private BookingBLL      $bookingBLL;
    private WhatsAppService $whatsApp;
    private EmailService    $emailService;
    private RoomBLL         $roomBLL;

    public function __construct()
    {
        $pdo              = Database::getConnection();
        $this->bookingBLL  = new BookingBLL(new BookingDAL($pdo));
        $this->roomBLL     = new RoomBLL(new RoomDAL($pdo));
        $this->whatsApp    = new WhatsAppService();
        $this->emailService= new EmailService();
    }

    /**
     * Display the booking enquiry form (GET).
     * Pre-selects a room if ?room_id is passed.
     */
    public function showForm(): void
    {
        $rooms      = $this->roomBLL->getActiveRooms();
        $preselected = sanitize_int(get_param('room_id') ?? '');

        $data = [
            'page_title' => 'Book a Stay — ' . APP_NAME,
            'rooms'      => $rooms,
            'preselected_room_id' => $preselected,
        ];

        $this->render('public/booking', $data);
    }

    /**
     * Process the booking form submission (POST).
     *
     * On success:
     *   - Save the enquiry to the database.
     *   - Optionally send email notifications.
     *   - Redirect the visitor to a WhatsApp URL.
     */
    public function submitEnquiry(): void
    {
        if (!is_post()) {
            redirect(BASE_URL . 'booking.php');
        }

        csrf_check();

        $data = [
            'room_id'              => sanitize_int(post('room_id') ?? ''),
            'guest_name'           => post('guest_name')       ?? '',
            'guest_email'          => post('guest_email')      ?? '',
            'guest_phone'          => post('guest_phone')      ?? '',
            'check_in'             => post('check_in')         ?? '',
            'check_out'            => post('check_out')        ?? '',
            'adults'               => sanitize_int(post('adults') ?? '1') ?? 1,
            'children'             => sanitize_int(post('children') ?? '0') ?? 0,
            'special_request'      => post('special_request')  ?? '',
            'communication_method' => post('communication_method') ?? 'WHATSAPP',
        ];

        $result = $this->bookingBLL->submitEnquiry($data);

        if (!$result['success']) {
            foreach ($result['errors'] as $error) {
                set_flash('error', $error);
            }
            redirect(BASE_URL . 'booking.php');
        }

        // Optionally attach room name for notifications.
        if (!empty($data['room_id'])) {
            $room = $this->roomBLL->getAllRooms();
            foreach ($room as $r) {
                if ((int) $r['id'] === $data['room_id']) {
                    $data['room_name'] = $r['name'];
                    break;
                }
            }
        }

        $data['reference_number'] = $result['reference'];

        // Send email notification to admin (non-blocking — failure is logged).
        $this->emailService->sendBookingNotification($data);

        // Send guest confirmation email.
        $this->emailService->sendGuestConfirmation($data);

        // Generate WhatsApp URL and redirect if method includes WhatsApp.
        if (in_array($data['communication_method'], ['WHATSAPP', 'BOTH'], true)) {
            $whatsAppUrl = $this->whatsApp->generateBookingUrl($data);
            redirect($whatsAppUrl);
        }

        set_flash('success', "Booking enquiry received. Reference: {$result['reference']}");
        redirect(BASE_URL . 'booking.php');
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
