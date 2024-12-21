function previewProfileImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('profilePreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
document.getElementById('is_customizable').addEventListener('change', function () {
    const customizationSection = document.getElementById('customization-section');
    if (this.checked) {
        customizationSection.style.display = 'block';
    } else {
        customizationSection.style.display = 'none';
    }
});
