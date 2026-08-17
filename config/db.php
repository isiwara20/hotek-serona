<?php

declare(strict_types=1);

/**
 * Database Configuration — PDO
 *
 * Uses PDO exclusively. Never use mysqli.
 *
 * For production, move credentials to environment variables
 * or a secrets manager. Never commit real passwords to VCS.
 */

return [
    'driver'   => 'mysql',
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'dbname'   => 'serona_db',
    'charset'  => 'utf8mb4',
    'username' => 'root',
    'password' => '',               // TODO: set a strong password in production

    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
    ],
];
