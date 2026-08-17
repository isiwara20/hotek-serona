<?php

declare(strict_types=1);

/**
 * BaseDAL — Abstract Data Access Layer Base Class
 *
 * All DAL classes extend this to receive a PDO connection
 * through dependency injection (constructor injection).
 *
 * Rules enforced by this layer:
 *   - No HTML rendering.
 *   - No business rules.
 *   - No access to $_POST / $_GET.
 *   - No redirects.
 *   - Return arrays, booleans, or scalar values only.
 */
abstract class BaseDAL
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
