
document.getElementById('is_customizable').addEventListener('change', function () {
    const customizationSection = document.getElementById('customization-section');
    if (this.checked) {
        customizationSection.style.display = 'block';
    } else {
        customizationSection.style.display = 'none';
    }
});
