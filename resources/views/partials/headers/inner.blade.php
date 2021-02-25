<section class="inner-header">
    <div class="container m-auto pt-20">
        @if (isset($header))
            <h1 class="text-4xl font-semibold mb-2">{{$header}}</h1>
        @endif
        @include('partials.breadcrumb')
    </div>
    <div class="shape-bottom"></div>
</section>