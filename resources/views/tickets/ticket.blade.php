<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .ticket {
            background-image: url('https://th.bing.com/th/id/OIP.GOqlRRTt6BZAFRPN-GqYPQHaE9?rs=1&pid=ImgDetMain');
            border: 2px solid #d83565;
            color: #f4f4f4;
            border-radius: 10px;
            width: 600px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: auto;
            position: relative;
            overflow: hidden;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            color: #d83565;
        }

        .details {
            margin-top: 40px;
            /* Ensure details start below the strip */
        }

        .details p {
            margin: 5px 0;
            font-size: 16px;
            line-height: 1.5;
        }

        .artist {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #d83565;
            margin-bottom: 10px;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        /* Style for the Ticket Number */
        .ticket-number {
            font-weight: bold;
            color: #d83565;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="">
            <h1>{{ $concert->name }} Ticket</h1>
        </div>
        <div class="details">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($concert->date)->format('F d, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($concert->date)->format('g:i A') }}</p>
            <p><strong>Venue:</strong> {{ $venue }}</p>
            <p><strong>Ticket Type:</strong> {{ $ticketType }}</p>
            <p class=""><strong>Ticket Number:</strong> #{{ $ticketNumber }}</p>
        </div>
        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>

</html>