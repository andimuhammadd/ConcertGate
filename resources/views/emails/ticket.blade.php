<!DOCTYPE html>
<html>

<head>
    <title>Your Concert Ticket</title>
</head>

<body>
    <h1>Here is your ticket for the concert!</h1>
    <p>Dear {{ $order->firstname }} {{ $order->lastname }},</p>
    <p>Thank you for your purchase. Your ticket is attached to this email.</p>
    <p>Order ID: {{ $order->id }}</p>
    <p>Enjoy the concert!</p>
</body>

</html>