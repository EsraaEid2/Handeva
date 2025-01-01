<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <img src="{{ asset('assets') }}/img/HandevaLogo.png" alt="Logo" class="img-fluid" />
            <h2>Order Success!</h2>
        </div>
        <div class="modal-body">
            <p>Thank you for your order, <strong>{{ auth()->user()->first_name }}</strong>! 💖</p>
            <p>Your order has been placed successfully and is being processed.</p>
            <p>We will contact you soon for delivery details.</p>
        </div>
        <div class="modal-footer">
            <a href="{{ route('user.home') }}" class="btn btn-primary">Back to Home</a>
            <a href="{{ route('user.home', ['order_id' => $order->id]) }}" class="btn btn-secondary">View Order</a>
        </div>
    </div>
</div>
<!-- Success Modal Script -->
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = '{{ session('
    success ') }}'; // تحقق من وجود رسالة نجاح في الجلسة

    if (successMessage) {
        const modal = document.getElementById('successModal');
        modal.style.display = 'flex'; // عرض المودال
    }

    // إغلاق المودال عند الضغط على الزر Close أو النقر خارج المودال
    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none'; // إخفاء المودال عند النقر خارج المحتوى
        }
    });
});
</script>
@endif