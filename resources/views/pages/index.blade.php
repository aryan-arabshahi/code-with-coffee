@extends('layouts.index')

@section('styles')
    <link rel="stylesheet" href="/assets/js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/js/owlcarousel/owl.theme.default.min.css">
@endsection

@section('content')

    @include('partials.navigation')

    @include('partials.headers.index')

    @include('partials.sections.categories')

    @include('partials.sections.latest_articles')

    @include('partials.sections.projects')

    @include('partials.sections.about')

    @include('partials.sections.contact')

@endsection

@section('scripts.end')
    <script src="/assets/js/owlcarousel/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                margin: 30,
            });
        });
    </script>
@endsection
