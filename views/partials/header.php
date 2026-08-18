<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($meta_description ?? 'Serona Hotel & Resort — Nature\'s Embrace. A premium eco-luxury retreat in Sri Lanka.') ?>">
    <title><?= e($page_title ?? APP_NAME . " — Nature's Embrace") ?></title>

    <!-- Google Fonts: Cormorant Garamond (headings) + Inter (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Project CSS -->
    <?php
    $mainCssPath       = ASSETS_PATH . '/css/main.css';
    $componentsCssPath = ASSETS_PATH . '/css/components.css';
    $responsiveCssPath = ASSETS_PATH . '/css/responsive.css';
    $vMain       = file_exists($mainCssPath)       ? filemtime($mainCssPath)       : 1;
    $vComponents = file_exists($componentsCssPath) ? filemtime($componentsCssPath) : 1;
    $vResponsive = file_exists($responsiveCssPath) ? filemtime($responsiveCssPath) : 1;
    ?>
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>?v=<?= $vMain ?>">
    <link rel="stylesheet" href="<?= asset('css/components.css') ?>?v=<?= $vComponents ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>?v=<?= $vResponsive ?>">
</head>
<body>

<header class="site-header" id="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="<?= base_url() ?>" class="site-logo" aria-label="<?= e(APP_NAME) ?> — Home">
            <img src="<?= asset('images/branding/Logo.jpeg') ?>" alt="<?= e(APP_NAME) ?> Logo" class="logo-img">
        </a>

        <!-- Primary Navigation — Admin login is strictly NOT included here -->
        <?php
        $currentPage = $active_page ?? (in_array(basename($_SERVER['PHP_SELF']), ['index.php', '']) ? 'home' : basename($_SERVER['PHP_SELF'], '.php'));
        ?>
        <nav class="site-nav" id="site-nav" aria-label="Primary navigation">
            <ul class="nav-list" role="list">
                <li><a href="<?= base_url() ?>" class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= base_url('rooms.php') ?>" class="nav-link <?= $currentPage === 'rooms' ? 'active' : '' ?>">Rooms &amp; Suites</a></li>
                <li><a href="<?= base_url('dining.php') ?>" class="nav-link <?= $currentPage === 'dining' ? 'active' : '' ?>">Dining</a></li>
                <li><a href="<?= base_url('experiences.php') ?>" class="nav-link <?= $currentPage === 'experiences' ? 'active' : '' ?>">Experiences</a></li>
                <li><a href="<?= base_url('gallery.php') ?>" class="nav-link <?= $currentPage === 'gallery' ? 'active' : '' ?>">Gallery</a></li>
                <li><a href="<?= base_url('about.php') ?>" class="nav-link <?= $currentPage === 'about' ? 'active' : '' ?>">About</a></li>
                <li><a href="<?= base_url('contact.php') ?>" class="nav-link <?= $currentPage === 'contact' ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="<?= base_url('booking.php') ?>" class="btn btn-header-cta" id="header-book-btn">Book Your Stay</a>

            <!-- Mobile menu toggle -->
            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="site-nav">
                <span class="hamburger"></span>
                <span class="hamburger"></span>
                <span class="hamburger"></span>
            </button>
        </div>
    </div>
</header>

<main id="main-content">

