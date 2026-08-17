<?php

declare(strict_types=1);

/**
 * AdminBLL — Business Logic Layer for admin panel operations.
 *
 * Aggregates cross-entity logic for the admin dashboard.
 * Phase 1: stub with structure ready for Phase 3+ implementation.
 */
class AdminBLL
{
    private BookingDAL  $bookingDAL;
    private ContactDAL  $contactDAL;
    private SettingsDAL $settingsDAL;

    public function __construct(
        BookingDAL  $bookingDAL,
        ContactDAL  $contactDAL,
        SettingsDAL $settingsDAL
    ) {
        $this->bookingDAL  = $bookingDAL;
        $this->contactDAL  = $contactDAL;
        $this->settingsDAL = $settingsDAL;
    }

    /**
     * Return summary statistics for the admin dashboard.
     *
     * @return array{
     *     total_bookings: int,
     *     new_bookings: int,
     *     total_messages: int,
     *     unread_messages: int
     * }
     */
    public function getDashboardStats(): array
    {
        $bookings = $this->bookingDAL->findAll();
        $messages = $this->contactDAL->findAll();

        $newBookings   = array_filter($bookings, fn ($b) => $b['status'] === 'NEW');
        $unreadMessages = array_filter($messages, fn ($m) => $m['status'] === 'UNREAD');

        return [
            'total_bookings'  => count($bookings),
            'new_bookings'    => count($newBookings),
            'total_messages'  => count($messages),
            'unread_messages' => count($unreadMessages),
        ];
    }

    /**
     * Return all booking enquiries.
     *
     * @return array[]
     */
    public function getAllBookings(): array
    {
        return $this->bookingDAL->findAll();
    }

    /**
     * Return all contact messages.
     *
     * @return array[]
     */
    public function getAllMessages(): array
    {
        return $this->contactDAL->findAll();
    }

    /**
     * Update a booking's status.
     *
     * @param int    $id
     * @param string $status
     * @param string $notes
     */
    public function updateBookingStatus(int $id, string $status, string $notes = ''): bool
    {
        $allowed = ['NEW', 'CONTACTED', 'CONFIRMED', 'CANCELLED', 'COMPLETED'];

        if (!in_array($status, $allowed, true)) {
            return false;
        }

        return $this->bookingDAL->updateStatus($id, $status, $notes);
    }

    /**
     * Return all site settings.
     *
     * @return array<string, string>
     */
    public function getSettings(): array
    {
        return $this->settingsDAL->findAll();
    }

    /**
     * Save (update) site settings.
     *
     * @param array<string, string> $settings
     */
    public function saveSettings(array $settings): bool
    {
        // Strip any sensitive keys that should not be settable via the UI.
        unset($settings['admin_password']);

        return $this->settingsDAL->setMany($settings);
    }
}
