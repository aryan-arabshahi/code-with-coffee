@extends('layouts.inner')

@section('content')
    <section class="container m-auto mt-20">
        <div class="font-medium text-3xl text-center">Search For Article!</div>
        <div style="width: 520px;" class="input-with-icon bg-white relative mt-6 m-auto">
            <input type="text" name="search" placeholder="Search for article">
            <button class="text-purple-default text-xl absolute right-0 top-0 bottom-0 rounded-r-full px-4">
                <i class="fa fa-search opacity-75"></i>
            </button>
        </div>
        <div class="text-center mt-3 text-sm">
            <span class="text-gray-desc">Popular help topics:</span>
            <a class="text-purple-default" href="/categories/Back-End">Back-End</a>,
            <a class="text-purple-default" href="/categories/Front-End">Front-End</a>,
            <a class="text-purple-default" href="/categories/DevOps">DevOps</a>
        </div>
    </section>

    <section class="container relative m-auto py-10 mt-12">
        <div class="grid grid-cols-3 gap-6 mt-10">

            @foreach ($articles as $article)

                @include('partials.image_box', [
                    'image' => "{$article->image_url}/800/533",
                    'name' => $article->name,
                    'description' => $article->description,
                    'link' => "/articles/" . Str::slug($article->name, '-'),
                ])

            @endforeach

        </div>

        <div>
            {{$articles->links()}}
        </div>

    </section>
@endsection
