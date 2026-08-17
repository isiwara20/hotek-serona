<?php

declare(strict_types=1);

/**
 * URL Helper Functions
 *
 * Centralise URL and asset path generation.
 * Never hardcode BASE_URL throughout the project — use these helpers.
 */

/**
 * Return the application base URL (with trailing slash).
 *
 * Example: http://localhost/hotek-serona/
 */
function base_url(string $path = ''): string
{
    return BASE_URL . ltrim($path, '/');
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
    return BASE_URL . 'assets/' . ltrim($path, '/');
}

/**
 * Return the URL for a public uploaded file inside /storage/uploads/.
 *
 * @param string $path  Relative path from uploads/.  e.g. 'rooms/image.webp'
 */
function upload_url(string $path): string
{
    return BASE_URL . 'storage/uploads/' . ltrim($path, '/');
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
