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
     * Mark a contact message as read.
     */
    public function markMessageAsRead(int $id): bool
    {
        return $this->contactDAL->markAsRead($id);
    }

    /**
     * Return all rooms for admin catalogue management.
     */
    public function getAllRooms(): array
    {
        $roomDAL = new RoomDAL(Database::getConnection());
        return $roomDAL->findAll();
    }

    public function saveRoom(array $data, ?int $id = null): bool|int
    {
        $roomDAL = new RoomDAL(Database::getConnection());
        if ($id && $id > 0) {
            return $roomDAL->update($id, $data);
        }
        return $roomDAL->create($data);
    }

    public function deleteRoom(int $id): bool
    {
        $roomDAL = new RoomDAL(Database::getConnection());
        return $roomDAL->delete($id);
    }

    // Dining CRUD
    public function getAllDining(): array
    {
        $diningDAL = new DiningDAL(Database::getConnection());
        return $diningDAL->findAll();
    }

    public function saveDining(array $data, ?int $id = null): bool|int
    {
        $diningDAL = new DiningDAL(Database::getConnection());
        if ($id && $id > 0) {
            return $diningDAL->update($id, $data);
        }
        return $diningDAL->create($data);
    }

    public function deleteDining(int $id): bool
    {
        $diningDAL = new DiningDAL(Database::getConnection());
        return $diningDAL->delete($id);
    }

    // Experiences CRUD
    public function getAllExperiences(): array
    {
        $expDAL = new ExperienceDAL(Database::getConnection());
        return $expDAL->findAllActive();
    }

    public function saveExperience(array $data, ?int $id = null): bool|int
    {
        $expDAL = new ExperienceDAL(Database::getConnection());
        if ($id && $id > 0) {
            return $expDAL->update($id, $data);
        }
        return $expDAL->create($data);
    }

    public function deleteExperience(int $id): bool
    {
        $expDAL = new ExperienceDAL(Database::getConnection());
        return $expDAL->delete($id);
    }

    // Gallery CRUD
    public function getAllGallery(): array
    {
        $galleryDAL = new GalleryDAL(Database::getConnection());
        return $galleryDAL->findAllActive();
    }

    public function saveGallery(array $data, ?int $id = null): bool|int
    {
        $galleryDAL = new GalleryDAL(Database::getConnection());
        if ($id && $id > 0) {
            return $galleryDAL->update($id, $data);
        }
        return $galleryDAL->create($data);
    }

    public function deleteGallery(int $id): bool
    {
        $galleryDAL = new GalleryDAL(Database::getConnection());
        return $galleryDAL->delete($id);
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
