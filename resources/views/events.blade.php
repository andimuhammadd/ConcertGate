<x-layout>
    <section class="pb-3 my-4">
        <div class="container">
            <div class="row">
                <div class="col events">
                    <div class="rounded d-flex">
                        <P class="rounded-list">6 events</P>
                        <P class="rounded-list ms-3"><i class="bi bi-calendar"></i></P>
                    </div>
                    <ul class="event-list mt-3">
                        <li class="event-item">
                            <a href="{{ url('/tickets') }}" class="event-link">
                                <section class="date-section">
                                    <ul class="date-details">
                                        <li class="fw-bold" style="font-size:small;">Mar</li>
                                        <li class="fs-4 fw-bolder">12</li>
                                        <li style="font-size:small;">Wed</li>
                                    </ul>
                                </section>
                                <section class="details-section">
                                    <h4 class="event-title">Big East Men's Basketball Tournament</h4>
                                    <h5 class="event-time">4:00 pm - Wembley - London</h5>
                                </section>
                                <section class="price-section">
                                    <p><i class="bi bi-ticket-fill" style="color:#F0B619;"></i> From 300k+</p>
                                </section>
                            </a>
                        </li>
                        <li class="event-item">
                            <a href="{{ url('/tickets') }}" class="event-link">
                                <section class="date-section">
                                    <ul class="date-details">
                                        <li class="fw-bold" style="font-size:small;">Mar</li>
                                        <li class="fs-4 fw-bolder">12</li>
                                        <li style="font-size:small;">Wed</li>
                                    </ul>
                                </section>
                                <section class="details-section">
                                    <h4 class="event-title">Big East Men's Basketball Tournament</h4>
                                    <h5 class="event-time">4:00 pm - Wembley - London</h5>
                                </section>
                                <section class="price-section">
                                    <p><i class="bi bi-ticket-fill" style="color:#F0B619;"></i> From 300k+</p>
                                </section>
                            </a>
                        </li>
                        <li class="event-item">
                            <a href="{{ url('/tickets') }}" class="event-link">
                                <section class="date-section">
                                    <ul class="date-details">
                                        <li class="fw-bold" style="font-size:small;">Mar</li>
                                        <li class="fs-4 fw-bolder">12</li>
                                        <li style="font-size:small;">Wed</li>
                                    </ul>
                                </section>
                                <section class="details-section">
                                    <h4 class="event-title">Big East Men's Basketball Tournament</h4>
                                    <h5 class="event-time">4:00 pm - Wembley - London</h5>
                                </section>
                                <section class="price-section">
                                    <p><i class="bi bi-ticket-fill" style="color:#F0B619;"></i> From 300k+</p>
                                </section>
                            </a>
                        </li>
                    </ul>
                    <section id="ticket-info">
                        <div class="container">
                            <h5 class="fw-bold">Tickets Info</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed illum tempore alias. Quae, accusantium! Voluptas repellat dolorem ex provident. Vero inventore molestiae optio perferendis in dignissimos harum adipisci labore commodi.</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat cupiditate ullam saepe aut in sequi porro minima odio autem consequatur accusantium id vitae impedit ex, nemo eos repudiandae ducimus. At.</p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 d-none d-lg-block side-link-events">
                    <a href="" class="fw-bold"><i class="bi bi-calendar2-event-fill mx-2"></i> 6 events</a>
                    <a href="#ticket-info" class="fw-bold"><i class="bi bi-info-circle-fill mx-2"></i>ticket info</a>
                </div>
            </div>
        </div>
    </section>
</x-layout>