<?php
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new AdminController();
$action     = $_GET['action'] ?? $_POST['action'] ?? '';

if (is_post()) {
    if ($action === 'delete') {
        $controller->deleteGallery();
    } else {
        $controller->saveGallery();
    }
} else {
    if ($action === 'delete') {
        $controller->deleteGallery();
    } else {
        $controller->gallery();
    }
}
