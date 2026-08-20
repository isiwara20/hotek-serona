<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

try {
    $pdo = Database::getConnection();

    // Check if rooms table has image_path column
    try {
        $pdo->exec("ALTER TABLE `rooms` ADD COLUMN `image_path` VARCHAR(255) NULL DEFAULT 'images/rooms/deluxe-suite.jpg' AFTER `room_size`");
        echo "Migration Result: Added 'image_path' column to rooms table.\n";
    } catch (\PDOException $e) {
        echo "Migration Result: 'image_path' column already exists in rooms table.\n";
    }

    // Check if room_images table exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `room_images` (
            `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `room_id`    INT UNSIGNED NOT NULL,
            `filename`   VARCHAR(255) NOT NULL,
            `alt_text`   VARCHAR(255) NULL DEFAULT NULL,
            `sort_order` SMALLINT     NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `idx_room_id` (`room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

} catch (\Throwable $ex) {
    echo "Migration Error: " . $ex->getMessage() . "\n";
}
