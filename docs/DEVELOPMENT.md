# Development Guide — Serona Hotel & Resort

## Adding a New Public Page

1. Create `XxxController.php` in `controllers/` with a method (e.g., `index()`, `showForm()`).
2. Create `XxxBLL.php` in `bll/` for business rules (if needed).
3. Create `XxxDAL.php` in `dal/` extending `BaseDAL` for DB access (if needed).
4. Create view `views/public/xxx.php` — include header/footer partials.
5. Create entry file `xxx.php` at project root:

```php
<?php
declare(strict_types=1);
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$controller = new XxxController();
$controller->index();
```

## Adding an Admin Page

1. Add method to `AdminController.php` — **always call `require_admin()` first**.
2. Create view `views/admin/xxx/index.php` — start with `include admin-header.php`.
3. Link from `views/partials/admin-sidebar.php`.
4. Create entry file `admin_xxx.php` at root.

## Adding a Database Table

1. Write `CREATE TABLE` statement in `database/serona_db.sql`.
2. Create `XxxDAL.php` extending `BaseDAL`.
3. Create `XxxBLL.php` calling the DAL.
4. Inject via constructor in the controller that needs it.

## Code Standards

```php
<?php
declare(strict_types=1);

// Output escaping — always:
echo e($userInput);

// Forms — always include CSRF:
echo csrf_field();

// Admin pages — always guard:
require_admin();

// DB access — always via DAL:
$stmt = $this->pdo->prepare('SELECT ... WHERE id = :id');
$stmt->execute([':id' => $id]);
```

## Generating a Password Hash

```bash
php -r "echo password_hash('YourStrongPassword', PASSWORD_BCRYPT, ['cost'=>12]);"
```

## Useful Helper Functions

| Function                | Purpose                                      |
|-------------------------|----------------------------------------------|
| `e($val)`               | Escape for HTML output                       |
| `base_url($path)`       | Generate absolute URL from BASE_URL          |
| `asset($path)`          | Generate URL to /assets/ file                |
| `redirect($url)`        | HTTP redirect + exit                         |
| `is_post()`             | Check if current request is POST             |
| `post($key)`            | Sanitised $_POST value or null               |
| `get_param($key)`       | Sanitised $_GET value or null                |
| `old($key)`             | Repopulate form field after POST             |
| `set_flash($type, $msg)`| Store one-time session message               |
| `get_flash($type)`      | Retrieve and clear session message           |
| `csrf_token()`          | Get/generate CSRF token                      |
| `csrf_field()`          | Render hidden CSRF input HTML                |
| `csrf_check()`          | Validate POST CSRF token (abort on fail)     |
| `require_admin()`       | Redirect to login if not authenticated       |
| `is_admin_logged_in()`  | Boolean admin session check                  |
| `current_admin()`       | Return admin session data array              |

## Local Development URLs

| URL                                          | Page             |
|----------------------------------------------|------------------|
| `http://localhost/hotek-serona/`             | Home             |
| `http://localhost/hotek-serona/rooms.php`    | Rooms listing    |
| `http://localhost/hotek-serona/booking.php`  | Booking form     |
| `http://localhost/hotek-serona/contact.php`  | Contact          |
| `http://localhost/hotek-serona/login.php`    | Admin login      |
| `http://localhost/hotek-serona/admin_dashboard.php` | Dashboard  |
| `http://localhost/phpmyadmin/`               | phpMyAdmin       |
