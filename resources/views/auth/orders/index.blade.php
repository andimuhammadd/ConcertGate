@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Kelola Pesanan</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal</th>
                    <th>Harga Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($orderItems->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No transactions found</td>
                </tr>
                @else
                @foreach($orderItems as $orderItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $orderItem->order->email }}</td>
                    <td>{{ $orderItem->order->created_at }}</td>
                    <td>{{ $orderItem->order->total_price }}</td>
                    <td>{{ $orderItem->order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $orderItem->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection