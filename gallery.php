<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$page_title = 'Gallery — ' . APP_NAME;

require_once VIEWS_PATH . '/public/gallery.php';
