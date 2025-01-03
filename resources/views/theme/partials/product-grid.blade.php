<div id="custom-products-list" class="custom-shop-page-products-wrap">
    <div class="custom-products-wrapper custom-products-grid">
        @foreach($products as $product)
        @if($product->is_visible)
        <div class="custom-single-product-item">
            @include('theme.partials.product_card')
        </div>
        @endif
        @endforeach
    </div>
    <div class="custom-page-pagination">
        {{ $products->links() }}
    </div>
</div>

<script>
document.getElementById('decrease-qty').addEventListener('click', function() {
    var qtyInput = document.getElementById('qty');
    if (qtyInput.value > 1) {
        qtyInput.value--;
    }
});

document.getElementById('increase-qty').addEventListener('click', function() {
    var qtyInput = document.getElementById('qty');
    if (qtyInput.value < qtyInput.max) {
        qtyInput.value++;
    }
});
</script>