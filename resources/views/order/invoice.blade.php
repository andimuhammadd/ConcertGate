<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Invoice</h5>
                    </div>
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
                        <div class="text-center">
                            <button class="btn btn-primary">Lakukan Pembelian Lain</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>