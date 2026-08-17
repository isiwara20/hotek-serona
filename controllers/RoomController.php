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
        $rooms = $this->roomBLL->getActiveRooms();

        $data = [
            'page_title' => 'Our Rooms — ' . APP_NAME,
            'rooms'      => $rooms,
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
