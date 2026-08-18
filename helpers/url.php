<?php

declare(strict_types=1);

/**
 * URL Helper Functions
 *
 * Centralise URL and asset path generation.
 * Never hardcode BASE_URL throughout the project — use these helpers.
 */

/**
 * Helper to get the current application base URL dynamically.
 * Auto-detects scheme, host, port, and subdirectory path.
 */
function get_app_base_url(): string
{
    if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SCRIPT_NAME'])) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host   = $_SERVER['HTTP_HOST'];
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $dir    = rtrim($scriptDir, '/');
        return $scheme . '://' . $host . ($dir !== '' ? $dir : '') . '/';
    }
    return defined('BASE_URL') ? BASE_URL : '/';
}

/**
 * Return the application base URL (with trailing slash).
 *
 * Example: http://localhost/hotek-serona/
 */
function base_url(string $path = ''): string
{
    return get_app_base_url() . ltrim($path, '/');
}

/**
 * Return the URL for an asset file inside /assets/.
 *
 * @param string $path  Relative path from assets/.  e.g. 'css/main.css'
 *
 * Example: asset('css/main.css') → http://localhost/hotek-serona/assets/css/main.css
 */
function asset(string $path): string
{
    return get_app_base_url() . 'assets/' . ltrim($path, '/');
}

/**
 * Return the URL for a public uploaded file inside /storage/uploads/.
 *
 * @param string $path  Relative path from uploads/.  e.g. 'rooms/image.webp'
 */
function upload_url(string $path): string
{
    return get_app_base_url() . 'storage/uploads/' . ltrim($path, '/');
}

/**
 * Return the current page URL (scheme + host + URI).
 */
function current_url(): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $uri    = $_SERVER['REQUEST_URI'] ?? '/';
    return $scheme . '://' . $host . $uri;
}
