<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ ($site_description) ?? __('app.header.description') }}">
    <meta name="author" content="Aryan Arabshahi">
    <link rel="stylesheet" href="/assets/css/style.css">
    @yield('styles')
    @yield('scripts.start')
    <title>{{ get_site_title(($site_title) ?? __('app.header.title'), appendAppName: false) }}</title>
</head>
<body>

    @include('partials.navigation')

    @include('partials.headers.inner')

    @yield('content')

    @include('partials.footer')

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script type="text/javascript">
        // Change navigation bar with scroll
        checkNavigationBar();
    </script>
    @yield('scripts.end')

</body>
</html>