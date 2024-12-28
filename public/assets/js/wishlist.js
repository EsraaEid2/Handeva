document.addEventListener('DOMContentLoaded', function () {
    // الاستماع للضغط على زر إضافة إلى القائمة
    const wishlistButtons = document.querySelectorAll('.add-to-wishlist');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();  // منع التصرف الافتراضي (الانتقال للرابط)
            const productId = this.getAttribute('data-product-id'); // الحصول على معرف المنتج
            addToWishlist(productId); // استدعاء الدالة الخاصة بإضافة المنتج
        });
    });

    // الاستماع للضغط على زر الحذف
    const removeButtons = document.querySelectorAll('.remove-from-wishlist');
    removeButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();  // منع التصرف الافتراضي (الانتقال للرابط)
            const productId = this.getAttribute('data-product-id'); // الحصول على معرف المنتج
            removeFromWishlist(productId); // استدعاء دالة الحذف
        });
    });
});

// دالة إضافة المنتج إلى الويش ليست
function addToWishlist(productId) {
    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            icon: data.success ? 'success' : 'error',
            title: data.success ? 'Added!' : 'Oops...',
            text: data.message,
        });

        // تحديث العدد في الـ UI إذا تمت الإضافة بنجاح
        if (data.success) {
            document.querySelector('.wishlist-count').textContent = data.wishlistCount;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while adding to the wishlist.',
        });
    });
}

// دالة حذف المنتج من الويش ليست
function removeFromWishlist(productId) {
    console.log('Removing product with ID:', productId);


fetch(`/wishlist/remove/${productId}`, { 
    method: 'DELETE',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
})

    
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            icon: data.success ? 'success' : 'error',
            title: data.success ? 'Removed!' : 'Oops...',
            text: data.message,
        });

        // إذا تم حذف المنتج بنجاح، نقوم بتحديث العدد في الـ UI
        if (data.success) {
            document.querySelector('.wishlist-count').textContent = data.wishlistCount;

            // حذف العنصر من واجهة المستخدم
            const productRow = document.querySelector(`[data-product-id="${productId}"]`).closest('tr');
            productRow.remove();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while removing from the wishlist.',
        });
    });
}
