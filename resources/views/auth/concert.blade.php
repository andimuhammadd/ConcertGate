@extends('layouts.auth')

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Concert List</h5>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                Add Data Concert
            </button>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Venue</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($concerts->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No concerts found</td>
                            </tr>
                        @else
                            @foreach($concerts as $concert)
                            <tr>
                                <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                <td class="border-bottom-0">{{ $concert->id }}</td>
                                <td class="border-bottom-0">{{ $concert->name }}</td>
                                <td class="border-bottom-0">{{ $concert->description }}</td>
                                <td class="border-bottom-0">{{ $concert->date }}</td>
                                <td class="border-bottom-0">{{ $concert->venue }}</td>
                                <td class="border-bottom-0">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $concert->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $concert->id }}">
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

<!-- Modal tambah concert -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Concert</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.concert.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Concert Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="venue" class="form-label">Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Concert</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit concert -->
@foreach($concerts as $concert)
<div class="modal fade" id="ModalEdit{{ $concert->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Concert Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.concert.update', $concert->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Concert Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $concert->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $concert->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" value="{{ $concert->date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="venue" class="form-label">Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" value="{{ $concert->venue }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tickets" class="form-label">Tickets</label>
                        <input type="number" class="form-control" id="tickets" name="tickets" value="{{ $concert->tickets }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Concert</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal delete concert -->
@foreach($concerts as $concert)
<div class="modal fade" id="ModalDelete{{ $concert->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are You Sure You Want To Delete?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.concert.destroy', $concert->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <p>Deleting this concert cannot be undone.</p>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
