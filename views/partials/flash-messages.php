<?php
/**
 * Flash Messages Partial
 *
 * Include this near the top of every public and admin page body,
 * after the header partial, before the main content.
 *
 * Usage: <?php include VIEWS_PATH . '/partials/flash-messages.php'; ?>
 */

$flashTypes = ['success', 'error', 'warning', 'info'];
$hasFlash   = false;
foreach ($flashTypes as $type) {
    if (has_flash($type)) { $hasFlash = true; break; }
}
?>
<?php if ($hasFlash): ?>
<div class="flash-container" role="alert" aria-live="polite" id="flash-messages">
    <?php foreach ($flashTypes as $type): ?>
        <?php $msgs = get_flash($type); ?>
        <?php foreach ($msgs as $msg): ?>
        <div class="flash flash--<?= e($type) ?>">
            <span class="flash__icon">
                <?php if ($type === 'success'): ?><i class="fa-solid fa-circle-check" aria-hidden="true"></i><?php endif; ?>
                <?php if ($type === 'error'):   ?><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i><?php endif; ?>
                <?php if ($type === 'warning'): ?><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i><?php endif; ?>
                <?php if ($type === 'info'):    ?><i class="fa-solid fa-circle-info" aria-hidden="true"></i><?php endif; ?>
            </span>
            <span class="flash__message"><?= e($msg) ?></span>
            <button class="flash__close" aria-label="Close notification" type="button">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
