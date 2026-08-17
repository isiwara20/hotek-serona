# Security — Serona Hotel & Resort

## SQL Injection Prevention

- PDO with prepared statements and named parameter binding exclusively.
- No string concatenation of user input into SQL.
- `mysqli` is strictly prohibited.

## XSS Prevention

- All output to HTML escaped with `e()` helper (`htmlspecialchars ENT_QUOTES UTF-8`).
- Raw values stored in database — only escaped when rendered in HTML.
- Never store HTML-escaped values; escape at the point of output.

## CSRF Protection

- 64-character cryptographically random token: `bin2hex(random_bytes(32))`.
- Stored in `$_SESSION[SESSION_CSRF_KEY]`.
- Every POST form includes: `<?= csrf_field() ?>`.
- Validated with `hash_equals()` (timing-safe) via `csrf_check()`.
- Implementation: `helpers/security.php` and `services/CsrfService.php`.

## Authentication

- Admin-only; no public user accounts.
- Passwords stored as bcrypt hashes: `password_hash($plain, PASSWORD_BCRYPT, ['cost'=>12])`.
- Verification: `password_verify()`.
- Session fixation prevented: `session_regenerate_id(true)` on login.
- Auth guard: `require_admin()` called at top of every admin page.
- Login page has `<meta name="robots" content="noindex, nofollow">`.
- Admin login URL is NOT linked anywhere in the public website.

## File Upload Security

- MIME type validated with `finfo` (not client-reported type).
- Extension derived from MIME, not from original filename.
- Random 32-character hex filename: `bin2hex(random_bytes(16))`.
- Allowed types: `image/jpeg`, `image/png`, `image/webp` only.
- File size limit: 5 MB (configurable via `UPLOAD_MAX_SIZE`).
- `is_uploaded_file()` checked before move.
- `storage/uploads/.htaccess` blocks PHP execution in upload dirs.

## Error Handling

| Environment | display_errors | Behaviour                    |
|-------------|----------------|------------------------------|
| development | On             | Full errors shown + logged   |
| production  | Off            | Errors logged only, never displayed |

Log files: `storage/logs/app.log`, `storage/logs/mail.log`.

## .htaccess Security

Root `.htaccess`:
- `Options -Indexes` — no directory listing.
- Blocks direct browser access to: `config/`, `bll/`, `dal/`, `services/`, `helpers/`, `controllers/`, `database/`, `docs/`, `storage/logs/`.
- Security headers: `X-Frame-Options`, `X-Content-Type-Options`, `X-XSS-Protection`, `Referrer-Policy`.

## Session Security

- `session.use_strict_mode = 1`
- `session.cookie_httponly = 1`
- `session.cookie_samesite = Lax`
- `session.use_only_cookies = 1`
- `session.cookie_secure = 1` (production/HTTPS)

## What Is NOT In This Project

- No payment gateway code
- No Stripe / PayPal / IPG
- No client-side user accounts
- No token-based API auth (Phase N if needed)
