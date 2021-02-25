@extends('layouts.index')

@section('styles')
    <link rel="stylesheet" href="/assets/js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/js/owlcarousel/owl.theme.default.min.css">
@endsection

@section('content')

    @include('partials.headers.index')

    @include('partials.sections.icon_box')

    @include('partials.sections.image_box')

    @include('partials.sections.vertical_icon_list')

    @include('partials.sections.image_description')

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
