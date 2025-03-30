<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .receipt-container {
            max-width: 500px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #ddd;
        }
        .header h2 {
            color: #333;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            color: #666;
        }
        .order-details {
            text-align: left;
            padding: 15px 0;
        }
        .order-details li {
            padding: 6px 0;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .items-table th, .items-table td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }
        .items-table th {
            background: #f8f8f8;
            color: #444;
            font-weight: 600;
        }
        .total-container {
            margin-top: 15px;
            text-align: right;
        }
        .total-container p {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <h2>Order Receipt</h2>
            <p>Thank you for your purchase, <strong>{{ $order->user->name }}</strong>!</p>
        </div>
        
        <ul class="order-details">
            <li><strong>Order ID:</strong> {{ $order->id }}</li>
            <li><strong>Date:</strong> {{ date('F d, Y', strtotime($order->created_at)) }}</li>
            <li><strong>Delivery Address:</strong> {{ $order->delivery_address }}</li>
            <li><strong>Status:</strong> {{ ucfirst($order->status) }}</li>
        </ul>

        <h3>Order Items</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-container">
            <p>Subtotal: RM {{ number_format($order->total_price - 3, 2) }}</p>
            <p>Delivery Fee: RM 3.00</p>
            <p><strong>Total Paid: RM {{ number_format($order->total_price, 2) }}</strong></p>
        </div>
        
        <div class="footer">
            <p>If you have any questions, please contact our support team.</p>
            <p>&copy; {{ date('Y') }} CareBitee</p>
        </div>
    </div>
</body>
</html>
