<?php

declare(strict_types=1);

/**
 * GalleryController — Handles public Gallery page logic and view rendering.
 */
class GalleryController
{
    private GalleryBLL $galleryBLL;

    public function __construct()
    {
        $pdo               = Database::getConnection();
        $this->galleryBLL  = new GalleryBLL(new GalleryDAL($pdo));
    }

    /**
     * Display the public Gallery page.
     */
    public function index(): void
    {
        $selectedCategory = isset($_GET['category']) ? sanitize($_GET['category']) : 'all';
        $galleryItems     = $this->galleryBLL->getGalleryItems($selectedCategory);
        $allGalleryItems  = $this->galleryBLL->getGalleryItems('all');
        $featuredItems    = $this->galleryBLL->getFeaturedVisuals();
        $categories       = $this->galleryBLL->getCategories();

        $data = [
            'page_title'       => 'Gallery — ' . APP_NAME . ' | A Glimpse of Serona',
            'meta_description' => 'Explore the visual story of Serona Hotel & Resort through photography of our rooms, suites, open-air dining, nature trails, infinity pool, and serene atmosphere.',
            'active_page'      => 'gallery',
            'selected_category'=> $selectedCategory,
            'gallery_items'    => $galleryItems,
            'all_gallery_items'=> $allGalleryItems,
            'featured_items'   => $featuredItems,
            'categories'       => $categories,
        ];

        $this->render('public/gallery', $data);
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
