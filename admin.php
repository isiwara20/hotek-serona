<?php
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$page   = $_GET['page']   ?? $_POST['page']   ?? 'dashboard';

if (!is_admin_logged_in()) {
    redirect(base_url('login.php'));
    exit;
}

$controller = new AdminController();

if (is_post()) {
    switch ($action) {
        case 'save_room':
            $controller->saveRoom();
            break;
        case 'delete_room':
            $controller->deleteRoom();
            break;

        case 'save_dining':
            $controller->saveDining();
            break;
        case 'delete_dining':
            $controller->deleteDining();
            break;

        case 'save_experience':
            $controller->saveExperience();
            break;
        case 'delete_experience':
            $controller->deleteExperience();
            break;

        case 'save_gallery':
            $controller->saveGallery();
            break;
        case 'delete_gallery':
            $controller->deleteGallery();
            break;

        case 'update_booking_status':
            $controller->updateBookingStatus();
            break;

        case 'mark_message_read':
            $controller->markMessageRead();
            break;

        case 'save_settings':
            $controller->settings();
            break;

        default:
            if ($page === 'settings') {
                $controller->settings();
            } elseif ($page === 'rooms') {
                $controller->saveRoom();
            } elseif ($page === 'dining') {
                $controller->saveDining();
            } elseif ($page === 'experiences') {
                $controller->saveExperience();
            } elseif ($page === 'gallery') {
                $controller->saveGallery();
            } else {
                $controller->updateBookingStatus();
            }
            break;
    }
    exit;
}

// GET Page Router
switch ($page) {
    case 'bookings':
        $controller->bookings();
        break;

    case 'messages':
        if ($action === 'mark_read') {
            $controller->markMessageRead();
        } else {
            $controller->messages();
        }
        break;

    case 'rooms':
        if ($action === 'delete') {
            $controller->deleteRoom();
        } else {
            $controller->rooms();
        }
        break;

    case 'dining':
        if ($action === 'delete') {
            $controller->deleteDining();
        } else {
            $controller->dining();
        }
        break;

    case 'experiences':
        if ($action === 'delete') {
            $controller->deleteExperience();
        } else {
            $controller->experiences();
        }
        break;

    case 'gallery':
        if ($action === 'delete') {
            $controller->deleteGallery();
        } else {
            $controller->gallery();
        }
        break;

    case 'settings':
        $controller->settings();
        break;

    case 'dashboard':
    default:
        $controller->dashboard();
        break;
}
