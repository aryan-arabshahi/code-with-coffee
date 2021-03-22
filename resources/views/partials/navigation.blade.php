<nav id="navigation">
    <div class="container m-auto relative">
        <ul id="navigation-menu" class="pt-12 hidden sm:block sm:pt-0 sm:flex sm:ml-12">
            <li><a class="py-3 sm:py-5" href="/">Home</a></li>
            <li><a class="py-3 sm:py-5" href="{{route('home.articles')}}">Articles</a></li>
            <li><a class="py-3 sm:py-5" href="{{route('home.about')}}">About</a></li>
            <li><a class="py-3 sm:py-5" href="{{route('home.contact')}}">Contact</a></li>
        </ul>
        <a id="navigation-logo" class="absolute left-0 ml-5 sm:ml-0" href="/" title="{{config('app.name')}}">
            <img class="block w-10" src="/assets/images/code-with-coffee.png" alt="{{config('app.name')}}">
        </a>
        <i id="navigation-bars" class="fa fa-bars block transform transition duration-300 sm:hidden"></i>
    </div>
</nav>