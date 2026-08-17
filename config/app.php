<?php

declare(strict_types=1);

/**
 * Application Configuration
 *
 * Central configuration for Serona Hotel & Resort.
 * Update these values before deploying to production.
 */

// ─────────────────────────────────────────────
// Application Identity
// ─────────────────────────────────────────────
define('APP_NAME',    'Serona Hotel & Resort');
define('APP_TAGLINE', "Nature's Embrace");

// ─────────────────────────────────────────────
// Environment
// Values: 'development' | 'production'
// ─────────────────────────────────────────────
define('APP_ENV',   'development');
define('APP_DEBUG', APP_ENV === 'development');

// ─────────────────────────────────────────────
// Base URL
// Trailing slash required.
// Change to your production domain before deployment.
// ─────────────────────────────────────────────
define('BASE_URL', 'http://localhost/hotek-serona/');

// ─────────────────────────────────────────────
// Admin Contact
// ─────────────────────────────────────────────
define('ADMIN_EMAIL', 'admin@serona.example.com'); // TODO: replace with real admin email

// ─────────────────────────────────────────────
// Session
// ─────────────────────────────────────────────
define('SESSION_ADMIN_KEY',  'serona_admin');
define('SESSION_FLASH_KEY',  'serona_flash');
define('SESSION_CSRF_KEY',   'serona_csrf_token');

// ─────────────────────────────────────────────
// Paths
// ─────────────────────────────────────────────
define('ROOT_PATH',    dirname(__DIR__));
define('CONFIG_PATH',  ROOT_PATH . DIRECTORY_SEPARATOR . 'config');
define('VIEWS_PATH',   ROOT_PATH . DIRECTORY_SEPARATOR . 'views');
define('STORAGE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'storage');
define('ASSETS_PATH',  ROOT_PATH . DIRECTORY_SEPARATOR . 'assets');
define('UPLOADS_PATH', STORAGE_PATH . DIRECTORY_SEPARATOR . 'uploads');
define('LOGS_PATH',    STORAGE_PATH . DIRECTORY_SEPARATOR . 'logs');

// ─────────────────────────────────────────────
// File Upload Limits
// ─────────────────────────────────────────────
define('UPLOAD_MAX_SIZE',    5 * 1024 * 1024); // 5 MB
define('UPLOAD_ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/webp']);
define('UPLOAD_ALLOWED_EXT',  ['jpg', 'jpeg', 'png', 'webp']);
