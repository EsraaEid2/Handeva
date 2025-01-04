document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('product-upload-form');
    const steps = document.querySelectorAll('.vd-step-content');
    const progressSteps = document.querySelectorAll('.vd-step');
    const nextBtn = document.querySelector('.vd-btn-next');
    const prevBtn = document.querySelector('.vd-btn-prev');
    const submitBtn = document.querySelector('.vd-submit-btn');
    let currentStep = 1;

    // Hide all steps except the first
    steps.forEach((step, index) => {
        step.style.display = index === 0 ? 'block' : 'none';
    });

    nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            if (currentStep < steps.length) {
                steps[currentStep - 1].style.display = 'none';
                steps[currentStep].style.display = 'block';
                updateStep(currentStep + 1);
            }
        } else {
            alert('Please complete all required fields before proceeding.');
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            document.querySelector(`[data-step="${currentStep}"] .vd-input-error`)?.classList.remove('vd-input-error');
            steps[currentStep - 1].style.display = 'none';
            steps[currentStep - 2].style.display = 'block';
            updateStep(currentStep - 1);
        }
    });

    function updateStep(step) {
        progressSteps[currentStep - 1].classList.remove('active');
        if (currentStep < step) {
            progressSteps[currentStep - 1].classList.add('completed');
        } else {
            progressSteps[currentStep - 1].classList.remove('completed');
        }
        progressSteps[step - 1].classList.add('active');

        currentStep = step;

        prevBtn.style.display = currentStep === 1 ? 'none' : 'block';
        nextBtn.style.display = currentStep === steps.length ? 'none' : 'block';
        submitBtn.style.display = currentStep === steps.length ? 'block' : 'none';
    }

    function validateStep(step) {
        const currentInputs = document.querySelector(`[data-step="${step}"]`).querySelectorAll('[required]');
        let isValid = true;

        currentInputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('vd-input-error');
            } else {
                input.classList.remove('vd-input-error');
            }
        });

        if (step === steps.length) {
            const fileInput = form.querySelector('input[name="images[]"]');
            if (fileInput && !fileInput.files.length) {
                isValid = false;
                alert('Please upload at least one image.');
            }
        }

        return isValid;
    }

    const isCustomizableCheckbox = document.getElementById('is_customizable');
    const customizationSection = document.getElementById('customization-section');
    const customizationSelect = document.getElementById('customization_id');

    function toggleCustomizationSection() {
        if (isCustomizableCheckbox.checked) {
            customizationSection.style.display = 'block';
            customizationSelect.required = true;
        } else {
            customizationSection.style.display = 'none';
            customizationSelect.required = false;
            customizationSelect.value = ''; // Clear selection if not customizable
        }
    }

    isCustomizableCheckbox.addEventListener('change', toggleCustomizationSection);
    toggleCustomizationSection(); // Initial check
});
