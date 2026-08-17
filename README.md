# Serona Hotel & Resort

> **Nature's Embrace** — A premium eco-luxury hotel & resort website with booking enquiry management.

---

## Project Overview

Serona Hotel & Resort is a production-grade PHP website providing:

- **Public website** — Home, Rooms, Dining, Experiences, Gallery, About, Contact
- **Booking enquiry system** — WhatsApp + Email (no online payment gateway)
- **Admin CMS** — Password-protected portal for managing content, bookings, and settings

---

## Technology Stack

| Layer      | Technology                         |
|------------|------------------------------------|
| Server     | Apache / XAMPP                     |
| Backend    | Pure PHP 8.1+ (no frameworks)      |
| Database   | MySQL via PDO (prepared statements)|
| Frontend   | HTML5 / Vanilla CSS / Vanilla JS   |
| Fonts      | Google Fonts (Cormorant Garamond + Inter) |
| Icons      | Font Awesome 6.4.0                 |

---

## Architecture

**N-Tier MVC** with strict layer separation:

```
HTTP Entry Point (*.php)
    ↓
Controller (controllers/)
    ↓
Business Logic Layer (bll/)
    ↓
Data Access Layer (dal/)
    ↓
PDO / MySQL
```

Services (`services/`) are consumed by Controllers and BLL.
Helpers (`helpers/`) are global procedural utilities.

---

## Environment Setup

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) with PHP 8.1+, MySQL, Apache

### Installation Steps

1. **Install XAMPP** and start Apache + MySQL.

2. **Place the project** inside:
   ```
   C:\xampp\htdocs\hotek-serona\
   ```

3. **Create the database** in phpMyAdmin:
   - Open: `http://localhost/phpmyadmin`
   - Create database: `serona_db`
   - Charset: `utf8mb4`, Collation: `utf8mb4_unicode_ci`

4. **Import the schema**:
   - Select `serona_db` → Import → choose `database/serona_db.sql`

5. **Configure the database** (if needed):
   - Edit `config/db.php`
   - Update `username` and `password` if not using default `root` / empty

6. **Configure WhatsApp number**:
   - Edit `config/whatsapp.php`
   - Replace `94XXXXXXXXX` with the hotel's real WhatsApp number

7. **Configure email addresses**:
   - Edit `config/mail.php`
   - Replace placeholder email addresses

8. **Visit the website**:
   ```
   http://localhost/hotek-serona/
   ```

9. **Admin login** (not linked in public navigation):
   ```
   http://localhost/hotek-serona/login.php
   ```

### Default Admin Credentials

> ⚠️ **Change the default password immediately after first login.**

The SQL file seeds a placeholder admin. Generate a proper hash:

```bash
php -r "echo password_hash('YourStrongPassword', PASSWORD_BCRYPT, ['cost'=>12]);"
```

Update the `users` table with this hash.

---

## Project Structure

```
hotek-serona/
│
├── assets/
│   ├── css/          main.css, responsive.css, admin.css, auth.css
│   ├── js/           main.js, booking.js, admin.js, validation.js
│   └── images/       branding/, hero/, rooms/, gallery/, ...
│
├── bll/              Business Logic Layer
│   ├── AuthBLL.php
│   ├── BookingBLL.php
│   ├── RoomBLL.php
│   ├── ContactBLL.php
│   └── AdminBLL.php
│
├── config/
│   ├── app.php       Application constants
│   ├── db.php        PDO database config
│   ├── init.php      Bootstrap (sessions, autoloader, helpers)
│   ├── mail.php      Email config
│   └── whatsapp.php  WhatsApp config
│
├── controllers/      HTTP request handlers
├── dal/              Data Access Layer (PDO queries only)
├── database/         serona_db.sql
├── docs/             Architecture & developer documentation
├── helpers/          Procedural utility functions
├── services/         Reusable services (Email, WhatsApp, Upload, CSRF, Logger)
│
├── storage/
│   ├── logs/         app.log, mail.log
│   └── uploads/      rooms/, gallery/, dining/, experiences/
│
├── views/
│   ├── public/       Public-facing pages
│   ├── admin/        Admin panel pages
│   ├── auth/         login.php
│   └── partials/     header, footer, admin-header, flash-messages
│
├── index.php         → HomeController
├── login.php         → AuthController (admin only)
├── logout.php        → AuthController::logout()
├── rooms.php         → RoomController
├── room-details.php  → RoomController
├── booking.php       → BookingController
├── contact.php       → ContactController
├── admin_dashboard.php → AdminController
├── .htaccess
└── README.md
```

---

## Booking Flow

```
Visitor selects room / clicks Book
    ↓
booking.php (form with CSRF token)
    ↓
BookingController::submitEnquiry()
    ↓
BookingBLL (validate dates, guest info)
    ↓
BookingDAL (INSERT booking_enquiries)
    ↓
EmailService (notify admin + guest)
    ↓
WhatsAppService (generate wa.me URL)
    ↓
Visitor is redirected to WhatsApp
    ↓
Hotel admin communicates manually
```

**No payment gateway. No online checkout.**

---

## Security

| Measure              | Implementation                          |
|----------------------|-----------------------------------------|
| SQL Injection        | PDO prepared statements only            |
| XSS                  | `htmlspecialchars()` via `e()` helper   |
| CSRF                 | `random_bytes(32)` + `hash_equals()`    |
| Password Storage     | `password_hash()` bcrypt cost 12        |
| Session Fixation     | `session_regenerate_id(true)` on login  |
| File Upload          | MIME validation via `finfo`, random filenames |
| Admin Access         | `require_admin()` guard on every admin page |
| Config Exposure      | `.htaccess` blocks direct access to backend dirs |
| Error Exposure       | Production mode hides all error details |

---

## Development Phases

| Phase | Status | Description                              |
|-------|--------|------------------------------------------|
| 1     | ✅ Done | Project structure, architecture, config, DAL/BLL/Controllers, DB schema |
| 2     | Planned | Public Serona home page & shared UI components |
| 3     | Planned | Admin panel CMS (rooms, gallery, dining, experiences) |
| 4     | Planned | Full booking enquiry system with WhatsApp/Email integration |
| 5     | Planned | Polish, SEO, performance, production hardening |

---

## Contributing

This is a private client project. Code quality standards:

- `declare(strict_types=1)` in all PHP files
- No raw SQL outside DAL classes
- No `$_POST` access outside Controllers
- No HTML rendering in BLL or DAL
- All output escaped with `e()`
- No payment-related code

---

*Serona Hotel & Resort © 2026. All rights reserved.*
