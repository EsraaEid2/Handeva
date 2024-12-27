<div class="modal fade ep-quick-view-modal" id="quickView" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/img/cancel.png') }}" alt="Close"
                        class="img-fluid" /></span>
            </button>
            <div class="modal-body">
                <div class="ep-quick-view-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="ep-product-thumbnail-wrap">
                                <div class="ep-product-thumb-carousel owl-carousel" id="quickViewImages">
                                    <!-- Carousel items will be injected here -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                            <div class="ep-product-details">
                                <h2 id="quickViewTitle" class="ep-product-title"></h2>
                                <div id="quickViewRating" class="ep-rating"></div>
                                <span id="quickViewPrice" class="ep-price"></span>
                                <div class="ep-product-info-stock-sku">
                                    <span id="quickViewStock" class="ep-product-stock-status"></span>
                                    <span id="quickViewSku" class="ep-product-sku-status ml-5"></span>
                                </div>
                                <p id="quickViewDescription" class="ep-products-desc"></p>
                                <div id="quickViewColors" class="ep-shopping-option-item"></div>
                                <div class="ep-product-quantity d-flex align-items-center">
                                    <div class="ep-quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" min="1" max="100" value="1" />
                                    </div>
                                    <button id="quickViewAddToCart" class="btn ep-btn-add-to-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
</script>