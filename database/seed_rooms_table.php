<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

try {
    $pdo = Database::getConnection();

    $stmt = $pdo->query("SELECT COUNT(*) FROM rooms");
    $count = (int) $stmt->fetchColumn();

    if ($count === 0) {
        $defaultRooms = [
            [
                'name'              => 'Executive Forest Villa',
                'slug'              => 'executive-forest-villa',
                'short_description' => 'A private sanctuary tucked away into Sigiriya canopy forest with private plunge pool deck and outdoor rainforest shower.',
                'description'       => 'Experience absolute privacy in our Executive Forest Villa. Designed with native teak timbers, glass facade walls, private sun deck, infinity plunge pool, and bespoke king bed setting.',
                'capacity'          => 2,
                'bed_type'          => 'King Bed',
                'room_size'         => '85 sqm',
                'image_path'        => 'images/rooms/family-suite.jpg',
                'status'            => 'AVAILABLE',
                'is_featured'       => 1
            ],
            [
                'name'              => 'Deluxe Rainforest Suite',
                'slug'              => 'deluxe-rainforest-suite',
                'short_description' => 'Elegantly appointed teak suite featuring high vaulted ceilings, private garden balcony, and panoramic mountain views.',
                'description'       => 'Spacious indoor-outdoor living surrounded by natural garden soundscapes. Features handmade artisan teak furniture, plush king bedding, and luxury marble bathroom.',
                'capacity'          => 2,
                'bed_type'          => 'King Bed',
                'room_size'         => '55 sqm',
                'image_path'        => 'images/rooms/deluxe-suite.jpg',
                'status'            => 'AVAILABLE',
                'is_featured'       => 0
            ],
            [
                'name'              => 'Signature Canopy Suite',
                'slug'              => 'signature-canopy-suite',
                'short_description' => 'Elevated suite perched high above the jungle canopy with 180-degree sunset mountain views and daybed deck.',
                'description'       => 'Immerse yourself in elevated rainforest luxury. Wake up to soft morning mist, endemic bird song, and unobstructed horizon views.',
                'capacity'          => 3,
                'bed_type'          => 'King Bed + Daybed',
                'room_size'         => '70 sqm',
                'image_path'        => 'images/rooms/premium-suite.jpg',
                'status'            => 'AVAILABLE',
                'is_featured'       => 1
            ],
            [
                'name'              => 'Family Sanctuary Villa',
                'slug'              => 'family-sanctuary-villa',
                'short_description' => 'Two-bedroom interconnected pavilion villa with private courtyard garden, outdoor dining area, and spacious lounge.',
                'description'       => 'Ideal for multi-generational families and groups seeking togetherness with personal space. Includes private garden lawn and dedicated butler service.',
                'capacity'          => 5,
                'bed_type'          => '1 King + 2 Twin Beds',
                'room_size'         => '120 sqm',
                'image_path'        => 'images/rooms/family-suite.jpg',
                'status'            => 'AVAILABLE',
                'is_featured'       => 0
            ]
        ];

        $insertStmt = $pdo->prepare("
            INSERT INTO rooms (name, slug, short_description, description, capacity, bed_type, room_size, image_path, status, is_featured, created_at, updated_at)
            VALUES (:name, :slug, :short_description, :description, :capacity, :bed_type, :room_size, :image_path, :status, :is_featured, NOW(), NOW())
        ");

        foreach ($defaultRooms as $r) {
            $insertStmt->execute($r);
        }

        echo "Seeded " . count($defaultRooms) . " real rooms into database.\n";
    } else {
        echo "Database rooms table already contains " . $count . " rooms.\n";
    }

} catch (\Throwable $ex) {
    echo "Seed Error: " . $ex->getMessage() . "\n";
}
