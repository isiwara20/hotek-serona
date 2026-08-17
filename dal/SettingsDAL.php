<?php

declare(strict_types=1);

/**
 * SettingsDAL — Data Access Layer for the site_settings table.
 *
 * Settings are stored as key-value pairs and are managed by the admin.
 */
class SettingsDAL extends BaseDAL
{
    /**
     * Return all settings as a flat key → value array.
     *
     * @return array<string, string>
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT setting_key, setting_value FROM site_settings ORDER BY setting_key ASC'
        );

        $stmt->execute();
        $rows = $stmt->fetchAll();

        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    /**
     * Return a single setting value by key.
     *
     * @param  string $key
     * @param  string $default  Returned if the key does not exist.
     * @return string
     */
    public function get(string $key, string $default = ''): string
    {
        $stmt = $this->pdo->prepare(
            'SELECT setting_value FROM site_settings WHERE setting_key = :key LIMIT 1'
        );

        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();

        return $row ? (string) $row['setting_value'] : $default;
    }

    /**
     * Update (or insert) a setting value.
     *
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO site_settings (setting_key, setting_value, updated_at)
             VALUES (:key, :value, NOW())
             ON DUPLICATE KEY UPDATE setting_value = :value, updated_at = NOW()'
        );

        return $stmt->execute([':key' => $key, ':value' => $value]);
    }

    /**
     * Update multiple settings in a single call.
     *
     * @param array<string, string> $settings  Key-value pairs.
     */
    public function setMany(array $settings): bool
    {
        $allSuccess = true;
        foreach ($settings as $key => $value) {
            if (!$this->set((string) $key, (string) $value)) {
                $allSuccess = false;
            }
        }
        return $allSuccess;
    }
}
