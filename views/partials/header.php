<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($meta_description ?? 'Serona Hotel & Resort — Nature\'s Embrace. A premium eco-luxury retreat.') ?>">
    <title><?= e($page_title ?? APP_NAME) ?></title>

    <!-- Google Fonts: Cormorant Garamond (headings) + Inter (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Project CSS -->
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">
</head>
<body>

<header class="site-header" id="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="<?= base_url() ?>" class="site-logo" aria-label="<?= e(APP_NAME) ?> — Home">
            <img src="<?= asset('images/branding/logo.png') ?>" alt="<?= e(APP_NAME) ?> Logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <span class="logo-text" style="display:none;"><?= e(APP_NAME) ?></span>
        </a>

        <!-- Primary Navigation — Admin login is NOT included here -->
        <nav class="site-nav" aria-label="Primary navigation">
            <ul class="nav-list" role="list">
                <li><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
                <li><a href="<?= base_url('rooms.php') ?>" class="nav-link">Rooms</a></li>
                <li><a href="<?= base_url('dining.php') ?>" class="nav-link">Dining</a></li>
                <li><a href="<?= base_url('experiences.php') ?>" class="nav-link">Experiences</a></li>
                <li><a href="<?= base_url('gallery.php') ?>" class="nav-link">Gallery</a></li>
                <li><a href="<?= base_url('about.php') ?>" class="nav-link">About</a></li>
                <li><a href="<?= base_url('contact.php') ?>" class="nav-link">Contact</a></li>
            </ul>
        </nav>

        <!-- CTA -->
        <div class="header-actions">
            <a href="<?= base_url('booking.php') ?>" class="btn btn-primary" id="header-book-btn">Book a Stay</a>

            <!-- Mobile menu toggle -->
            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span class="hamburger"></span>
                <span class="hamburger"></span>
                <span class="hamburger"></span>
            </button>
        </div>
    </div>
</header>

<main id="main-content">
