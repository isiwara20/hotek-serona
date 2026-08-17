<?php

declare(strict_types=1);

/**
 * ContactBLL — Business Logic Layer for contact form submissions.
 */
class ContactBLL
{
    private ContactDAL $contactDAL;

    public function __construct(ContactDAL $contactDAL)
    {
        $this->contactDAL = $contactDAL;
    }

    /**
     * Process a contact form submission.
     *
     * @param  array $data  Sanitised data from the controller.
     * @return array{success: bool, errors: string[]}
     */
    public function submitMessage(array $data): array
    {
        $errors = $this->validateMessage($data);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $id = $this->contactDAL->create($data);

        if ($id === false) {
            return ['success' => false, 'errors' => ['Could not save your message. Please try again.']];
        }

        return ['success' => true, 'errors' => []];
    }

    /**
     * Validate contact form fields.
     *
     * @param  array $data
     * @return string[]
     */
    private function validateMessage(array $data): array
    {
        $errors = [];

        if (empty($data['name']) || !validate_length($data['name'], 2, 100)) {
            $errors[] = 'Please enter your full name.';
        }

        if (empty($data['email']) || !validate_email($data['email'])) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (empty($data['message']) || !validate_length($data['message'], 10, 2000)) {
            $errors[] = 'Your message must be between 10 and 2000 characters.';
        }

        return $errors;
    }
}
