<?php
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new AdminController();
$action     = $_GET['action'] ?? $_POST['action'] ?? '';

if (is_post()) {
    if ($action === 'delete') {
        $controller->deleteExperience();
    } else {
        $controller->saveExperience();
    }
} else {
    if ($action === 'delete') {
        $controller->deleteExperience();
    } else {
        $controller->experiences();
    }
}
