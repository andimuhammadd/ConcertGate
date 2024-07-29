<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #007bff;
        }

        h2 {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            font-size: 16px;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Dear {{ $order->firstname }} {{ $order->lastname }},</p>
        <p>Thank you for your order. Here are the details:</p>

        <h2>Order Summary</h2>
        <ul>
            <li><strong>Order ID:</strong> {{ $order->id }}</li>
            <li><strong>Order Date:</strong> {{ $order->created_at }}</li>
            <li><strong>Total Price:</strong> {{ $order->total_price }}</li>
        </ul>

        <h2>Customer Details</h2>
        <ul>
            <li><strong>Name:</strong> {{ $order->firstname }} {{ $order->lastname }}</li>
            <li><strong>Email:</strong> {{ $order->email }}</li>
            <li><strong>Phone Number:</strong> {{ $order->phone }}</li>
        </ul>

        @foreach($order->orderItems as $item)
        <h2>Event Details</h2>
        <ul>
            <li><strong>Event Name:</strong> {{ $item->ticket->concert->name }}</li>
            <li><strong>Event Date and Time:</strong> {{ $item->ticket->concert->date }}</li>
            <li><strong>Event Venue:</strong> {{ $item->ticket->concert->venue }}</li>
        </ul>

        <h2>Ticket Details</h2>
        <ul>
            <li><strong>Number of Tickets:</strong> {{ $item->quantity }}</li>
            <li><strong>Ticket Type:</strong> {{ $item->ticket->type }}</li>
            <li><strong>Price:</strong> {{ $item->ticket->price }}</li>
        </ul>
        @endforeach

        <h2>Customer Support</h2>
        <p>If you have any questions or need assistance, please contact our customer support:</p>
        <p>Email: support@example.com</p>
        <p>Phone: (123) 456-7890</p>

        <h2>Additional Information</h2>
        <p>For more information, please visit our <a href="#">FAQ</a> page.</p>
        <p>For our refund and cancellation policy, please refer to our <a href="#">Terms and Conditions</a>.</p>

        <p>You can complete your payment using the following link:</p>
        <a href="{{ $paymentUrl }}" class="btn">Complete Payment</a>
        <p class="footer">Thank you for choosing our service!</p>
    </div>
</body>

</html>