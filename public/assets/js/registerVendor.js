document.addEventListener('DOMContentLoaded', function () {
    const vendorRadio = document.querySelector('input[name="is_pending_vendor"][value="1"]');
    const customerRadio = document.querySelector('input[name="is_pending_vendor"][value="0"]');
    const phoneField = document.getElementById('phone-field');

    // Listen for changes on the radio buttons
    vendorRadio.addEventListener('change', () => {
        if (vendorRadio.checked) {
            phoneField.style.display = 'block';
        }
    });

    customerRadio.addEventListener('change', () => {
        if (customerRadio.checked) {
            phoneField.style.display = 'none';
        }
    });
});

