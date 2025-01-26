<header>
    <nav class="navbar navbar-expand-lg bg-body-white p-4" style="border-bottom: 5px solid hsla(0, 0%, 80%, 0.2);">
        <div class="container-fluid mb-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/LOGO.svg') }}" width="70px;" height="70px">
            </a>
            <a class="navbar-brand p-2 no-style" style="color: black;" href="{{ url('/') }}"><b>Sağlık</b>&nbsp;Pusulam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-5">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/') }}">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/about-us') }}">Hakkımızda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/contact') }}">İletişim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/sss') }}">SSS</a>
                    </li>
                    <a href="{{ url('/account/profile') }}"><img src="{{ asset('assets/img/user-icon.jpg') }}" width="50px;" height="50px" style="opacity: 0.9;"></a>
                    <button type="button" class="btn btn-primary rounded-4 shadow" onclick="location.href='{{ url('/account/register') }}'">Hemen Katılın</button>
                </ul>
            </div>
        </div>
    </nav>
</header>