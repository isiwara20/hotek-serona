# Architecture — Serona Hotel & Resort

## Pattern: N-Tier MVC

```
HTTP Entry Point (*.php at root)
         |
    Controller  (controllers/)   — Receives HTTP, calls BLL, renders view
         |
    BLL         (bll/)           — Business rules, validation, orchestration
         |
    DAL         (dal/)           — PDO queries, returns arrays/bool/IDs
         |
    MySQL via PDO
```

Services (`services/`) are utility classes consumed by Controllers and BLL.  
Helpers (`helpers/`) are procedural functions available globally via `require_once`.

## Layer Contracts

| Layer      | May access                  | Must NOT access               |
|------------|-----------------------------|-------------------------------|
| Controller | BLL, Services, Views        | PDO directly, raw SQL         |
| BLL        | DAL, Services               | $_POST, HTML, redirects       |
| DAL        | PDO only                    | BLL, Services, HTML, redirect |
| Services   | Other services, config      | DAL directly (exception: AuthService, LoggerService) |
| Views      | Helpers (e, asset, base_url)| BLL, DAL, PDO                 |

## Autoloading

`spl_autoload_register()` in `config/init.php` resolves classes from:

- `controllers/ClassName.php`
- `bll/ClassName.php`
- `dal/ClassName.php`
- `services/ClassName.php`

No Composer required for Phase 1.

## Key Files

| File                    | Role                                    |
|-------------------------|-----------------------------------------|
| `config/app.php`        | Application-wide constants              |
| `config/init.php`       | Session, autoloader, error handling     |
| `config/db.php`         | PDO connection configuration            |
| `config/whatsapp.php`   | WhatsApp phone + API base               |
| `config/mail.php`       | Email sender / admin address            |
| `dal/Database.php`      | PDO singleton                           |
| `helpers/security.php`  | require_admin(), CSRF, session helpers  |
| `helpers/functions.php` | e(), redirect(), set_flash(), old()     |
