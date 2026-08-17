<?php

declare(strict_types=1);

/**
 * BookingDAL — Data Access Layer for the booking_enquiries table.
 */
class BookingDAL extends BaseDAL
{
    /**
     * Insert a new booking enquiry and return the new record's ID.
     *
     * @param  array $data  Sanitised, validated enquiry data from BookingBLL.
     * @return int|false    New ID, or false on failure.
     */
    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO booking_enquiries
                (reference_number, room_id, guest_name, guest_email, guest_phone,
                 check_in, check_out, adults, children, special_request,
                 communication_method, status, created_at, updated_at)
             VALUES
                (:reference_number, :room_id, :guest_name, :guest_email, :guest_phone,
                 :check_in, :check_out, :adults, :children, :special_request,
                 :communication_method, :status, NOW(), NOW())'
        );

        $success = $stmt->execute([
            ':reference_number'    => $data['reference_number'],
            ':room_id'             => $data['room_id']             ?? null,
            ':guest_name'          => $data['guest_name'],
            ':guest_email'         => $data['guest_email'],
            ':guest_phone'         => $data['guest_phone'],
            ':check_in'            => $data['check_in'],
            ':check_out'           => $data['check_out'],
            ':adults'              => $data['adults']              ?? 1,
            ':children'            => $data['children']            ?? 0,
            ':special_request'     => $data['special_request']     ?? null,
            ':communication_method'=> $data['communication_method']?? 'WHATSAPP',
            ':status'              => 'NEW',
        ]);

        return $success ? (int) $this->pdo->lastInsertId() : false;
    }

    /**
     * Return all booking enquiries (admin use), most recent first.
     *
     * @return array[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT b.id, b.reference_number, b.guest_name, b.guest_email,
                    b.guest_phone, b.check_in, b.check_out, b.adults, b.children,
                    b.communication_method, b.status, b.admin_notes,
                    b.created_at, r.name AS room_name
             FROM   booking_enquiries b
             LEFT   JOIN rooms r ON b.room_id = r.id
             ORDER  BY b.created_at DESC'
        );

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find a booking enquiry by its ID (admin use).
     *
     * @param  int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT b.*, r.name AS room_name
             FROM   booking_enquiries b
             LEFT   JOIN rooms r ON b.room_id = r.id
             WHERE  b.id = :id
             LIMIT  1'
        );

        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Update the status and/or admin notes of a booking enquiry.
     *
     * @param  int    $id
     * @param  string $status      One of: NEW|CONTACTED|CONFIRMED|CANCELLED|COMPLETED
     * @param  string $adminNotes  Optional internal notes.
     * @return bool
     */
    public function updateStatus(int $id, string $status, string $adminNotes = ''): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE booking_enquiries
             SET    status = :status,
                    admin_notes = :admin_notes,
                    updated_at = NOW()
             WHERE  id = :id'
        );

        return $stmt->execute([
            ':status'      => $status,
            ':admin_notes' => $adminNotes,
            ':id'          => $id,
        ]);
    }
}
