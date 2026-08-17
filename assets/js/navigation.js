/**
 * Serona Hotel & Resort — Navigation JavaScript
 * Handles sticky header scroll transformations, mobile menu toggle,
 * escape key handler, and accessibility state.
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('site-header');
    const navToggle = document.getElementById('nav-toggle');
    const siteNav = document.getElementById('site-nav');

    // ─────────────────────────────────────────────────────────────
    // 1. Sticky Header Scroll Transformation
    // ─────────────────────────────────────────────────────────────
    function handleHeaderScroll() {
        if (!header) return;
        const scrollY = window.scrollY || window.pageYOffset;
        if (scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleHeaderScroll, { passive: true });
    handleHeaderScroll(); // Initialize on page load

    // ─────────────────────────────────────────────────────────────
    // 2. Mobile Menu Toggle & Accessibility
    // ─────────────────────────────────────────────────────────────
    if (navToggle && siteNav) {
        function toggleMobileMenu() {
            const isOpen = siteNav.classList.contains('open');
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        function openMobileMenu() {
            siteNav.classList.add('open');
            navToggle.classList.add('active');
            navToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden'; // Lock scroll on mobile
        }

        function closeMobileMenu() {
            siteNav.classList.remove('open');
            navToggle.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        navToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleMobileMenu();
        });

        // Close mobile nav when clicking a nav link
        const navLinks = siteNav.querySelectorAll('.nav-link');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                closeMobileMenu();
            });
        });

        // Close mobile nav when clicking outside
        document.addEventListener('click', function (e) {
            if (siteNav.classList.contains('open') && !siteNav.contains(e.target) && !navToggle.contains(e.target)) {
                closeMobileMenu();
            }
        });

        // Close on Escape key press
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && siteNav.classList.contains('open')) {
                closeMobileMenu();
            }
        });
    }
});
