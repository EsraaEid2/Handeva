<table class="table">
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
            <td>{{ $order->product->title }}</td>
            <td>{{ $order->custom_type }}</td>
            <td>
                @foreach ($order->customizationOptions as $option)
                <p>{{ $option->option_value }}</p>
                @endforeach
            </td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>