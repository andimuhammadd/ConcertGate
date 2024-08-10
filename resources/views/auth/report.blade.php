@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Laporan Penjualan Tiket</h1>

    <!-- Tambahkan tombol untuk mengekspor ke Excel -->
    <a href="{{ route('export.sales.report') }}" class="btn btn-success mb-3">Ekspor ke Excel</a>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Keuntungan</h5>
                    <p class="card-text">Rp. {{ number_format($totalSales, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Tiket Yang Terjual</h5>
                    <p class="card-text">{{ $totalTicketsSold }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Daftar Konser</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Konser</th>
                <th>Tanggal</th>
                <th>Tiket terjual</th>
                <th>Total Keuntungan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($concerts as $concert)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $concert->name }}</td>
                <td>{{ \Carbon\Carbon::parse($concert->date)->format('F d, Y') }}</td>
                <td>{{ $concert->total_sold }}</td>
                <td>Rp. {{ number_format($concert->total_revenue, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.report.detail', $concert->id) }}" class="btn btn-primary">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Detail Pembayaran</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ORDER ID</th>
                <th>Email</th>
                <th>Total Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->order_id }}</td>
                <td>{{ $payment->order->email }}</td>
                <td>Rp. {{ number_format($payment->order->total_price, 2, ',', '.') }}</td>
                <td>{{$payment->payment_status }}</td>
                <td>{{$payment->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection