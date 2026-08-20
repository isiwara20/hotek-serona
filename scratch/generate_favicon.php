<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/init.php';

$logoPath = ASSETS_PATH . '/images/branding/Logo.png';
$outputPath = ASSETS_PATH . '/images/branding/favicon-rounded.png';

if (!file_exists($logoPath)) {
    die("Logo not found\n");
}

$size = 180;
$cornerRad = 36; // rounded corners

// Create transparent canvas
$canvas = imagecreatetruecolor($size, $size);
imagealphablending($canvas, false);
imagesavealpha($canvas, true);
$transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
imagefill($canvas, 0, 0, $transparent);

// Create rounded white background mask
$bg = imagecreatetruecolor($size, $size);
$white = imagecolorallocate($bg, 255, 255, 255);
imagefill($bg, 0, 0, $white);

// Draw rounded rectangle on canvas
imagealphablending($canvas, true);

// Fill rounded rectangle with white
for ($x = 0; $x < $size; $x++) {
    for ($y = 0; $y < $size; $y++) {
        $inCorner = false;
        
        // Top-left
        if ($x < $cornerRad && $y < $cornerRad) {
            $dist = sqrt(pow($cornerRad - $x, 2) + pow($cornerRad - $y, 2));
            if ($dist > $cornerRad) $inCorner = true;
        }
        // Top-right
        elseif ($x >= ($size - $cornerRad) && $y < $cornerRad) {
            $dist = sqrt(pow($x - ($size - $cornerRad - 1), 2) + pow($cornerRad - $y, 2));
            if ($dist > $cornerRad) $inCorner = true;
        }
        // Bottom-left
        elseif ($x < $cornerRad && $y >= ($size - $cornerRad)) {
            $dist = sqrt(pow($cornerRad - $x, 2) + pow($y - ($size - $cornerRad - 1), 2));
            if ($dist > $cornerRad) $inCorner = true;
        }
        // Bottom-right
        elseif ($x >= ($size - $cornerRad) && $y >= ($size - $cornerRad)) {
            $dist = sqrt(pow($x - ($size - $cornerRad - 1), 2) + pow($y - ($size - $cornerRad - 1), 2));
            if ($dist > $cornerRad) $inCorner = true;
        }

        if (!$inCorner) {
            imagesetpixel($canvas, $x, $y, imagecolorallocatealpha($canvas, 255, 255, 255, 0));
        }
    }
}

// Load source Logo
$logoImg = imagecreatefrompng($logoPath);
$origW = imagesx($logoImg);
$origH = imagesy($logoImg);

// Scale logo to fit inside rounded box with padding
$padding = 24;
$targetW = $size - ($padding * 2);
$targetH = (int) ($origH * ($targetW / $origW));

if ($targetH > ($size - ($padding * 2))) {
    $targetH = $size - ($padding * 2);
    $targetW = (int) ($origW * ($targetH / $origH));
}

$destX = (int) (($size - $targetW) / 2);
$destY = (int) (($size - $targetH) / 2);

imagecopyresampled($canvas, $logoImg, $destX, $destY, 0, 0, $targetW, $targetH, $origW, $origH);

imagepng($canvas, $outputPath);
imagedestroy($canvas);
imagedestroy($bg);
imagedestroy($logoImg);

echo "Favicon generated successfully at: " . $outputPath . "\n";
