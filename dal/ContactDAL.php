<?php

declare(strict_types=1);

/**
 * ContactDAL — Data Access Layer for the contact_messages table.
 */
class ContactDAL extends BaseDAL
{
    /**
     * Insert a new contact message from the public contact form.
     *
     * @param  array $data  Sanitised contact data from ContactBLL.
     * @return int|false    New ID, or false on failure.
     */
    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO contact_messages
                (name, email, phone, subject, message, status, created_at)
             VALUES
                (:name, :email, :phone, :subject, :message, :status, NOW())'
        );

        $success = $stmt->execute([
            ':name'    => $data['name'],
            ':email'   => $data['email'],
            ':phone'   => $data['phone']   ?? null,
            ':subject' => $data['subject'] ?? null,
            ':message' => $data['message'],
            ':status'  => 'UNREAD',
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    /**
     * Return all contact messages (admin use), most recent first.
     *
     * @return array[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, email, phone, subject, message, status, created_at
             FROM   contact_messages
             ORDER  BY created_at DESC'
        );

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Mark a contact message as read.
     *
     * @param int $id
     */
    public function markAsRead(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contact_messages SET status = 'READ' WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }
}
