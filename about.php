<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$page_title       = 'About Us — ' . APP_NAME;
$active_page      = 'about';
$meta_description = 'Discover the story of Serona Hotel & Resort in Sigiriya, Sri Lanka. An eco-luxury sanctuary combining sustainable hospitality, heritage architecture, and natural beauty.';

require_once VIEWS_PATH . '/public/about.php';
