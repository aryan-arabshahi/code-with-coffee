@extends('layouts.inner')

@section('content')
    <section class="px-6 container m-auto mt-16 sm:px-0">
        <h1 class="font-medium text-3xl border-b pb-4 mb-6">{{$page->name}}</h1>
        <div class="page-content text-gray-desc">
            {!! $page->content !!}
        </div>
    </section>
@endsection
