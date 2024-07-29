<!DOCTYPE html>
<html>

<head>
    <title>Concert Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            width: 600px;
            margin: 20px auto;
        }

        .ticket h1 {
            font-size: 24px;
        }

        .ticket p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h1>{{ $order->orderItems->first()->ticket->concert->name }}</h1>
        <p><strong>Date:</strong> {{ $order->orderItems->first()->ticket->concert->date }}</p>
        <p><strong>Venue:</strong> {{ $order->orderItems->first()->ticket->concert->venue }}</p>
        <p><strong>Ticket Type:</strong> {{ $order->orderItems->first()->ticket->type }}</p>
        <p><strong>Price:</strong> {{ $order->orderItems->first()->ticket->price }}</p>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
    </div>
</body>

</html>