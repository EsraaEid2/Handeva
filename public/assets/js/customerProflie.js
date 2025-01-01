document.addEventListener('DOMContentLoaded', function () {
    // Tab switching functionality
    const menuLinks = document.querySelectorAll('.profile-tab-menu a');
    const sections = document.querySelectorAll('.profile-section');

    // Initially hide all sections except dashboard
    sections.forEach(section => {
        if (section.id !== 'dashboard') {
            section.style.display = 'none';
        }
    });

    menuLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove active class from all links
            menuLinks.forEach(l => l.classList.remove('active'));

            // Add active class to clicked link
            this.classList.add('active');

            // Hide all sections
            sections.forEach(section => section.style.display = 'none');

            // Show target section
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });

    // Modal functionality for orders
    const viewOrderButtons = document.querySelectorAll('.view-order-btn');
    
    viewOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');
            const modalId = `orderModal${orderId}`;
            const modal = document.getElementById(modalId);
            
            if (modal) {
                const bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();
            }
        });
    });

    // Account Details Functionality
    const editBtn = document.getElementById('editPersonalInfo');
    const cancelBtn = document.getElementById('cancelPersonalInfo');
    const personalInfoForm = document.getElementById('personalInfoForm');
    const formInputs = personalInfoForm ? personalInfoForm.querySelectorAll('input') : [];
    const actionButtons = document.getElementById('personalInfoButtons');

    // Store original values for cancel functionality
    let originalValues = {};

    // Edit button click handler
    if (editBtn) {
        editBtn.addEventListener('click', function() {
            // Store original values
            formInputs.forEach(input => {
                originalValues[input.name] = input.value;
                input.disabled = false;
            });
            
            actionButtons.style.display = 'block';
            editBtn.style.display = 'none';
        });
    }

    // Cancel button click handler
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            // Restore original values
            formInputs.forEach(input => {
                input.value = originalValues[input.name];
                input.disabled = true;
            });
            
            actionButtons.style.display = 'none';
            editBtn.style.display = 'block';
        });
    }

    // Personal Info Form Submit
    if (personalInfoForm) {
        personalInfoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your profile has been updated.',
                        icon: 'success'
                    });
                    
                    // Disable inputs and hide action buttons
                    formInputs.forEach(input => input.disabled = true);
                    actionButtons.style.display = 'none';
                    editBtn.style.display = 'block';
                } else {
                    throw new Error(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Save Changes';
            });
        });
    }

    // Password Form Submit
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Updating...';

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your password has been updated.',
                        icon: 'success'
                    });
                    this.reset();
                } else {
                    throw new Error(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Update Password';
            });
        });
    }
});