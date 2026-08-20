<?php

declare(strict_types=1);

/**
 * ExperienceDAL — Data Access Layer for Serona Resort Experiences.
 *
 * Extends BaseDAL to interface with the database or provide fallback structured data.
 */
class ExperienceDAL extends BaseDAL
{
    /**
     * Retrieve all active experiences from database or fallback dataset.
     *
     * @return array[]
     */
    public function findAllActive(): array
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, title, slug, category, short_description, full_description,
                        featured_image, meta_info, display_order, is_featured, status
                 FROM   experiences
                 WHERE  status != 'HIDDEN'
                 ORDER  BY is_featured DESC, display_order ASC"
            );
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (!empty($results)) {
                return $results;
            }
        } catch (\PDOException $e) {
            // Table might not exist yet; fall back to curated fallback dataset
        }

        return $this->getFallbackExperiences();
    }

    /**
     * Retrieve experiences filtered by category.
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

        return array_values(array_filter($all, function ($exp) use ($category) {
            return strtolower($exp['category']) === strtolower($category);
        }));
    }

    /**
     * Retrieve the primary featured experience.
     *
     * @return array|null
     */
    public function findFeatured(): ?array
    {
        $all = $this->findAllActive();
        foreach ($all as $exp) {
            if (!empty($exp['is_featured'])) {
                return $exp;
            }
        }

        return $all[0] ?? null;
    }

    /**
     * Curated, client-ready fallback dataset when DB table is not yet populated.
     *
     * @return array[]
     */
    private function getFallbackExperiences(): array
    {
        return [
            [
                'id'                => 1,
                'title'             => 'Guided Rainforest Trails',
                'slug'              => 'guided-rainforest-trails',
                'category'          => 'nature',
                'short_description' => 'Explore hidden flora, endemic birdlife, and natural streams accompanied by our resident naturalist.',
                'full_description'  => 'Walk through untouched forest paths around Serona. Learn about indigenous flora, spot endemic bird species, and listen to the soothing murmur of natural mountain streams at a peaceful, relaxed pace.',
                'featured_image'    => 'images/experiences/nature-walk.jpg',
                'meta_info'         => 'Nature • Guided • 1.5 - 2 Hours • Couples & Families',
                'display_order'     => 1,
                'is_featured'       => true,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 2,
                'title'             => 'Sunrise Mountain Viewpoint',
                'slug'              => 'sunrise-mountain-viewpoint',
                'category'          => 'nature',
                'short_description' => 'Begin the day with soft morning light, fresh mountain air, and panoramic views of Sigiriya canopy.',
                'full_description'  => 'A gentle morning walk to our private view platform where golden dawn sunlight illuminates the surrounding rainforest and distant mist-laden peaks.',
                'featured_image'    => 'images/hero/experience-band.jpg',
                'meta_info'         => 'Nature • Sunrise • 1 Hour • All Ages',
                'display_order'     => 2,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 3,
                'title'             => 'Quiet Garden & Organic Rest',
                'slug'              => 'quiet-garden-rest',
                'category'          => 'wellness',
                'short_description' => 'Unwind in secluded shaded garden pavilions crafted for peaceful reading, meditation, and quietude.',
                'full_description'  => 'Nestled among native spice trees and tropical palms, our garden rest areas invite you to slow your mind, sip herbal tea, and feel the natural rhythm of Serona.',
                'featured_image'    => 'images/experiences/wellness.jpg',
                'meta_info'         => 'Wellness • Solitude • Open Daily • Quiet Zone',
                'display_order'     => 3,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 4,
                'title'             => 'Rainforest Infinity Poolside',
                'slug'              => 'rainforest-infinity-poolside',
                'category'          => 'leisure',
                'short_description' => 'Spend unhurried hours by our cliffside pool, overlooking tropical canopy greenery and mountain sunsets.',
                'full_description'  => 'Immerse yourself in crystal waters that reflect the open sky and jungle canopy. Refreshing herbal mocktails and chilled towels served poolside.',
                'featured_image'    => 'images/hero/hero-bg.jpg',
                'meta_info'         => 'Leisure • Infinity Pool • Open Daily • All Guests',
                'display_order'     => 4,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 5,
                'title'             => 'Authentic Regional Flavours & Discovery',
                'slug'              => 'authentic-regional-flavours',
                'category'          => 'local',
                'short_description' => 'Discover the rich culinary history and local agricultural traditions of Sigiriya and Central Province.',
                'full_description'  => 'Our culinary team introduces guests to organic farm harvests, local spices, traditional clay-pot preparation, and authentic Sri Lankan hospitality.',
                'featured_image'    => 'images/dining/dining-main.jpg',
                'meta_info'         => 'Local • Culinary • Evening • Interactive',
                'display_order'     => 5,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 6,
                'title'             => 'Together at Serona — Family Moments',
                'slug'              => 'family-moments-serona',
                'category'          => 'family',
                'short_description' => 'Shared garden explorations, poolside fun, and evening stargazing designed for multi-generational families.',
                'full_description'  => 'Creating space for families to connect naturally. Enjoy open-air leisure, birdwatching games, and relaxed courtyard dining tailored for all ages.',
                'featured_image'    => 'images/rooms/family-suite.jpg',
                'meta_info'         => 'Family • Leisure • All Day • Multi-Generational',
                'display_order'     => 6,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ],
            [
                'id'                => 7,
                'title'             => 'Candlelit Jungle Private Dining',
                'slug'              => 'candlelit-jungle-private-dining',
                'category'          => 'private',
                'short_description' => 'An exclusive dining setup under tropical lanterns and stars for anniversaries, proposals, or intimate celebrations.',
                'full_description'  => 'Surrounded by quiet forest sounds and soft lantern glow, enjoy a custom multi-course dinner curated by our executive chef for your special occasion.',
                'featured_image'    => 'images/experiences/private-dining.jpg',
                'meta_info'         => 'Private • Dining • By Request • Romantic & Exclusive',
                'display_order'     => 7,
                'is_featured'       => false,
                'status'            => 'PUBLISHED'
            ]
        ];
    }

    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO experiences (name, description, filename, sort_order, is_active, created_at, updated_at)
             VALUES (:name, :description, :filename, :sort_order, :is_active, NOW(), NOW())'
        );

        $success = $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'] ?? null,
            ':filename'    => $data['filename']    ?? 'images/experiences/nature-walk.jpg',
            ':sort_order'  => (int)($data['sort_order'] ?? 0),
            ':is_active'   => (int)($data['is_active']  ?? 1),
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE experiences
             SET    name = :name,
                    description = :description,
                    filename = :filename,
                    is_active = :is_active,
                    updated_at = NOW()
             WHERE  id = :id'
        );

        return $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'] ?? null,
            ':filename'    => $data['filename']    ?? 'images/experiences/nature-walk.jpg',
            ':is_active'   => (int)($data['is_active']  ?? 1),
            ':id'          => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM experiences WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
