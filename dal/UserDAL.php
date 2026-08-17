<?php

declare(strict_types=1);

/**
 * UserDAL — Data Access Layer for the users table.
 *
 * Handles all database reads/writes for admin user accounts.
 * This is admin-only; there are no public user accounts.
 */
class UserDAL extends BaseDAL
{
    /**
     * Find a user record by email address.
     *
     * @param  string $email
     * @return array|null  The user row (without password ideally filtered at call site), or null.
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, email, password, role, status, last_login_at, created_at
             FROM   users
             WHERE  email = :email
             LIMIT  1'
        );

        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    /**
     * Find a user record by primary key ID.
     *
     * @param  int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, email, role, status, last_login_at, created_at
             FROM   users
             WHERE  id = :id
             LIMIT  1'
        );

        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    /**
     * Update the last_login_at timestamp for a user.
     *
     * @param int $userId
     */
    public function updateLastLogin(int $userId): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE users SET last_login_at = NOW() WHERE id = :id'
        );

        return $stmt->execute([':id' => $userId]);
    }

    /**
     * Insert a new admin user into the database.
     *
     * @param  array $data  Keys: name, email, password (pre-hashed), role.
     * @return int|false  The new user's ID, or false on failure.
     */
    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (name, email, password, role, status, created_at, updated_at)
             VALUES (:name, :email, :password, :role, :status, NOW(), NOW())'
        );

        $success = $stmt->execute([
            ':name'     => $data['name'],
            ':email'    => $data['email'],
            ':password' => $data['password'],
            ':role'     => $data['role']   ?? 'ADMIN',
            ':status'   => $data['status'] ?? 'ACTIVE',
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }
}
