<?php
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new AdminController();
if (is_post()) {
    $controller->updateBookingStatus();
} else {
    $controller->bookings();
}
