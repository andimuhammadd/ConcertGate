<x-layout>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="ticket border" style="border-radius: 24px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="row">
                        <div class="col-4">
                            <div class="img-wrapper" style="width: 100%; height: 100%;">
                                <img src="{{ url('/images/band.jpg') }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-top-left-radius: 24px; border-bottom-left-radius: 24px;">
                            </div>
                        </div>
                        <div class="col p-3" style="line-height: 8px;">
                            <h5 class="fw-bold">{{ $concert->name }}</h5>
                            <p class="fs-5">{{ \Carbon\Carbon::parse($concert->date)->format('D M d Y h:i A') }}</p>
                            <p class="fs-5">{{ $concert->venue }}</p>
                            <p style="font-size: small;">Alamat Konser</p>
                            <div class="row">
                                <div class="col">
                                    <i class="bi bi-ticket-fill"></i> <span>Section: {{ $ticket->type }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seats my-3 px-3 py-2 border" style="border-radius: 24px;">
                    <h5 class="fw-bold mb-4"><i class="bi bi-check-circle-fill"></i> Perks</h5>
                    <div class="seat-detail" style="line-height: 5px;">
                        <p class="fs-5"><i class="bi bi-ticket-detailed"></i> Paper ticket (keep as a souvenir!)</p>
                    </div>
                </div>
                <div class="seats my-3 px-3 py-2 border" style="border-radius: 24px;">
                    <h5 class="fw-bold mb-4"><i class="bi bi-check-circle-fill"></i> Your Seats</h5>
                    <div class="seat-detail" style="line-height: 5px;">
                        <p class="fw-bold">Section: {{ $ticket->type }}</p>
                        <p class="fs-5">1 Ticket</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="form">
                    <h5>Contact Information</h5>
                    <p>We'll use this information to send you updates on your order</p>
                    <form id="orderForm" action="{{ route('order.store', ['ticketId' => $ticket->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                        </div>
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Continue</button>
                    </form>
                </div>

                <div class="guarantee my-4 p-3" style="background-color: #F5F7F8; border-radius: 16px;">
                    <div class="align-items-center">
                        <div class="row">
                            <div class="col">
                                <i class="bi bi-shield-fill-check" style="font-size: 2rem;"></i>
                                <span style="font-weight: bold; margin-left: 5px;">100% buyer guarantee <a href="#">Learn More</a></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <i class="bi bi-patch-check-fill" style="font-size: 2rem;"></i>
                                <span style="font-weight: bold; margin-left: 5px;">100% buyer guarantee <a href="#">Learn More</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="order-details">
                            <p><strong>Concert:</strong> {{ $concert->name }}</p>

                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($concert->date)->format('D M d Y h:i A') }}</p>

                            <p><strong>Section:</strong> {{ $ticket->type }}</p>

                            <p><strong>Email:</strong> <span id="confirmEmail"></span></p>

                            <p><strong>Name:</strong> <span id="confirmName"></span></p>

                            <p><strong>Phone:</strong> <span id="confirmPhone"></span></p>

                            <p><strong>Total Price:</strong> {{ $ticket->price }}</span></p>

                            <p class="text-center fw-bold">Are you sure you want to place this order?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmOrderButton">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your custom JavaScript here -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('orderForm');
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'), {});
            const confirmButton = document.getElementById('confirmOrderButton');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Update modal with form data
                document.getElementById('confirmEmail').textContent = document.getElementById('email').value;
                document.getElementById('confirmName').textContent = `${document.getElementById('first_name').value} ${document.getElementById('last_name').value}`;
                document.getElementById('confirmPhone').textContent = document.getElementById('phone').value;

                // Show the modal
                modal.show();
            });

            confirmButton.addEventListener('click', function() {
                form.submit();
            });
        });
    </script>
</x-layout>