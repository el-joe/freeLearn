<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Learn</title>

    @include('web.layout.styles')
    @stack('styles')
</head>

<body class="antialiased">
    @include('web.layout.navbar')
    <div style="min-height: calc(100vh - 440px)">

        @yield('content')
    </div>
    @include('web.layout.footer')

    @include('web.layout.scripts')
    @stack('scripts')
</body>

</html>
