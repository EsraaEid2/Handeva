
    // Get all the stars
    const stars = document.querySelectorAll('#stars i');
    const starsInput = document.getElementById('stars-input');

    // Add click event to each star
    stars.forEach(star => {
        star.addEventListener('click', function () {
            let rating = this.getAttribute('data-index');
            setRating(rating);
        });
    });

    // Function to set the rating and update the star colors
    function setRating(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-index') <= rating) {
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill');
            } else {
                star.classList.remove('bi-star-fill');
                star.classList.add('bi-star');
            }
        });
        starsInput.value = rating; // Set the value in the hidden input
    }
