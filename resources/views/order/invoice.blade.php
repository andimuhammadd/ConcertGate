<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="86" height="86" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <h3 class="text-center">Thankyou!</h3>
            <p class="text-center">Transaction Id : {{$order->payments->first()->transaction_id}}</p>
            <div class="col-md-6">

                <strong>{{$order->firstname}},</strong>
                <p>Thankyou for your purchase, Please find your payment detail below.</p>
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Detail Pesanan</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama:</th>
                                    <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No Hp:</th>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email:</th>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total Pembayaran:</th>
                                    <td>Rp. {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status:</th>
                                    <td>{{ ucfirst($order->status) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="text-center mt-3">Please check your email. Your ticket has been sent to your registered email address.</p>
            </div>
        </div>
    </div>
</x-layout>