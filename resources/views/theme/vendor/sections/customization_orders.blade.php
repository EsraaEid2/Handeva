<div class="custom-orders-container">
    <table class="custom-orders-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Customization Type</th>
                <th>Options</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($custom_orders as $order)
            <tr>
                <td data-label="Product">
                    <span class="product-title">{{ $order->product->title }}</span>
                </td>
                <td data-label="Customization Type">
                    <span class="custom-type">{{ $order->custom_type }}</span>
                </td>
                <td data-label="Options">
                    <div class="options-list">
                        @foreach ($order->customizationOptions as $option)
                        <span class="option-item">{{ $option->option_value }}</span>
                        @endforeach
                    </div>
                </td>
                <td data-label="Status">
                    <span class="status-badge">{{ $order->status }}</span>
                </td>
                <td data-label="Order Date">
                    <span class="order-date">{{ $order->created_at->format('Y-m-d') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>