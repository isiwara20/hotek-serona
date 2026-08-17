<?php

declare(strict_types=1);

/**
 * BookingBLL — Business Logic Layer for booking enquiries.
 *
 * Responsibilities:
 *   - Validate enquiry data at the business level.
 *   - Generate reference numbers.
 *   - Persist enquiries via BookingDAL.
 *   - Return structured results (success flag, errors, reference).
 *
 * Does NOT:
 *   - Read $_POST directly.
 *   - Render HTML.
 *   - Redirect.
 *   - Write SQL.
 */
class BookingBLL
{
    private BookingDAL $bookingDAL;

    public function __construct(BookingDAL $bookingDAL)
    {
        $this->bookingDAL = $bookingDAL;
    }

    /**
     * Process and save a booking enquiry submission.
     *
     * @param  array $data  Sanitised data passed by the controller.
     * @return array{
     *     success: bool,
     *     errors: string[],
     *     reference: string|null,
     *     enquiry_id: int|null
     * }
     */
    public function submitEnquiry(array $data): array
    {
        $errors = $this->validateEnquiry($data);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'reference' => null, 'enquiry_id' => null];
        }

        // Business rules
        $checkIn  = new \DateTime($data['check_in']);
        $checkOut = new \DateTime($data['check_out']);

        if ($checkOut <= $checkIn) {
            return ['success' => false, 'errors' => ['Check-out date must be after check-in date.'], 'reference' => null, 'enquiry_id' => null];
        }

        $today = new \DateTime('today');
        if ($checkIn < $today) {
            return ['success' => false, 'errors' => ['Check-in date cannot be in the past.'], 'reference' => null, 'enquiry_id' => null];
        }

        $data['reference_number'] = generate_booking_reference();

        $enquiryId = $this->bookingDAL->create($data);

        if ($enquiryId === false) {
            return ['success' => false, 'errors' => ['We could not save your enquiry. Please try again.'], 'reference' => null, 'enquiry_id' => null];
        }

        return [
            'success'    => true,
            'errors'     => [],
            'reference'  => $data['reference_number'],
            'enquiry_id' => $enquiryId,
        ];
    }

    /**
     * Validate required booking fields.
     *
     * @param  array $data
     * @return string[]  Array of validation error messages.
     */
    private function validateEnquiry(array $data): array
    {
        $errors = [];

        if (empty($data['guest_name']) || !validate_length($data['guest_name'], 2, 100)) {
            $errors[] = 'Please enter a valid full name (2–100 characters).';
        }

        if (empty($data['guest_email']) || !validate_email($data['guest_email'])) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (empty($data['guest_phone']) || !validate_phone($data['guest_phone'])) {
            $errors[] = 'Please enter a valid phone number.';
        }

        if (empty($data['check_in']) || !validate_date($data['check_in'])) {
            $errors[] = 'Please enter a valid check-in date (YYYY-MM-DD).';
        }

        if (empty($data['check_out']) || !validate_date($data['check_out'])) {
            $errors[] = 'Please enter a valid check-out date (YYYY-MM-DD).';
        }

        $adults = (int) ($data['adults'] ?? 0);
        if ($adults < 1 || $adults > 20) {
            $errors[] = 'Number of adults must be between 1 and 20.';
        }

        return $errors;
    }
}
