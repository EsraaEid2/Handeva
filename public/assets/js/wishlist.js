function addToWishlist(productId) {
    console.log('esraa');
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
    })
    .catch(error => {
        console.error('Error:', error); // تصحيح الخطأ هنا
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while adding to the wishlist.',
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Handle remove from wishlist
    document.querySelectorAll('.btn-remove-wishlist').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            let productId = this.getAttribute('data-id');

            fetch(`/wishlist/remove/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.closest('tr').remove(); // Remove the item from the table
                    Swal.fire('Deleted!', 'Product removed from wishlist.', 'success');
                } else {
                    Swal.fire('Oops...', 'Failed to remove product.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while removing the product.', 'error');
            });
        });
    });

    // Handle add to wishlist
    document.querySelectorAll('.ep-btn-wishlist').forEach(function (button) {
        button.addEventListener('click', function () {
            let productId = this.getAttribute('data-product-id');
            addToWishlist(productId); 
        });
    });
});
