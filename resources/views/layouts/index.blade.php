<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/style.css">
    @yield('styles')
    @yield('scripts.start')
    <title>{{ ($title) ?? config('app.name') }}</title>
</head>
<body>

    @yield('content')

    @include('partials.footer')

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/app.js"></script>
    @yield('scripts.end')

</body>
</html>