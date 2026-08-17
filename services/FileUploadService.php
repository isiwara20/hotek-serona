<?php

declare(strict_types=1);

/**
 * FileUploadService — Secure image upload handler.
 *
 * Used by admin controllers to upload room, gallery, dining,
 * experience, and facility images.
 *
 * Security features:
 *   - MIME validation using finfo (not file extension alone).
 *   - Extension whitelist: jpg, jpeg, png, webp.
 *   - Random generated filenames (no trust of original filename).
 *   - File size limit enforcement.
 *   - Never stores PHP or executable files.
 *
 * Usage:
 *   $uploader = new FileUploadService();
 *   $result   = $uploader->upload($_FILES['image'], 'rooms');
 *   if ($result['success']) {
 *       $storedFilename = $result['filename'];
 *   }
 */
class FileUploadService
{
    /** @var string[] */
    private array $allowedMime;

    /** @var string[] */
    private array $allowedExtensions;

    private int $maxSize;

    public function __construct()
    {
        $this->allowedMime       = UPLOAD_ALLOWED_MIME;
        $this->allowedExtensions = UPLOAD_ALLOWED_EXT;
        $this->maxSize           = UPLOAD_MAX_SIZE;
    }

    /**
     * Upload a single image file to a named subdirectory under /storage/uploads/.
     *
     * @param  array  $file       One entry from $_FILES (e.g. $_FILES['image']).
     * @param  string $subDir     Target subdirectory, e.g. 'rooms', 'gallery'.
     * @return array{
     *     success: bool,
     *     filename: string|null,
     *     path: string|null,
     *     error: string|null
     * }
     */
    public function upload(array $file, string $subDir): array
    {
        // 1. Check for upload errors.
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return $this->failure($this->uploadErrorMessage($file['error'] ?? UPLOAD_ERR_NO_FILE));
        }

        // 2. Enforce file size limit.
        if (($file['size'] ?? 0) > $this->maxSize) {
            return $this->failure('File size exceeds the maximum allowed limit (' . ($this->maxSize / 1024 / 1024) . ' MB).');
        }

        // 3. Verify the file is actually an uploaded file (security).
        if (!is_uploaded_file($file['tmp_name'] ?? '')) {
            return $this->failure('Invalid file upload source.');
        }

        // 4. Validate MIME type using finfo (not the client-supplied type).
        $finfo    = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $this->allowedMime, true)) {
            return $this->failure("File type '{$mimeType}' is not permitted. Allowed: JPG, PNG, WebP.");
        }

        // 5. Derive a safe extension from the MIME type (ignore client filename).
        $extension = $this->mimeToExtension($mimeType);
        if ($extension === null) {
            return $this->failure('Could not determine a safe file extension.');
        }

        // 6. Generate a cryptographically random filename.
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;

        // 7. Ensure the target directory exists.
        $targetDir = UPLOADS_PATH . DIRECTORY_SEPARATOR . ltrim($subDir, '/\\');
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                return $this->failure('Could not create upload directory.');
            }
        }

        // 8. Move the uploaded file to the target directory.
        $targetPath = $targetDir . DIRECTORY_SEPARATOR . $filename;
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $this->failure('Failed to move uploaded file. Check directory permissions.');
        }

        return [
            'success'  => true,
            'filename' => $filename,
            'path'     => $targetPath,
            'error'    => null,
        ];
    }

    /**
     * Delete an uploaded file by subdirectory and filename.
     *
     * @param string $subDir
     * @param string $filename
     */
    public function delete(string $subDir, string $filename): bool
    {
        // Prevent path traversal: allow only the plain filename.
        $safeFilename = basename($filename);
        $path = UPLOADS_PATH . DIRECTORY_SEPARATOR . ltrim($subDir, '/\\') . DIRECTORY_SEPARATOR . $safeFilename;

        if (file_exists($path) && is_file($path)) {
            return unlink($path);
        }

        return false;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private Helpers
    // ─────────────────────────────────────────────────────────────────────────

    private function failure(string $error): array
    {
        LoggerService::warning('[FileUpload] Upload rejected: ' . $error);
        return ['success' => false, 'filename' => null, 'path' => null, 'error' => $error];
    }

    private function mimeToExtension(string $mime): ?string
    {
        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            default      => null,
        };
    }

    private function uploadErrorMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the maximum size.',
            UPLOAD_ERR_PARTIAL   => 'The file was only partially uploaded.',
            UPLOAD_ERR_NO_FILE   => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR=> 'Missing temporary folder.',
            UPLOAD_ERR_CANT_WRITE=> 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the upload.',
            default              => 'An unknown upload error occurred.',
        };
    }
}
