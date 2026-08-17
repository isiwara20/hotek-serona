<?php

declare(strict_types=1);

/**
 * ContactController — Handles the public contact form.
 */
class ContactController
{
    private ContactBLL    $contactBLL;
    private EmailService  $emailService;

    public function __construct()
    {
        $pdo                = Database::getConnection();
        $this->contactBLL   = new ContactBLL(new ContactDAL($pdo));
        $this->emailService = new EmailService();
    }

    /**
     * Display the contact form (GET).
     */
    public function showForm(): void
    {
        $data = ['page_title' => 'Contact Us — ' . APP_NAME];
        $this->render('public/contact', $data);
    }

    /**
     * Process a contact form submission (POST).
     */
    public function submit(): void
    {
        if (!is_post()) {
            redirect(BASE_URL . 'contact.php');
        }

        csrf_check();

        $data = [
            'name'    => post('name')    ?? '',
            'email'   => post('email')   ?? '',
            'phone'   => post('phone')   ?? '',
            'subject' => post('subject') ?? '',
            'message' => post('message') ?? '',
        ];

        $result = $this->contactBLL->submitMessage($data);

        if (!$result['success']) {
            foreach ($result['errors'] as $error) {
                set_flash('error', $error);
            }
            redirect(BASE_URL . 'contact.php');
        }

        // Notify admin via email (non-blocking).
        $this->emailService->send(
            ADMIN_EMAIL,
            'New Contact Message — ' . APP_NAME,
            "<p>New contact form submission from <strong>{$data['name']}</strong> ({$data['email']}).</p><p>{$data['message']}</p>"
        );

        set_flash('success', 'Your message has been received. We will be in touch shortly.');
        redirect(BASE_URL . 'contact.php');
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
