<?php

declare(strict_types=1);

/**
 * General Helper Functions
 *
 * Small, reusable utilities available project-wide.
 * Loaded once by config/init.php via require_once.
 */

// ─────────────────────────────────────────────────────────────────────────────
// Output Escaping
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Escape a string for safe HTML output.
 * Always use this when printing user-supplied or database-sourced data.
 *
 * @param string|null $value
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// ─────────────────────────────────────────────────────────────────────────────
// HTTP Utilities
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Redirect to a URL and terminate execution.
 *
 * @param string $url Absolute or relative URL.
 */
function redirect(string $url): never
{
    header('Location: ' . $url, true, 302);
    exit;
}

/**
 * Check whether the current request is a POST request.
 */
function is_post(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Check whether the current request is a GET request.
 */
function is_get(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Return a previously submitted form value (for repopulating forms after error).
 * Falls back to an empty string if the key does not exist.
 *
 * @param string $key   POST field name.
 * @param string $default
 */
function old(string $key, string $default = ''): string
{
    return e((string) ($_POST[$key] ?? $default));
}

// ─────────────────────────────────────────────────────────────────────────────
// Flash Messages
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Set a one-time flash message in the session.
 *
 * @param string $type    One of: success | error | warning | info
 * @param string $message Human-readable message.
 */
function set_flash(string $type, string $message): void
{
    $_SESSION[SESSION_FLASH_KEY][$type][] = $message;
}

/**
 * Retrieve and clear flash messages of a given type.
 *
 * @param string $type One of: success | error | warning | info
 * @return string[]
 */
function get_flash(string $type): array
{
    $messages = $_SESSION[SESSION_FLASH_KEY][$type] ?? [];
    unset($_SESSION[SESSION_FLASH_KEY][$type]);
    return $messages;
}

/**
 * Check whether any flash message of a given type exists.
 */
function has_flash(string $type): bool
{
    return !empty($_SESSION[SESSION_FLASH_KEY][$type]);
}

// ─────────────────────────────────────────────────────────────────────────────
// Environment
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Check whether the application is running in debug/development mode.
 */
function is_debug(): bool
{
    return defined('APP_DEBUG') && APP_DEBUG === true;
}

// ─────────────────────────────────────────────────────────────────────────────
// Miscellaneous
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Generate a random booking reference number.
 * Format: SRN-YYYYMMDD-XXXXXX  (e.g. SRN-20260817-A3F9B2)
 */
function generate_booking_reference(): string
{
    $date   = date('Ymd');
    $random = strtoupper(bin2hex(random_bytes(3)));
    return "SRN-{$date}-{$random}";
}

/**
 * Truncate a string to the given length, appending an ellipsis if truncated.
 */
function str_limit(string $value, int $limit = 100, string $end = '…'): string
{
    if (mb_strlen($value) <= $limit) {
        return $value;
    }
    return rtrim(mb_substr($value, 0, $limit)) . $end;
}
