<?php

declare(strict_types=1);

/**
 * Validation Helper Functions
 *
 * Lightweight input validation utilities.
 * Business-rule validation lives in the BLL. These helpers handle
 * low-level data type/format checks reusable across the project.
 */

/**
 * Check that a string is non-empty after trimming.
 */
function validate_required(string $value): bool
{
    return trim($value) !== '';
}

/**
 * Validate an email address format.
 */
function validate_email(string $email): bool
{
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate a phone number (digits, optional leading +, spaces, dashes).
 * Accepts formats like: +94771234567, 0771234567, 077-123-4567
 */
function validate_phone(string $phone): bool
{
    return (bool) preg_match('/^\+?[\d\s\-]{7,20}$/', trim($phone));
}

/**
 * Validate a date string against a given format (default: Y-m-d).
 */
function validate_date(string $date, string $format = 'Y-m-d'): bool
{
    $d = \DateTime::createFromFormat($format, $date);
    return $d !== false && $d->format($format) === $date;
}

/**
 * Check that a string's length is within the given bounds.
 *
 * @param string $value
 * @param int    $min   Minimum character count (inclusive).
 * @param int    $max   Maximum character count (inclusive).  0 = no max.
 */
function validate_length(string $value, int $min = 1, int $max = 0): bool
{
    $len = mb_strlen(trim($value));
    if ($len < $min) {
        return false;
    }
    if ($max > 0 && $len > $max) {
        return false;
    }
    return true;
}

/**
 * Sanitise a string by stripping tags and trimming whitespace.
 * Use BEFORE storing to database. (Do NOT escape for HTML here.)
 */
function sanitize_string(string $value): string
{
    return trim(strip_tags($value));
}

/**
 * Sanitise and validate an integer value.
 * Returns the integer or null if invalid.
 */
function sanitize_int(mixed $value): ?int
{
    $filtered = filter_var($value, FILTER_VALIDATE_INT);
    return ($filtered === false) ? null : (int) $filtered;
}

/**
 * Return a cleaned POST value, or null if the key does not exist.
 */
function post(string $key): ?string
{
    return isset($_POST[$key]) ? sanitize_string((string) $_POST[$key]) : null;
}

/**
 * Return a cleaned GET value, or null if the key does not exist.
 */
function get_param(string $key): ?string
{
    return isset($_GET[$key]) ? sanitize_string((string) $_GET[$key]) : null;
}
