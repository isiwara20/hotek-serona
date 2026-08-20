<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

$dal = new DiningDAL(Database::getConnection());
$meals = $dal->findAll();
echo "Initial Meals Count: " . count($meals) . "\n";

$newId = $dal->create([
    'name'        => 'Test Fresh Meal',
    'category'    => 'Breakfast',
    'price'       => '$15.00',
    'description' => 'Delicious fresh test meal',
    'filename'    => 'images/dining/dining-main.jpg'
]);

echo "Created Meal ID: " . var_export($newId, true) . "\n";

if ($newId && $newId > 0) {
    $updated = $dal->update((int)$newId, [
        'name'        => 'Updated Fresh Meal',
        'category'    => 'Lunch',
        'price'       => '$22.00',
        'description' => 'Updated fresh test meal description',
        'filename'    => 'images/dining/dining-main.jpg',
        'is_active'   => 1
    ]);
    echo "Updated Meal: " . ($updated ? "SUCCESS" : "FAILED") . "\n";

    $deleted = $dal->delete((int)$newId);
    echo "Deleted Meal: " . ($deleted ? "SUCCESS" : "FAILED") . "\n";
}
