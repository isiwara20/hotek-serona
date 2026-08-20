/**
 * Serona Hotel & Resort — Form Validation & FAQ Interactivity
 * Handles client-side contact form validation, character counter,
 * submit loading states, and FAQ accordion toggles.
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // ─────────────────────────────────────────────────────────────
    // 1. FAQ Accordion Toggle Interactivity
    // ─────────────────────────────────────────────────────────────
    const faqTriggers = document.querySelectorAll('.faq-trigger');

    if (faqTriggers.length > 0) {
        faqTriggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                const faqItem = trigger.closest('.faq-item');
                const faqContent = trigger.nextElementSibling;
                const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

                // Close other open FAQ items for accordion behavior
                document.querySelectorAll('.faq-item').forEach(function (item) {
                    if (item !== faqItem) {
                        item.classList.remove('active');
                        const otherTrigger = item.querySelector('.faq-trigger');
                        const otherContent = item.querySelector('.faq-content');
                        if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                        if (otherContent) otherContent.hidden = true;
                    }
                });

                // Toggle current FAQ item
                if (isExpanded) {
                    faqItem.classList.remove('active');
                    trigger.setAttribute('aria-expanded', 'false');
                    if (faqContent) faqContent.hidden = true;
                } else {
                    faqItem.classList.add('active');
                    trigger.setAttribute('aria-expanded', 'true');
                    if (faqContent) faqContent.hidden = false;
                }
            });
        });
    }

    // ─────────────────────────────────────────────────────────────
    // 2. Contact Form Client-Side Validation & Interactions
    // ─────────────────────────────────────────────────────────────
    const contactForm = document.getElementById('contact-form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    const charCountEl = document.getElementById('char-count');
    const submitBtn = document.getElementById('contact-submit-btn');

    // Real-time Message Character Counter
    if (messageInput && charCountEl) {
        const updateCharCount = function () {
            const length = messageInput.value.length;
            charCountEl.textContent = length + ' / 2000';

            if (length > 1900) {
                charCountEl.style.color = '#d9534f';
            } else {
                charCountEl.style.color = 'var(--color-text-muted)';
            }
        };

        messageInput.addEventListener('input', updateCharCount);
        updateCharCount();
    }

    // Helper functions for field error display
    const showError = function (inputEl, errorEl, message) {
        if (inputEl) {
            inputEl.style.borderColor = '#d9534f';
            inputEl.classList.add('invalid');
        }
        if (errorEl) {
            errorEl.textContent = message;
        }
    };

    const clearError = function (inputEl, errorEl) {
        if (inputEl) {
            inputEl.style.borderColor = '';
            inputEl.classList.remove('invalid');
        }
        if (errorEl) {
            errorEl.textContent = '';
        }
    };

    const isValidEmail = function (email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email.toLowerCase());
    };

    // Live validation on blur
    if (nameInput) {
        nameInput.addEventListener('blur', function () {
            const nameErr = document.getElementById('name-error');
            if (nameInput.value.trim().length < 2) {
                showError(nameInput, nameErr, 'Please enter your full name (at least 2 characters).');
            } else {
                clearError(nameInput, nameErr);
            }
        });
    }

    if (emailInput) {
        emailInput.addEventListener('blur', function () {
            const emailErr = document.getElementById('email-error');
            if (!isValidEmail(emailInput.value.trim())) {
                showError(emailInput, emailErr, 'Please enter a valid email address.');
            } else {
                clearError(emailInput, emailErr);
            }
        });
    }

    if (messageInput) {
        messageInput.addEventListener('blur', function () {
            const msgErr = document.getElementById('message-error');
            if (messageInput.value.trim().length < 10) {
                showError(messageInput, msgErr, 'Your message must be at least 10 characters.');
            } else {
                clearError(messageInput, msgErr);
            }
        });
    }

    // Form Submit Handler
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            let isValid = true;

            const nameErr = document.getElementById('name-error');
            const emailErr = document.getElementById('email-error');
            const msgErr = document.getElementById('message-error');

            // Validate Name
            if (nameInput && nameInput.value.trim().length < 2) {
                showError(nameInput, nameErr, 'Please enter your full name (at least 2 characters).');
                isValid = false;
            } else if (nameInput) {
                clearError(nameInput, nameErr);
            }

            // Validate Email
            if (emailInput && !isValidEmail(emailInput.value.trim())) {
                showError(emailInput, emailErr, 'Please enter a valid email address.');
                isValid = false;
            } else if (emailInput) {
                clearError(emailInput, emailErr);
            }

            // Validate Message
            if (messageInput && messageInput.value.trim().length < 10) {
                showError(messageInput, msgErr, 'Your message must be at least 10 characters.');
                isValid = false;
            } else if (messageInput) {
                clearError(messageInput, msgErr);
            }

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstInvalid = contactForm.querySelector('.invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
                return false;
            }

            // Show Loading Spinner State on Submit Button
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin" aria-hidden="true"></i> Sending Message...';
            }
        });
    }

});
