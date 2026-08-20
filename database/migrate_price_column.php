<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

try {
    $pdo = Database::getConnection();

    // Check if dining_items table exists
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

    // Add price column if table already existed without it
    try {
        $pdo->exec("ALTER TABLE `dining_items` ADD COLUMN `price` VARCHAR(50) NULL DEFAULT '$18.00' AFTER `category`");
        echo "Migration Result: Added 'price' column to dining_items table successfully.\n";
    } catch (\PDOException $e) {
        echo "Migration Result: 'price' column already exists or table ready.\n";
    }

} catch (\Throwable $ex) {
    echo "Migration Error: " . $ex->getMessage() . "\n";
}
