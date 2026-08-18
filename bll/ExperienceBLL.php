<?php

declare(strict_types=1);

/**
 * ExperienceBLL — Business Logic Layer for Serona Experiences.
 *
 * Enforces business rules and category grouping for public views.
 */
class ExperienceBLL
{
    private ExperienceDAL $experienceDAL;

    public function __construct(ExperienceDAL $experienceDAL)
    {
        $this->experienceDAL = $experienceDAL;
    }

    /**
     * Get all active experiences, optionally filtered by category.
     *
     * @param string|null $category
     * @return array[]
     */
    public function getExperiences(?string $category = null): array
    {
        if ($category !== null && !empty(trim($category))) {
            return $this->experienceDAL->findByCategory($category);
        }

        return $this->experienceDAL->findAllActive();
    }

    /**
     * Get the signature featured experience.
     *
     * @return array|null
     */
    public function getFeaturedExperience(): ?array
    {
        return $this->experienceDAL->findFeatured();
    }

    /**
     * Get experiences grouped by category keys.
     *
     * @return array<string, array[]>
     */
    public function getExperiencesByCategory(): array
    {
        $all = $this->experienceDAL->findAllActive();
        $grouped = [
            'nature'   => [],
            'wellness' => [],
            'leisure'  => [],
            'local'    => [],
            'family'   => [],
            'private'  => [],
        ];

        foreach ($all as $exp) {
            $cat = strtolower($exp['category'] ?? 'nature');
            if (isset($grouped[$cat])) {
                $grouped[$cat][] = $exp;
            } else {
                $grouped[$cat] = [$exp];
            }
        }

        return $grouped;
    }

    /**
     * Get category navigation list.
     *
     * @return array[]
     */
    public function getCategories(): array
    {
        return [
            ['key' => 'all',      'label' => 'All Experiences'],
            ['key' => 'nature',   'label' => 'Nature'],
            ['key' => 'wellness', 'label' => 'Wellness'],
            ['key' => 'leisure',  'label' => 'Leisure'],
            ['key' => 'local',    'label' => 'Local Connections'],
            ['key' => 'family',   'label' => 'Together at Serona'],
            ['key' => 'private',  'label' => 'Private Moments'],
        ];
    }
}
