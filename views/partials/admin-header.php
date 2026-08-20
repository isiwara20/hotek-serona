<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title ?? 'Admin — ' . APP_NAME) ?></title>

    <!-- Browser Tab Title Logo Favicon (White Rounded Background) -->
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/branding/favicon-rounded.svg') ?>">
    <link rel="alternate icon" type="image/png" href="<?= asset('images/branding/Logo.png') ?>">
    <link rel="apple-touch-icon" href="<?= asset('images/branding/favicon-rounded.svg') ?>">

    <!-- Google Fonts: Playfair Display + Montserrat (Admin) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body class="admin-body">

<div class="admin-layout" id="admin-layout">
    <!-- Sidebar -->
    <?php include VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'admin-sidebar.php'; ?>

    <!-- Main content area -->
    <div class="admin-content" id="admin-content">
        <!-- Top bar -->
        <header class="admin-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle" aria-label="Toggle sidebar" type="button">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>

            <div class="admin-topbar-right">
                <span class="admin-user">
                    <i class="fa-solid fa-user-shield" aria-hidden="true"></i>
                    <?= e(current_admin()['name'] ?? 'Admin') ?>
                </span>
                <a href="<?= base_url('logout.php') ?>" class="admin-logout-link" id="admin-logout-btn">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Logout
                </a>
            </div>
        </header>

        <!-- Flash messages -->
        <?php include VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'flash-messages.php'; ?>

        <!-- Page content injected here -->
