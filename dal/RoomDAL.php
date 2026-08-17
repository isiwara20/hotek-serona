<?php

declare(strict_types=1);

/**
 * RoomDAL — Data Access Layer for the rooms and room_images tables.
 */
class RoomDAL extends BaseDAL
{
    /**
     * Return all active rooms.
     *
     * @return array[]
     */
    public function findAllActive(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, name, slug, short_description, capacity, bed_type,
                    room_size, status, is_featured, created_at
             FROM   rooms
             WHERE  status != 'HIDDEN'
             ORDER  BY is_featured DESC, created_at ASC"
        );

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Return all rooms (admin use).
     *
     * @return array[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, slug, short_description, capacity, bed_type,
                    room_size, status, is_featured, created_at
             FROM   rooms
             ORDER  BY created_at ASC'
        );

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find a single room by its slug (for public room detail pages).
     *
     * @param  string $slug
     * @return array|null
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, name, slug, short_description, description,
                    capacity, bed_type, room_size, status, is_featured, created_at
             FROM   rooms
             WHERE  slug = :slug
               AND  status != 'HIDDEN'
             LIMIT  1"
        );

        $stmt->execute([':slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Find a single room by its primary key ID (admin use).
     *
     * @param  int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, slug, short_description, description,
                    capacity, bed_type, room_size, status, is_featured, created_at
             FROM   rooms
             WHERE  id = :id
             LIMIT  1'
        );

        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Return all images for a given room.
     *
     * @param  int $roomId
     * @return array[]
     */
    public function findImagesByRoomId(int $roomId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, room_id, filename, alt_text, sort_order
             FROM   room_images
             WHERE  room_id = :room_id
             ORDER  BY sort_order ASC, id ASC'
        );

        $stmt->execute([':room_id' => $roomId]);
        return $stmt->fetchAll();
    }
}
