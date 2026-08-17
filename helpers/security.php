<?php

declare(strict_types=1);

/**
 * Security Helper Functions
 *
 * Authentication guards, session helpers, and secure utilities.
 * Loaded globally by config/init.php.
 */

// ─────────────────────────────────────────────────────────────────────────────
// Authentication Guards
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Check whether an admin user is currently logged in.
 */
function is_admin_logged_in(): bool
{
    return isset($_SESSION[SESSION_ADMIN_KEY])
        && is_array($_SESSION[SESSION_ADMIN_KEY])
        && !empty($_SESSION[SESSION_ADMIN_KEY]['id'])
        && ($_SESSION[SESSION_ADMIN_KEY]['role'] ?? '') === 'ADMIN';
}

/**
 * Guard for admin-only pages.
 * If the admin is not authenticated, redirect to the login page and terminate.
 *
 * Usage: Call at the very top of every admin entry file or controller action.
 */
function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('error', 'Please log in to access the admin panel.');
        redirect(BASE_URL . 'login.php');
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// CSRF Helpers (thin wrappers — full logic lives in CsrfService)
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Generate a CSRF token, store it in the session, and return it.
 * Safe to call multiple times — returns the existing token if one exists.
 */
function csrf_token(): string
{
    if (empty($_SESSION[SESSION_CSRF_KEY])) {
        $_SESSION[SESSION_CSRF_KEY] = bin2hex(random_bytes(32));
    }
    return $_SESSION[SESSION_CSRF_KEY];
}

/**
 * Render a hidden HTML input containing the current CSRF token.
 * Use inside every POST form:
 *   <?= csrf_field() ?>
 */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/**
 * Validate a CSRF token submitted via POST.
 * Uses hash_equals() to prevent timing attacks.
 *
 * @param string $submittedToken  Value from $_POST['csrf_token'].
 */
function csrf_verify(string $submittedToken): bool
{
    $sessionToken = $_SESSION[SESSION_CSRF_KEY] ?? '';

    if (empty($sessionToken) || empty($submittedToken)) {
        return false;
    }

    return hash_equals($sessionToken, $submittedToken);
}

/**
 * Validate the CSRF token from $_POST and abort with 403 if invalid.
 * Convenience wrapper that controllers can call directly.
 */
function csrf_check(): void
{
    $submitted = $_POST['csrf_token'] ?? '';

    if (!csrf_verify($submitted)) {
        http_response_code(403);
        // Log the suspicious request.
        error_log('[CSRF] Invalid token. IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        exit('403 Forbidden — Invalid security token. Please go back and try again.');
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// Secure Session Utilities
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Log in an admin user by writing their data into the session.
 * Regenerates the session ID to prevent session fixation attacks.
 *
 * @param array $adminData  Associative array from the users table (without password).
 */
function session_login_admin(array $adminData): void
{
    session_regenerate_id(true);
    $_SESSION[SESSION_ADMIN_KEY] = [
        'id'    => $adminData['id'],
        'name'  => $adminData['name'],
        'email' => $adminData['email'],
        'role'  => $adminData['role'],
    ];
}

/**
 * Log out the current admin by clearing their session data.
 */
function session_logout_admin(): void
{
    unset($_SESSION[SESSION_ADMIN_KEY]);
    unset($_SESSION[SESSION_CSRF_KEY]);
    session_regenerate_id(true);
}

/**
 * Return the currently logged-in admin's data, or null if not logged in.
 *
 * @return array|null
 */
function current_admin(): ?array
{
    return is_admin_logged_in() ? $_SESSION[SESSION_ADMIN_KEY] : null;
}
