<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Invoice</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <table>
                    <tr>
                        <td>Nama: </td>
                        <td>: {{$order->firstname}} {{$order->lastname}}</td>
                    </tr>
                    <tr>
                        <td>No Hp: </td>
                        <td>: {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>: {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Total Price:</td>
                        <td>: {{$order->total_price}}</td>
                    </tr>
                    <tr>
                        <td>Status: </td>
                        <td>: {{$order->status}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>