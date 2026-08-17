<?php

declare(strict_types=1);

/**
 * AuthController — Handles admin login and logout.
 *
 * Responsibilities:
 *   - Display the login form.
 *   - Process POST login submission (CSRF-checked).
 *   - Handle logout.
 *   - Redirect appropriately after login/logout.
 *
 * Never accessed via public navigation.
 */
class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $pdo             = Database::getConnection();
        $userDAL         = new UserDAL($pdo);
        $authBLL         = new AuthBLL($userDAL);
        $this->authService = new AuthService($authBLL);
    }

    /**
     * Display the admin login form (GET).
     * If already logged in, redirect to dashboard.
     */
    public function showLogin(): void
    {
        if ($this->authService->isAdminAuthenticated()) {
            redirect(BASE_URL . 'admin_dashboard.php');
        }

        $data = [
            'page_title' => 'Admin Login — ' . APP_NAME,
        ];

        $this->render('auth/login', $data);
    }

    /**
     * Process the login form submission (POST).
     */
    public function login(): void
    {
        if (!is_post()) {
            redirect(BASE_URL . 'login.php');
        }

        csrf_check();

        $email    = post('email')    ?? '';
        $password = post('password') ?? '';

        if (empty($email) || empty($password)) {
            set_flash('error', 'Please enter your email and password.');
            redirect(BASE_URL . 'login.php');
        }

        $success = $this->authService->loginAdmin($email, $password);

        if (!$success) {
            set_flash('error', 'Invalid credentials. Please try again.');
            redirect(BASE_URL . 'login.php');
        }

        redirect(BASE_URL . 'admin_dashboard.php');
    }

    /**
     * Log out the admin and redirect to the login page.
     */
    public function logout(): void
    {
        $this->authService->logoutAdmin();
        set_flash('success', 'You have been logged out successfully.');
        redirect(BASE_URL . 'login.php');
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
