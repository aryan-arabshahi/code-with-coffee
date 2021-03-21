<section class="inner-header">
    <div class="px-6 container m-auto pt-20 sm:px-0">
        @if (isset($header))
            <h1 class="text-2xl font-semibold mb-2 sm:text-4xl">{{$header}}</h1>
        @endif
        @include('partials.breadcrumb')
    </div>
    <div class="shape-bottom"></div>
</section>