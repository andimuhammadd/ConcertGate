@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                    <td>{{ $orderItem->order->payments->first()->payment_method ?? 'N/A' }}</td>
                    <td>{{ $orderItem->order->total_price }}</td>
                    <td>{{ $orderItem->order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $orderItem->id) }}" class="btn btn-primary">View</a>
                        <form action="{{ route('admin.orders.destroy', $orderItem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection