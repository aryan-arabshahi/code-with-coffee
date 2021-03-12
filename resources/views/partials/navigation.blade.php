<nav id="navigation">
    <div class="container m-auto relative">
        <ul class="flex ml-12">
            <li><a href="/">Home</a></li>
            <li><a href="{{route('home.articles')}}">Articles</a></li>
            <li><a href="{{route('home.about')}}">About</a></li>
            <li><a href="{{route('home.contact')}}">Contact</a></li>
        </ul>
        <a style="top: 8px;" class="absolute left-0" href="/" title="{{config('app.name')}}">
            <img class="block w-10" src="/assets/images/code-with-coffee.png" alt="{{config('app.name')}}">
        </a>
    </div>
</nav>