<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sağlık Pusulam')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body @yield('body-attr', '')>

{{--<div class="loader-container">--}}
{{--    <div class="medical-loader"></div>--}}
{{--</div>--}}

@include('layouts.partials.header')

<main @yield('main-attr', '')>
    @yield('content')
</main>

@include('layouts.partials.footer')
<!-- Scripts -->
@yield('scripts')
</body>

</html>
