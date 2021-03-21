<footer class="overflow-hidden footer mt-24">
    <div class="container m-auto">
        <div class="flex flex-col flex-col-reverse lg:flex-row">
            <div class="px-8 mt-10 sm:px-16 lg:px-0 lg:mt-0 lg:w-4/12">
                <div class="font-medium text-center lg:text-left">
                    If you are interested in technology, you can follow me on:
                </div>
                <ul class="flex justify-center lg:justify-start mt-6">
                    <li>
                        <a class="icon-list-item" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="ml-4">
                        <a class="icon-list-item" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="ml-4">
                        <a class="icon-list-item" href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li class="ml-4">
                        <a class="icon-list-item" href="#">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="px-8 mt-10 sm:px-16 lg:px-0 lg:mt-0 lg:w-4/12 lg:pl-24">
                <div class="font-medium text-lg mb-2">Useful Links</div>
                <ul class="useful-links">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="{{route('home.articles')}}">Articles</a>
                    </li>
                    <li>
                        <a href="{{route('home.about')}}">About</a>
                    </li>
                    <li>
                        <a href="{{route('home.contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="px-8 mt-10 sm:px-16 lg:px-0 lg:mt-0 lg:w-4/12">
                <div class="font-medium text-lg mb-2">Newsletter</div>
                <div>
                    Subscribe newsletter to get the latest updates:
                </div>
                <form class="ajax-form" action="{{route('newsletter.subscribe')}}" method="POST" clearForm="true">
                    <div class="subscribe-button pr-32 bg-white rounded-full relative px-4 shadow-lg mt-5">
                        <input class="block w-full py-3 bg-transparent text-black-default" type="text" name="email" placeholder="Enter Your Email" autocomplete="off">
                        @include('partials.submit_button', [
                            'class' => 'btn-default btn-subscribe absolute right-0 top-0 bottom-0 rounded-r-full px-4',
                            'label' => 'Subscribe',
                        ])
                        <div class="form-errors absolute left-0 right-0 px-4 py-1" field="email"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copyrights-container container m-auto text-center text-sm border-t mt-6 py-6 flex items-center justify-center">
        <span class="mt-1">Copyrights © 2021</span>
        <a href="/" title="{{config('app.name')}}">
            <img class="inline-block w-8 ml-2" src="/assets/images/code-with-coffee.png" alt="{{config('app.name')}}">
        </a>
    </div>
    <div class="shape-top"></div>
</footer>