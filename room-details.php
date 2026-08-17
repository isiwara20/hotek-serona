<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$slug = get_param('slug') ?? '';
$controller = new RoomController();
$controller->show($slug);
