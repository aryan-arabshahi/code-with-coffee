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

    @include('partials.headers.inner')

    @yield('content')

    @include('partials.footer')

    @yield('scripts.end')

</body>
</html>