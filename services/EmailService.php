<?php

declare(strict_types=1);

/**
 * EmailService — Send HTML emails using PHP's native mail() function.
 *
 * This service centralises all email sending logic.
 * Controllers must NOT call mail() directly.
 *
 * Configuration is loaded from /config/mail.php.
 *
 * Usage:
 *   $mailer = new EmailService();
 *   $mailer->sendBookingNotification($bookingData);
 *   $mailer->send('to@example.com', 'Subject', '<p>Body</p>');
 */
class EmailService
{
    private string $fromName;
    private string $fromAddress;
    private string $adminEmail;
    private string $replyTo;
    private string $charset;

    public function __construct()
    {
        $config            = require CONFIG_PATH . DIRECTORY_SEPARATOR . 'mail.php';
        $this->fromName    = (string) $config['from_name'];
        $this->fromAddress = (string) $config['from_address'];
        $this->adminEmail  = (string) $config['admin_email'];
        $this->replyTo     = (string) $config['reply_to'];
        $this->charset     = (string) ($config['charset'] ?? 'UTF-8');
    }

    /**
     * Send an HTML email.
     *
     * @param  string $to       Recipient email address.
     * @param  string $subject  Email subject.
     * @param  string $htmlBody HTML content.
     * @return bool             True on success.
     */
    public function send(string $to, string $subject, string $htmlBody): bool
    {
        $headers = $this->buildHeaders();

        $success = @mail($to, $subject, $htmlBody, $headers);

        if (!$success) {
            $this->logFailure($to, $subject);
        }

        return $success;
    }

    /**
     * Send a booking enquiry notification to the hotel admin.
     *
     * @param  array $booking  Booking data array.
     * @return bool
     */
    public function sendBookingNotification(array $booking): bool
    {
        $subject = 'New Booking Enquiry — ' . ($booking['reference_number'] ?? 'N/A');
        $body    = $this->buildBookingEmailBody($booking);

        return $this->send($this->adminEmail, $subject, $body);
    }

    /**
     * Send a booking confirmation acknowledgement to the guest.
     *
     * @param  array $booking
     * @return bool
     */
    public function sendGuestConfirmation(array $booking): bool
    {
        if (empty($booking['guest_email'])) {
            return false;
        }

        $subject = 'Booking Enquiry Received — ' . APP_NAME;
        $body    = $this->buildGuestConfirmationBody($booking);

        return $this->send($booking['guest_email'], $subject, $body);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private Helpers
    // ─────────────────────────────────────────────────────────────────────────

    private function buildHeaders(): string
    {
        $from    = $this->encodedFrom();
        $replyTo = $this->replyTo ?: $this->fromAddress;

        return implode("\r\n", [
            "MIME-Version: 1.0",
            "Content-type: text/html; charset={$this->charset}",
            "From: {$from}",
            "Reply-To: {$replyTo}",
            "X-Mailer: Serona-Mailer/1.0",
        ]);
    }

    private function encodedFrom(): string
    {
        $name = mb_encode_mimeheader($this->fromName, $this->charset);
        return "{$name} <{$this->fromAddress}>";
    }

    private function buildBookingEmailBody(array $b): string
    {
        $ref      = e($b['reference_number'] ?? 'N/A');
        $name     = e($b['guest_name']       ?? '');
        $email    = e($b['guest_email']      ?? '');
        $phone    = e($b['guest_phone']      ?? '');
        $room     = e($b['room_name']        ?? 'Not specified');
        $checkIn  = e($b['check_in']         ?? '');
        $checkOut = e($b['check_out']        ?? '');
        $adults   = e((string)($b['adults'] ?? 1));
        $children = e((string)($b['children'] ?? 0));
        $special  = e($b['special_request']  ?? 'None');
        $method   = e($b['communication_method'] ?? '');

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head><meta charset="UTF-8"><title>Booking Enquiry</title></head>
        <body style="font-family: Arial, sans-serif; color: #26372F; background: #F7F5EE; padding: 24px;">
          <h2 style="color: #263B31;">New Booking Enquiry</h2>
          <table cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px; background: #fff; border-radius: 8px;">
            <tr><td style="font-weight:bold;">Reference</td><td>{$ref}</td></tr>
            <tr style="background:#f7f5ee;"><td style="font-weight:bold;">Guest Name</td><td>{$name}</td></tr>
            <tr><td style="font-weight:bold;">Email</td><td>{$email}</td></tr>
            <tr style="background:#f7f5ee;"><td style="font-weight:bold;">Phone</td><td>{$phone}</td></tr>
            <tr><td style="font-weight:bold;">Room</td><td>{$room}</td></tr>
            <tr style="background:#f7f5ee;"><td style="font-weight:bold;">Check-in</td><td>{$checkIn}</td></tr>
            <tr><td style="font-weight:bold;">Check-out</td><td>{$checkOut}</td></tr>
            <tr style="background:#f7f5ee;"><td style="font-weight:bold;">Adults</td><td>{$adults}</td></tr>
            <tr><td style="font-weight:bold;">Children</td><td>{$children}</td></tr>
            <tr style="background:#f7f5ee;"><td style="font-weight:bold;">Special Request</td><td>{$special}</td></tr>
            <tr><td style="font-weight:bold;">Communication</td><td>{$method}</td></tr>
          </table>
          <p style="color:#6F776F; font-size:12px; margin-top:16px;">— Serona Hotel &amp; Resort Booking System</p>
        </body>
        </html>
        HTML;
    }

    private function buildGuestConfirmationBody(array $b): string
    {
        $name = e($b['guest_name'] ?? 'Guest');
        $ref  = e($b['reference_number'] ?? 'N/A');

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head><meta charset="UTF-8"><title>Booking Received</title></head>
        <body style="font-family: Arial, sans-serif; color: #26372F; background: #F7F5EE; padding: 24px;">
          <h2 style="color: #263B31;">Thank you, {$name}!</h2>
          <p>We have received your booking enquiry at <strong>Serona Hotel &amp; Resort</strong>.</p>
          <p>Your reference number is: <strong>{$ref}</strong></p>
          <p>Our team will contact you shortly to confirm your reservation.</p>
          <p style="color:#6F776F;">If you have any questions, please reach us via WhatsApp or email.</p>
          <p>— The Serona Team</p>
        </body>
        </html>
        HTML;
    }

    /**
     * Log a mail failure to /storage/logs/mail.log.
     */
    private function logFailure(string $to, string $subject): void
    {
        $logFile = LOGS_PATH . DIRECTORY_SEPARATOR . 'mail.log';
        $line    = '[' . date('Y-m-d H:i:s') . '] FAILED to: ' . $to . ' | Subject: ' . $subject . PHP_EOL;
        @file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    }
}
