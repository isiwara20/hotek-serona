/**
 * Serona Hotel & Resort — Main JavaScript
 * Handles IntersectionObserver scroll reveals, booking bar interactions,
 * flash message dismissals, and UI micro-interactions.
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // ─────────────────────────────────────────────────────────────
    // 1. Native IntersectionObserver Scroll Reveals
    // ─────────────────────────────────────────────────────────────
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion && 'IntersectionObserver' in window) {
        const revealElements = document.querySelectorAll('.reveal, .reveal-up, .reveal-left, .reveal-right');

        const revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Reveal once
                }
            });
        }, {
            root: null,
            threshold: 0.12,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(function (el) {
            revealObserver.observe(el);
        });
    } else {
        // Fallback: immediately show all elements if reduced motion or no observer support
        document.querySelectorAll('.reveal, .reveal-up, .reveal-left, .reveal-right').forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    // ─────────────────────────────────────────────────────────────
    // 2. Floating Booking / Enquiry Bar Logic
    // ─────────────────────────────────────────────────────────────
    const checkInInput = document.getElementById('bar-check-in');
    const checkOutInput = document.getElementById('bar-check-out');
    const bookingForm = document.getElementById('hero-booking-bar-form');

    if (checkInInput && checkOutInput) {
        // Set default dates if empty
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 2);

        const formatDate = (date) => date.toISOString().split('T')[0];

        if (!checkInInput.value) checkInInput.value = formatDate(today);
        if (!checkOutInput.value) checkOutInput.value = formatDate(tomorrow);

        checkInInput.min = formatDate(today);

        checkInInput.addEventListener('change', function () {
            const checkInDate = new Date(this.value);
            if (!isNaN(checkInDate.getTime())) {
                const nextDay = new Date(checkInDate);
                nextDay.setDate(checkInDate.getDate() + 1);
                checkOutInput.min = formatDate(nextDay);

                if (new Date(checkOutInput.value) <= checkInDate) {
                    checkOutInput.value = formatDate(nextDay);
                }
            }
        });
    }

    // Handle Hero Booking Bar Form Submit -> Redirect to booking.php with prefilled query params
    if (bookingForm) {
        bookingForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const checkIn = checkInInput ? checkInInput.value : '';
            const checkOut = checkOutInput ? checkOutInput.value : '';
            const guests = document.getElementById('bar-guests') ? document.getElementById('bar-guests').value : '2';
            const roomType = document.getElementById('bar-room-type') ? document.getElementById('bar-room-type').value : '';

            let targetUrl = 'booking.php?';
            const params = new URLSearchParams();
            if (checkIn) params.append('check_in', checkIn);
            if (checkOut) params.append('check_out', checkOut);
            if (guests) params.append('adults', guests);
            if (roomType) params.append('room_id', roomType);

            window.location.href = targetUrl + params.toString();
        });
    }

    // ─────────────────────────────────────────────────────────────
    // 3. Flash Messages Dismissal
    // ─────────────────────────────────────────────────────────────
    document.querySelectorAll('.flash__close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const flash = btn.closest('.flash');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-10px)';
                setTimeout(function () {
                    flash.remove();
                }, 300);
            }
        });
    });

    // Auto-dismiss success flash after 5 seconds
    document.querySelectorAll('.flash--success').forEach(function (flash) {
        setTimeout(function () {
            if (flash && flash.parentNode) {
                flash.style.opacity = '0';
                setTimeout(function () {
                    if (flash.parentNode) flash.remove();
                }, 300);
            }
        }, 5000);
    });

    // ─────────────────────────────────────────────────────────────
    // 4. Room Category Filter Interactivity
    // ─────────────────────────────────────────────────────────────
    const filterButtons = document.querySelectorAll('.rooms-filter-nav .filter-btn');
    const roomRows = document.querySelectorAll('.room-editorial-row');

    if (filterButtons.length > 0 && roomRows.length > 0) {
        filterButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetFilter = btn.getAttribute('data-filter');

                filterButtons.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');

                roomRows.forEach(function (row) {
                    const rowCategory = row.getAttribute('data-category');
                    if (targetFilter === 'all' || rowCategory === targetFilter) {
                        row.style.display = 'grid';
                        setTimeout(function () {
                            row.style.opacity = '1';
                            row.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(20px)';
                        setTimeout(function () {
                            row.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    // ─────────────────────────────────────────────────────────────
    // 5. Experiences Category Filter Interactivity
    // ─────────────────────────────────────────────────────────────
    const expFilterButtons = document.querySelectorAll('.filter-tab-btn');
    const expCategoryBlocks = document.querySelectorAll('.experience-category-block');

    if (expFilterButtons.length > 0) {
        expFilterButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetFilter = btn.getAttribute('data-filter');

                expFilterButtons.forEach(function (b) {
                    b.classList.remove('active');
                    b.setAttribute('aria-selected', 'false');
                });
                btn.classList.add('active');
                btn.setAttribute('aria-selected', 'true');

                if (targetFilter === 'all') {
                    expCategoryBlocks.forEach(function (block) {
                        block.style.display = 'block';
                        setTimeout(function () {
                            block.style.opacity = '1';
                        }, 50);
                    });
                } else {
                    expCategoryBlocks.forEach(function (block) {
                        const blockCat = block.getAttribute('data-category');
                        if (blockCat === targetFilter) {
                            block.style.display = 'block';
                            setTimeout(function () {
                                block.style.opacity = '1';
                            }, 50);
                            block.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        } else {
                            block.style.opacity = '0';
                            setTimeout(function () {
                                block.style.display = 'none';
                            }, 300);
                        }
                    });
                }
            });
        });
    }

});


