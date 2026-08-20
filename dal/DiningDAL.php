<?php
declare(strict_types=1);

/**
 * DiningDAL — Data Access Layer for resort meals & dining menu items.
 */
class DiningDAL extends BaseDAL
{
    public function findAll(): array
    {
        try {
            $stmt = $this->pdo->prepare(
                'SELECT id, name, description, category, price, filename, sort_order, is_active, created_at
                 FROM   dining_items
                 ORDER  BY sort_order ASC, id ASC'
            );
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            return [];
        }
    }

    public function findById(int $id): ?array
    {
        $all = $this->findAll();
        foreach ($all as $item) {
            if ((int)$item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }

    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO dining_items (name, description, category, price, filename, sort_order, is_active, created_at, updated_at)
             VALUES (:name, :description, :category, :price, :filename, :sort_order, :is_active, NOW(), NOW())'
        );

        $success = $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'] ?? null,
            ':category'    => $data['category']    ?? 'Breakfast',
            ':price'       => $data['price']       ?? '$18.00',
            ':filename'    => $data['filename']    ?? 'images/dining/dining-main.jpg',
            ':sort_order'  => (int)($data['sort_order'] ?? 0),
            ':is_active'   => (int)($data['is_active']  ?? 1),
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE dining_items
             SET    name = :name,
                    description = :description,
                    category = :category,
                    price = :price,
                    filename = :filename,
                    is_active = :is_active,
                    updated_at = NOW()
             WHERE  id = :id'
        );

        return $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'] ?? null,
            ':category'    => $data['category']    ?? 'Breakfast',
            ':price'       => $data['price']       ?? '$18.00',
            ':filename'    => $data['filename']    ?? 'images/dining/dining-main.jpg',
            ':is_active'   => (int)($data['is_active']  ?? 1),
            ':id'          => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM dining_items WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    private function getFallbackMeals(): array
    {
        return [
            [
                'id'          => 1,
                'name'        => 'Ceylon Egg Hoppers & Coconut Sambal',
                'description' => 'Crispy bowl-shaped rice flour pancakes with runny farm egg center, served with fresh coconut chutney and fiery lunu miris.',
                'category'    => 'Breakfast',
                'price'       => '$16.00',
                'filename'    => 'images/gallery/gallery-3.jpg',
                'sort_order'  => 1,
                'is_active'   => 1,
            ],
            [
                'id'          => 2,
                'name'        => 'Sigiriya Spiced Grilled Lobster',
                'description' => 'Ocean lobster seasoned with organic rainforest garden spices, served with fragrant lemongrass pilaf and herb butter.',
                'category'    => 'Dinner',
                'price'       => '$42.00',
                'filename'    => 'images/dining/dining-main.jpg',
                'sort_order'  => 2,
                'is_active'   => 1,
            ],
            [
                'id'          => 3,
                'name'        => 'Tropical Avocado & Organic Poached Toast',
                'description' => 'Artisanal sourdough toast topped with smashed avocado, heirloom tomatoes, micro-greens, and citrus vinaigrette.',
                'category'    => 'Lunch',
                'price'       => '$18.00',
                'filename'    => 'images/gallery/gallery-4.jpg',
                'sort_order'  => 3,
                'is_active'   => 1,
            ],
            [
                'id'          => 4,
                'name'        => 'Wild Passionfruit & Mango Coconut Mousse',
                'description' => 'Chilled organic coconut cream mousse layered with fresh tropical passionfruit reduction and crushed pistachio.',
                'category'    => 'Desserts',
                'price'       => '$14.00',
                'filename'    => 'images/gallery/gallery-2.jpg',
                'sort_order'  => 4,
                'is_active'   => 1,
            ],
            [
                'id'          => 5,
                'name'        => 'Sigiriya Sunrise Herbal Mocktail',
                'description' => 'Refreshing blend of crushed king coconut water, fresh lime, wild lemongrass syrup, and mint leaves.',
                'category'    => 'Beverages & Cocktails',
                'price'       => '$12.00',
                'filename'    => 'images/hero/experience-band.jpg',
                'sort_order'  => 5,
                'is_active'   => 1,
            ]
        ];
    }
}
