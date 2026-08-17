<?php

declare(strict_types=1);

/**
 * AuthService — High-level authentication service.
 *
 * Provides a clean facade over session management and the AuthBLL.
 * Controllers call this service rather than managing session state directly.
 */
class AuthService
{
    private AuthBLL $authBLL;

    public function __construct(AuthBLL $authBLL)
    {
        $this->authBLL = $authBLL;
    }

    /**
     * Attempt an admin login.
     *
     * @param  string $email
     * @param  string $password
     * @return bool  True if login was successful.
     */
    public function loginAdmin(string $email, string $password): bool
    {
        $admin = $this->authBLL->attemptLogin($email, $password);

        if ($admin === null) {
            LoggerService::warning('[Auth] Failed login attempt.', ['email' => $email]);
            return false;
        }

        session_login_admin($admin);
        LoggerService::info('[Auth] Admin logged in.', ['id' => $admin['id'], 'email' => $admin['email']]);

        return true;
    }

    /**
     * Log out the current admin.
     */
    public function logoutAdmin(): void
    {
        $admin = current_admin();
        session_logout_admin();

        if ($admin) {
            LoggerService::info('[Auth] Admin logged out.', ['id' => $admin['id']]);
        }
    }

    /**
     * Check whether the current request comes from an authenticated admin.
     */
    public function isAdminAuthenticated(): bool
    {
        return is_admin_logged_in();
    }
}
