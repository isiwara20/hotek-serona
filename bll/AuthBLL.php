<?php

declare(strict_types=1);

/**
 * AuthBLL — Business Logic Layer for admin authentication.
 *
 * Responsibilities:
 *   - Validate login credentials at the business level.
 *   - Hash passwords.
 *   - Verify passwords.
 *   - Delegate database reads/writes to UserDAL.
 *
 * This class must NOT:
 *   - Read $_POST directly.
 *   - Render HTML.
 *   - Redirect.
 *   - Write raw SQL.
 */
class AuthBLL
{
    private UserDAL $userDAL;

    public function __construct(UserDAL $userDAL)
    {
        $this->userDAL = $userDAL;
    }

    /**
     * Attempt to authenticate an admin user.
     *
     * @param  string $email     Sanitised email from controller.
     * @param  string $password  Raw password from controller.
     * @return array|null        The authenticated user row (no password field), or null on failure.
     */
    public function attemptLogin(string $email, string $password): ?array
    {
        if (empty($email) || empty($password)) {
            return null;
        }

        $user = $this->userDAL->findByEmail($email);

        if ($user === null) {
            // Use a timing-safe dummy verify to prevent user enumeration via timing.
            password_verify($password, '$2y$12$invalidsaltinvalidsaltinvalidsalt..');
            return null;
        }

        if (($user['status'] ?? '') !== 'ACTIVE') {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        // Update last login timestamp (fire-and-forget; failure is non-critical).
        $this->userDAL->updateLastLogin((int) $user['id']);

        // Never return the password hash to the calling layer.
        unset($user['password']);

        return $user;
    }

    /**
     * Hash a plain-text password using PHP's recommended algorithm.
     *
     * @param  string $plaintext
     * @return string  The bcrypt hash to store in the database.
     */
    public function hashPassword(string $plaintext): string
    {
        return password_hash($plaintext, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Verify a plain-text password against a stored hash.
     *
     * @param string $plaintext  Raw input.
     * @param string $hash       Stored hash from DB.
     */
    public function verifyPassword(string $plaintext, string $hash): bool
    {
        return password_verify($plaintext, $hash);
    }
}
