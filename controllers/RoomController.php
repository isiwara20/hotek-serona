<?php

declare(strict_types=1);

/**
 * RoomController — Handles the public rooms listing and room detail pages.
 */
class RoomController
{
    private RoomBLL $roomBLL;

    public function __construct()
    {
        $pdo           = Database::getConnection();
        $this->roomBLL = new RoomBLL(new RoomDAL($pdo));
    }

    /**
     * Display the public rooms listing page.
     */
    public function index(): void
    {
        $dbRooms = [];
        try {
            $dbRooms = $this->roomBLL->getActiveRooms();
        } catch (Throwable $e) {
            // Log error silently and fall back to curated presentation array
        }

        // Default luxury room catalogue definition (merges DB data with brand presentation assets)
        $defaultRooms = [
            [
                'id'                => 1,
                'name'              => 'Deluxe Room',
                'slug'              => 'deluxe-room',
                'category'          => 'rooms',
                'category_label'    => 'Deluxe Room',
                'tag'               => 'Popular Choice',
                'short_description' => 'A calm and comfortable space created for couples or solo travellers seeking a peaceful stay with organic teak furnishings and forest views.',
                'capacity'          => 2,
                'capacity_label'    => '2 Guests',
                'bed_type'          => 'King Bed',
                'room_size'         => '32 m²',
                'view_type'         => 'Garden & Forest View',
                'image'             => 'images/rooms/deluxe-room.jpg',
                'is_featured'       => 0,
                'features'          => ['Private Balcony', 'Rain Forest Shower', 'Organic Amenities', 'Complimentary Teas'],
                'spec_icons'        => [
                    ['icon' => 'fa-user', 'label' => '2 Guests'],
                    ['icon' => 'fa-bed', 'label' => 'King Bed'],
                    ['icon' => 'fa-expand', 'label' => '32 m²'],
                    ['icon' => 'fa-tree', 'label' => 'Garden View']
                ]
            ],
            [
                'id'                => 2,
                'name'              => 'Premium Suite',
                'slug'              => 'premium-suite',
                'category'          => 'suites',
                'category_label'    => 'Signature Suite',
                'tag'               => 'Signature Suite',
                'short_description' => 'An expansive private suite featuring a sun-drenched wooden deck, a private plunge pool, and panoramic jungle sunrise views.',
                'capacity'          => 2,
                'capacity_label'    => '2 Guests',
                'bed_type'          => 'King Bed',
                'room_size'         => '54 m²',
                'view_type'         => 'Panoramic Jungle View',
                'image'             => 'images/rooms/premium-suite.jpg',
                'is_featured'       => 1,
                'features'          => ['Private Plunge Pool', 'Panoramic Sundeck', 'Deep Soaking Tub', 'Butler Service'],
                'spec_icons'        => [
                    ['icon' => 'fa-user', 'label' => '2 Guests'],
                    ['icon' => 'fa-bed', 'label' => 'King Bed'],
                    ['icon' => 'fa-expand', 'label' => '54 m²'],
                    ['icon' => 'fa-water', 'label' => 'Plunge Pool']
                ]
            ],
            [
                'id'                => 3,
                'name'              => 'Family Villa Suite',
                'slug'              => 'family-villa-suite',
                'category'          => 'family',
                'category_label'    => 'Family Villa',
                'tag'               => 'Family Sanctuary',
                'short_description' => 'Two interconnected bedroom suites with a spacious shared living pavilion, private outdoor garden terrace, and premium amenities.',
                'capacity'          => 4,
                'capacity_label'    => '4 Guests',
                'bed_type'          => '2 King Beds',
                'room_size'         => '85 m²',
                'view_type'         => 'Private Garden Terrace',
                'image'             => 'images/rooms/family-suite.jpg',
                'is_featured'       => 0,
                'features'          => ['2 Bedrooms', 'Living Pavilion', 'Private Terrace', 'Family Dining Setup'],
                'spec_icons'        => [
                    ['icon' => 'fa-users', 'label' => '4 Guests'],
                    ['icon' => 'fa-bed', 'label' => '2 Bedrooms'],
                    ['icon' => 'fa-expand', 'label' => '85 m²'],
                    ['icon' => 'fa-people-roof', 'label' => 'Private Pavilion']
                ]
            ],
        ];

        // Merge database records with default presentation data
        $finalRooms = [];
        if (!empty($dbRooms)) {
            foreach ($dbRooms as $index => $dbRoom) {
                $matchedDefault = $defaultRooms[$index] ?? $defaultRooms[0];
                $merged = array_merge($matchedDefault, $dbRoom);
                if (empty($merged['image'])) {
                    $merged['image'] = $matchedDefault['image'];
                }
                if (empty($merged['category'])) {
                    $merged['category'] = $matchedDefault['category'];
                }
                if (empty($merged['spec_icons'])) {
                    $merged['spec_icons'] = $matchedDefault['spec_icons'];
                }
                $finalRooms[] = $merged;
            }
        } else {
            $finalRooms = $defaultRooms;
        }

        // Find featured suite for spotlight section
        $featuredRoom = null;
        foreach ($finalRooms as $room) {
            if (!empty($room['is_featured'])) {
                $featuredRoom = $room;
                break;
            }
        }
        if ($featuredRoom === null && !empty($finalRooms)) {
            $featuredRoom = $finalRooms[1] ?? $finalRooms[0];
        }

        $data = [
            'page_title'    => 'Rooms & Suites — ' . APP_NAME,
            'meta_desc'     => 'Discover serene, luxury accommodation at Serona Hotel & Resort. Peaceful rooms, signature suites, and family villas surrounded by nature.',
            'active_page'   => 'rooms',
            'categories'    => [
                'all'    => 'All Stays',
                'rooms'  => 'Deluxe Rooms',
                'suites' => 'Signature Suites',
                'family' => 'Family Villas',
            ],
            'featured_room' => $featuredRoom,
            'rooms'         => $finalRooms,
        ];

        $this->render('public/rooms', $data);
    }

    /**
     * Display the room detail page for a given slug.
     *
     * @param string $slug  URL slug for the room.
     */
    public function show(string $slug): void
    {
        $room = $this->roomBLL->getRoomBySlug($slug);

        if ($room === null) {
            http_response_code(404);
            $data = ['page_title' => 'Room Not Found — ' . APP_NAME];
            // TODO: render a proper 404 view in Phase 2.
            echo '<h1>Room not found.</h1>';
            return;
        }

        $data = [
            'page_title' => e($room['name']) . ' — ' . APP_NAME,
            'room'       => $room,
        ];

        $this->render('public/room-details', $data);
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
