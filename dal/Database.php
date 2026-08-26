<?php

declare(strict_types=1);

/**
 * Database — PDO Singleton
 *
 * Provides a single shared PDO connection for the lifetime of each request.
 * All DAL classes must obtain the connection through this class.
 *
 * Usage:
 *   $pdo = Database::getConnection();
 */
class Database
{
    private static ?PDO $connection = null;

    /**
     * Private constructor — prevents direct instantiation.
     */
    private function __construct() {}

    /**
     * Returns the shared PDO connection, creating it on first call.
     *
     * @throws RuntimeException if the connection cannot be established.
     */
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            self::$connection = self::createConnection();
        }

        return self::$connection;
    }

    /**
     * Creates and configures a new PDO connection from /config/db.php.
     */
    private static function createConnection(): PDO
    {
        $config = require CONFIG_PATH . DIRECTORY_SEPARATOR . 'db.php';

        $dsn = sprintf(
            '%s:host=%s;port=%d;dbname=%s;charset=%s',
            $config['driver'],
            $config['host'],
            $config['port'],
            $config['dbname'],
            $config['charset']
        );

        try {
            $pdo = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options']
            );

            return $pdo;
        } catch (PDOException $e) {
            // Auto-provision missing database in development mode if unknown database error 1049 occurs
            if (APP_DEBUG && ($e->getCode() === 1049 || str_contains($e->getMessage(), 'Unknown database'))) {
                try {
                    $serverDsn = sprintf(
                        '%s:host=%s;port=%d;charset=%s',
                        $config['driver'],
                        $config['host'],
                        $config['port'],
                        $config['charset']
                    );
                    $serverPdo = new PDO($serverDsn, $config['username'], $config['password'], $config['options']);
                    $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `" . str_replace('`', '``', $config['dbname']) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                    $serverPdo->exec("USE `" . str_replace('`', '``', $config['dbname']) . "`");

                    $sqlFile = ROOT_PATH . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'serona_db.sql';
                    if (file_exists($sqlFile)) {
                        $sql = file_get_contents($sqlFile);
                        if ($sql !== false) {
                            $serverPdo->exec($sql);
                        }
                    }

                    return new PDO($dsn, $config['username'], $config['password'], $config['options']);
                } catch (\Throwable $autoSetupErr) {
                    error_log('[Database] Auto setup failed: ' . $autoSetupErr->getMessage());
                }
            }

            // Log the real error; never expose credentials or DSN to browser.
            error_log('[Database] Connection failed: ' . $e->getMessage());

            if (APP_DEBUG) {
                throw new RuntimeException(
                    'Database connection failed: ' . $e->getMessage(),
                    (int) $e->getCode(),
                    $e
                );
            }

            throw new RuntimeException(
                'A database error occurred. Please try again later.'
            );
        }
    }

    /**
     * Closes the connection by dropping the static reference.
     * Useful in long-running scripts or test teardowns.
     */
    public static function closeConnection(): void
    {
        self::$connection = null;
    }

    // Prevent cloning and unserialization of the singleton.
    private function __clone() {}
    public function __wakeup(): void
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }
}
