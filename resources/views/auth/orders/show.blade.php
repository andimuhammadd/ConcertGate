@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order #{{ $orderItem->order->id }}</h5>
            <p><strong>Customer:</strong> {{ $orderItem->order->email }}</p>
            <p><strong>Concert:</strong> {{ $orderItem->ticket->concert->name }}</p>
            <p><strong>Ticket Type:</strong> {{ $orderItem->ticket->type }}</p>
            <p><strong>Total Price:</strong> {{ $orderItem->order->total_price }}</p>
            <p><strong>Status:</strong> {{ $orderItem->order->status }}</p>

            <form action="{{ route('admin.orders.update', $orderItem->order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="Unpaid" {{ $orderItem->order->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="Paid" {{ $orderItem->order->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Canceled" {{ $orderItem->order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Order</button>
            </form>
        </div>
    </div>
</div>
@endsection