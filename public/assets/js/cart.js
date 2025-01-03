document.addEventListener('DOMContentLoaded', () => {
    // Add to Cart Function
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
if (!csrfToken) {
    console.error("CSRF token is missing.");
    return;
}
    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 }),
        })
        .then(response => {
            // تأكد من أن الاستجابة هي JSON
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const contentType = response.headers.get('Content-Type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Expected JSON response, but got ' + contentType);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert(data.message); // Show message after adding to cart
            updateCartCount(data.cartCount);
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            alert("Error: " + error.message); // Show more detailed error message
        });
        
    }

    // Update Cart Function
    function updateCart(productId, newQuantity, totalItemPriceEl) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: newQuantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Update Order Summary
            document.getElementById('subtotal').textContent = `JOD ${data.subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `JOD ${data.total.toFixed(2)}`;
            totalItemPriceEl.textContent = `JOD ${data.itemTotal.toFixed(2)}`;
            updateCartCount(data.cartCount); // تحديث عدد الكارت
        })
        .catch(error => console.error('Error updating cart:', error));
    }

    // Handle Quantity Updates
    const cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach(item => {
        const decreaseBtn = item.querySelector('.quantity-btn.decrease');
        const increaseBtn = item.querySelector('.quantity-btn.increase');
        const quantityInput = item.querySelector('.quantity-input');
        const totalItemPriceEl = item.querySelector('.total-item-price');
        const maxQuantity = parseInt(quantityInput.getAttribute('max'));
        const productId = item.dataset.productId;

        decreaseBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateCart(productId, quantity, totalItemPriceEl);
            }
        });

        increaseBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < maxQuantity) {
                quantity++;
                quantityInput.value = quantity;
                updateCart(productId, quantity, totalItemPriceEl);
            }
        });

        quantityInput.addEventListener('change', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 1) quantity = 1;
            if (quantity > maxQuantity) quantity = maxQuantity;
            quantityInput.value = quantity;
            updateCart(productId, quantity, totalItemPriceEl);
        });
    });

    // Remove Item from Cart Function
    function removeItem(productId, button, totalItemPriceEl) {
        fetch(`/cart/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove item from the cart UI
                button.closest('.cart-item').remove();
                // Update the order summary
                document.getElementById('subtotal').textContent = `JOD ${data.subtotal.toFixed(2)}`;
                document.getElementById('total').textContent = `JOD ${data.total.toFixed(2)}`;
                updateCartCount(data.cartCount); // تحديث عدد الكارت
            } else {
                alert("Failed to remove item. Please try again.");
            }
        })
        .catch(error => console.error('Error removing item:', error));
    }

    // Handle Item Removal
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.productId;
            if (confirm("Are you sure you want to remove this item from the cart?")) {
                const totalItemPriceEl = button.closest('.cart-item').querySelector('.total-item-price');
                removeItem(productId, button, totalItemPriceEl);
            }
        });
    });

    // Add to Cart Event Listeners
    const addToCartButtons = document.querySelectorAll('.ep-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.productId; // Get product ID from data attribute
            addToCart(productId); // Call addToCart function
        });
    });

    function updateCartCount(newCount) {
        const cartCountEl = document.querySelector('.cart-count');
        if (cartCountEl) {
            cartCountEl.textContent = newCount; // تحديث النص بالعدد الجديد
        }
    }
    
});
