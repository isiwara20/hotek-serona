/**
 * SERONA HOTEL & RESORT — Admin Interactive Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Sidebar Toggle
    const sidebarToggleBtn = document.getElementById('sidebar-toggle');
    const adminLayout = document.getElementById('admin-layout');
    const adminSidebar = document.getElementById('admin-sidebar');

    if (sidebarToggleBtn && adminSidebar) {
        sidebarToggleBtn.addEventListener('click', () => {
            adminSidebar.classList.toggle('collapsed');
            if (adminLayout) {
                adminLayout.classList.toggle('sidebar-collapsed');
            }
        });
    }

    // Generic Modal Helper Function
    function setupModal(modalOverlayId, openBtns, closeBtnIds, fillCallback) {
        const overlay = document.getElementById(modalOverlayId);
        if (!overlay) return;

        function open() {
            overlay.classList.add('active');
            overlay.setAttribute('aria-hidden', 'false');
        }

        function close() {
            overlay.classList.remove('active');
            overlay.setAttribute('aria-hidden', 'true');
        }

        openBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                if (fillCallback) fillCallback(btn);
                open();
            });
        });

        closeBtnIds.forEach((id) => {
            const btn = document.getElementById(id);
            if (btn) btn.addEventListener('click', close);
        });

        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) close();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && overlay.classList.contains('active')) close();
        });
    }

    // 2. Booking Status Modal
    const statusModalOverlay = document.getElementById('status-modal-overlay');
    if (statusModalOverlay) {
        setupModal(
            'status-modal-overlay',
            document.querySelectorAll('.open-status-modal'),
            ['close-modal-btn', 'cancel-modal-btn'],
            (btn) => {
                document.getElementById('modal-booking-id').value = btn.getAttribute('data-id') || '';
                document.getElementById('modal-booking-ref').value = btn.getAttribute('data-ref') || '';
                document.getElementById('modal-guest-name').value = btn.getAttribute('data-guest') || '';
                document.getElementById('modal-status-select').value = btn.getAttribute('data-status') || 'NEW';
                document.getElementById('modal-admin-notes').value = btn.getAttribute('data-notes') || '';
            }
        );
    }

    // 3. Room Modal (Add / Edit)
    const roomModalOverlay = document.getElementById('room-modal-overlay');
    if (roomModalOverlay) {
        const openAddRoomBtn = document.getElementById('open-add-room-modal');
        if (openAddRoomBtn) {
            openAddRoomBtn.addEventListener('click', () => {
                document.getElementById('room-modal-title').textContent = 'Add New Room';
                document.getElementById('room-id').value = '';
                document.getElementById('room-name').value = '';
                document.getElementById('room-slug').value = '';
                document.getElementById('room-short-desc').value = '';
                if (document.getElementById('room-category')) document.getElementById('room-category').value = 'rooms';
                document.getElementById('room-capacity').value = '2';
                document.getElementById('room-bed-type').value = 'King Bed';
                document.getElementById('room-size').value = '45 sqm';
                document.getElementById('room-status').value = 'AVAILABLE';
                document.getElementById('room-featured').checked = false;
            });
        }

        setupModal(
            'room-modal-overlay',
            [...(openAddRoomBtn ? [openAddRoomBtn] : []), ...document.querySelectorAll('.edit-room-btn')],
            ['close-room-modal', 'cancel-room-modal'],
            (btn) => {
                if (btn.classList.contains('edit-room-btn')) {
                    document.getElementById('room-modal-title').textContent = 'Edit Room Details';
                    document.getElementById('room-id').value = btn.getAttribute('data-id') || '';
                    document.getElementById('room-name').value = btn.getAttribute('data-name') || '';
                    document.getElementById('room-slug').value = btn.getAttribute('data-slug') || '';
                    document.getElementById('room-short-desc').value = btn.getAttribute('data-desc') || '';
                    if (document.getElementById('room-category')) document.getElementById('room-category').value = btn.getAttribute('data-category') || 'rooms';
                    document.getElementById('room-capacity').value = btn.getAttribute('data-capacity') || '2';
                    document.getElementById('room-bed-type').value = btn.getAttribute('data-bed') || 'King Bed';
                    document.getElementById('room-size').value = btn.getAttribute('data-size') || '45 sqm';
                    document.getElementById('room-status').value = btn.getAttribute('data-status') || 'AVAILABLE';
                    document.getElementById('room-featured').checked = btn.getAttribute('data-featured') === '1';
                }
            }
        );
    }

    // 4. Dining Modal (Add / Edit)
    const diningModalOverlay = document.getElementById('dining-modal-overlay');
    if (diningModalOverlay) {
        const openAddDiningBtn = document.getElementById('open-add-dining-modal');
        setupModal(
            'dining-modal-overlay',
            [...(openAddDiningBtn ? [openAddDiningBtn] : []), ...document.querySelectorAll('.edit-dining-btn')],
            ['close-dining-modal', 'cancel-dining-modal'],
            (btn) => {
                if (btn.classList.contains('edit-dining-btn')) {
                    document.getElementById('dining-modal-title').textContent = 'Edit Meal Details';
                    document.getElementById('dining-id').value = btn.getAttribute('data-id') || '';
                    document.getElementById('dining-name').value = btn.getAttribute('data-name') || '';
                    document.getElementById('dining-category').value = btn.getAttribute('data-category') || 'Breakfast';
                    if (document.getElementById('dining-price')) document.getElementById('dining-price').value = btn.getAttribute('data-price') || '$18.00';
                    document.getElementById('dining-desc').value = btn.getAttribute('data-desc') || '';
                    document.getElementById('dining-active').checked = btn.getAttribute('data-active') === '1';
                } else {
                    document.getElementById('dining-modal-title').textContent = 'Add New Meal';
                    document.getElementById('dining-id').value = '';
                    document.getElementById('dining-name').value = '';
                    document.getElementById('dining-category').value = 'Breakfast';
                    if (document.getElementById('dining-price')) document.getElementById('dining-price').value = '$18.00';
                    document.getElementById('dining-desc').value = '';
                    document.getElementById('dining-active').checked = true;
                }
            }
        );
    }

    // 5. Experience Modal (Add / Edit)
    const expModalOverlay = document.getElementById('exp-modal-overlay');
    if (expModalOverlay) {
        const openAddExpBtn = document.getElementById('open-add-exp-modal');
        setupModal(
            'exp-modal-overlay',
            [...(openAddExpBtn ? [openAddExpBtn] : []), ...document.querySelectorAll('.edit-exp-btn')],
            ['close-exp-modal', 'cancel-exp-modal'],
            (btn) => {
                if (btn.classList.contains('edit-exp-btn')) {
                    document.getElementById('exp-modal-title').textContent = 'Edit Experience';
                    document.getElementById('exp-id').value = btn.getAttribute('data-id') || '';
                    document.getElementById('exp-name').value = btn.getAttribute('data-name') || '';
                    document.getElementById('exp-desc').value = btn.getAttribute('data-desc') || '';
                    document.getElementById('exp-active').checked = true;
                } else {
                    document.getElementById('exp-modal-title').textContent = 'Add Experience';
                    document.getElementById('exp-id').value = '';
                    document.getElementById('exp-name').value = '';
                    document.getElementById('exp-desc').value = '';
                    document.getElementById('exp-active').checked = true;
                }
            }
        );
    }

    // 6. Gallery Modal (Add / Edit)
    const galleryModalOverlay = document.getElementById('gallery-modal-overlay');
    if (galleryModalOverlay) {
        const openAddGalleryBtn = document.getElementById('open-add-gallery-modal');
        setupModal(
            'gallery-modal-overlay',
            [...(openAddGalleryBtn ? [openAddGalleryBtn] : []), ...document.querySelectorAll('.edit-gallery-btn')],
            ['close-gallery-modal', 'cancel-gallery-modal'],
            (btn) => {
                if (btn.classList.contains('edit-gallery-btn')) {
                    document.getElementById('gallery-modal-title').textContent = 'Edit Gallery Caption';
                    document.getElementById('gallery-id').value = btn.getAttribute('data-id') || '';
                    document.getElementById('gallery-caption').value = btn.getAttribute('data-caption') || '';
                    document.getElementById('gallery-category').value = btn.getAttribute('data-category') || 'rooms';
                    document.getElementById('gallery-active').checked = true;
                } else {
                    document.getElementById('gallery-modal-title').textContent = 'Add Gallery Photo';
                    document.getElementById('gallery-id').value = '';
                    document.getElementById('gallery-caption').value = '';
                    document.getElementById('gallery-category').value = 'rooms';
                    document.getElementById('gallery-active').checked = true;
                }
            }
        );
    }

    // 7. Table Filter Pills (Bookings Page)
    const filterPills = document.querySelectorAll('.filter-pill');
    const bookingRows = document.querySelectorAll('#bookings-table tbody tr');

    filterPills.forEach((pill) => {
        pill.addEventListener('click', () => {
            const filterValue = pill.getAttribute('data-filter');

            filterPills.forEach((p) => p.classList.remove('active'));
            pill.classList.add('active');

            bookingRows.forEach((row) => {
                const rowStatus = row.getAttribute('data-status');
                if (filterValue === 'all' || rowStatus === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
