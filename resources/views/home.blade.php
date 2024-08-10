<x-layout>
    <x-header></x-header>
    <section>
        <div class="container p-4">
            <div class="col d-flex">
                <P class="rounded-list">21 April - 20 Mai</P>
                <P class="rounded-list ms-3"><i class="bi bi-calendar"></i></P>
            </div>
            <div class="concert-px-2 concert-mt-3">
                <div class="row  concert-p-4 concert-rounded-4">
                    <div class="concert-col concert-artist-details">
                        <!-- Daftar Acara Mendatang -->
                        <section class="concert-upcoming-events">
                            <h2>Konser Mendatang</h2>

                            @if ($upcomingConcerts->isEmpty())
                            <p>No upcoming concerts available.</p>
                            @else
                            @foreach ($upcomingConcerts as $concert)
                            <div class="concert-event-card">
                                <div class="concert-event-image">
                                    <img src="{{ asset('images/band.jpg') }}" alt="{{ $concert->name }}">
                                </div>
                                <div class="concert-event-info">
                                    <h3>{{ $concert->name }}</h3>
                                    <p>Tanggal: {{ \Carbon\Carbon::parse($concert->date)->format('F d, Y') }}</p>
                                    <p>Tempat: {{ $concert->venue }}</p>
                                    <div class="button-container">
                                        <a href="" class="concert-btn">Buy Ticket</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </section>
                    </div>
                    <div class="col-lg-4 d-none d-lg-block">
                        <p class="border p-2 rounded-5 text-light" style="background-color: #3399FF; font-weight:bold"><i class="bi bi-dot "></i> tickets info</p>
                        <p class="border p-2 rounded-5 text-light" style="background-color: #3399FF; font-weight:bold"><i class="bi bi-dot "></i> events info</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Artist section-->

    <section class="p-4">
        <div class="row">
            <div class="col-lg-8 col-md-4">
                <h5 class="fw-bold">Events Info</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed illum tempore alias. Quae, accusantium! Voluptas repellat dolorem ex provident. Vero inventore molestiae optio perferendis in dignissimos harum adipisci labore commodi.</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat cupiditate ullam saepe aut in sequi porro minima odio autem consequatur accusantium id vitae impedit ex, nemo eos repudiandae ducimus. At.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p>
                <h5 class="fw-bold">Where Can I Buy Cheap Big East Tournament Tickets?</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel vero commodi assumenda iste. Ab repellendus tempore blanditiis deserunt! Temporibus quibusdam odit magnam laboriosam esse dolores recusandae officiis qui molestiae non?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate distinctio, nisi quae maxime ipsa pariatur alias voluptatibus natus suscipit quod cumque, accusantium ullam neque, sed repellat placeat impedit magnam officia?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum est provident totam, assumenda, quas beatae et repudiandae molestiae officia aperiam tempora iure. Nesciunt delectus voluptate minus nemo eveniet incidunt aperiam!</p>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <p class="border p-2 rounded-5 text-light" style="background-color: #3399FF; font-weight:bold"><i class="bi bi-dot "></i> ticket info</p>
            </div>
        </div>

    </section>
</x-layout>