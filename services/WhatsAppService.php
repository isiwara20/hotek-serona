<?php

declare(strict_types=1);

/**
 * WhatsAppService — Generate WhatsApp booking enquiry links.
 *
 * This service does NOT send automated messages.
 * It generates a wa.me URL that, when opened by the visitor's browser,
 * launches WhatsApp (Desktop or Web) with a pre-filled message.
 *
 * The hotel's WhatsApp number is read from /config/whatsapp.php.
 * Never hardcode the phone number elsewhere in the project.
 *
 * Usage:
 *   $service = new WhatsAppService();
 *   $url = $service->generateBookingUrl($bookingData);
 *   // Redirect or render as a link.
 */
class WhatsAppService
{
    private string $phone;
    private string $greeting;
    private string $apiBase;

    public function __construct()
    {
        $config        = require CONFIG_PATH . DIRECTORY_SEPARATOR . 'whatsapp.php';
        $this->phone   = (string) $config['phone'];
        $this->greeting = (string) ($config['greeting'] ?? 'Hello Serona Hotel & Resort,');
        $this->apiBase  = (string) ($config['api_base'] ?? 'https://wa.me/');
    }

    /**
     * Generate a WhatsApp URL pre-filled with a booking enquiry message.
     *
     * @param  array $booking  Keys: guest_name, guest_phone, guest_email,
     *                                room_name, check_in, check_out,
     *                                adults, children, special_request,
     *                                reference_number.
     * @return string  Full wa.me URL ready for use in an <a href> or redirect.
     */
    public function generateBookingUrl(array $booking): string
    {
        $message = $this->buildBookingMessage($booking);
        return $this->apiBase . rawurlencode($this->phone) . '?text=' . rawurlencode($message);
    }

    /**
     * Generate a simple general enquiry URL with a short message.
     *
     * @param  string $customMessage  Optional override message.
     * @return string
     */
    public function generateGeneralUrl(string $customMessage = ''): string
    {
        $message = !empty($customMessage)
            ? $customMessage
            : $this->greeting . "\n\nI would like to make a general enquiry. Please assist me.";

        return $this->apiBase . rawurlencode($this->phone) . '?text=' . rawurlencode($message);
    }

    /**
     * Build the formatted booking enquiry message body.
     *
     * @param  array $booking
     * @return string
     */
    private function buildBookingMessage(array $booking): string
    {
        $roomName  = !empty($booking['room_name'])      ? $booking['room_name']      : 'Not specified';
        $checkIn   = !empty($booking['check_in'])       ? $booking['check_in']       : 'Not specified';
        $checkOut  = !empty($booking['check_out'])      ? $booking['check_out']      : 'Not specified';
        $adults    = !empty($booking['adults'])         ? $booking['adults']         : '1';
        $children  = isset($booking['children'])        ? $booking['children']       : '0';
        $special   = !empty($booking['special_request'])? $booking['special_request']: 'None';
        $ref       = !empty($booking['reference_number'])? $booking['reference_number'] : 'N/A';

        return implode("\n", [
            $this->greeting,
            '',
            'I would like to make a booking enquiry.',
            '',
            "Reference : {$ref}",
            "Name      : {$booking['guest_name']}",
            "Phone     : {$booking['guest_phone']}",
            "Email     : {$booking['guest_email']}",
            "Room      : {$roomName}",
            "Check-in  : {$checkIn}",
            "Check-out : {$checkOut}",
            "Adults    : {$adults}",
            "Children  : {$children}",
            "Special   : {$special}",
            '',
            'Thank you.',
        ]);
    }

    /**
     * Return the configured WhatsApp phone number.
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
