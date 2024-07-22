<x-layout>
    <x-header></x-header>
    <section class="pb-3 my-4">
        <div class="container">
            <div class="row">
                <div class="col events">
                    <div class="rounded d-flex">
                        <p class="rounded-list">{{ $ticketCount }} ticket types</p>
                        <P class="rounded-list ms-3"><i class="bi bi-calendar"></i></P>
                    </div>

                    <div class="concert-detail border mt-3 p-3" style="border-radius: 24px; line-height: 5px;">
                        <h1>{{ $concert->name }}</h1>
                        <p class="fs-5">{{ $concert->description }}</p>
                        <p class="fs-5 my-4"><span class="fw-bold">Date:</span> {{ \Carbon\Carbon::parse($concert->date)->format('d M Y, h:i A') }}</p>
                        <p class="fs-5"><span class="fw-bold">Venue:</span> {{ $concert->venue }}</p>
                    </div>

                    <ul class="event-list mt-3">
                        @foreach($concert->tickets as $ticket)
                        <li class="event-item">
                            <a href="{{ url('/ticket/' . $ticket['id']) }}" class="event-link">
                                <section class="details-section">
                                    <h4 class="event-title">{{ $ticket['type'] }}</h4>
                                    <h5 class="event-time">Available: {{ $ticket['quantity'] }}</h5>
                                </section>
                                <section class="price-section">
                                    <p style="font-size: large;"><i class="bi bi-ticket-fill me-2" style="color:#F0B619;"></i>Rp.{{ number_format($ticket->price, 2) }}</p>
                                </section>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4 d-none d-lg-block side-link-events">
                    <a href="" class="fw-bold"><i class="bi bi-calendar2-event-fill mx-2"></i>{{ $ticketCount }} tickets</a>
                    <a href="#ticket-info" class="fw-bold"><i class="bi bi-info-circle-fill mx-2"></i>ticket info</a>
                    <div class="guarantee my-4 p-3" style="background-color: #F5F7F8; border-radius: 16px;">
                        <div class="align-items-center">
                            <div class="row">
                                <div class="col">
                                    <i class="bi bi-shield-fill-check" style="font-size: 2rem;"></i>
                                    <span style="font-weight: bold; margin-left: 5px;">100% buyer guarantee</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <i class="bi bi-patch-check-fill" style="font-size: 2rem;"></i>
                                    <span style="font-weight: bold; margin-left: 5px;">100% buyer guarantee</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>