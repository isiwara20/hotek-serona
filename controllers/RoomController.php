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
        $finalRooms = [];
        try {
            $finalRooms = $this->roomBLL->getActiveRooms();
        } catch (Throwable $e) {
            $finalRooms = [];
        }

        // Format room attributes for public template
        foreach ($finalRooms as &$room) {
            $room['image']          = !empty($room['image_path']) ? $room['image_path'] : 'images/rooms/deluxe-suite.jpg';
            $room['capacity_label'] = ((int)($room['capacity'] ?? 2)) . ' Guests';
            $room['category']       = str_contains(strtolower($room['name'] ?? ''), 'villa') ? 'family' : (str_contains(strtolower($room['name'] ?? ''), 'suite') ? 'suites' : 'rooms');
            $room['spec_icons']     = [
                ['icon' => 'fa-user', 'label' => ((int)($room['capacity'] ?? 2)) . ' Guests'],
                ['icon' => 'fa-bed', 'label' => $room['bed_type'] ?? 'King Bed'],
                ['icon' => 'fa-expand', 'label' => $room['room_size'] ?? '45 m²'],
                ['icon' => 'fa-tree', 'label' => 'Forest View']
            ];
        }
        unset($room);

        // Find featured suite for spotlight section
        $featuredRoom = null;
        foreach ($finalRooms as $room) {
            if (!empty($room['is_featured'])) {
                $featuredRoom = $room;
                break;
            }
        }
        if ($featuredRoom === null && !empty($finalRooms)) {
            $featuredRoom = $finalRooms[0];
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
