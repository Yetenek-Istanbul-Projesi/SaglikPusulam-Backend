<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Sayfası')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body>

    {{-- <div class="loader-container"> --}}
    {{--    <div class="medical-loader"></div> --}}
    {{-- </div> --}}

    @include('layouts.partials.header')

    <main>
        <nav aria-label="breadcrumb" style="padding: 2rem; margin-top: 10px; margin-left: 21px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pages/blog') }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pages/blog/@yield('slug','')') }}" class="text-primary">@yield('title', 'Blog Sayfası')</a></li>
            </ol>
        </nav>
        <div class="container" style="padding-left: 50px;">
             <h1 class="text-primary col-9">@yield('title', 'Blog Sayfası')</h1>

             <div class="row mt-5">
        <!-- Sol içerik kısmı -->
        <div class="col-lg-8 col-md-6 mb-4">
            <div class="col-lg-11 col-md-8 mb-7">
                @yield('content')
            </div>
        </div>

        <!-- Sağ tarafta kart (sidebar) -->
        @yield('sidebar')
             </div>
        </div>
    </main>

    @include('layouts.partials.footer')
    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
