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
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, name, slug, category, short_description, description, capacity, bed_type,
                        room_size, image_path, status, is_featured, created_at
                 FROM   rooms
                 WHERE  status != 'HIDDEN'
                 ORDER  BY is_featured DESC, created_at ASC"
            );

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Return all rooms (admin use).
     *
     * @return array[]
     */
    public function findAll(): array
    {
        try {
            $stmt = $this->pdo->prepare(
                'SELECT id, name, slug, category, short_description, description, capacity, bed_type,
                        room_size, image_path, status, is_featured, created_at
                 FROM   rooms
                 ORDER  BY created_at ASC'
            );

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            return [];
        }
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
            "SELECT id, name, slug, category, short_description, description,
                    capacity, bed_type, room_size, image_path, status, is_featured, created_at
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
            'SELECT id, name, slug, category, short_description, description,
                    capacity, bed_type, room_size, image_path, status, is_featured, created_at
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

    /**
     * Create a new room in the database.
     */
    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO rooms (name, slug, category, short_description, description, capacity, bed_type, room_size, image_path, status, is_featured, created_at, updated_at)
             VALUES (:name, :slug, :category, :short_description, :description, :capacity, :bed_type, :room_size, :image_path, :status, :is_featured, NOW(), NOW())'
        );

        $success = $stmt->execute([
            ':name'              => $data['name'],
            ':slug'              => $data['slug']              ?? strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name']))),
            ':category'          => $data['category']          ?? 'rooms',
            ':short_description' => $data['short_description'] ?? null,
            ':description'       => $data['description']       ?? null,
            ':capacity'          => (int)($data['capacity']    ?? 2),
            ':bed_type'          => $data['bed_type']          ?? 'King Bed',
            ':room_size'         => $data['room_size']         ?? '45 sqm',
            ':image_path'        => $data['image_path']        ?? 'images/rooms/deluxe-suite.jpg',
            ':status'            => $data['status']            ?? 'AVAILABLE',
            ':is_featured'       => (int)($data['is_featured'] ?? 0),
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    /**
     * Update an existing room record.
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE rooms
             SET    name = :name,
                    slug = :slug,
                    category = :category,
                    short_description = :short_description,
                    capacity = :capacity,
                    bed_type = :bed_type,
                    room_size = :room_size,
                    image_path = :image_path,
                    status = :status,
                    is_featured = :is_featured,
                    updated_at = NOW()
             WHERE  id = :id'
        );

        return $stmt->execute([
            ':name'              => $data['name'],
            ':slug'              => $data['slug'] ?? strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name']))),
            ':category'          => $data['category'] ?? 'rooms',
            ':short_description' => $data['short_description'] ?? null,
            ':capacity'          => (int)($data['capacity'] ?? 2),
            ':bed_type'          => $data['bed_type'] ?? 'King Bed',
            ':room_size'         => $data['room_size'] ?? '45 sqm',
            ':image_path'        => $data['image_path'] ?? 'images/rooms/deluxe-suite.jpg',
            ':status'            => $data['status'] ?? 'AVAILABLE',
            ':is_featured'       => (int)($data['is_featured'] ?? 0),
            ':id'                => $id,
        ]);
    }

    /**
     * Delete a room from database.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM rooms WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
