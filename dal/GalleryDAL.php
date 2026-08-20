<?php

declare(strict_types=1);

/**
 * GalleryDAL — Data Access Layer for Serona Resort Gallery.
 *
 * Extends BaseDAL to query the database or return a curated visual gallery dataset.
 */
class GalleryDAL extends BaseDAL
{
    /**
     * Retrieve all active gallery items.
     *
     * @return array[]
     */
    public function findAllActive(): array
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, title, category, image_path, alt_text, caption, aspect_ratio, display_order, is_featured, status
                 FROM   gallery
                 WHERE  status != 'HIDDEN'
                 ORDER  BY display_order ASC, id ASC"
            );
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (!empty($results)) {
                return $results;
            }
        } catch (\PDOException $e) {
            // Table might not exist; fall back to curated dataset
        }

        return $this->getFallbackGallery();
    }

    /**
     * Retrieve gallery items filtered by category.
     *
     * @param string $category
     * @return array[]
     */
    public function findByCategory(string $category): array
    {
        $all = $this->findAllActive();
        if (empty($category) || strtolower($category) === 'all') {
            return $all;
        }

        return array_values(array_filter($all, function ($item) use ($category) {
            return strtolower($item['category']) === strtolower($category);
        }));
    }

    /**
     * Retrieve featured gallery items.
     *
     * @return array[]
     */
    public function findFeatured(): array
    {
        $all = $this->findAllActive();
        return array_values(array_filter($all, function ($item) {
            return !empty($item['is_featured']);
        }));
    }

    /**
     * Curated, client-ready fallback gallery dataset using high-res property photography.
     *
     * @return array[]
     */
    private function getFallbackGallery(): array
    {
        return [
            [
                'id'            => 1,
                'title'         => 'Infinity Pool at Sunset',
                'category'      => 'pool',
                'category_label'=> 'Pool & Sky',
                'image_path'    => 'images/gallery/gallery-1.jpg',
                'alt_text'      => 'Serona infinity pool overlooking mountain rainforest during golden hour sunset',
                'caption'       => 'Golden hour reflections over our rainforest infinity pool',
                'aspect_ratio'  => 'wide',
                'display_order' => 1,
                'is_featured'   => true
            ],
            [
                'id'            => 2,
                'title'         => 'Deluxe Suite Teak Interior',
                'category'      => 'rooms',
                'category_label'=> 'Rooms & Suites',
                'image_path'    => 'images/gallery/gallery-2.jpg',
                'alt_text'      => 'Deluxe suite interior with organic teak furnishings and forest view balcony',
                'caption'       => 'Natural teak wood furnishings and quiet canopy views',
                'aspect_ratio'  => 'portrait',
                'display_order' => 2,
                'is_featured'   => false
            ],
            [
                'id'            => 3,
                'title'         => 'Farm-to-Table Gourmet Dish',
                'category'      => 'dining',
                'category_label'=> 'Dining',
                'image_path'    => 'images/gallery/gallery-3.jpg',
                'alt_text'      => 'Gourmet dining dish prepared with organic local Sri Lankan ingredients',
                'caption'       => 'Artisanal dishes prepared with fresh local harvests and island spices',
                'aspect_ratio'  => 'square',
                'display_order' => 3,
                'is_featured'   => false
            ],
            [
                'id'            => 4,
                'title'         => 'Rainforest Trail Walk',
                'category'      => 'experiences',
                'category_label'=> 'Experiences',
                'image_path'    => 'images/experiences/nature-walk.jpg',
                'alt_text'      => 'Guided nature walk through untouched tropical rainforest canopy',
                'caption'       => 'Guided trails through endemic rainforest flora and natural streams',
                'aspect_ratio'  => 'large',
                'display_order' => 4,
                'is_featured'   => true
            ],
            [
                'id'            => 5,
                'title'         => 'Open-Air Lantern Evening Dining',
                'category'      => 'dining',
                'category_label'=> 'Dining',
                'image_path'    => 'images/dining/dining-main.jpg',
                'alt_text'      => 'Open-air forest restaurant dining beneath warm evening lanterns',
                'caption'       => 'Atmospheric evening dining under tropical lanterns',
                'aspect_ratio'  => 'wide',
                'display_order' => 5,
                'is_featured'   => false
            ],
            [
                'id'            => 6,
                'title'         => 'Garden River Spa Pavilion',
                'category'      => 'nature',
                'category_label'=> 'Nature & Wellness',
                'image_path'    => 'images/experiences/wellness.jpg',
                'alt_text'      => 'Secluded garden wellness pavilion surrounded by tropical foliage',
                'caption'       => 'Quiet rest pavilions tucked away in untouched greenery',
                'aspect_ratio'  => 'portrait',
                'display_order' => 6,
                'is_featured'   => false
            ],
            [
                'id'            => 7,
                'title'         => 'Premium Suite Private Plunge Pool',
                'category'      => 'rooms',
                'category_label'=> 'Rooms & Suites',
                'image_path'    => 'images/rooms/premium-suite.jpg',
                'alt_text'      => 'Premium suite with private wooden sun deck and infinity plunge pool',
                'caption'       => 'Private plunge pool deck overlooking sunrise mountain views',
                'aspect_ratio'  => 'wide',
                'display_order' => 7,
                'is_featured'   => true
            ],
            [
                'id'            => 8,
                'title'         => 'Candlelit Jungle Private Dining',
                'category'      => 'evenings',
                'category_label'=> 'Evenings & Atmosphere',
                'image_path'    => 'images/experiences/private-dining.jpg',
                'alt_text'      => 'Candlelit outdoor private table setup for dinner under stars',
                'caption'       => 'Intimate jungle private dining surrounded by evening forest sounds',
                'aspect_ratio'  => 'square',
                'display_order' => 8,
                'is_featured'   => false
            ],
            [
                'id'            => 9,
                'title'         => 'Family Villa Suite Grounds',
                'category'      => 'resort',
                'category_label'=> 'Resort Architecture',
                'image_path'    => 'images/rooms/family-suite.jpg',
                'alt_text'      => 'Family villa suite architecture surrounded by lush tropical gardens',
                'caption'       => 'Eco-friendly architecture blending seamlessly into nature',
                'aspect_ratio'  => 'wide',
                'display_order' => 9,
                'is_featured'   => false
            ],
            [
                'id'            => 10,
                'title'         => 'Forest Canopy Terrace Balcony',
                'category'      => 'nature',
                'category_label'=> 'Nature & Views',
                'image_path'    => 'images/gallery/gallery-4.jpg',
                'alt_text'      => 'Private terrace balcony with uninterrupted forest canopy views',
                'caption'       => 'Morning fog lifting over the Sigiriya rainforest canopy',
                'aspect_ratio'  => 'portrait',
                'display_order' => 10,
                'is_featured'   => false
            ]
        ];
    }

    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO gallery (filename, caption, category, sort_order, is_active, created_at)
             VALUES (:filename, :caption, :category, :sort_order, :is_active, NOW())'
        );

        $success = $stmt->execute([
            ':filename'   => $data['filename'],
            ':caption'    => $data['caption']    ?? null,
            ':category'   => $data['category']   ?? 'rooms',
            ':sort_order' => (int)($data['sort_order'] ?? 0),
            ':is_active'  => (int)($data['is_active']  ?? 1),
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE gallery
             SET    caption = :caption,
                    category = :category,
                    is_active = :is_active
             WHERE  id = :id'
        );

        return $stmt->execute([
            ':caption'   => $data['caption']  ?? null,
            ':category'  => $data['category'] ?? 'rooms',
            ':is_active' => (int)($data['is_active'] ?? 1),
            ':id'        => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM gallery WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
