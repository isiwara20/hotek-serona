<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

$dal = new DiningDAL(Database::getConnection());
$mealsBefore = $dal->findAll();
echo "Meals Count Before: " . count($mealsBefore) . "\n";

if (!empty($mealsBefore)) {
    $targetId = (int)$mealsBefore[0]['id'];
    $dal->delete($targetId);
    $mealsAfter = $dal->findAll();
    echo "Deleted Meal ID " . $targetId . " Successfully!\n";
    echo "Meals Count After: " . count($mealsAfter) . "\n";
}
