<?php

declare(strict_types=1);

/**
 * API Endpoint: Rooms
 * Phase 1: Stub — full implementation in Phase 4+
 */

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/init.php';

// Set JSON response headers
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Only allow POST (or GET for read-only endpoints)
if (!is_post()) {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method Not Allowed.',
        'data'    => null,
    ]);
    exit;
}

// CSRF validation (always required for state-changing endpoints)
csrf_check();

// TODO: Implement Rooms API logic in Phase 4+.
http_response_code(501);
echo json_encode([
    'success' => false,
    'message' => 'This endpoint is not yet implemented.',
    'data'    => null,
]);
