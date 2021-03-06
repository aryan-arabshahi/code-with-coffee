<section class="container relative m-auto py-10 mt-24">
    <h2 class="text-4xl text-center font-medium">Latest Articles</h2>
    <div class="px-4 sm:px-0 owl-carousel mt-10">

        @foreach ($latestArticles as $article)

            @include('partials.image_box', [
                'image' => "{$article->image_url}/800/533",
                'name' => $article->name,
                'description' => $article->description,
                'link' => "/articles/" . generate_slug($article->name),
            ])

        @endforeach

    </div>
</section>