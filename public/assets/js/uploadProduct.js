document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('product-upload-form');
    const steps = document.querySelectorAll('.vd-step-content');
    const progressSteps = document.querySelectorAll('.vd-step');
    const nextBtn = document.querySelector('.vd-btn-next');
    const prevBtn = document.querySelector('.vd-btn-prev');
    const submitBtn = document.querySelector('.vd-submit-btn');
    let currentStep = 1;

    // Hide all steps except first
    steps.forEach((step, index) => {
        if (index !== 0) step.style.display = 'none';
    });

    nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            if (currentStep < steps.length) {
                steps[currentStep - 1].style.display = 'none';
                steps[currentStep].style.display = 'block';
                updateStep(currentStep + 1);
            }
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            steps[currentStep - 1].style.display = 'none';
            steps[currentStep - 2].style.display = 'block';
            updateStep(currentStep - 1);
        }
    });

    function updateStep(step) {
        // Remove active class from current step indicator
        progressSteps[currentStep - 1].classList.remove('active');
        // Add completed class to previous step
        if (currentStep < step) {
            progressSteps[currentStep - 1].classList.add('completed');
        } else {
            progressSteps[currentStep - 1].classList.remove('completed');
        }
        // Add active class to new step indicator
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
        
        return isValid;
    }

    document.getElementById('is_customizable').addEventListener('change', function() {
        const customizationSection = document.getElementById('customization-section');
        customizationSection.style.display = this.checked ? 'block' : 'none';
    });
});