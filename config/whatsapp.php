<?php

declare(strict_types=1);

/**
 * WhatsApp Configuration
 *
 * Used by WhatsAppService to generate booking enquiry links.
 *
 * Phone number format:
 *   International format WITHOUT the leading '+'.
 *   Example: 94771234567  (Sri Lanka country code 94)
 *
 * TODO: Replace the placeholder number with the hotel's real WhatsApp number.
 */

return [
    // ─────────────────────────────────────────────────────────────────
    // Hotel WhatsApp number (international format, no '+', no spaces).
    // Example: '94771234567'
    // ─────────────────────────────────────────────────────────────────
    'phone' => '94XXXXXXXXX',   // <-- REPLACE with actual number

    // ─────────────────────────────────────────────────────────────────
    // Greeting line prepended to every booking message.
    // ─────────────────────────────────────────────────────────────────
    'greeting' => 'Hello Serona Hotel & Resort,',

    // ─────────────────────────────────────────────────────────────────
    // Base WhatsApp API URL — do not change.
    // ─────────────────────────────────────────────────────────────────
    'api_base' => 'https://wa.me/',
];
