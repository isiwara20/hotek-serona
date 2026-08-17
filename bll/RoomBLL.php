<?php

declare(strict_types=1);

/**
 * RoomBLL — Business Logic Layer for room data.
 */
class RoomBLL
{
    private RoomDAL $roomDAL;

    public function __construct(RoomDAL $roomDAL)
    {
        $this->roomDAL = $roomDAL;
    }

    /**
     * Return all publicly visible rooms.
     *
     * @return array[]
     */
    public function getActiveRooms(): array
    {
        return $this->roomDAL->findAllActive();
    }

    /**
     * Return a single room by slug for the public detail page.
     * Returns null if not found or hidden.
     *
     * @param  string $slug
     * @return array|null
     */
    public function getRoomBySlug(string $slug): ?array
    {
        if (empty(trim($slug))) {
            return null;
        }

        $room = $this->roomDAL->findBySlug($slug);

        if ($room === null) {
            return null;
        }

        // Attach images to the room data.
        $room['images'] = $this->roomDAL->findImagesByRoomId((int) $room['id']);

        return $room;
    }

    /**
     * Return all rooms with their images (admin management list).
     *
     * @return array[]
     */
    public function getAllRooms(): array
    {
        return $this->roomDAL->findAll();
    }
}
