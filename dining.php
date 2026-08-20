<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$page_title       = 'Dining — ' . APP_NAME;
$meta_description = 'Dine at Serona Hotel & Resort — thoughtfully prepared dishes, fresh local ingredients and warm hospitality in a peaceful natural setting. Discover our dining catalogue.';
$active_page      = 'dining';

$diningDAL = new DiningDAL(Database::getConnection());
$allMeals  = $diningDAL->findAll();
$meals     = array_values(array_filter($allMeals, fn($m) => !empty($m['is_active'])));

require_once VIEWS_PATH . '/public/dining.php';
