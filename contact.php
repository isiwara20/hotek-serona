<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new ContactController();
if (is_post()) {
    $controller->submit();
} else {
    $controller->showForm();
}
