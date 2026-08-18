<?php

declare(strict_types=1);

/**
 * Public Entry Point — Gallery Page
 */
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new GalleryController();
$controller->index();
