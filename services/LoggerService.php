<?php

declare(strict_types=1);

/**
 * LoggerService — Simple file-based logger.
 *
 * Writes timestamped log entries to /storage/logs/app.log.
 * Supports: INFO, WARNING, ERROR levels.
 *
 * Usage:
 *   LoggerService::info('Admin logged in.', ['user_id' => 1]);
 *   LoggerService::error('DB failure', ['message' => $e->getMessage()]);
 */
class LoggerService
{
    private const LOG_FILE = LOGS_PATH . DIRECTORY_SEPARATOR . 'app.log';

    public const LEVEL_INFO    = 'INFO';
    public const LEVEL_WARNING = 'WARNING';
    public const LEVEL_ERROR   = 'ERROR';

    /**
     * Write an INFO-level log entry.
     */
    public static function info(string $message, array $context = []): void
    {
        self::write(self::LEVEL_INFO, $message, $context);
    }

    /**
     * Write a WARNING-level log entry.
     */
    public static function warning(string $message, array $context = []): void
    {
        self::write(self::LEVEL_WARNING, $message, $context);
    }

    /**
     * Write an ERROR-level log entry.
     */
    public static function error(string $message, array $context = []): void
    {
        self::write(self::LEVEL_ERROR, $message, $context);
    }

    /**
     * Write a formatted log line to the log file.
     *
     * Format: [2026-08-17 10:30:00] [LEVEL] Message | context: {...}
     */
    private static function write(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $line      = "[{$timestamp}] [{$level}] {$message}";

        if (!empty($context)) {
            $line .= ' | context: ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }

        $line .= PHP_EOL;

        // Suppress errors on write failure — logging must not crash the app.
        @file_put_contents(self::LOG_FILE, $line, FILE_APPEND | LOCK_EX);
    }
}
