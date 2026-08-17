/**
 * Serona Hotel & Resort — Main JavaScript
 * Phase 1: Core UI behaviours
 *
 * No jQuery. No frameworks. Pure ES6+.
 */

'use strict';

// ─────────────────────────────────────────────────────────────────────────────
// 1. Mobile Navigation Toggle
// ─────────────────────────────────────────────────────────────────────────────
(function initMobileNav() {
    const toggle = document.getElementById('nav-toggle');
    const nav    = document.querySelector('.site-nav');

    if (!toggle || !nav) return;

    toggle.addEventListener('click', () => {
        const isOpen = nav.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen.toString());
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !nav.contains(e.target)) {
            nav.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
}());

// ─────────────────────────────────────────────────────────────────────────────
// 2. Password Toggle (login page)
// ─────────────────────────────────────────────────────────────────────────────
(function initPasswordToggle() {
    const btn   = document.getElementById('password-toggle');
    const input = document.getElementById('password');

    if (!btn || !input) return;

    btn.addEventListener('click', () => {
        const isVisible = input.type === 'text';
        input.type = isVisible ? 'password' : 'text';

        const icon = btn.querySelector('i');
        if (icon) {
            icon.className = isVisible ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }
    });
}());

// ─────────────────────────────────────────────────────────────────────────────
// 3. Flash Message Dismiss
// ─────────────────────────────────────────────────────────────────────────────
(function initFlashDismiss() {
    document.querySelectorAll('.flash__close').forEach((btn) => {
        btn.addEventListener('click', () => {
            const flash = btn.closest('.flash');
            if (flash) {
                flash.style.transition = 'opacity 0.25s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300);
            }
        });
    });

    // Auto-dismiss success flashes after 5 seconds
    document.querySelectorAll('.flash--success').forEach((flash) => {
        setTimeout(() => {
            if (flash.isConnected) {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 600);
            }
        }, 5000);
    });
}());

// ─────────────────────────────────────────────────────────────────────────────
// 4. Sticky Header — add scroll class
// ─────────────────────────────────────────────────────────────────────────────
(function initStickyHeader() {
    const header = document.getElementById('site-header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });
}());
