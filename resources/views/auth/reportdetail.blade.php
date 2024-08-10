@extends('layouts.auth')

@section('content')
<h1>Detail Konser</h1>
<div class="card">
    <div class="card-header">
        <h2>{{ $concert->name }}</h2>
        <a href="{{ route('admin.report.export', $concert->id) }}" class="btn btn-success">Export to Excel</a>
    </div>
    <div class="card-body">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($concert->date)->format('F d, Y') }}</p>
        <p><strong>Deskripsi:</strong> {{ $concert->description }}</p>
        <p><strong>Venue:</strong> {{ $concert->venue }}</p>
        <p><strong>Tiket Terjual:</strong> {{ $concert->tickets->sum(fn($ticket) => $ticket->orderItems->sum('quantity')) }}</p>
        <p><strong>Total Keuntungan:</strong> Rp. {{ number_format($concert->tickets->sum(fn($ticket) => $ticket->orderItems->sum(fn($item) => $item->price * $item->quantity)), 2, ',', '.') }}</p>

        <h3>Daftar Tiket</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Tiket</th>
                    <th>Harga</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Keuntungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($concert->tickets as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->type }}</td>
                    <td>Rp. {{ number_format($ticket->price, 2, ',', '.') }}</td>
                    <td>{{ $ticket->orderItems->sum('quantity') }}</td>
                    <td>Rp. {{ number_format($ticket->orderItems->sum(fn($item) => $item->price * $item->quantity), 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Pesanan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Jenis Tiket</th>
                    <th>Harga Total</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($concert->tickets->flatMap->orderItems as $orderItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $orderItem->order->firstname }} {{ $orderItem->order->lastname }}</td>
                    <td>{{ $orderItem->order->email }}</td>
                    <td>{{ $orderItem->order->phone }}</td>
                    <td>{{ $orderItem->ticket->type }}</td>
                    <td>Rp. {{ number_format($orderItem->price * $orderItem->quantity, 2, ',', '.') }}</td>
                    <td>
                        @if($orderItem->order->payments->isNotEmpty())
                        {{ $orderItem->order->payments->first()->payment_method }}
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection