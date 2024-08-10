<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light p-3 h-10 fixed-top" id="headerNav" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:#FFFFFF">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="bi bi-music-note-beamed" style="font-size: 2rem; font-weight:bold; color:#3399FF"> Concert Gate</i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ url('/concerts') }}">Concerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ url('/contact') }}">Contact US</a>
                </li>
            </ul>
            <div class="d-flex">


            </div>
        </div>
    </div>
</nav>