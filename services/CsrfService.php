<?php

declare(strict_types=1);

/**
 * CsrfService — Object-oriented CSRF token management.
 *
 * The procedural helpers (csrf_token(), csrf_field(), csrf_check())
 * in helpers/security.php delegate to these same session keys and
 * can coexist with this class.
 *
 * Use this class when you need more granular CSRF control,
 * e.g. per-form tokens or API CSRF handling.
 */
class CsrfService
{
    /**
     * Generate a new CSRF token and store it in the session.
     * If a token already exists, it is returned unchanged.
     *
     * @return string  The 64-character hex token.
     */
    public function generateToken(): string
    {
        if (empty($_SESSION[SESSION_CSRF_KEY])) {
            $_SESSION[SESSION_CSRF_KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[SESSION_CSRF_KEY];
    }

    /**
     * Retrieve the current CSRF token without generating a new one.
     *
     * @return string  Empty string if no token exists.
     */
    public function getToken(): string
    {
        return (string) ($_SESSION[SESSION_CSRF_KEY] ?? '');
    }

    /**
     * Validate a submitted CSRF token against the session token.
     * Uses hash_equals() to prevent timing-based attacks.
     *
     * @param  string $submittedToken  Value from the form's hidden input.
     * @return bool
     */
    public function validateToken(string $submittedToken): bool
    {
        $sessionToken = $this->getToken();

        if (empty($sessionToken) || empty($submittedToken)) {
            return false;
        }

        return hash_equals($sessionToken, $submittedToken);
    }

    /**
     * Rotate the CSRF token (generate a new one, invalidating the old).
     * Call this after a successful form submission if desired.
     *
     * @return string  The new token.
     */
    public function rotateToken(): string
    {
        unset($_SESSION[SESSION_CSRF_KEY]);
        return $this->generateToken();
    }

    /**
     * Return an HTML hidden input string for embedding in forms.
     *
     * @return string
     */
    public function inputField(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . e($this->generateToken()) . '">';
    }
}
