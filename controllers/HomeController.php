<?php

declare(strict_types=1);

/**
 * HomeController — Handles the public home / landing page.
 */
class HomeController
{
    private RoomBLL $roomBLL;

    public function __construct()
    {
        $pdo           = Database::getConnection();
        $this->roomBLL = new RoomBLL(new RoomDAL($pdo));
    }

    /**
     * Display the public home page.
     */
    public function index(): void
    {
        $featuredRooms = $this->roomBLL->getActiveRooms();
        // Filter to featured only for the landing page (max 3).
        $featuredRooms = array_filter($featuredRooms, fn ($r) => (bool) $r['is_featured']);
        $featuredRooms = array_slice(array_values($featuredRooms), 0, 3);

        $data = [
            'page_title'    => APP_NAME . ' — ' . APP_TAGLINE,
            'featured_rooms'=> $featuredRooms,
        ];

        $this->render('public/home', $data);
    }

    /**
     * Render a view file, passing extracted data variables.
     *
     * @param string $view  Relative path from /views/ (no .php extension).
     * @param array  $data  Variables to extract into the view scope.
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
