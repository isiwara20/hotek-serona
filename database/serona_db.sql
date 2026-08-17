-- ============================================================
-- Serona Hotel & Resort — Initial Database Schema
-- File:    serona_db.sql
-- Engine:  InnoDB
-- Charset: utf8mb4 / utf8mb4_unicode_ci
-- 
-- Import:
--   1. Open phpMyAdmin → Create database: serona_db
--   2. Select serona_db → Import → this file
--   OR:
--   mysql -u root -p serona_db < serona_db.sql
--
-- Notes:
--   - No payment tables.
--   - Admin-only authentication (no public user accounts).
--   - Booking enquiry flow: Website → WhatsApp/Email → Admin.
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ──────────────────────────────────────────────────────────
-- 1. users — Admin accounts only
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`            INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(100)    NOT NULL,
    `email`         VARCHAR(191)    NOT NULL,
    `password`      VARCHAR(255)    NOT NULL COMMENT 'bcrypt hash via password_hash()',
    `role`          ENUM('ADMIN')   NOT NULL DEFAULT 'ADMIN',
    `status`        ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE',
    `last_login_at` TIMESTAMP       NULL DEFAULT NULL,
    `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Admin user accounts only. No public user accounts.';

-- ──────────────────────────────────────────────────────────
-- 2. rooms — Hotel room catalogue
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `rooms` (
    `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(150)    NOT NULL,
    `slug`              VARCHAR(200)    NOT NULL COMMENT 'URL-friendly identifier, e.g. deluxe-garden-room',
    `short_description` VARCHAR(300)    NULL     DEFAULT NULL,
    `description`       TEXT            NULL     DEFAULT NULL,
    `capacity`          TINYINT UNSIGNED NOT NULL DEFAULT 2,
    `bed_type`          VARCHAR(100)    NULL     DEFAULT NULL COMMENT 'e.g. King, Twin, Double',
    `room_size`         VARCHAR(50)     NULL     DEFAULT NULL COMMENT 'e.g. 45 sqm',
    `status`            ENUM('AVAILABLE', 'UNAVAILABLE', 'HIDDEN') NOT NULL DEFAULT 'AVAILABLE',
    `is_featured`       TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_rooms_slug` (`slug`),
    INDEX `idx_rooms_status`      (`status`),
    INDEX `idx_rooms_is_featured` (`is_featured`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 3. room_images — Images for each room
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `room_images` (
    `id`         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `room_id`    INT UNSIGNED  NOT NULL,
    `filename`   VARCHAR(255)  NOT NULL COMMENT 'Generated random filename in /storage/uploads/rooms/',
    `alt_text`   VARCHAR(200)  NULL DEFAULT NULL,
    `sort_order` SMALLINT      NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_room_images_room_id` (`room_id`),
    CONSTRAINT `fk_room_images_room`
        FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 4. booking_enquiries — Visitor booking requests
--    No payment data. Admin communicates manually via WhatsApp/Email.
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `booking_enquiries` (
    `id`                   INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `reference_number`     VARCHAR(30)     NOT NULL COMMENT 'Format: SRN-YYYYMMDD-XXXXXX',
    `room_id`              INT UNSIGNED    NULL     DEFAULT NULL,
    `guest_name`           VARCHAR(150)    NOT NULL,
    `guest_email`          VARCHAR(191)    NOT NULL,
    `guest_phone`          VARCHAR(30)     NOT NULL,
    `check_in`             DATE            NOT NULL,
    `check_out`            DATE            NOT NULL,
    `adults`               TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `children`             TINYINT UNSIGNED NOT NULL DEFAULT 0,
    `special_request`      TEXT            NULL     DEFAULT NULL,
    `communication_method` ENUM('WHATSAPP', 'EMAIL', 'BOTH') NOT NULL DEFAULT 'WHATSAPP',
    `status`               ENUM('NEW', 'CONTACTED', 'CONFIRMED', 'CANCELLED', 'COMPLETED')
                                           NOT NULL DEFAULT 'NEW',
    `admin_notes`          TEXT            NULL     DEFAULT NULL,
    `created_at`           TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`           TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_booking_reference` (`reference_number`),
    INDEX `idx_booking_status`    (`status`),
    INDEX `idx_booking_check_in`  (`check_in`),
    INDEX `idx_booking_check_out` (`check_out`),
    INDEX `idx_booking_created`   (`created_at`),
    INDEX `idx_booking_email`     (`guest_email`),
    CONSTRAINT `fk_booking_room`
        FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
        ON DELETE SET NULL    -- Retain enquiry history if room is deleted
        ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 5. contact_messages — Public contact form submissions
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id`         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(150)  NOT NULL,
    `email`      VARCHAR(191)  NOT NULL,
    `phone`      VARCHAR(30)   NULL DEFAULT NULL,
    `subject`    VARCHAR(200)  NULL DEFAULT NULL,
    `message`    TEXT          NOT NULL,
    `status`     ENUM('UNREAD', 'READ') NOT NULL DEFAULT 'UNREAD',
    `created_at` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_contact_status`  (`status`),
    INDEX `idx_contact_email`   (`email`),
    INDEX `idx_contact_created` (`created_at`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 6. gallery — Resort gallery images
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `gallery` (
    `id`         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `filename`   VARCHAR(255)  NOT NULL,
    `caption`    VARCHAR(300)  NULL DEFAULT NULL,
    `category`   VARCHAR(100)  NULL DEFAULT NULL COMMENT 'e.g. rooms, dining, nature',
    `sort_order` SMALLINT      NOT NULL DEFAULT 0,
    `is_active`  TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_gallery_category`  (`category`),
    INDEX `idx_gallery_is_active` (`is_active`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 7. dining_items — Dining section content
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `dining_items` (
    `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(150)  NOT NULL,
    `description` TEXT          NULL DEFAULT NULL,
    `category`    VARCHAR(100)  NULL DEFAULT NULL COMMENT 'e.g. Restaurant, Bar, Breakfast',
    `filename`    VARCHAR(255)  NULL DEFAULT NULL,
    `sort_order`  SMALLINT      NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_dining_is_active` (`is_active`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 8. experiences — Guest experiences / activities
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `experiences` (
    `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(150)  NOT NULL,
    `description` TEXT          NULL DEFAULT NULL,
    `filename`    VARCHAR(255)  NULL DEFAULT NULL,
    `sort_order`  SMALLINT      NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_experiences_is_active` (`is_active`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 9. facilities — Resort facilities
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `facilities` (
    `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(150)  NOT NULL,
    `description` TEXT          NULL DEFAULT NULL,
    `icon`        VARCHAR(100)  NULL DEFAULT NULL COMMENT 'Font Awesome class, e.g. fa-swimming-pool',
    `sort_order`  SMALLINT      NOT NULL DEFAULT 0,
    `is_active`   TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_facilities_is_active` (`is_active`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- 10. site_settings — Key-value store for admin-managed content
-- ──────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `site_settings` (
    `id`            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `setting_key`   VARCHAR(100)  NOT NULL,
    `setting_value` TEXT          NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_settings_key` (`setting_key`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────
-- Default site settings
-- ──────────────────────────────────────────────────────────
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('site_name',         'Serona Hotel & Resort'),
('site_tagline',      "Nature's Embrace"),
('contact_phone',     '+94XXXXXXXXX'),
('contact_whatsapp',  '94XXXXXXXXX'),
('contact_email',     'info@serona.example.com'),
('contact_address',   'Serona Resort, Sri Lanka'),
('social_facebook',   ''),
('social_instagram',  ''),
('social_twitter',    '')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

-- ──────────────────────────────────────────────────────────
-- Default admin user (password must be changed immediately)
-- Password: Admin@123  (CHANGE THIS BEFORE LAUNCH)
-- Hash generated with: password_hash('Admin@123', PASSWORD_BCRYPT, ['cost' => 12])
-- ──────────────────────────────────────────────────────────
INSERT INTO `users` (`name`, `email`, `password`, `role`, `status`) VALUES
(
    'Serona Admin',
    'admin@serona.example.com',
    '$2y$12$LjA7UD1nQHsVBqBLJHa2HOtW1e4PkLq3V5FhFQQhDWqdGJzpS4hdi',
    'ADMIN',
    'ACTIVE'
)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);
-- NOTE: Above hash is a PLACEHOLDER. Generate a real hash with:
-- php -r "echo password_hash('YourStrongPassword', PASSWORD_BCRYPT, ['cost'=>12]);"

SET FOREIGN_KEY_CHECKS = 1;
