/**
 * Serona Hotel & Resort — Navigation JavaScript
 * Handles sticky header scroll transformations, mobile menu toggle,
 * escape key handler, accessibility state, and responsive resize protection.
 */

'use strict';

// ─────────────────────────────────────────────────────────────
// Global functions defined BEFORE DOMContentLoaded so inline
// onclick= attributes work immediately on click.
// ─────────────────────────────────────────────────────────────

window.openMobileMenu = function () {
    var siteNav    = document.getElementById('site-nav');
    var navToggle  = document.getElementById('nav-toggle');
    var navOverlay = document.getElementById('nav-overlay');

    if (siteNav) {
        siteNav.classList.add('open');
        siteNav.style.display = 'flex';
    }
    if (navToggle) {
        navToggle.classList.add('active');
        navToggle.setAttribute('aria-expanded', 'true');
        navToggle.setAttribute('aria-label', 'Close navigation');
    }
    if (navOverlay) {
        navOverlay.classList.add('open');
        navOverlay.style.display = 'block';
    }
    document.body.classList.add('nav-open');
    document.body.style.overflow = 'hidden';
};

window.closeMobileMenu = function () {
    var siteNav    = document.getElementById('site-nav');
    var navToggle  = document.getElementById('nav-toggle');
    var navOverlay = document.getElementById('nav-overlay');

    if (siteNav) {
        siteNav.classList.remove('open');
        siteNav.style.display = 'none';
    }
    if (navToggle) {
        navToggle.classList.remove('active');
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.setAttribute('aria-label', 'Open navigation');
    }
    if (navOverlay) {
        navOverlay.classList.remove('open');
        navOverlay.style.display = 'none';
    }
    document.body.classList.remove('nav-open');
    document.body.style.overflow = '';
};

// ─────────────────────────────────────────────────────────────
// DOM-ready: attach event listeners
// ─────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    var header     = document.getElementById('site-header');
    var siteNav    = document.getElementById('site-nav');
    var navToggle  = document.getElementById('nav-toggle');
    var navClose   = document.getElementById('nav-close');
    var navOverlay = document.getElementById('nav-overlay');

    // 1. Sticky Header Scroll
    function handleHeaderScroll() {
        if (!header) return;
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    window.addEventListener('scroll', handleHeaderScroll, { passive: true });
    handleHeaderScroll();

    // 2. Hamburger toggle button
    if (navToggle) {
        navToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (siteNav && siteNav.classList.contains('open')) {
                window.closeMobileMenu();
            } else {
                window.openMobileMenu();
            }
        });
    }

    // 3. Close (X) button — direct listener
    if (navClose) {
        navClose.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.closeMobileMenu();
        });
    }

    // 4. Backdrop overlay click
    if (navOverlay) {
        navOverlay.addEventListener('click', function (e) {
            e.preventDefault();
            window.closeMobileMenu();
        });
    }

    // 5. Close when any nav link or drawer button is clicked
    if (siteNav) {
        var drawerInteractiveElements = siteNav.querySelectorAll('.nav-link, .drawer-actions a, .btn');
        drawerInteractiveElements.forEach(function (el) {
            el.addEventListener('click', function () {
                window.closeMobileMenu();
            });
        });
    }

    // 6. Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            window.closeMobileMenu();
        }
    });

    // 7. Close on outside click
    document.addEventListener('click', function (e) {
        if (!siteNav || !siteNav.classList.contains('open')) return;
        if (!siteNav.contains(e.target) && (!navToggle || !navToggle.contains(e.target))) {
            window.closeMobileMenu();
        }
    });

    // 8. Desktop Breakpoint Resize Protection
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            window.closeMobileMenu();
        }
    });
});

