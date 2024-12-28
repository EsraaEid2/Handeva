document.addEventListener('DOMContentLoaded', function () {
    // الاستماع للضغط على زر "إضافة إلى السلة"
    const addToCartButtons = document.querySelectorAll('.ep-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // منع التصرف الافتراضي (الانتقال للرابط)

            const productId = this.getAttribute('data-product-id'); // الحصول على معرف المنتج
            const quantityInput = this.closest('.ep-product-quantity')?.querySelector('#qty'); // العثور على حقل الكمية داخل العنصر نفسه
            let quantity = quantityInput ? quantityInput.value : 1; // إذا كانت الكمية موجودة نأخذها، وإلا نضع القيمة الافتراضية 1

            // التأكد من أن الكمية هي عدد صحيح أكبر من 0
            quantity = Math.max(1, parseInt(quantity) || 1);

            addToCart(productId, quantity); // استدعاء دالة إضافة المنتج إلى الكارت
        });
    });
});

// دالة إضافة المنتج إلى الكارت
function addToCart(productId, quantity) {
    const url = document.querySelector('meta[name="cart-add-route"]').content; // استخدام الميتا تاج للحصول على الرابط
console.log(url);

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            icon: data.success ? 'success' : 'error',
            title: data.success ? 'Added to Cart!' : 'Oops...',
            text: data.message,
        });

        // تحديث العدد في الـ UI إذا تمت الإضافة بنجاح
        if (data.success) {
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = data.cartCount;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while adding to the cart.',
        });
    });
}
