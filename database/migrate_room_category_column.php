<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

try {
    $pdo = Database::getConnection();

    try {
        $pdo->exec("ALTER TABLE `rooms` ADD COLUMN `category` VARCHAR(50) NULL DEFAULT 'rooms' AFTER `slug`");
        echo "Migration Result: Added 'category' column to rooms table.\n";
    } catch (\PDOException $e) {
        echo "Migration Result: 'category' column already exists in rooms table.\n";
    }

} catch (\Throwable $ex) {
    echo "Migration Error: " . $ex->getMessage() . "\n";
}
