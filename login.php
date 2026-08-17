<?php

declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new AuthController();

if (is_post()) {
    $controller->login();
} else {
    $controller->showLogin();
}
