/**
 * Serona Hotel & Resort — Gallery JavaScript
 * Handles category filtering and Vanilla JS Fullscreen Lightbox Modal
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
    // ─────────────────────────────────────────────────────────────
    // 1. Gallery Category Filtering
    // ─────────────────────────────────────────────────────────────
    const filterButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryCards = document.querySelectorAll('.gallery-card');

    if (filterButtons.length > 0 && galleryCards.length > 0) {
        filterButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetFilter = btn.getAttribute('data-filter');

                // Update active tab state
                filterButtons.forEach(function (b) {
                    b.classList.remove('active');
                    b.setAttribute('aria-selected', 'false');
                });
                btn.classList.add('active');
                btn.setAttribute('aria-selected', 'true');

                // Filter cards with smooth fade
                galleryCards.forEach(function (card) {
                    const cardCat = card.getAttribute('data-category');
                    if (targetFilter === 'all' || cardCat === targetFilter) {
                        card.style.display = 'block';
                        setTimeout(function () {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(function () {
                            card.style.display = 'none';
                        }, 250);
                    }
                });
            });
        });
    }

    // ─────────────────────────────────────────────────────────────
    // 2. Fullscreen Lightbox Modal
    // ─────────────────────────────────────────────────────────────
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxBackdrop = document.getElementById('lightbox-backdrop');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCategory = document.getElementById('lightbox-category');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const closeBtn = document.getElementById('lightbox-close');
    const prevBtn = document.getElementById('lightbox-prev');
    const nextBtn = document.getElementById('lightbox-next');

    let visibleCards = [];
    let currentIndex = 0;
    let triggerElement = null;

    if (lightbox && galleryCards.length > 0) {
        // Collect currently visible cards for cycling
        function getVisibleCards() {
            return Array.from(galleryCards).filter(function (card) {
                return window.getComputedStyle(card).display !== 'none';
            });
        }

        // Open Lightbox at specific card index
        function openLightbox(cardIndex) {
            visibleCards = getVisibleCards();
            if (visibleCards.length === 0) return;

            if (cardIndex < 0) cardIndex = visibleCards.length - 1;
            if (cardIndex >= visibleCards.length) cardIndex = 0;

            currentIndex = cardIndex;
            const targetCard = visibleCards[currentIndex];

            const fullImg = targetCard.getAttribute('data-full-img');
            const title = targetCard.getAttribute('data-title');
            const caption = targetCard.getAttribute('data-caption');
            const category = targetCard.getAttribute('data-category-label');

            if (lightboxImg) {
                lightboxImg.src = fullImg;
                lightboxImg.alt = title || 'Gallery Image';
            }
            if (lightboxCategory) lightboxCategory.textContent = category || 'SERONA';
            if (lightboxTitle) lightboxTitle.textContent = title || '';
            if (lightboxCaption) lightboxCaption.textContent = caption || '';
            if (lightboxCounter) lightboxCounter.textContent = (currentIndex + 1) + ' of ' + visibleCards.length;

            lightbox.classList.add('open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            if (closeBtn) closeBtn.focus();
        }

        // Close Lightbox
        function closeLightbox() {
            lightbox.classList.remove('open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            if (triggerElement) {
                triggerElement.focus();
                triggerElement = null;
            }
        }

        // Previous Image
        function showPrev() {
            openLightbox(currentIndex - 1);
        }

        // Next Image
        function showNext() {
            openLightbox(currentIndex + 1);
        }

        // Event Listeners for Gallery Cards
        galleryCards.forEach(function (card) {
            card.addEventListener('click', function (e) {
                // If user clicked expand button or card itself
                triggerElement = document.activeElement || card;
                visibleCards = getVisibleCards();
                const idx = visibleCards.indexOf(card);
                if (idx !== -1) {
                    openLightbox(idx);
                }
            });

            card.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    triggerElement = card;
                    visibleCards = getVisibleCards();
                    const idx = visibleCards.indexOf(card);
                    if (idx !== -1) {
                        openLightbox(idx);
                    }
                }
            });
        });

        // Lightbox Control Listeners
        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
        if (lightboxBackdrop) lightboxBackdrop.addEventListener('click', closeLightbox);
        if (prevBtn) prevBtn.addEventListener('click', showPrev);
        if (nextBtn) nextBtn.addEventListener('click', showNext);

        // Keyboard Navigation (Escape, ArrowLeft, ArrowRight)
        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('open')) return;

            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                showPrev();
            } else if (e.key === 'ArrowRight') {
                showNext();
            }
        });
    }
});
