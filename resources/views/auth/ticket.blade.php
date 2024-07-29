@extends('layouts.auth')

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Ticket List</h5>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                Add Ticket
            </button>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">No</th>
                            <th class="border-bottom-0">ID</th>
                            <th class="border-bottom-0">Concert</th>
                            <th class="border-bottom-0">Type</th>
                            <th class="border-bottom-0">Price</th>
                            <th class="border-bottom-0">Quantity</th>
                            <th class="border-bottom-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tickets->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No tickets found</td>
                            </tr>
                        @else
                            @foreach($tickets as $ticket)
                            <tr>
                                <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                <td class="border-bottom-0">{{ $ticket->id }}</td>
                                <td class="border-bottom-0">{{ $ticket->concert->name }}</td>
                                <td class="border-bottom-0">{{ $ticket->type }}</td>
                                <td class="border-bottom-0">{{ $ticket->price }}</td>
                                <td class="border-bottom-0">{{ $ticket->quantity }}</td>
                                <td class="border-bottom-0">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $ticket->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $ticket->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal Add Ticket -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="concert_id" class="form-label">Concert</label>
                        <select class="form-control" id="concert_id" name="concert_id" required>
                            @foreach(App\Models\Concert::all() as $concert)
                            <option value="{{ $concert->id }}">{{ $concert->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Ticket -->
@foreach($tickets as $ticket)
<div class="modal fade" id="ModalEdit{{ $ticket->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Ticket Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="concert_id" class="form-label">Concert</label>
                        <select class="form-control" id="concert_id" name="concert_id" required>
                            @foreach(App\Models\Concert::all() as $concert)
                            <option value="{{ $concert->id }}" @if($concert->id == $ticket->concert_id) selected @endif>{{ $concert->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{ $ticket->type }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $ticket->price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $ticket->quantity }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Delete Ticket -->
@foreach($tickets as $ticket)
<div class="modal fade" id="ModalDelete{{ $ticket->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are You Sure Want To Delete?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
