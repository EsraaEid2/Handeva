<div id="products-list" class="shop-page-products-wrap">
    <div class="products-wrapper products-gird">
        @foreach($products as $product)
        @if($product->is_visible)
        <div class="single-product-item">
            @include('theme.partials.product_card')
        </div>
        @endif
        @endforeach
    </div>
    <div class="page-pagination">
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