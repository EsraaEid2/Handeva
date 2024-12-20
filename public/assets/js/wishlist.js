function addToWishlist(productId) {
    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message); // Show success message
        } else {
            alert(data.message); // Show failure message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding to the wishlist.');
    });
}

 // Wait for the DOM to be ready
 document.addEventListener('DOMContentLoaded', function() {
    // Listen for click events on the remove buttons
    document.querySelectorAll('.btn-remove-wishlist').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action (page reload)
            
            let productId = this.getAttribute('data-id'); // Get product id from data attribute
            
            // Send AJAX request to remove the product
            fetch('/wishlist/remove/' + productId, {
                method: 'DELETE', // Use DELETE method for removing
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF Token
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If successful, remove the product row from the table
                    this.closest('tr').remove();
                    alert('Product removed from wishlist!');
                } else {
                    alert('Failed to remove product.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while removing the product.');
            });
        });
    });
});
