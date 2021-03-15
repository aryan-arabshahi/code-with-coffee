@extends('layouts.inner')

@section('content')
    <section class="px-4 sm:px-0 container m-auto mt-16">
        <h1 class="font-medium text-3xl border-b pb-4 mb-6">{{$article->name}}</h1>
        @include('partials.author', [
            'date' => humanize_date($article->created_at),
        ])
        <div class="page-content text-gray-desc">
            {!! $article->content !!}
        </div>
    </section>
@endsection
