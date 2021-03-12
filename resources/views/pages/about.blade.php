@extends('layouts.inner')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/timeline.css">
@endsection

@section('content')
    <section class="container m-auto mt-16">
        <img style="width: 180px;" class="m-auto border rounded-full" src="/assets/images/me.jpg" alt="Aryan Arabshahi">
        <div class="page-content text-gray-desc mt-8">
            I'm Aryan Arabshahi.
            I born on 28 of April 1991. I studied mechanical engineering at university but the truth is that physics was a little bit boring to me. So, I drank my cup of coffee and start to code and everything began.
            I'm a full-time programmer since 2013 and worked on various projects for various companies.
            I'm a full-stack developer but I worked as a back-end developer more than everything.
        </div>

        <div class="mt-8">
            <div class="timeline">

                <div class="timeline__event animated flipInX">
                    <div class="timeline__event__date bg-purple-default text-white font-medium text-lg">
                        2020 - Now
                    </div>
                    <div class="timeline__event__content">
                        <div class="timeline__event__title font-medium text-lg">
                            Farabeen
                        </div>
                        <div style="font-size: 15px; margin-top: 6px;" class="timeline__event__description text-gray-desc">
                            Working as a back-end developer and sysadmin on an online shopping service and an online English learning application
                            implemented with Laravel and Express frameworks. Also used Docker, Python, Bash for the automatic build process and the deployment.
                        </div>
                    </div>
                </div>

                <div class="timeline__event animated flipInX">
                    <div class="timeline__event__date bg-purple-default text-white font-medium text-lg">
                        2019 - 2020
                    </div>
                    <div class="timeline__event__content">
                        <div class="timeline__event__title font-medium text-lg">
                            Atrisa
                        </div>
                        <div style="font-size: 15px; margin-top: 6px;" class="timeline__event__description text-gray-desc">
                            Worked as a back-end developer and sysadmin on an online Fax service
                            (No further information is available due to the information security policy)
                        </div>
                    </div>
                </div>

                <div class="timeline__event animated flipInX">
                    <div class="timeline__event__date bg-purple-default text-white font-medium text-lg">
                        2013 - 2019
                    </div>
                    <div class="timeline__event__content">
                        <div class="timeline__event__title font-medium text-lg">
                            Rahco
                        </div>
                        <div style="font-size: 15px; margin-top: 6px;" class="timeline__event__description text-gray-desc">
                            Worked as a full-stack developer on various projects as the team lead.
                            The most important one is an online SMS provider implemented with PHP and Python.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
