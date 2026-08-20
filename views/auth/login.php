<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Login page must NOT be indexed by search engines -->
    <meta name="robots" content="noindex, nofollow">
    <title><?= e($page_title ?? 'Admin Login') ?></title>

    <!-- Browser Tab Title Logo Favicon (White Rounded Background) -->
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/branding/favicon-rounded.svg') ?>">
    <link rel="alternate icon" type="image/png" href="<?= asset('images/branding/Logo.png') ?>">
    <link rel="apple-touch-icon" href="<?= asset('images/branding/favicon-rounded.svg') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="<?= asset('css/auth.css') ?>">
</head>
<body class="auth-body">

<main class="auth-main" id="auth-main">
    <div class="auth-card" id="auth-card">

        <!-- Brand -->
        <div class="auth-brand">
            <span class="auth-brand-name"><?= e(APP_NAME) ?></span>
            <span class="auth-brand-sub">Administration</span>
        </div>

        <h1 class="auth-title">Sign In</h1>
        <p class="auth-subtitle">Restricted access — authorised personnel only.</p>

        <!-- Flash messages -->
        <?php include VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'flash-messages.php'; ?>

        <!-- Login form -->
        <form
            action="<?= base_url('login.php') ?>"
            method="POST"
            class="auth-form"
            id="login-form"
            novalidate
        >
            <!-- CSRF Token -->
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope input-icon" aria-hidden="true"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="admin@example.com"
                        value="<?= old('email') ?>"
                        autocomplete="email"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock input-icon" aria-hidden="true"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    <button
                        type="button"
                        class="password-toggle"
                        id="password-toggle"
                        aria-label="Toggle password visibility"
                    >
                        <i class="fa-solid fa-eye" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full" id="login-submit-btn">
                <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
                Sign In
            </button>
        </form>

    </div>
</main>

<!-- Minimal JS for password toggle only -->
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
