# Database — Serona Hotel & Resort

## Tables

| Table               | Purpose                              |
|---------------------|--------------------------------------|
| `users`             | Admin accounts (bcrypt passwords)    |
| `rooms`             | Room catalogue with status/slug      |
| `room_images`       | Images per room (FK → rooms)         |
| `booking_enquiries` | Visitor booking requests             |
| `contact_messages`  | Contact form submissions             |
| `gallery`           | Resort gallery images                |
| `dining_items`      | Dining section content               |
| `experiences`       | Guest experiences / activities       |
| `facilities`        | Resort facilities with FA icons      |
| `site_settings`     | Admin-managed key-value store        |

## Conventions

- **Engine:** InnoDB
- **Charset:** utf8mb4 / utf8mb4_unicode_ci
- **Primary key:** `id` (UNSIGNED INT AUTO_INCREMENT)
- **Timestamps:** `created_at` DEFAULT CURRENT_TIMESTAMP, `updated_at` ON UPDATE CURRENT_TIMESTAMP
- **Soft deletes:** Use `status = 'HIDDEN'` or `is_active = 0` — never hard DELETE important content
- **Booking FK:** `ON DELETE SET NULL` on `room_id` — preserves enquiry history if a room is deleted
- **No payment tables** — booking is WhatsApp/Email manual process

## Booking Enquiry Statuses

| Status      | Meaning                              |
|-------------|--------------------------------------|
| NEW         | Just submitted, not yet reviewed     |
| CONTACTED   | Admin has contacted the guest        |
| CONFIRMED   | Reservation verbally confirmed       |
| CANCELLED   | Guest or admin cancelled             |
| COMPLETED   | Stay completed                       |

## Access Pattern

```
Controller → BLL → DAL (extends BaseDAL) → PDO → MySQL
```

All queries: prepared statements only.  
Connection: `Database::getConnection()` (singleton in `dal/Database.php`).

## Schema File

`database/serona_db.sql` — import into phpMyAdmin or via CLI:
```bash
mysql -u root -p serona_db < database/serona_db.sql
```
