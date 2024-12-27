// Initialize the carousel with three images
$('#quickView').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var product = button.data('product');
    var images = product.images;

    var carousel = $('#quickViewImages');
    carousel.empty();

    images.forEach(function(image) {
        carousel.append('<div class="item"><img src="' + image.url + '" alt="Product Image"></div>');
    });

    // Initialize the carousel
    carousel.owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });

    // Set other product details
    $('#quickViewTitle').text(product.title);
    $('#quickViewRating').html(generateRatingStars(product.avg_rating));
    $('#quickViewPrice').text('JOD ' + product.price);
    $('#quickViewStock').text(product.stock > 0 ? 'In Stock' : 'Out of Stock');
    $('#quickViewSku').text('SKU: ' + product.sku);
    $('#quickViewDescription').text(product.description);
    $('#quickViewAddToCart').data('product-id', product.id);
});

function generateRatingStars(rating) {
    var stars = '';
    for (var i = 1; i <= 5; i++) {
        stars += '<span class="star ' + (i <= rating ? 'filled' : '') + '">&#9733;</span>';
    }
    return stars;
}
