<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

try {
    $pdo = Database::getConnection();

    // Ensure table structure exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `dining_items` (
            `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
            `name`        VARCHAR(150)  NOT NULL,
            `description` TEXT          NULL DEFAULT NULL,
            `category`    VARCHAR(100)  NULL DEFAULT NULL,
            `price`       VARCHAR(50)   NULL DEFAULT '$18.00',
            `filename`    VARCHAR(255)  NULL DEFAULT NULL,
            `sort_order`  SMALLINT      NOT NULL DEFAULT 0,
            `is_active`   TINYINT(1)    NOT NULL DEFAULT 1,
            `created_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Check count of items
    $stmt = $pdo->query("SELECT COUNT(*) FROM dining_items");
    $count = (int) $stmt->fetchColumn();

    if ($count === 0) {
        $defaultMeals = [
            [
                'name'        => 'Ceylon Egg Hoppers & Coconut Sambal',
                'description' => 'Crispy bowl-shaped rice flour pancakes with runny farm egg center, served with fresh coconut chutney and fiery lunu miris.',
                'category'    => 'Breakfast',
                'price'       => '$16.00',
                'filename'    => 'images/gallery/gallery-3.jpg',
                'sort_order'  => 1
            ],
            [
                'name'        => 'Sigiriya Spiced Grilled Lobster',
                'description' => 'Ocean lobster seasoned with organic rainforest garden spices, served with fragrant lemongrass pilaf and herb butter.',
                'category'    => 'Dinner',
                'price'       => '$42.00',
                'filename'    => 'images/dining/dining-main.jpg',
                'sort_order'  => 2
            ],
            [
                'name'        => 'Tropical Avocado & Organic Poached Toast',
                'description' => 'Artisanal sourdough toast topped with smashed avocado, heirloom tomatoes, micro-greens, and citrus vinaigrette.',
                'category'    => 'Lunch',
                'price'       => '$18.00',
                'filename'    => 'images/gallery/gallery-4.jpg',
                'sort_order'  => 3
            ],
            [
                'name'        => 'Wild Passionfruit & Mango Coconut Mousse',
                'description' => 'Chilled organic coconut cream mousse layered with fresh tropical passionfruit reduction and crushed pistachio.',
                'category'    => 'Desserts',
                'price'       => '$14.00',
                'filename'    => 'images/gallery/gallery-2.jpg',
                'sort_order'  => 4
            ],
            [
                'name'        => 'Sigiriya Sunrise Herbal Mocktail',
                'description' => 'Refreshing blend of crushed king coconut water, fresh lime, wild lemongrass syrup, and mint leaves.',
                'category'    => 'Beverages & Cocktails',
                'price'       => '$12.00',
                'filename'    => 'images/hero/experience-band.jpg',
                'sort_order'  => 5
            ]
        ];

        $insertStmt = $pdo->prepare("
            INSERT INTO dining_items (name, description, category, price, filename, sort_order, is_active, created_at, updated_at)
            VALUES (:name, :description, :category, :price, :filename, :sort_order, 1, NOW(), NOW())
        ");

        foreach ($defaultMeals as $m) {
            $insertStmt->execute($m);
        }

        echo "Seeded " . count($defaultMeals) . " real default meals into database.\n";
    } else {
        echo "Database dining_items table already contains " . $count . " items.\n";
    }

} catch (\Throwable $ex) {
    echo "Seed Error: " . $ex->getMessage() . "\n";
}
