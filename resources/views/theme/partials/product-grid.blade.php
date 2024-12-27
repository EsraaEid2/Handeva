<div class="shop-page-products-wrap">
    <div class="products-wrapper">
        <div class="row">
            @foreach($products as $product)
            @if($product->is_visible)
            <div class="col-lg-4 col-sm-6">
                @include('theme.partials.product_card')
            </div>
            @endif
            @endforeach
        </div>
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