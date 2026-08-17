<?php

declare(strict_types=1);

/**
 * Mail Configuration
 *
 * Used by EmailService to centralise sender information.
 * This project uses PHP's native mail() function.
 *
 * For production, consider using an SMTP relay (e.g. SendGrid, Mailgun)
 * via a thin wrapper or PHPMailer — drop that decision into Phase N.
 */

return [
    // ─────────────────────────────────────────────────────────────────
    // From name and address that appear in sent emails.
    // TODO: Replace with actual hotel address.
    // ─────────────────────────────────────────────────────────────────
    'from_name'    => 'Serona Hotel & Resort',
    'from_address' => 'noreply@serona.example.com',   // <-- REPLACE

    // ─────────────────────────────────────────────────────────────────
    // Admin/notification email — receives booking enquiry copies.
    // TODO: Replace with actual admin email.
    // ─────────────────────────────────────────────────────────────────
    'admin_email'  => 'admin@serona.example.com',     // <-- REPLACE

    // ─────────────────────────────────────────────────────────────────
    // Reply-To address — where guest replies will land.
    // ─────────────────────────────────────────────────────────────────
    'reply_to'     => 'reservations@serona.example.com', // <-- REPLACE

    // ─────────────────────────────────────────────────────────────────
    // Default content type for outgoing emails.
    // ─────────────────────────────────────────────────────────────────
    'content_type' => 'text/html',
    'charset'      => 'UTF-8',
];
