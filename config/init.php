<?php

declare(strict_types=1);

/**
 * Serona Hotel & Resort — Initialisation File
 *
 * This is the single entry point for all PHP pages.
 * Every top-level entry file must require this first.
 *
 * Responsibilities:
 *   1. Load application configuration constants.
 *   2. Start/resume the PHP session safely.
 *   3. Register the PSR-style class autoloader.
 *   4. Bootstrap error handling appropriate to environment.
 *   5. Load global helper functions.
 */

// ─────────────────────────────────────────────────────────────────────────────
// 1. Guard: prevent direct execution of config files
// ─────────────────────────────────────────────────────────────────────────────
if (!defined('ROOT_PATH')) {
    require_once __DIR__ . '/app.php';
}

// ─────────────────────────────────────────────────────────────────────────────
// 2. Error reporting — environment-aware
//    In production, errors are logged only. Never displayed to visitors.
// ─────────────────────────────────────────────────────────────────────────────
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('log_errors',     '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
    ini_set('log_errors',     '1');
}

ini_set('error_log', LOGS_PATH . DIRECTORY_SEPARATOR . 'app.log');

// ─────────────────────────────────────────────────────────────────────────────
// 3. Session configuration — must happen BEFORE session_start()
// ─────────────────────────────────────────────────────────────────────────────
ini_set('session.use_strict_mode',    '1');
ini_set('session.cookie_httponly',    '1');
ini_set('session.cookie_samesite',    'Lax');
ini_set('session.use_only_cookies',   '1');

// Set cookie_secure to '1' in production (HTTPS).
ini_set('session.cookie_secure', APP_ENV === 'production' ? '1' : '0');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. Class Autoloader
//    Loads classes automatically from /controllers, /bll, /dal, /services.
//    Class name must match file name exactly (case-sensitive on Linux).
// ─────────────────────────────────────────────────────────────────────────────
spl_autoload_register(function (string $className): void {
    $autoloadDirs = [
        ROOT_PATH . DIRECTORY_SEPARATOR . 'controllers',
        ROOT_PATH . DIRECTORY_SEPARATOR . 'bll',
        ROOT_PATH . DIRECTORY_SEPARATOR . 'dal',
        ROOT_PATH . DIRECTORY_SEPARATOR . 'services',
    ];

    foreach ($autoloadDirs as $dir) {
        $file = $dir . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// 5. Load global helper functions
//    These are procedural helpers available project-wide.
// ─────────────────────────────────────────────────────────────────────────────
require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'functions.php';
require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'security.php';
require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'validation.php';
require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'url.php';
