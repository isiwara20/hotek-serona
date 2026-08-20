<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

$logoPath = ASSETS_PATH . '/images/branding/Logo.png';
$svgPath = ASSETS_PATH . '/images/branding/favicon-rounded.svg';

if (file_exists($logoPath)) {
    $imageData = base64_encode(file_get_contents($logoPath));
    $src = 'data:image/png;base64,' . $imageData;

    $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
  <rect x="0" y="0" width="100" height="100" rx="24" ry="24" fill="#FFFFFF" stroke="#E5E2DA" stroke-width="2" />
  <image href="{$src}" x="10" y="10" width="80" height="80" preserveAspectRatio="xMidYMid meet" />
</svg>
SVG;

    file_put_contents($svgPath, $svgContent);
    echo "SVG Favicon created successfully at: " . $svgPath . "\n";
}
