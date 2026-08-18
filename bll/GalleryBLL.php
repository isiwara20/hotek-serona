<?php

declare(strict_types=1);

/**
 * GalleryBLL — Business Logic Layer for Serona Gallery.
 *
 * Manages category filtering, featured visual selections, and visual story groupings.
 */
class GalleryBLL
{
    private GalleryDAL $galleryDAL;

    public function __construct(GalleryDAL $galleryDAL)
    {
        $this->galleryDAL = $galleryDAL;
    }

    /**
     * Retrieve gallery items, optionally filtered by category key.
     *
     * @param string|null $category
     * @return array[]
     */
    public function getGalleryItems(?string $category = null): array
    {
        if ($category !== null && !empty(trim($category))) {
            return $this->galleryDAL->findByCategory($category);
        }

        return $this->galleryDAL->findAllActive();
    }

    /**
     * Retrieve featured items for visual hero / highlight sections.
     *
     * @return array[]
     */
    public function getFeaturedVisuals(): array
    {
        return $this->galleryDAL->findFeatured();
    }

    /**
     * Retrieve category navigation definitions.
     *
     * @return array[]
     */
    public function getCategories(): array
    {
        return [
            ['key' => 'all',         'label' => 'All Moments'],
            ['key' => 'resort',      'label' => 'Resort'],
            ['key' => 'rooms',       'label' => 'Rooms & Suites'],
            ['key' => 'dining',      'label' => 'Dining'],
            ['key' => 'experiences', 'label' => 'Experiences'],
            ['key' => 'nature',      'label' => 'Nature'],
            ['key' => 'pool',        'label' => 'Pool & Sky'],
            ['key' => 'evenings',    'label' => 'Serona After Dark'],
        ];
    }
}
