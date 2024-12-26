<!-- resources/views/theme/partials/quick-view-modal.blade.php -->
<div class="modal fade" id="quickView" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/img/cancel.png') }}" alt="Close"
                        class="img-fluid" /></span>
            </button>
            <div class="modal-body">
                <div class="quick-view-content single-product-page-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel" id="quickViewImages"></div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                            <div class="product-details">
                                <h2 id="quickViewTitle"></h2>
                                <div id="quickViewRating" class="rating"></div>
                                <span id="quickViewPrice" class="price"></span>
                                <div class="product-info-stock-sku">
                                    <span id="quickViewStock" class="product-stock-status"></span>
                                    <span id="quickViewSku" class="product-sku-status ml-5"></span>
                                </div>
                                <p id="quickViewDescription" class="products-desc"></p>
                                <div id="quickViewColors" class="shopping-option-item"></div>
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" min="1" max="100" value="1" />
                                    </div>
                                    <button id="quickViewAddToCart" class="btn btn-add-to-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>